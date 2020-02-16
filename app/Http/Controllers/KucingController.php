<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kucing;

use App\Http\Resources\Kucing as KucingResource;

class KucingController extends Controller
{
    //* Fungsi menampilkan semua data
    public function index()
    {
        $kucings = Kucing::all();
        return new KucingResource($kucings);
    }

    //* Fungsi menampilkan single data
    public function show($id)
    {
        $kucing = Kucing::findOrFail($id);
        return new KucingResource($kucing);
    }

    //* Fungsi menambah data
    public function store(Request $request)
    {
        // Menambah gambar
        $image = $request->file('gambar');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $kucing = new Kucing();
        $kucing->nama = $request->nama;
        $kucing->jenis = $request->jenis;
        $kucing->umur = $request->umur;
        $kucing->gambar = $new_name;
        $kucing->save();

        return new KucingResource($kucing);
    }

    //* Fungsi mengupdate data
    public function update(Request $request, $id)
    {
        $kucing = Kucing::findOrFail($id);
        $kucing->nama = $request->nama;
        $kucing->jenis = $request->jenis;
        $kucing->umur = $request->umur;

        //* Jika gambar kosong maka query gambar
        //* menggunakan gambar_lama yg berisi gambar lama
        if (is_null($request->gambar)) {
            $kucing->gambar = $request->gambar_lama;
        } else {
            //* Jika ada query gambar maka akan diganti
            $image = $request->file('gambar');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);

            $kucing->gambar = $new_name;
        }

        $kucing->save();

        return new KucingResource($kucing);
    }

    //* Fungsi menghapus data
    public function destroy($id)
    {
        $kucing = Kucing::findOrFail($id);
        if ($kucing->delete()) {
            return new KucingResource($kucing);
        }
    }
}
