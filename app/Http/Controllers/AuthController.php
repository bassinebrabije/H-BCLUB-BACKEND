<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PDF;

class AuthController extends Controller
{
    public function index()
    {
        return response()->json(Admin::all(), 200);
    }
    public function downloadPDF()
    {
        $admins = Admin::all();

        $pdf = PDF::loadView('pdf.admins', compact('admins'))->setPaper('a4', 'landscape');

        return $pdf->download('admins.pdf');
    }
    public function login(Request $request)
    {
        Log::info('Login request received', ['data' => $request->all()]);

        $validator = \Validator::make($request->all(), [

            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            Log::info('Login successful', ['admin' => $admin]);
            return response()->json($admin, 200);
        }

        Log::error('Unauthorized access attempt');
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'ville' => 'required',
            'sexe' => 'required',
            'username' => 'required|string|unique:admins',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string|confirmed',
            'imgadmin' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('imgadmin')) {
            $image = $request->file('imgadmin');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data['imgadmin'] = $name;
        } else {
            $data['imgadmin'] = 'unknown.jpg';
        }

        $admin = Admin::create($data);

        return response()->json($admin, 201);
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json(['error' => 'Admin not found'], 404);
        }

        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully'], 200);
    }
}
