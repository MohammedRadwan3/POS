<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Models\Client;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create', compact('client', 'categories'));
    }

    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);

        $total_price = 0;
        foreach ($request->products as $id => $quantity) {
            $product = Product::FindOrFail($id);
            $total_price += $product->sale_price * $quantity['quantity'];
            $product->update([
                'stock' => $product->stock - $quantity['quantity']
            ]);

        }//end of foreach}

        $order->update([
            'total_price' => $total_price,
        ]);

        toastr()->success(__('site.added_successfully'));
        return redirect()->route('dashboard.orders.index');

    } // end of store

    public function edit(Client $client, Order $order)
    {
        //
    }

    public function update(Request $request, Client $client, Order $order)
    {
        //
    }

    public function destroy(Client $client)
    {
        //
    }
}
