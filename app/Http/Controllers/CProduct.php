<?php

namespace App\Http\Controllers;

use App\Models\MProduct;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CProduct extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MProduct::with('category')->get();
        return response()->json([
            "success" => true,
            "message" => "Product berhasil ditampilkan",
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
        $user = JWTAuth::parseToken()->authenticate();
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time() . "." . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $imgName);

            $user->image = $imgName;
            $user->save();
        }

        $validasi = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->messages());
        }
        $data = MProduct::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
        ]);
        return response()->json([
            "success" => true,
            "message" => "Product berhasil ditambah",
            "data" => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MProduct  $mProduct
     * @return \Illuminate\Http\Response
     */
    public function show(MProduct $Product)
    {
        $data = MProduct::with('category')->find($Product->id_product);
        return response()->json([
            "success" => true,
            "message" => "Product " . $Product->name . " berhasil ditampilkan",
            "data" => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MProduct  $mProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $imgName = time() . "." . $img->getClientOriginalExtension();
            $img->move(public_path('images'), $imgName);

            $user->image = $imgName;
            $user->save();
        }

        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json($validasi->messages());
        }

        MProduct::where('id_product', $id)->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
        ]);
        $data = MProduct::with('category')->find($id);
        return response()->json([
            "success" => true,
            "message" => "Product berhasil diupdate",
            "data" => $data,
        ]);

        // return response()->json(["data" => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MProduct  $mProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(MProduct $Product)
    {
        $name = $Product->name;
        MProduct::destroy($Product->id_product);
        return response()->json([
            "success" => true,
            "message" => "Product " . $name . " berhasil dihapus",
        ]);
    }
}
