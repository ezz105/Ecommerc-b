<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // List all orders for the authenticated user
    public function index()
{
    $user = Auth::user();

    if ($user->role === 'customer') {
        // Fetch only the user's orders
        $orders = Order::where('user_id', $user->id)->get();
    } elseif ($user->role === 'vendor') {
        // Fetch orders linked to the vendor's products
        $orders = Order::whereHas('orderItems', function ($query) use ($user) {
            $query->where('artisan_id', $user->id);
        })->get();
    } elseif ($user->role === 'admin') {
        // Admin sees all orders
        $orders = Order::all();
    } else {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    return response()->json(['success' => true, 'data' => $orders], 200);
}


    // Show a specific order for the authenticated user
    public function show($id)
    {
        $order = Order::with(['orderItems', 'shippingAddress', 'billingAddress'])
            ->where('user_id', Auth::id())
            ->find($id);
    
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        return response()->json(['order' => $order], 200);
    }
    

    // Place a new order
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_address_id' => 'required|exists:addresses,id',
            'billing_address_id' => 'required|exists:addresses,id',
            'total_amount' => 'required|numeric|min:0.01',
            'shipping_amount' => 'nullable|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string|max:1000',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|integer|min:1',
            'order_items.*.price_per_unit' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $order = Order::create([
            'order_number' => Str::uuid(),
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total_amount' => $request->total_amount,
            'shipping_amount' => $request->shipping_amount ?? 0,
            'tax_amount' => $request->tax_amount ?? 0,
            'discount_amount' => $request->discount_amount ?? 0,
            'payment_status' => 'pending',
            'payment_method' => null,
            'notes' => $request->notes,
            'shipping_address_id' => $request->shipping_address_id,
            'billing_address_id' => $request->billing_address_id,
        ]);

        foreach ($request->order_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price_per_unit' => $item['price_per_unit'],
                'total_price' => $item['quantity'] * $item['price_per_unit'],
            ]);
        }

        return response()->json(['success' => true, 'data' => $order], 201);
    }

    // Update the order status
    public function update(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->find($id);
    
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'notes' => 'nullable|string|max:1000',
        ]);
    
        if ($order->status === 'shipped' && $request->status === 'cancelled') {
            return response()->json(['error' => 'You cannot cancel an order that has already been shipped.'], 400);
        }
    
        $order->update([
            'status' => $request->status,
            'notes' => $request->notes ?? $order->notes,
        ]);
    
        return response()->json(['message' => 'Order updated successfully.', 'order' => $order], 200);
    }
    
    public function cancelOrder($id)
{
    $order = Order::where('user_id', Auth::id())->find($id);

    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }

    if (!in_array($order->status, ['pending', 'processing'])) {
        return response()->json(['error' => 'Order cannot be cancelled at this stage.'], 400);
    }

    $order->update(['status' => 'cancelled']);

    return response()->json(['message' => 'Order cancelled successfully.', 'order' => $order], 200);
}
public function destroy($id)
{
    $order = Order::where('user_id', Auth::id())->find($id);

    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }

    if ($order->status !== 'cancelled') {
        return response()->json(['error' => 'Only cancelled orders can be deleted.'], 400);
    }

    $order->delete();

    return response()->json(['message' => 'Order deleted successfully.'], 200);
}


}
