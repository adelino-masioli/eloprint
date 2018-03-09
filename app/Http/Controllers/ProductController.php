<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductStore;
use App\Http\Requests\ProductUpdate;
use App\Models\Product;
use \App\Models\Statu;
use \App\Helpers;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Statu::whereIn('id', [1,2])->get();
        return view('dashboard.product.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductStore  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request)
    {
        try{
            $data          = $request->all();
            $data['price'] = Helpers::money_reverse($request->price);

            Product::create($data);
            return redirect('dashboard/product/create')->with('success', 'Salvo com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/product/create')->with('error', 'Erro ao cadastrar!');
        }
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
        $product = Product::find($id);
        $status = Statu::whereIn('id', [1,2])->get();
        return view('dashboard.product.edit', compact('product', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ProductUpdate  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdate $request)
    {
        try{
            $product       = Product::find($request->id);
            $data          = $request->all();
            $data['price'] = Helpers::money_reverse($request->price);
            $product->fill($data)->save();
            return redirect('dashboard/product/edit/'.$request->id)->with('success', 'Salvo com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/product/edit/'.$request->id)->with('error', 'Erro ao salvar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $product = Product::find($id);
            $product->delete();
            return redirect('dashboard/products/')->with('success', 'Registro excluído com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/products/')->with('error', 'Erro ao excluir!');
        }
    }


    /**
     * Duplicate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function duplicate($id)
    {
        try{
            $row                = Product::findOrFail($id);
            $newname            = $row->name . '-Copy'.date('Y-m-d H:m:s');
            $data               = $row;
            $data['name']       = $newname;
            $data['status_id']  = 2;
            $array              = $data->replicate()->save();
            
            return redirect('dashboard/products/')->with('success', 'Registro duplicado com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/products/')->with('error', 'Erro ao duplicar!');
        }
    }
}
