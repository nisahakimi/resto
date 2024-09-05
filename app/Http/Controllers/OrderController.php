<?php

namespace App\Http\Controllers;

use App\Meja;
use App\Menu;
use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $orders = Order::all();
        $orders = Order::with('items', 'meja')->get();
        return view('order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $orders = Order::all();
        $mejas = Meja::all();
        $menus = Menu::where('ketersediaan', true)->get();
        return view('order.create', compact('orders', 'mejas', 'menus'));
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
            'order_status' => 'required',
            'tanggal' => 'required|date',
            'id_meja' => 'required',
            'menus' => 'required|array',
            'menus.*.id_menu' => 'required|exists:menus,id',
            'menus.*.quantity' => 'required|integer|min:1',
        ]);

        $order = new Order();
        $order->order_status = $validateData['order_status'];
        $order->tanggal = $validateData['tanggal'];
        // $order->total_harga = $validateData['total_harga'];
        $order->id_meja = $validateData['id_meja'];
        $order->id_user = Auth::id();

        // Calculate total price
        $total_price = 0;
        foreach ($request->input('menus') as $menu) {
            $menuItem = Menu::find($menu['id_menu']);
            if ($menuItem) {
                $total_price += $menuItem->harga * $menu['quantity'];
            }
        }
        $order->total_harga = $total_price;
        $order->save();
        // Save the order

        // Create the OrderItems associated with the newly created Order
        foreach ($validateData['menus'] as $menu) {
            $order->items()->create([
                'id_order' => $order->id, // Foreign key for the Order
                'id_menu' => $menu['id_menu'],
                'quantity' => $menu['quantity'],
            ]);
        }
        // dd($order, $validateData['menus']);

        // // Prepare data for the Order model
        // $orderData = $request->only(['order_status', 'tanggal', 'total_harga', 'id_meja']);
        // $orderData['id_user'] = Auth::id();

        // // Create the Order
        // $order = Order::create($orderData);


        // // Create the OrderItems
        // foreach ($validateData['menus'] as $menu) {
        //     $order->items()->create([
        //         'id_order' => $order->id, // Foreign key for the Order
        //         'id_menu' => $menu['id_menu'],
        //         'quantity' => $menu['quantity'],
        //     ]);
        // }

        // // Redirect to index with success message
        // // dd($validateData);

        return redirect()->route('orders.index')->with('pesan', 'Order berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
        $orders = Order::all();
        $mejas = Meja::all();
        $orderItems = $order->items;
        // $availableMenus = Menu::where('ketersediaan', true)->get(); // Fetch only available menus
        $menus = Menu::all();
        $unavailableMenuIds = $menus->where('ketersediaan', false)->pluck('id')->toArray();


        return view('order.edit', compact('order', 'mejas', 'orderItems', 'menus', 'availableMenus', 'unavailableMenuIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validateData = $request->validate([
            'order_status' => 'required',
            'tanggal' => 'required|date',
            'total_harga' => 'required|numeric',
            'id_meja' => 'required',
            'menus' => 'required|array',
            'menus.*.id_menu' => 'required|exists:menus,id',
            'menus.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::find($id);
        $order->update([
            'order_status' => $validateData['order_status'],
            'tanggal' => $validateData['tanggal'],
            'id_meja' => $validateData['id_meja'],
            'id_user' => Auth::id(),
        ]);

        // Recalculate the total price
        $total_price = 0;
        foreach ($request->input('menus') as $menu) {
            $menuItem = Menu::find($menu['id_menu']);
            if ($menuItem) {
                $total_price += $menuItem->harga * $menu['quantity'];
            }
        }
        $order->total_harga = $total_price;
        $order->save();

        $order->items()->delete();

        // Create or update OrderItems
        foreach ($validateData['menus'] as $menu) {
            OrderItem::create([
                'id_order' => $order->id,
                'id_menu' => $menu['id_menu'],
                'quantity' => $menu['quantity'],
            ]);
        }


        return redirect()->route('orders.index')->with('pesan', 'Order berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        // Check if the user has the 'admin' role
        if (Auth::user() && Auth::user()->role !== 'admin') {
            return redirect('/forbidden');
        }

        $order->delete();
        return redirect()->route('orders.index')->with('pesan', 'Order berhasil dihapus');
    }
}
