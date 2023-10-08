<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use LINE\Clients\MessagingApi\Model\ReplyMessageRequest;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Constants\HTTPHeader;
use LINE\Parser\EventRequestParser;
use LINE\Clients\MessagingApi\Model\StickerMessage;
use LINE\Clients\MessagingApi\Api\MessagingApiBlobApi;
use LINE\Clients\MessagingApi\Model\ImageMessage;
use LINE\Webhook\Model\MessageEvent;
use LINE\Parser\Exception\InvalidEventRequestException;
use LINE\Constants\MessageType;
use LINE\Parser\Exception\InvalidSignatureException;
use LINE\Webhook\Model\TextMessageContent;
use LINE\Webhook\Model\StickerMessageContent;
use LINE\Webhook\Model\ImageMessageContent;
use Illuminate\Support\Facades\Storage;


class LineBotController extends Controller
{

    public function getMessageContent($messageId)
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://api-data.line.me/v2/bot/message/' . $messageId . '/content';

        try {
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('linebot.channel_access_token'),
                ]
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            Log::error('Failed to get message content: ' . $e->getMessage());
            return null;
        }
    }

    public function callback(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $config = new \LINE\Clients\MessagingApi\Configuration();
        $config->setAccessToken(config('linebot.channel_access_token'));
        $bot = new \LINE\Clients\MessagingApi\Api\MessagingApiApi(
            client: $client,
            config: $config,
        );

        $body = $request->getContent();
        Log::info('body: ' . $body);

        $botBlob = new MessagingApiBlobApi(
            client: $client,
            config: $config,
        );

        $signature = $request->header(HTTPHeader::LINE_SIGNATURE);
        Log::info('signature: ' . $signature);
        if (empty($signature)) {
            return response('Bad Request: No signature', 400);
        }

        $secret = config('linebot.channel_secret');
        Log::info('secret: ' . $secret);

        // Signature verification
        $hash = hash_hmac('sha256', $body, $secret, true);
        $hashSignature = base64_encode($hash);
        if (!hash_equals($hashSignature, $signature)) {
            Log::error('Computed signature does not match.');
            return response('Invalid signature', 400);
        }

        // Parsing and handling events
        try {
            $parsedEvents = EventRequestParser::parseEventRequest($body, $secret, $signature);
        } catch (InvalidSignatureException $e) {
            Log::error('Invalid Signature: ' . $e->getMessage());
            return response('Bad Request: Invalid signature', 400);
        } catch (InvalidEventRequestException $e) {
            Log::error('Invalid Event Request: ' . $e->getMessage());
            return response('Bad Request: Invalid event request', 400);
        } catch (\Exception $e) {
            Log::error('General Error: ' . $e->getMessage());
            return response('Internal Server Error', 500);
        }

        foreach ($parsedEvents->getEvents() as $event) {
            if (!($event instanceof MessageEvent)) {
                Log::info('Non-message event has come');
                continue;
            }

            $message = $event->getMessage();
            Log::info('message: ' . json_encode($message));

            // Handle Text Messages
            if ($message instanceof TextMessageContent) {
                $replyText = $message->getText();
                Log::info('Reply text: ' . $replyText);

                if ($replyText === 'hello') {
                    $replyText = 'world';
                } elseif ($replyText === "show_playlist") {
                    $replyText = Playlist::inRandomOrder()->first()->name;
                } elseif ($replyText === "show_artists") {
                    $replyText = "";
                    $artists = Artist::take(10)->get();

                    foreach ($artists as $artist) {
                        $replyText .= $artist->name . "\n";
                    }
                }

                $this->replyText($bot, $event->getReplyToken(), $replyText);
            }

            // Handle Sticker Messages
            elseif ($message instanceof StickerMessageContent) {
                Log::info('Sticker message has come');

                // You might want to reply with a sticker.
                // You need STKID, STKPKGID and STKVER which should be known or defined by you.
                $STKID = '5';
                $STKPKGID = '1';
                $STKVER = '100'; // Adjust as needed
                $this->replySticker($bot, $event->getReplyToken(), $STKID, $STKPKGID, $STKVER);
            } elseif ($message instanceof ImageMessageContent) {
                Log::info('Image message has come');

                // Get the binary data of the image sent by the user using LINE Messaging API
                $contentId = $message->getId();
                // Log::info('contentId: ' . $contentId);
                $sfo = $botBlob->getMessageContent($contentId);
                // Log::info('sfo: ' . $sfo);
                $image = $sfo->fread($sfo->getSize());
                // Log::info('image: ' . $image);

                // Store the image into Laravel storage

                Storage::put('/public/images/' . $contentId . '.jpg', $image);
                // file_put_contents($path, $image);
                Log::info("Image has been stored in Laravel storage");
                // Respond with another image
                $original = "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png";
                $preview = "https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png";

                // $original = "https://source.unsplash.com/random";
                // $preview = "https://source.unsplash.com/random";

                $message = new ImageMessage(
                    [
                        'type' => MessageType::IMAGE,
                        'originalContentUrl' => $original,
                        'previewImageUrl' => $preview,
                    ]
                );
                $request = new ReplyMessageRequest([
                    'replyToken' => $event->getReplyToken(),
                    'messages' => [$message],
                ]);
                $bot->replyMessage($request);

                Log::info("Image has been sent");
            } else {
                Log::info('Non-text and non-sticker message has come');
            }
        }

        return response('OK', 200);
    }

    private function replyText($bot, $replyToken, $text)
    {
        try {
            $bot->replyMessage(new ReplyMessageRequest([
                'replyToken' => $replyToken,
                'messages' => [
                    (new TextMessage(['text' => $text]))->setType('text'),
                ],
            ]));
        } catch (\Exception $e) {
            Log::error('Failed to send reply: ' . $e->getMessage());
        }
    }

    private function replySticker($bot, $replyToken, $stkId, $stkPkgId, $stkVer)
    {
        try {
            $bot->replyMessage(new ReplyMessageRequest([
                'replyToken' => $replyToken,
                'messages' => [
                    (new StickerMessage([
                        'packageId' => $stkPkgId,
                        'stickerId' => $stkId,
                        'stickerResourceType' => $stkVer, // If the SDK/API requires it.
                    ]))->setType('sticker'),
                ],
            ]));
        } catch (\Exception $e) {
            Log::error('Failed to send sticker: ' . $e->getMessage());
        }
    }
}
