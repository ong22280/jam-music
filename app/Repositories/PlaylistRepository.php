<?php

namespace App\Repositories;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PlaylistRepository
{
  // public function getAllOfUser(User $user) {
  //   $playlistsKey = "playlists:{$user->email}";
  //   $value = Redis::get($playlistsKey);

  //   if (empty($value)) {
  //     $playlists = Playlist::withCount('song')->ofUser($playlistsKey)->get();
  //     Redis::set($playlistsKey, json_encode($playlists));
  //   } else {
  //     $playlists = json_decode($value);
  //   }
  //   return $playlists;
  // }

  public function getAllOfUser($user_id)
  {
    $playlistsKey = "playlists:{$user_id}";
    $value = Redis::get($playlistsKey);

    if (empty($value)) {
      $playlists = Playlist::where('user_id', $user_id)->get();
      Redis::set($playlistsKey, json_encode($playlists));
    } else {
      $playlists = json_decode($value);
    }

    return $playlists;
  }


  
}
