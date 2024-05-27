<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalletTransaction;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'free_min' => 5
        ]);
        // Create wallet for the user and set initial balance
        $initialBalance = 50; // Set initial wallet balance to 0
        $walletTransaction = new WalletTransaction();
        $walletTransaction->user_id = $user->id;
        $walletTransaction->amount = $initialBalance;
        $walletTransaction->transaction_type = 'credit';
        $walletTransaction->message = "Registration reward";
        $walletTransaction->created_at = now();
        $walletTransaction->updated_at = now();
        $walletTransaction->save();

        // Update the user's wallet_balance with the initial balance
        $user->wallet_balance += $initialBalance;
        $user->save();
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Registered successfull!');
    }
}
