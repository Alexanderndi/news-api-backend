<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserPreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pref = \App\Models\UserPreference::where('user_id', $id)->first();
        if (!$pref) {
            return response()->json(['message' => 'Preferences not found'], 404);
        }
        return response()->json($pref);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pref = \App\Models\UserPreference::firstOrCreate(['user_id' => $id]);
        $data = $request->only(['sources', 'categories', 'authors']);
        $pref->fill($data);
        $pref->save();
        return response()->json($pref);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
