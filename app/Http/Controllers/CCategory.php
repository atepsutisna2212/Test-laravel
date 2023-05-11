<?php

namespace App\Http\Controllers;

use App\Models\MCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CCategory extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MCategory::all();
        return response()->json([
            "success" => true,
            "message" => "Category berhasil ditampilkan",
            "data" => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->messages());
        }
        $data = MCategory::create([
            'name' => $request->name,
        ]);
        if ($data)
            return response()->json([
                "success" => true,
                "message" => "Category berhasil ditambah",
                "data" => $data,
            ]);
        else
            return response()->json(['message' => 'Tambah category gagal']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MCategory  $mCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = MCategory::find($id);
        return response()->json([
            "success" => true,
            "message" => "Category " . $id . " berhasil ditampilkan",
            "data" => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MCategory  $mCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->messages());
        }

        MCategory::where('id_category', $id)->update([
            'name' => $request->name,
        ]);
        $data = MCategory::find($id);
        if ($validasi)
            return response()->json([
                "success" => true,
                "message" => "Category berhasil diupdate",
                "data" => $data,
            ]);
        else
            return response()->json(['message' => 'Update category gagal']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MCategory  $mCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kode = $id;
        MCategory::destroy($id);
        return response()->json([
            "success" => true,
            "message" => "Category " . $kode . " berhasil dihapus",
        ]);
    }
}
