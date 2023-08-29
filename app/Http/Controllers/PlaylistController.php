<?php

namespace App\Http\Controllers;

use App\Models\Enums\PlaylistAccessibility;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Providers\PlaylistPolicy;

class PlaylistController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Playlist::class);

        // if (! Gate::allows('viewAny', Playlist::class)) {
        //     return redirect()->to('/');
        // }

        $user = Auth::user();

        // $playlists = Playlist::with('songs')->whereUserId($user->id)->get();
        // $query = Playlist::where('user_id', $user->id);
        $query = Playlist::with('songs')->ofUser($user->id);

        if ($request->has('accessibility') && in_array($request->accessibility, ['PUBLIC', 'PRIVATE'])) {
            $query->filterByAccessibility($request->accessibility);
        }


        if ($request->has('search')) {
            $query->withNameLike($request->search);
        }

        $query->sortedBy($request->input('sort', 'latest'));  // Default to 'latest' if not provided

        $playlists = $query->paginate(6);

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
        Gate::authorize('create', Playlist::class);
        return view('playlists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Playlist::class);

        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'accessibility' => ['required', 'in:PUBLIC,PRIVATE']
        ]);
        // $user = Auth::user();
        // $playlist = new Playlist();
        // $playlist->name = $request->name;
        // $playlist->accessibility = $request->accessibility;
        // $playlist->user_id = $user->id;
        // $playlist->save();

        $playlist = new Playlist();
        $playlist->accessibility = $request->get('accessibility');
        $playlist->name = $request->get('name');
        $request->user()->playlists()->save($playlist);

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
        Gate::authorize('update', $playlist);

        return view('playlists.edit', [
            'playlist' => $playlist
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        Gate::authorize('update', $playlist);

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
