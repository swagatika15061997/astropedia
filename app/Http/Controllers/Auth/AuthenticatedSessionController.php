<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Cart;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $this->mergeSessionCartWithUserCart();
        return redirect()->intended(RouteServiceProvider::HOME)->with('info', 'Welcome to astropedia!');
    }

    /**
     * Destroy an authenticated session.
     */
    public function mergeSessionCartWithUserCart()
{
    if (Auth::check()) {
        $userId = Auth::id();
        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {
            foreach ($sessionCart as $productId => $cartItem) {
                $existingCartItem = Cart::where('product_id', $productId)
                    ->where('customer_id', $userId)
                    ->first();

                if ($existingCartItem) {
                    return redirect()->back()->with('warning', 'Product already added to cart!');
                } else {
                    $cartItemModel = new Cart();
                    $cartItemModel->customer_id = $userId;
                    $cartItemModel->product_id = $productId;
                    $cartItemModel->quantity = $cartItem['quantity'];
                    $cartItemModel->price = $cartItem['price'];
                    $cartItemModel->name = $cartItem['name'];
                    $cartItemModel->discount = $cartItem['discount'];
                    $cartItemModel->thumbnail = $cartItem['thumbnail'];
                    $cartItemModel->save();
                }
            }

            // Clear session cart after merging with user cart
            session()->forget('cart');
        }
    }
}

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('info', 'Welcome back soon!');
    }
}
