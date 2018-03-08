<?php

namespace App\Http\Controllers;
use App\Http\Requests\CustomerStore;
use App\Http\Requests\CustomerUpdate;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('dashboard.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CustomerStore  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStore $request)
    {
        try{
            $input = $request->all();
            Customer::create($input);
            return redirect('dashboard/customer/create')->with('success', 'Salvo com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/customer/create')->with('error', 'Erro ao cadastrar!');
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
        $customer = Customer::find($id);
        return view('dashboard.customer.edit', compact('customer'));
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
            $customer = Customer::find($request->id);
            $customer->fill($request->all())->save();
            return redirect('dashboard/customer/edit/'.$request->id)->with('success', 'Salvo com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/customer/edit/'.$request->id)->with('error', 'Erro ao salvar!');
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
            $customer = Customer::find($id);
            $customer->delete();
            return redirect('dashboard/customers/')->with('success', 'Registro excluído com sucesso!');
        }catch(\Exception $e){
            return redirect('dashboard/customers/')->with('error', 'Erro ao excluir!');
        }
    }
}
