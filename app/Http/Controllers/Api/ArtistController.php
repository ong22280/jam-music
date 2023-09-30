<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::get();
        return $artists;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
        ]);
        $name = $request->get('name');

        $exist = Artist::where('name', $name)->first();
        if ($exist !== null) {
            // return response()->json([
            //     'message' => 'Artist already exists',
            //     'artist' => $exists,
            // ], 409);
            abort(409, 'Artist already exists');
        }

        $artist = new Artist();
        $artist->name = $name;
        $artist->save();
        $artist->refresh(); // refresh for 
        return $artist;
        // return [
        //     // 'to' => route('artist.show', ['artist' => $artist->id]),
        //     'to' => url('/api/artist/' . $artist->id),
        // ]
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        // $songs = $artist->songs();
        return $artist->load('songs');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
        ]);
        $name = $request->get('name');

        $exist = Artist::where('name', $name)->where('id', '!=', $artist->id)->first();
        if ($exist !== null) {
            abort(400, 'Artist already exists');
        }

        $artist->name = $name;
        $artist->image_path = $request->get('image_path') ?? null;
        $artist->save();
        $artist->refresh(); // refresh for 
        return $artist;
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Artist $artist)
    public function destroy(Request $request, Artist $artist)
    {
        $id = $artist->id;
        $request->validate([
            'id' => ['required', 'integer', 'min:1'],
        ]);
        
        $name = $request->get('name');
        if ($name !== $artist->name) {
            abort(400, 'Artist name does not match');
        }
        $artist->delete();
        return [
            'message' => 'Artist deleted {id: ' . $artist->id . ', name: ' . $artist->name . '}',
            'success' => true,
        ];
    }
}
