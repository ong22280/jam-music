<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index() {
        $songs = collect([
            [
                'title' => 'River',
                'artist' => 'Miley Cyrus',
                'album' => 'Endless Summer Vocation',
                'duration' => [
                    'minutes' => 3,
                    'seconds' => 20
                ],
                'youtube_id' => 'v_4fljfr2r4'
            ],
            [
                'title' => 'Song for You',
                'artist' => 'Lee Isaacs',
                'album' => 'After the Apocalypses',
                'duration' => [
                    'minutes' => 2,
                    'seconds' => 48
                ],
                'youtube_id' => 'TP8kY5CF2Dg'
            ],
            [
                'title' => "คำถามซึ่งไร้คนตอบ",
                'artist' => 'Getsunova',
                'album' => 'The First Album',
                'duration' => [
                    'minutes' => 4,
                    'seconds' => 29
                ],
                'youtube_id' => 'mVkMDcjSpMQ'
            ],
        ]);

        return view('songs.index', [
            'title' => 'Song Playlist',
            'songs' => $songs
        ]);
    }
}
