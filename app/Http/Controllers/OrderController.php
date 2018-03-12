<?php

namespace App\Http\Controllers;
use App\Http\Requests\OrderStore;
use App\Http\Requests\CustomerUpdate;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Product;
use App\Helpers;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('dashboard.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('dashboard.order.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\OrderStore  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStore $request)
    {
        try{
            $data                = $request->all();
            $data['transaction'] = Helpers::gen_token(10);
            $data['total']       = '0.00';
            $data['status_id']   = 5;
            $order               = Order::create($data);
            return redirect('dashboard/order/edit/'.$order->transaction);
        }catch(\Exception $e){
            return redirect('dashboard/order/create')->with('error', 'Erro ao cadastrar!');
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
    public function edit($transaction)
    {
        $customers = Customer::all();
        $products  = Product::all();
        $order = Order::where('transaction', $transaction)->first();
        $items = OrderItem::where('order_id', $order->id)->get();
        return view('dashboard.order.edit', compact('order', 'customers', 'products', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\CustomerUpdate  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdate $request)
    {
        try{
            $customer = Order::find($request->id);
            $customer->fill($request->all())->save();
            return redirect('dashboard/order/edit/'.$request->id)->with('success', 'Salvo com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/order/edit/'.$request->id)->with('error', 'Erro ao salvar!');
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
            $customer = Order::find($id);
            $customer->delete();
            return redirect('dashboard/orders/')->with('success', 'Registro excluído com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/orders/')->with('error', 'Erro ao excluir!');
        }
    }
}
