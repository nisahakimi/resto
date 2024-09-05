<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pembayarans = Pembayaran::all();
        return view('pembayaran.index', ['pembayarans' => $pembayarans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pembayarans = Pembayaran::all();
        $orders = Order::all();
        return view('pembayaran.create', compact('pembayarans','orders'));
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
            'tanggal' => 'required|date',
            'total_bayar' => 'required',
            'id_order' => 'required',
        ]);

        $validateData['id_user'] = Auth::id();

        Pembayaran::create($validateData);
        $order = Order::find($validateData['id_order']);
        if ($order) {
            $order->order_status = 'completed'; // Update to 'completed'
            $order->save();
        }

        return redirect()->route('pembayarans.index')->with('pesan', 'Data Pembayaran Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
        $pembayarans = Pembayaran::all();
        $orders = Order::all();
        return view('pembayaran.edit', compact('pembayaran', 'pembayarans', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validateData = $request->validate([
            'tanggal' => 'required|date',
            'total_bayar' => 'required',
            'id_order' => 'required',
        ]);

        $validateData['id_user'] = auth()->user()->id;

        $pembayaran = Pembayaran::find($id);
        $pembayaran->update($request->all());
        $order = Order::find($validateData['id_order']);
        if ($order) {
            $order->order_status = 'completed'; // Update to 'completed'
            $order->save();
        }

        return redirect()->route('pembayarans.index')->with('pesan', 'Data Pembayaran Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
        $pembayaran->delete();
        return redirect()->route('pembayarans.index')->with('pesan', 'Data Pembayaran Berhasil Dihapus');
    }
}
