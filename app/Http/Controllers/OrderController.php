<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\PaymentController;
use App\Mail\OrderEmail;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderDetial;
use App\Models\Part;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Throwable;

class OrderController extends Controller
{
   
    public function addToCart($pId)
    {
        $parts = Part::find($pId);
    
        // Check if the parts is in stock
        if ($parts->stock > 0) {
            $myCart = session()->get('basket');
    
            // Check if the parts has a discount
            if ($parts->discount > 0) {
                // Calculate discounted price
                $discountedPrice = $parts->price - ($parts->price * $parts->discount / 100);
            } else {
                // Use original price if no discount
                $discountedPrice = $parts->price;
            }
    
            // Step 1: If cart is empty
            if (empty($myCart)) {
                // Action: Add to cart
                $cart[$parts->id] = [
                    'parts_id' => $parts->id,
                    'parts_name' => $parts->name,
                    'price' => $discountedPrice, // Use discounted price
                    'quantity' => 1,
                    'subtotal' => 1 * $discountedPrice, // Calculate subtotal with discounted price
                    'image' => $parts->image,
                ];
    
                session()->put('basket', $cart);
    
                notify()->success('Part added to cart.');
                return redirect()->back();
            } else {
                // Step 2: If part already exists in cart, update quantity and subtotal
                if (array_key_exists($pId, $myCart)) {
                    if ($parts->stock > $myCart[$pId]['quantity']) {
                        // Increase quantity and update subtotal
                        $myCart[$pId]['quantity'] = $myCart[$pId]['quantity'] + 1;
                        $myCart[$pId]['subtotal'] = $myCart[$pId]['quantity'] * $myCart[$pId]['price'];
    
                        session()->put('basket', $myCart);
    
                        notify()->success('Quantity updated.');
                        return redirect()->back();
                    } else {
                        notify()->error('Quantity not available.');
                        return redirect()->back();
                    }
                } else {
                    // Step 3: Add new part to cart
                    $myCart[$parts->id] = [
                        'parts_id' => $parts->id,
                        'parts_name' => $parts->name,
                        'price' => $discountedPrice, // Use discounted price
                        'quantity' => 1,
                        'subtotal' => 1 * $discountedPrice, // Calculate subtotal with discounted price
                        'image' => $parts->image,
                    ];
    
                    session()->put('basket', $myCart);
                    notify()->success('Part added to cart.');
                    return redirect()->back();
                }
            }
        } else {
            notify()->error('This part is out of stock.');
            return redirect()->back();
        }
    }
    
    public function viewCart()
    {

    $myCart=session()->get('basket')?? [];
   //dd($myCart);
    return view('frontend.pages.cart',compact('myCart'));
    }


    public function clearCart()
    {
    session()->forget('basket');
     notify()->success('Cart clear.');
    return redirect()->back();

    }

    public function cartItemDelete($pId)
    {
        
        $cart=session()->get('basket');

       unset($cart[$pId]);


    
       session()->put('basket',$cart);

       notify()->success('Item remove.');

       return redirect()->back();

  
    }
    public function checkout()
    {

        $myCart=session()->get('basket')?? [];
        return view('frontend.pages.checkout',compact('myCart'));
    }

    public function placeOrder(Request $request)
    {

       
        // dd($request->all());
        //step1 validation
        $validation=Validator::make($request->all(),[
            'receiver_name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'paymentMethod'=>'required|in:cod,online'
            ]);
    
        if($validation->fails())
        {
            notify()->error($validation->getMessageBag());
           
            return redirect()->back();
        }
        try{
    
            $cart=session()->get('basket');
            
            //quary for store data into Orders table
            DB::beginTransaction();
           
            $order=Order::create([
                'receiver_name'=>$request->receiver_name,
                'receiver_email'=>$request->email,
                'receiver_address'=>$request->address,
                'receiver_mobile'=>auth('customerGuard')->user()->mobile,
                'payment_method'=>$request->paymentMethod,
                'customer_id'=>auth('customerGuard')->user()->id,
                'total_amount'=>array_sum(array_column($cart,'subtotal'))
    
            ]);
    
            //quary for storing data into Order_details table
            
            foreach($cart as $singleData)
            {
              
                OrderDetail::create([
                    'order_id'=>$order->id,
                    'parts_id'=>$singleData['parts_id'],
                    'parts_unit_price'=>$singleData['price'],
                    'parts_quantity'=>$singleData['quantity'],
                    'subtotal'=>$singleData['subtotal'],
                ]);
                 //decrement stock 
            $parts=Part::find($singleData['parts_id']);
            $parts->decrement('stock',$singleData['quantity']);
            }
            DB::commit();
    
            // notify()->success('Order place successfully.');
            session()->forget('basket');

            Mail::to($request->email)->send(new OrderEmail($order));

            if($request->paymentMethod != 'cod')
            {
                //jodi cod na hoy tahole online payment korbe.
                //call ssl commerz to pay
                $payment=new PaymentController();
    
                $payment->payNow($order); 
                
            }if ($request->paymentMethod == 'cod')
            {

                notify()->success('Order place seccessfully');
                session()->forget('basket');
                return redirect()->route('home');
            }
                            
                }catch(Throwable $exception){

                    DB::rollBack();
                    notify()->error($exception->getMessage());

                    return redirect()->back();
                }

                

                
               
                      
    
        }
        public function viewInvoice($id)
        {
            $order=Order::with('orderDetails')->find($id);
            return view('frontend.pages.invoice',compact('order'));
        }
        public function order() {
            $allOrders = Order::with('customer')->orderBy('created_at', 'desc')->paginate(10); 
            return view('backend.order', compact('allOrders'));
        }
        
    public function orderView($id)
    {

        $orders=Order::find($id);
        return view ('backend.page.orderView',compact('orders'));
    }
    public function orderConfirm($id)
    {

        $orders=Order::find($id);
        $orders->update(['status'=>'accept']);
        return redirect()->back();
    }

    public function orderStatus(Request $request,$id){

        $orders=Order::find($id);
    //    dd($orders);
        $orders->update([
            'status'=>$request->order_status]);
            return redirect()->route('order.list');


    }
    public function updateCart(Request $request, $id)
{
    $cart = session()->get('basket');
    $parts = Part::find($id);

    // Ensure quantity is at least 1
    $quantity = max(1, $request->quantity);

    if ($parts->stock >= $quantity) {
        $cart[$id]['quantity'] = $quantity;
        $cart[$id]['subtotal'] = $quantity * $cart[$id]['price'];

        session()->put('basket', $cart);
        notify()->success('Cart updated.');
    } else {
        notify()->error('Stock not available');
    }

    return redirect()->back();
}

    

}
