<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'merchandise_total' => 'required|numeric',
            'shipping_fee' => 'required|numeric',
            'total_payment' => 'required|numeric',
            'cart_data' => 'required',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'payment_method' => $request->payment_method,
                'merchandise_total' => $request->merchandise_total,
                'shipping_fee' => $request->shipping_fee,
                'total_payment' => $request->total_payment,
            ]);

            $cartItems = json_decode($request->cart_data, true);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            DB::commit();
            return redirect()->route('order.success')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Order failed: ' . $e->getMessage()]);
        }
    }


    public function generateOrdersPDF()
    {
        $orders = Order::all();
        $pdf = Pdf::loadView('pdfOrders', compact('orders'));
        return $pdf->download('orders_report.pdf');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $orderIds = $request->input('order_ids', []);

        if (empty($orderIds)) {
            return back()->with('error', 'No orders selected.');
        }

        if ($action === 'delete') {
            Order::whereIn('id', $orderIds)->delete();
            return back()->with('success', 'Selected orders deleted.');
        }

        if ($action === 'edit') {
            return redirect()->route('admin.orders.batchEdit', ['ids' => implode(',', $orderIds)]);
        }

        return back()->with('error', 'Invalid action.');
    }


}

