<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // by user id
        $user = User::find(1);
        $playlists = Playlist::where('user_id', $user->id)->paginate(6);

        // by user model
        // $user = User::find(1);
        // $playlists = $user->playlists()->paginate(10);

        return view('playlists.index', [
            'playlists' => $playlists,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('playlists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'accessibility' => ['required', 'in:PUBLIC,PRIVATE']
        ]);
        $user = User::find(1);
        $playlist = new Playlist();
        $playlist->name = $request->name;
        $playlist->accessibility = $request->accessibility;
        $playlist->user_id = $user->id;
        $playlist->save();
        return redirect()->route('playlists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        return view('playlists.show', [
            'playlist' => $playlist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        return view('playlists.edit', [
            'playlist' => $playlist
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'accessibility' => ['required', 'in:PUBLIC,PRIVATE']
        ]);

        $playlist->name = $request->name;
        $playlist->accessibility = $request->accessibility;
        $playlist->save();

        return redirect()->route('playlists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        if ($playlist->songs()->count()) {
            return redirect()->route('playlists.index');
        }
        $playlist->delete();
        return redirect()->route('playlists.index');
    }

    public function addSong(Playlist $playlist)
    {
        $songs = Song::get();
        return view('playlists.add-song', [
            'playlist' => $playlist,
            'songs' => $songs
        ]);
    }

    public function storeSongPlaylist(Request $request, Playlist $playlist)
    {
        $request->validate([
            'song_id' => ['required', 'exists:songs,id']
        ]);

        $playlist->songs()->attach($request->song_id);

        return redirect()->route('playlists.show', $playlist->id);
    }

    public function removeSong(Playlist $playlist, Song $song)
    {
        $playlist->songs()->detach($song->id);
        return redirect()->route('playlists.show', $playlist->id);
    }

}
