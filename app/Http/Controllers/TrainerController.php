<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class TrainerController extends Controller
{

    public function index()
    {
        return response()->json(Trainer::all(), 200);

    }

    public function downloadPDF(Request $request)
    {
        $ville = $request->query('ville');

        if ($ville) {
            \Log::info('Received ville parameter: ' . $ville);
            $trainers = Trainer::where('ville', $ville)->get();
            if ($trainers->isEmpty()) {
                \Log::info('No trainers found for the specified ville: ' . $ville);
                return response()->json(['error' => 'No trainers found for the specified ville'], 404);
            }
        } else {
            \Log::info('No ville parameter received. Fetching all trainers.');
            $trainers = Trainer::all();
            if ($trainers->isEmpty()) {
                \Log::info('No trainers found in the database.');
                return response()->json(['error' => 'No trainers found'], 404);
            }
        }
        $pdf = PDF::loadView('pdf.trainers', compact('trainers'))->setPaper('a4', 'landscape');
        return $pdf->download('trainers.pdf');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:trainers',
            'ville' => 'required',
            'sexe' => 'required',
            'about' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validatedData['email'] = strtolower($validatedData['email']);
        $validatedData['fname'] = strtolower($validatedData['fname']);
        $validatedData['lastname'] = strtolower($validatedData['lastname']);

        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('images'), $imageName);

        $trainer = Trainer::create(array_merge(
            $validatedData,
            ['img' => $imageName]
        ));

        return response()->json($trainer, 201);

    }

    public function show($id)
    {
        $trainer = Trainer::findOrFail($id);
        return response()->json($trainer, 200);

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'ville' => 'required',
            'sexe' => 'required',
            'about' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $trainer = Trainer::findOrFail($id);

        $validatedData['email'] = strtolower($validatedData['email']);
        $validatedData['fname'] = strtolower($validatedData['fname']);
        $validatedData['lastname'] = strtolower($validatedData['lastname']);

        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $trainer->img = $imageName;
        }

        $trainer->update($validatedData);

        return response()->json($trainer, 200);

    }

    public function destroy($id)
    {
        $trainer = Trainer::findOrFail($id);

        if ($trainer->img) {
            Storage::delete(public_path('images') . '/' . $trainer->img);
        }

        $trainer->delete();

        return response()->json(null, 204);

    }
}
