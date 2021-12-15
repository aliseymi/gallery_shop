<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function all()
    {
        $orders = Order::paginate(10);

        return view('admin.orders.all', compact('orders'));
    }

    public function showDetails(Request $request)
    {
        $id = $request->id;

        $order = Order::find($id);

        $totalPrice = $order->amount;

        $orderItems = $order->orderItems;
        
        $orderItemRows = '';
        foreach($orderItems as $orderItem){
            $product = $orderItem->product;

            $orderItemRows .= '
            <tr>
                <td>
                    <img src="/'.$product->thumbnail_url.'" class="product_img">
                    '.$product->category->title.'</td>
                <td>'.$product->title.'</td>
                <td>
                    <a href="#" class="btn btn-default btn-icons" title="لینک دمو"><i class="fa fa-link"></i></a>
                </td>
                <td>
                    <a href="#" class="btn btn-default btn-icons" title="لینک دانلود"><i class="fa fa-link"></i></a>
                </td>
                <td>'.number_format($product->price).' تومان</td>
            </tr>';
        }

        $mainOutput['orderItemRows'] = $orderItemRows;
        $mainOutput['totalPrice'] = number_format($totalPrice) . ' تومان';

        return $mainOutput;
    }
}
