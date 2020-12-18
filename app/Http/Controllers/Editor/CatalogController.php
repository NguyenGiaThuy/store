<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $userTitle = 'editor';

        return view('editor.catalogs.home', [
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
            'avatar' => Auth::user()->profile->avatar,
            'catalogList' => Catalog::all(),
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

        return view('editor.catalogs.create', [
            'userTitle' => $userTitle,
            'username' => Auth::user()->username,
        ]);;
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
            'id' => 'required|integer|gte:1|unique:catalogs',
            'catalog_name' => 'required|string|max:255|unique:catalogs',
        ]);

        try {
            Catalog::create([
                'id' => $request->get('id'),
                'catalog_name' => $request->get('catalog_name'),
            ]);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot add new catalog!');
        }

        return redirect()->route('editor.catalogs.index')->with('status', '"' . $request->get('catalog_name') . '" added!');
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
        $catalog = Catalog::find($id);

        return view('editor.catalogs.details', [
            'id' => $id,
            'catalog_name' => $catalog->catalog_name,
            'productList' => $catalog->products,
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
        $catalog = Catalog::find($id);

        $request->validate([
            'catalog_name' => 'required|string|max:255|unique:catalogs,catalog_name,' . $catalog->id,
        ]);

        $catalogInput = $request->only('catalog_name');

        try {
            $catalog->update($catalogInput);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot update catalog!');
        }

        if($catalog->wasChanged()) {
            return redirect()->back()->with('status', 'Catalog updated!');
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
        $catalog = Catalog::find($id);
        $catalogName = $catalog->catalog_name;

        try {
            foreach ($catalog->products as $product) {
                $product->update(['catalog_id' => null]);
            }

            Catalog::destroy($id);

        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Cannot delete catalog!');
        }

        return redirect()->route('editor.catalogs.index')->with('status', 'Catalog "' . $catalogName . '"' . ' deleted!');
    }
}
