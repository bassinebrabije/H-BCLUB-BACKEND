<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class MemberController extends Controller
{

    public function index()
    {
        return response()->json(Member::all(), 200);
    }
    public function downloadPDF()
    {
        $members = Member::all();

        $pdf = PDF::loadView('pdf.members', compact('members'))->setPaper('a4', 'landscape');

        return $pdf->download('members.pdf');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'ville' => 'required',
            'subscription' => 'required',
            'sexe' => 'required',
            'imagemembers' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Convert email, fname, and lname to lowercase
        $validatedData['email'] = strtolower($validatedData['email']);
        $validatedData['fname'] = strtolower($validatedData['fname']);
        $validatedData['lname'] = strtolower($validatedData['lname']);

        $imageName = 'unknown.jpg';
        if ($request->hasFile('imagemembers')) {
            $imageName = time() . '.' . $request->imagemembers->extension();
            $request->imagemembers->move(public_path('images'), $imageName);
        }

        $member = Member::create(array_merge(
            $validatedData,
            ['imagemembers' => $imageName]
        ));

        return response()->json($member, 201);
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member, 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'ville' => 'required',
            'subscription' => 'required',
            'sexe' => 'required',
        ]);

        $member = Member::findOrFail($id);

        $validatedData['email'] = strtolower($validatedData['email']);
        $validatedData['fname'] = strtolower($validatedData['fname']);
        $validatedData['lname'] = strtolower($validatedData['lname']);

        $member->update($validatedData);

        $member->updated_at = now();
        $member->save();

        return response()->json($member, 200);
    }

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
