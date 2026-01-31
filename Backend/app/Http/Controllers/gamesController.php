<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;


class gamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $game = Games::all();
        return response()->json($game);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required',
        ]);

        $path = $request->file('image')->store('games', 'public');

        // Generate public URL
        $imageUrl = asset('storage/' . $path);

        $game = new Games();
        $game->name = $request->name;
        $game->slug = $request->slug;
        $game->description = $request->description;
        $game->image = $imageUrl;
        $game->is_popular = $request->is_popular ?? 0;
        $game->is_new = $request->is_new ?? 0;
        $game->is_active = $request->is_active ?? 0;
        $game->save();

        return response()->json([
            'game' => $game,
            'message' => 'Game created successfully',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Games $games, $id)
    {
        $game = Games::find($id);
        return response()->json([
            'game' => $game,
            'message' => 'Game found successfully',
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $game = Games::findOrFail($id);

        $game->name = $request->name;
        $game->slug = $request->slug;
        $game->description = $request->description;
        $game->is_popular = $request->is_popular ?? 0;
        $game->is_new = $request->is_new ?? 0;
        $game->is_active = $request->is_active ?? 0;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('games', 'public');
            $game->image = asset('storage/' . $path);
        }

        $game->save();

        return response()->json([
            'game' => $game,
            'message' => 'Game updated successfully',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Games $games, $id)
    {
        $game = Games::find($id);
        $game->delete();
        return response()->json([
            'game' => $game,
            'message' => 'Game deleted successfully',
        ]);
    }

   public function checkUser(Request $request)
{
    $users = $request->all();
    $result = [];

    // ✅ Mobile Legends
    if (
        isset($users['mobile_legends']['uid']) &&
        isset($users['mobile_legends']['zone'])
    ) {
        try {
            $mlRes = Http::get('https://api.isan.eu.org/nickname/ml', [
                'id' => $users['mobile_legends']['uid'],
                'zone' => $users['mobile_legends']['zone'],
            ]);

            $result['mobile_legends'] = $mlRes->json();
        } catch (\Exception $e) {
            $result['mobile_legends'] = null;
        }
    }

    // ✅ PUBG (safe)
    if (isset($users['pubg']['nickname'])) {
        try {
            $pubgRes = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PUBG_API_KEY'),
                'Accept' => 'application/vnd.api+json'
            ])->get('https://api.pubg.com/shards/steam/players', [
                'filter[playerNames]' => $users['pubg']['nickname']
            ]);

            $result['pubg'] = $pubgRes->json();
        } catch (\Exception $e) {
            $result['pubg'] = null;
        }
    }

    // ✅ Free Fire (safe)
    if (isset($users['free_fire']['uid'])) {
        try {
            $ffRes = Http::get('https://api.ff.garena.com/player_info', [
                'uid' => $users['free_fire']['uid']
            ]);

            $result['free_fire'] = $ffRes->json();
        } catch (\Exception $e) {
            $result['free_fire'] = null;
        }
    }

    return response()->json($result);
}

}
