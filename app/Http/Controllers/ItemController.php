<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Item;
use \App\Order;
use Session;
use Auth;

class ItemController extends Controller
{
    function showMenu(){
    	// return view('hello',['item1' => 'sample item 1','item2' => 'sample item 2']);


    	// return view('hello')->with('item1','sample item 1')
    	// 					->with('item2','sample item 2');

    	$items = Item::all(); //SELECT * FROM items;
    	return view('show_items',['items' => $items]);

    }

    function itemDetails($id){
    	$item = Item::find($id);
    	return view('items.item_details', compact('item'));
    }

    function addItem(){
        return view('items.add_items');
    }

    function saveItem(Request $request){
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            // 'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        );

        $this->validate($request, $rules);

        $item = new Item;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->category_id =  $request->categories;

        $image = $request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $destination = "image/";
        $image->move($destination, $image_name);
        $item->image = $destination.$image_name;

        $item->save();

        // Session::has('success_message'); //isset
        // Session::get('success_message'); //to display or retrieve
        // Session::flush(); //session destroy, it will delete all the variable -  typically it will be on log out
        // Session::forget('success_message'); // unset
        Session::flash('success_message', 'Item added successfully.');

        return redirect("/menu");
    }

    function editItemForm($id){
        $item = Item::find($id);

        return view('items.edit_item', compact('item'));

    }

    function updateItem(Request $request, $id){
     $rules = array(
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    );

     $this->validate($request, $rules);
     $item = Item::find($id);
     $item->name = $request->name;
     $item->description = $request->description;
     $item->price = $request->price;
     $item->category_id = $request->categories;

     $image = $request->file('image');
     $image_name = time().'.'.$image->getClientOriginalExtension();
     $destination = "image/";
     $image->move($destination, $image_name);
     $item->image = $destination.$image_name;

     $item->save();

        // Session::flush(); //session destroy, it will delete all the variable
        // Session::forget('success_message'); // unset
     Session::flash('success_message', $request->name.'Item updated successfully.');
     return redirect("/menu/$id");
 }

 function delete($id){
    $item = Item::find($id);
    $item->delete();
    Session::flash('delete_message', 'Item deleted successfully.');

    return redirect('/menu');
}
function addToCart(Request $request, $id){
        // if(Session::has('cart'))
        //     $cart = Session::get('cart');
        // else
        //     $cart = [];

        // if(isset($cart[$id]))
        //     $cart[$id] += $request->quantity;
        // else
        //     $cart[$id] = $request->$quantity;

    $quantity = Session::has("cart.$id") ? /*this is your condition, cart is the array*/

    Session::get("cart.$id") + $request->quantity : $request->quantity; /*short cut for if else statement*/

    Session::put("cart.$id", $quantity);

    $item = Item::find($id);

    Session::flash('success_message', "$request->quantity $item->name Added to Cart");

    return redirect('/menu');
}

function showCart(){

    $cart = Session::get('cart');
    $cart_items = [];
    $total = 0;

    if (Session::has('cart')) {
        foreach ($cart as $item_id => $quantity) {
            $cart_item = Item::find($item_id);  
            $cart_item->quantity = $quantity;
            $cart_item->subtotal = $quantity * $cart_item->price;
            $total += $cart_item->subtotal;

            $cart_items[] = $cart_item;
        }

    }
    return view('items.my_cart', compact('cart_items', 'total'));
}

function emptyCart(){
    Session::forget("cart");

    Session::flash('delete_message', 'Your Cart is Empty.');

    return redirect()->back();

}

function removeCart($id){

    Session::forget("cart.$id");

    $item = Item::find($id);
    Session::flash('delete_message', "$item->name Removed from cart");
    return redirect()->back();
}


function updateQuantity(Request $request, $id){

   Session::put("cart.$id", $request->quantity);
   $item = Item::find($id);
   Session::flash('success_message','Quantity updated successfully.');
   return redirect()->back();
}

function checkOut(){
    $order = new Order;
    $order->user_id = Auth::user()->id;
    $order->total = 0;
    $order->save();

    $total = 0;

    foreach (Session::get('cart') as $item_id => $quantity){
        $order->items()->attach($item_id, ['quantity'=>$quantity]);
        $item = Item::find($item_id);
        $total += $item->price * $quantity;
    }

        $order->total = $total;
        $order->save(); 

        Session::forget('cart');

        return redirect('/orders');
}

function showOrders(){
    $orders = Order::where('user_id','=',Auth::user()->id)->get();

    return view('order', compact('orders'));
}

}
