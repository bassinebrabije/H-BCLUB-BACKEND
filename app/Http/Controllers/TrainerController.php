<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Trainer::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:trainers',
            'ville' => 'required',
            'sexe' => 'required',
            'experience' => 'required|integer',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('images'), $imageName);

        $trainer = Trainer::create([
            'fname' => $request->fname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'ville' => $request->ville,
            'sexe' => $request->sexe,
            'experience' => $request->experience,
            'img' => $imageName,
        ]);

        return $trainer;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Trainer::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'fname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:trainers,email,' . $id,
            'ville' => 'required',
            'sexe' => 'required',
            'experience' => 'required|integer',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $trainer = Trainer::find($id);

        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $imageName);
            $trainer->img = $imageName;
        }

        $trainer->update($request->all());

        return $trainer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainer = Trainer::find($id);
        if ($trainer->img) {
            Storage::delete(public_path('images') . '/' . $trainer->img);
        }
        return Trainer::destroy($id);
    }
}
