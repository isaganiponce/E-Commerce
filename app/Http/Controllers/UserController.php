<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\User;

class UserController extends Controller
{
    public function userHome(Request $request)
    {
        $query = Product::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%");
        }
        $products = $query->get();
        $tops = Product::where('category', 'tops')->take(5)->get();
        $bottoms = Product::where('category', 'bottoms')->take(5)->get();
        $bna = Product::where('category', 'bna')->take(5)->get();
        $footwear = Product::where('category', 'footwear')->take(5)->get();

        return view('home', compact('products', 'tops', 'bottoms', 'bna', 'footwear'));
    }

    public function tops()
    {
        $products = Product::where('category', 'tops')->get();
        return view('tops', compact('products'));
    }

    public function bottoms()
    {
        $products = Product::where('category', 'bottoms')->get();
        return view('bottoms', compact('products'));
    }

    public function bna()
    {
        $products = Product::where('category', 'bna')->get();
        return view('bna', compact('products'));
    }

    public function footwear()
    {
        $products = Product::where('category', 'footwear')->get();
        return view('footwear', compact('products'));
    }

    public function checkoutnpayment(Request $request)
    {
        $cart = session('cart', []);
        $orderedProducts = [];

        if ($request->has('product_id')) {
            // Single product checkout
            $product = Product::with('sizes')->findOrFail($request->input('product_id'));
            $size = $request->input('size');
            $quantity = $request->input('quantity', 1);

            $orderedProducts = [
                [
                    'product' => $product,
                    'size' => $size,
                    'quantity' => $quantity,
                ]
            ];
        }

        return view('checkoutnpayment', compact('cart', 'orderedProducts'));
    }

    function adminLogin()
    {
        if (View::exists('admin.login')) {
            return view('admin.login');
        } else {
            abort(404, 'Not Found');
        }
    }

    // log in
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.home');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|in:user,admin',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:20',
            'billing_address' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:255',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'billing_address' => $request->billing_address,
            'shipping_address' => $request->shipping_address,
            // 'email_verified_at' => now(), // Uncomment if you want to auto-verify
            // 'remember_token' => Str::random(10), // Optional
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.home');
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($user ? $user->id : 'NULL'),
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string',
            'billing_address' => 'nullable|string',
            'shipping_address' => 'nullable|string',
        ]);

        if ($user) {
            $user->fill($request->only([
                'name',
                'email',
                'phone',
                'dob',
                'gender',
                'billing_address',
                'shipping_address'
            ]));
            $user->save();

            return redirect('/account')->with('success', 'Profile updated successfully.');
        }

        return redirect('/login')->withErrors(['user' => 'User not authenticated.']);
    }


    public function show($id)
    {
        $product = Product::with('sizes')->findOrFail($id);
        return view('products_descrp', compact('product'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $cart[] = [
            'product_id' => $request->product_id,
            'size' => $request->size,
            'quantity' => $request->quantity,
        ];
        session(['cart' => $cart]);
        return response()->json(['success' => true]);
    }

    public function dashboard()
    {
        $totalRevenue = \App\Models\Order::sum('total');
        $totalProductsSold = \App\Models\OrderItem::sum('quantity');
        $totalCustomers = \App\Models\User::where('role', 'user')->count();
        $totalReturns = \App\Models\ReturnRequest::count();

        $orderHistory = \App\Models\Order::latest()->take(10)->get();
        $topProducts = \App\Models\OrderItem::select('product_id', \DB::raw('SUM(quantity) as sold'))
            ->groupBy('product_id')
            ->orderByDesc('sold')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalProductsSold',
            'totalCustomers',
            'totalReturns',
            'orderHistory',
            'topProducts'
        ));
    }
    public function saveCheckout(Request $request)
    {
        // Decode cart data from hidden input
        $cart = json_decode($request->input('cart_data'), true);

        if (!$cart || count($cart) === 0) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            // Add other order fields as needed (e.g., address, total, etc.)
        ]);

        // Save each cart item as an order item
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['productId'] ?? null,
                'size' => $item['size'] ?? null,
                'quantity' => $item['quantity'] ?? 1,
                'price' => $item['productPrice'] ?? 0,
            ]);
        }

        // Optionally, clear the cart in session/localStorage (handled in JS)
        // Redirect to a success page or show a message
        return redirect()->route('checkoutnpayment')->with('payment_success', true);
    }

    public function adminOrders()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function adminProducts(Request $request)
    {
        // Search functionality
        $query = Product::orderBy('id', 'asc');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('category', 'like', "%$search%");
            });
        }
        $products = $query->get();

        return view('admin.products', compact('products'));
    }

    // Add Product
    public function addProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'nullable|string|max:255',
            'image_path' => 'nullable|string|max:255',
        ]);
        Product::create($request->only('name', 'price', 'category', 'image_path'));
        return redirect()->route('admin.products')->with('success', 'Product added!');
    }

    // Edit Product
    public function editProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'nullable|string|max:255',
            'image_path' => 'nullable|string|max:255',
        ]);
        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'price', 'category', 'image_path'));
        return redirect()->route('admin.products')->with('success', 'Product updated!');
    }

    // Delete Product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }

    public function adminCustomers()
    {
        // Only get users with role 'user' (not admins)
        $customers = User::where('role', 'user')->orderBy('id', 'asc')->get();
        return view('admin.customers', compact('customers'));
    }

    public function signup()
    {
        return view('signup');
    }
}
