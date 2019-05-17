<?php

namespace App\Http\Controllers;

use AfricasTalking\SDK\AfricasTalking;
use App\Customer;
use App\Jobs\SendEmailJob;
use App\Jobs\SendSmsJob;
use App\Mail\OrderMail;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Safaricom\Mpesa\Mpesa;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id','DESC')->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $customers = Customer::all();
       return view('orders.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'=>'required|integer'
        ]);

        $order=Order::create([
            'customer_id'=>$request->customer_id,
            'total'=>0,
            'user_id'=>Auth::user()->id,
        ]);

        $customer = Customer::find($request->customer_id);

     //   $this->dispatch(new SendEmailJob($order, $customer));

        $message ="Your order number # ".$order->id." has been dispatched";

       // $this->dispatch(new SendSmsJob($customer->phone, $message));
        $this->pay();

        return redirect()->route('orders.index')->with('success','Order created');
    }

    public function pay()
    {
        $mpesa = new Mpesa();
        $BusinessShortCode="174379";
        $LipaNaMpesaPasskey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $TransactionType="CustomerPayBillOnline";
        $Amount="1";
        $PartyA="254723740215";
        $PartyB="174379";
        $PhoneNumber="254723740215";
        $CallBackURL="https://bbd7366a.ngrok.io/mpesa/confirm";
        $AccountReference="Testing";
        $TransactionDesc="Testing";
        $Remarks="Testing";

        $stkPushSimulation=$mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

        dd($stkPushSimulation);

    }


    //policy
    //php artisan make:policy OrderPolicy --model=Order

    //start the queue
    //php artisan queue:work


    //php artisan make:job SendEmailJob
    //php artisan make:job SendSmsJob

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findorFail($id);
        $products = Product::all();
        return view('orders.update', compact('order','products'));
    }

    //php artisan make:mail OrderMail

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity'=>'required|integer|min:1'
        ]);

        $order = Order::findOrFail($id);
        $product = Product::find($request->product_id);
        $order->total += $product->price * $request->quantity;
        $order->save();

        OrderDetail::create([
            'order_id'=>$id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'total'=>$product->price * $request->quantity
        ]);

        return back()->with('success','Order Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('success','Order Deleted');
    }
}
