<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menus = Menu::all();
        return view('menu.index',['menus' => $menus]);
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

        $menus = Menu::all();
        return view('menu.create',compact('menus'));
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
        $validateData = $request->validate([
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'ketersediaan' => 'required',
        ]);

        Menu::create($validateData);
        return redirect()->route('menus.index')->with('pesan','Menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
         // Check if the user has the 'admin' role
         if (Auth::user() && Auth::user()->role !== 'admin') {
            return redirect('/forbidden');
        }

        $menus = Menu::all();
        return view('menu.edit',compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validateData = $request->validate([
            'nama_menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'ketersediaan' => 'required',
        ]);

        $menu = Menu::find($id);
        $menu->update($request->all());
        return redirect()->route('menus.index')->with('pesan','Menu berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
         // Check if the user has the 'admin' role
         if (Auth::user() && Auth::user()->role !== 'admin') {
            return redirect('/forbidden');
        }

        $menu->delete();
        return redirect()->route('menus.index')->with('pesan','Menu berhasil dihapus');
    }
}
