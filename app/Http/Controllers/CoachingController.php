<?php

namespace App\Http\Controllers;

use App\Models\Coaching;
use Illuminate\Http\Request;

class CoachingController extends Controller
{
    public function index()
    {
        return Coaching::with(['member', 'trainer'])->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|exists:members,id',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        $coaching = Coaching::create($validatedData);

        return response()->json($coaching->load(['member', 'trainer']), 201);
    }

    public function show(Coaching $coaching)
    {
        return $coaching->load(['member', 'trainer']);
    }

    public function update(Request $request, Coaching $coaching)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|exists:members,id',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        $coaching->update($validatedData);

        return response()->json($coaching->load(['member', 'trainer']), 200);
    }

    public function destroy(Coaching $coaching)
    {
        $coaching->delete();

        return response()->noContent();
    }
}
