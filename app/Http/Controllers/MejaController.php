<?php

namespace App\Http\Controllers;

use App\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mejas = Meja::all();
        return view('meja.index', ['mejas' => $mejas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // Check if the user has the 'admin' role
        if (Auth::user() && Auth::user()->role !== 'admin') {
            return redirect('/forbidden');
        }

        $mejas = Meja::all();
        return view('meja.create', compact('mejas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Check if the user has the 'admin' role
        if (Auth::user() && Auth::user()->role !== 'admin') {
            return redirect('/forbidden');
        }

        $validateData = $request->validate([
            'nomor_meja' => 'required',
        ]);

        Meja::create($validateData);
        return redirect()->route('mejas.index')->with('pesan', 'Meja berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function show(Meja $meja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function edit(Meja $meja)
    {
        //
        $mejas = Meja::all();
        return view('meja.edit', compact('meja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validateData = $request->validate([
            'nomor_meja' => 'required',
        ]);

        $meja = Meja::find($id);
        $meja->update($request->all());
        return redirect()->route('mejas.index')->with('pesan', 'Meja berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meja  $meja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meja $meja)
    {
        //
        // Check if the user has the 'admin' role
        if (Auth::user() && Auth::user()->role !== 'admin') {
            return redirect('/forbidden');
        }

        $meja->delete();
        return redirect()->route('mejas.index')->with('pesan', 'Meja berhasil dihapus');
    }
}
