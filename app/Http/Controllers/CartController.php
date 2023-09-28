<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $cartItems = Auth::user()->carts;

        return view('cart.index', compact('cartItems', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = new Cart();
        $books = $user->carts()->where('book_id', $request['book'])->get();

        if ($books->isEmpty()) {
            $cart->user_id = $user->id;
            $cart->quantity = 1;
            $cart->book_id = $request['book'];

            $cart->save();
        } else {
            return response()->json(['error' => __('error.already_in_cart')]);
        }
        return response()->json(['success' => __('success.add_to_cart_success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('carts.index');
    }

    public function increase(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->input('book');

        $cartItem = $user->carts()->where('book_id', $bookId)->first();

        $book = Book::where('id', $bookId)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + 1;
            if ($newQuantity > $book->stock) {
                return response()->json(['error' => __('error.maximum_quantity')]);
            } else {
                DB::table('carts')
                    ->where('user_id', $user->id)
                    ->where('book_id', $bookId)
                    ->update(['quantity' => $newQuantity]);
                return response()->json(['success' => __('success.update_success')]);
            }
        } else {
            return response()->json(['error' => __('error.dont_exist')]);
        }
    }

    public function decrease(Request $request)
    {
        $user = Auth::user();
        $bookId = $request->input('book');

        $cartItem = $user->carts()->where('book_id', $bookId)->first();

        $book = Book::where('id', $bookId)->first();

        if ($cartItem) {
            if ($cartItem->quantity > config('app.min_book_cart')) {
                $newQuantity = $cartItem->quantity - 1;
                if ($newQuantity > $book->stock) {
                    return response()->json(['error' => __('error.maximum_quantity')]);
                } else {
                    DB::table('carts')
                        ->where('user_id', $user->id)
                        ->where('book_id', $bookId)
                        ->update(['quantity' => $newQuantity]);

                    return response()->json(['success' => __('success.update_success')]);
                }
            } else {
                return response()->json(['error' => __('error.minimum_quantity')]);
            }
        } else {
            return response()->json(['error' => __('error.dont_exist')]);
        }
    }
}
