<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artist = Artist::get();
        $artist = Artist::paginate(9);
        return view('artists.index', [
            'artists' => $artist,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Artist::class);
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Dependency Injection
    {
        Gate::authorize('create', Artist::class);

        $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:artists,name'],
        ]);

        $artist_name = $request->get('name');
        if ($artist_name == null) {
            return redirect()->back();
        }
        $artist = new Artist();
        $artist->name = $artist_name;

        $fileName = 'desired_filename.jpg';
        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->storeAs('artist_images', $fileName, 'public');
            $artist->image_path = $path;
        }
        
        $artist->save();
        return redirect()->route('artists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return view('artists.show', [
            'artist' => $artist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('artists.edit', [
            'artist' => $artist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $artist_name = $request->get('name');
        if ($artist_name == null) {
            return redirect()->back();
        }
        $artist->name = $artist_name;
        $artist->save();
        return redirect()->route('artists.show', ['artist' => $artist]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        if ($artist->songs->isEmpty()) {
            $artist->delete();
            return redirect()->route('artists.index');
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating new song of specified artist
     * HTTP Method: GET
     * Route Name: artists.songs.create
     * Route Param: {artist}
     */
    public function createSong(Artist $artist)
    {
        return view('artists.create-song', [
            'artist' => $artist,
        ]);
    }

    /**
     * Store a newly created song of specified artist in storage.
     * HTTP Method: POST
     * Route Name: artists.songs.store
     * Route Param: {artist}
     */
    public function storeSong(Request $request, Artist $artist)
    {
        $request->validate([
            'title' => ['required', 'min:4', 'max:255'],
            'duration' => ['required', 'integer', 'min:10'],
        ]);

        $song = new Song();
        $song->title = $request->get('title');
        $song->duration = $request->get('duration');

        // แบบที่ 1: ใช้ save() ของ Model Song
        // $song->artist_id = $artist->id;
        // $song->save();

        // แบบที่ 2: ใช้ save() ของ Model Artist
        $artist->songs()->save($song);
        return redirect()->route('artists.show', ['artist' => $artist]);
    }
}
