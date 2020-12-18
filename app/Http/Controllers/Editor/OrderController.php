<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Order;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userTitle = 'editor';

        return view('editor.orders.home', [
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
            'avatar' => Auth::user()->profile->avatar,
            'orderList' => Order::all(),
        ]);
    }

    public function showUser($userId)
    {
        if ($userId == Auth::user()->id) {
            return redirect()->route('editor.profile');
        }

        $userTitle = 'editor';
        $user = User::find($userId);
        $profile = $user->profile;

        return view('editor.partials.user-profile', [
            'username' => $user->username,
            'real_name' => $profile->real_name,
            'phone_number' => $profile->phone_number,
            'email' => $profile->email,
            'address' => $profile->address,
            'avatar' => $profile->avatar,
            'role_id' => $user->role_id,
            'role' => $user->role->role_name,
            'userTitle' => $userTitle,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $userTitle = 'editor';
        $username = Auth::user()->username;

        return view('editor.orders.create', [
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
            'productList' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|gte:1|unique:orders',
            'user_id' => 'required|integer|gte:1',
            'products' => 'required|string',
        ]);

        $order = null;
        try {
            $order = Order::create([
                'id' => $request->get('id'),
                'user_id' => $request->get('user_id'),
            ]);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot add new order!');
        }

        $productIDs = explode(',', $request->get('products'));
        $uniqueProductIDs = array_unique($productIDs);
        $productIDCounts = array_count_values($productIDs);

            foreach ($uniqueProductIDs as $uniqueProductID) {
                $order->products()->attach($uniqueProductID);
                $product = Product::find($uniqueProductID);
                if($product) {
                    $order->products()->updateExistingPivot($uniqueProductID, [
                        'sub_total' => Product::find($uniqueProductID)->price * $productIDCounts[$uniqueProductID],
                        'quantity' => $productIDCounts[$uniqueProductID],
                        ]);
                }
                else {
                    $order->products()->detach();
                    Order::destroy($request->get('id'));
                    return redirect()->back()->with('error', 'Cannot add new order!');
                }
            }

        $totalPrice = 0;
        foreach ($order->products as $product) {
            $totalPrice += $product->pivot->sub_total;
        }

        try {
            $order->update(['total_price' => $totalPrice,]);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot add new order!');
        }

        return redirect()->route('editor.orders.index')->with('status', 'Order ' . $request->get('id') . ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $userTitle = 'editor';
        $order = Order::find($id);

        return view('editor.orders.details', [
            'id' => $id,
            'total_price' => $order->total_price,
            'user_id' => $order->user_id,
            'productList' => $order->products,
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
            'created_at' => $order->created_at,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $request->validate([
            'user_id' => 'required|integer|gte:1',
        ]);

        $totalPrice = 0;
        foreach ($order->products as $product) {
            $totalPrice += $product->pivot->sub_total;
        }

        try {
            $order->update([
                'user_id' => $request->get('user_id'),
                'total_price' => $totalPrice,
            ]);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot update order!');
        }

        if ($order->wasChanged()) {
            return redirect()->back()->with('status', 'Order updated!');
        } else {
            return redirect()->back()->with('error', 'No change was made!');
        }
    }

    public function destroyProduct($orderId, $productId)
    {
        $order = Order::find($orderId);
        $order->products()->detach($productId);

        $totalPrice = 0;
        foreach ($order->products as $product) {
            $totalPrice += $product->pivot->sub_total;
        }

        try {
            $order->update(['total_price' => $totalPrice,]);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot update order!');
        }

        if ($order->wasChanged()) {
            return redirect()->back()->with('status', 'Order updated!');
        } else {
            return redirect()->back()->with('error', 'No change was made!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            Order::find($id)->products()->detach();
            Order::destroy($id);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot delete order!');
        }

        return redirect()->route('editor.orders.index')->with('status', 'Order "' . $id . '"' . ' deleted!');
    }
}
