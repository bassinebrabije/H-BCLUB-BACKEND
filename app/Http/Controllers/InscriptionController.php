<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use PDF;

class InscriptionController extends Controller
{

    public function index()
    {
        return response()->json(Inscription::all(), 200);
    }

    public function downloadPDF(Request $request)
    {
        $ville = $request->query('ville');
        if ($ville) {
            \Log::info('Received ville parameter: ' . $ville);
            $inscriptions = Inscription::where('ville', $ville)->get();
            if ($inscriptions->isEmpty()) {
                \Log::info('No Inscription found for the specified ville: ' . $ville);
                return response()->json(['error' => 'No Inscription found for the specified ville'], 404);
            }
        } else {
            \Log::info('No ville parameter received. Fetching all Inscription.');
            $inscriptions = Inscription::all();
            if ($inscriptions->isEmpty()) {
                \Log::info('No Inscription found in the database.');
                return response()->json(['error' => 'No Inscription found'], 404);
            }
        }
        $pdf = PDF::loadView('pdf.inscriptions', compact('inscriptions'))->setPaper('a4', 'landscape');
        return $pdf->download('inscriptions.pdf');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:inscriptions',
            'phone_number' => 'required',
            'ville' => 'required',
        ]);

        $validatedData['email'] = strtolower($validatedData['email']);
        $validatedData['full_name'] = strtolower($validatedData['full_name']);

        $inscription = Inscription::create($validatedData);

        return response()->json($inscription, 201);
    }

    public function show($id)
    {
        $inscription = Inscription::findOrFail($id);
        return response()->json($inscription, 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:inscriptions,email,' . $id,
            'phone_number' => 'required',
            'ville' => 'required',
        ]);

        $inscription = Inscription::findOrFail($id);

        $validatedData['email'] = strtolower($validatedData['email']);
        $validatedData['full_name'] = strtolower($validatedData['full_name']);

        $inscription->update($validatedData);

        return response()->json($inscription, 200);
    }

    public function destroy($id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->delete();

        return response()->json(null, 204);
    }
}
