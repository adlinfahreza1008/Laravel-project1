<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Kategori::all();
        return view('kategori.index', compact('rows')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [ 
            'kategori_nama' => 'bail|required|unique:tb_kategori', 
            'kategori_keterangan' => 'required' 
            ], 
            
            [ 
            'kategori_nama.required'       => 'Nama wajib diisi', 
            'kategori_nama.unique'         => 'Nama sudah ada', 
            'kategori_keterangan.required' => 'keterangan wajib diisi' 
            ]); 
             
            Kategori::create([ 
            'kategori_nama'         => $request->kategori_nama, 
            'kategori_keterangan'   => $request->kategori_keterangan, 
             
            ]); 
        return redirect('/kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Kategori::findOrFail($id); 
        return view('Kategori.edit', compact('row'));
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
        $request->validate(
            [
                'kategori_nama' => 'bail|required',
                'kategori_keterangan' => 'required'
             ],
             [
                'kategori_nama.required' => 'NAMA wajib diisi',
                'kategori_keterangan.required' => 'Keterangan diisi dengan Jelas'
            ]);
            
            $row = Kategori::findOrFail($id);
            $row->update([
                'kategori_nama' => $request->kategori_nama,
                'kategori_keterangan' => $request->kategori_keterangan
            ]);
            
            return redirect('/kategori');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Kategori::findOrFail($id); 
        $row->delete();

        return redirect('/kategori');
    }
}
