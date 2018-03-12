<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemStore;
use App\Http\Requests\OrderItemSUpdate;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Product;
use App\Helpers;

class OrderItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\OrderItemStore  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemStore $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);
            $amount  = $request->product_amount ? $request->product_amount : 1;
            $price   = $request->product_discount && $request->product_discount > 0 ? Helpers::money_reverse($request->product_discount) : $product->price;
            $data['product']    = $product->name;
            $data['price']      = $price;
            $data['subtotal']   = $price * $amount;
            $data['amount']     = $amount;
            $data['order_id']   = $request->order_id;
            $data['product_id'] = $request->product_id;
            $verifyissetitem    = OrderItem::where('product_id', $request->product_id)->where('order_id', $request->order_id);
            if(count($verifyissetitem->get()) == 0){
                OrderItem::create($data);
            }else{
                $item = $verifyissetitem->first();
                $item->delete();
                OrderItem::create($data);
            }
            $msg = ['status'=>1, 'response'=>'Produto adicionado com sucesso!'];
            return json_encode($msg);
        } catch (\Exception $e) {
            $msg = ['status'=>2, 'response'=>'Erro ao adicionar o Produto!'];
            return json_encode($msg);
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
        try {
            $customer = OrderItem::find($id);
            $customer->delete();
            $msg = ['status'=>1, 'response'=>'Produto removido com sucesso!'];
            return json_encode($msg);
        } catch (\Exception $e) {
            $msg = ['status'=>2, 'response'=>'Erro ao remover o produto!'];
            return json_encode($msg);
        }
    }

        /**
     * Display resources by order_id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($order_id)
    {
        $items =  OrderItem::where('order_id', $order_id);
        $results = [];
        foreach($items->get() as $key => $value) {
            $results[$key]['id']         = $value->id;
            $results[$key]['product']    = $value->products->name;
            $results[$key]['price']      = number_format($value->products->price, 2, ',', '.');
            $results[$key]['discount']   = number_format($value->price, 2, ',', '.');
            $results[$key]['amount']     = $value->amount;
            $results[$key]['subtotal']   = number_format($value->subtotal, 2, ',', '.');
        }

        if($items->count() > 0) {
            $msg = ['status'=>1, 'response'=>$results];
            return json_encode($msg);
        }else{
            $msg = ['status'=>2, 'response'=>'false'];
            return json_encode($msg);
        }

    }
}
