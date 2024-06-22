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
    public function downloadPDF(Request $request)
    {
        $ville = $request->query('ville');

        if ($ville) {
            \Log::info('Received ville parameter: ' . $ville);
            $members = Member::where('ville', $ville)->get();
            if ($members->isEmpty()) {
                \Log::info('No members found for the specified ville: ' . $ville);
                return response()->json(['error' => 'No members found for the specified ville'], 404);
            }
        } else {
            \Log::info('No ville parameter received. Fetching all members.');
            $members = Member::all();
            if ($members->isEmpty()) {
                \Log::info('No members found in the database.');
                return response()->json(['error' => 'No members found'], 404);
            }
        }

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
