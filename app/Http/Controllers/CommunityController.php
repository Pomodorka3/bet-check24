<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('community.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('community.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $community = new Community([
            'name' => $request->get('name'),
            'created_by' => auth()->user()->id
        ]);
        $community->save();

        return redirect()->route('community.show', [$community->id])->with('success', 'Community has been added');
    }

    /**
     * Display the specified resource.
     */
//    public function show(Community $community)
    public function show(int $id)
    {
        $community = new Community([
            'name' => 'Community Name',
            'created_by' => auth()->user()->id
            ]);



        // TODO: Check if user in community
        // TODO: Load other community user stats
        return view('community.show', compact('community'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Community $community)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Community $community)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community $community)
    {
        //
    }
}
