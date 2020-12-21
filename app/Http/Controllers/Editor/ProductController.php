<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userTitle = 'editor';

        return view('editor.products.home', [
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
            'avatar' => Auth::user()->profile->avatar,
            'productList' => Product::all(),
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

        return view('editor.products.create', compact('userTitle', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255|unique:products',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|integer|gt:0',
            'type' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'catalog_id' => 'nullable|integer|gte:1',
        ]);

        try {
            Product::create([
                'product_name' => $request->get('product_name'),
                'brand' => $request->get('brand'),
                'price' => $request->get('price'),
                'type' => $request->get('type'),
                'image' => $request->get('image'),
                'catalog_id' => $request->get('catalog_id'),
            ]);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot add new product!');
        }

        return redirect()->route('editor.products.index')->with('status', '"' . $request->get('product_name') . '" added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $userTitle = 'editor';
        $product = Product::find($id);

        return view('editor.products.details', [
            'id' => $product->id,
            'product_name' => $product->product_name,
            'brand' => $product->brand,
            'price' => $product->price,
            'type' => $product->type,
            'image' => $product->image,
            'catalog_id' => $product->catalog_id,
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $request->validate([
            'product_name' => 'required|string|max:255|unique:products,product_name,' . $product->id,
            'brand' => 'nullable|string|max:255',
            'price' => 'required|integer|gte:0',
            'type' => 'nullable|string|max:255',
            'image' => 'nullable|string',
            'catalog_id' => 'nullable|integer|gte:1',
        ]);

        $productInput = $request->only('product_name', 'brand', 'price', 'type', 'image', 'catalog_id');

        try {
            $product->update($productInput);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot update product!');
        }

        if($product->wasChanged()) {
            return redirect()->back()->with('status', 'Product updated!');
        } else {
            return redirect()->back()->with('error', 'No change was made!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $productName = Product::find($id)->product_name;

        try {
            Product::destroy($id);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot delete product!');
        }

        return redirect()->route('editor.products.index')->with('status', 'Product "' . $productName . '"' . ' deleted!');
    }
}
