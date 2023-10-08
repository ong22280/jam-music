<?php

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class PlaylistRepository
{
  // public function getAllOfUser(User $user) {
  //   $playlistsKey = "playlists:{$user->email}";
  //   $value = Redis::get($playlistsKey);

  //   if (empty($value)) {
  //     $playlists = Playlist::withCount('song')->ofUser($user-
  //     Redis::set($playlistsKey, json_encode($playlists));
  //   } else {
  //     $playlists = json_decode($value);
  //   }
  //   return $playlists;
  // }

  // public function updatePlaylistCacheOfUser
}