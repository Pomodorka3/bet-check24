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
        $userCommunities = auth()->user()->createdCommunities->merge(auth()->user()->communities);
        $communities = Community::all()->filter(function ($community) {
            return $community->created_by !== auth()->user()->id && !$community->users->contains(auth()->user()->id);
        });

        return view('community.index', compact('communities', 'userCommunities'));
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
        $community->users()->attach(auth()->user()->id); // Attach the user who created the community (creator is always a member of the community
        $community->save();

        return redirect()->route('community.show', [$community->id])->with('success', 'Community has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Community $community)
//    public function show(int $id)
    {

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
        $community->delete();
        return redirect()->route('community.index')->with('success', 'Community has been disbanded');
    }

    public function join(Community $community)
    {
        $community->users()->attach(auth()->user()->id);
        return redirect()->route('community.index')->with('success', 'You have joined the community');
    }

    public function leave(Community $community)
    {
        $community->users()->detach(auth()->user()->id);
        return redirect()->route('community.index')->with('success', 'You have left the community');
    }
}
