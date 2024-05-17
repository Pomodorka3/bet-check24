<?php

namespace App\Http\Controllers;

use App\Models\FootballMatch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FootballMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) abort(403);

        if ($request->get('team_1_id') === $request->get('team_2_id')) {
            return redirect()->route('admin.index')->with('error', 'The teams must be different.');
        }

        $footballMatch = new FootballMatch([
            'team_1_id' => $request->get('team_1_id'),
            'team_2_id' => $request->get('team_2_id'),
            'starts_at' => Carbon::parse($request->get('starts_at'))
        ]);
        $footballMatch->save();

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FootballMatch $footballMatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FootballMatch $footballMatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FootballMatch $footballMatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FootballMatch $footballMatch)
    {
        //
    }
}
