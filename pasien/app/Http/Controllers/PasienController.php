<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function showAll()
    {
        return response()->json(Pasien::all());
    }
    public function showOne($id)
    {
        return response()->json(Pasien::find($id));
    }
    public function create(Request $request)
    {
        $Pasien = Pasien::create($request->all());
        return response()->json($Pasien, 201);
    }
    public function update($id, Request $request)
    {
        $Pasien = Pasien::findOrFail($id);
        $Pasien->update($request->all());
        return response()->json($Pasien, 200);
    }
    public function delete($id)
    {
        Pasien::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}