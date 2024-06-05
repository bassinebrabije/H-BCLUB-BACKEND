<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Member::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'ville' => 'required',
            'subscription' => 'required',
            'sexe' => 'required',
            'imagemembers' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->imagemembers->extension();
        $request->imagemembers->move(public_path('images'), $imageName);

        $member = Member::create(array_merge(
            $validatedData,
            ['imagemembers' => $imageName]
        ));

        return response()->json($member, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'ville' => 'required',
            'subscription' => 'required',
            'sexe' => 'required',
        ]);

        $member = Member::findOrFail($id);

        // Update the member fields
        $member->update($validatedData);

        // Update the created_at field to the current timestamp
        $member->updated_at = now();
        $member->save();

        return response()->json($member, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        if ($member->imagemembers) {
            Storage::delete(public_path('images') . '/' . $member->imagemembers);
        }

        $member->delete();

        return response()->json(null, 204);
    }
}
