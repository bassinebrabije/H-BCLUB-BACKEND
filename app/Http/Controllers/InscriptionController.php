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

    public function downloadPDF()
    {
        $inscriptions = Inscription::all();

        $pdf = PDF::loadView('pdf.inscriptions', compact('inscriptions'));

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
