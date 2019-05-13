<?php

use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;

class MySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create(['name'=>'Walter','email'=>'walter@gamail.com', 'password'=>bcrypt('secret')]);

       $c1 = Customer::create(['name'=>'John Doe','phone'=>'111-222-22','address'=>'Westlands']);
       $c2 = Customer::create(['name'=>'Jane Doe','phone'=>'111-333-22','address'=>'Kilimani']);

       $p1= Product::create(['name'=>'Cement', 'quantity'=>100,'price'=>450]);
       $p2= Product::create(['name'=>'Nails Pack', 'quantity'=>200,'price'=>2000]);
       $p3= Product::create(['name'=>'Paint', 'quantity'=>500,'price'=>1450]);
       $p4= Product::create(['name'=>'Tiles Pack', 'quantity'=>800,'price'=>680]);


       $order_1 = Order::create(['customer_id'=>1, 'total'=>4000]);
       $order_2 = Order::create(['customer_id'=>2, 'total'=>6800]);
       $order_3 = Order::create(['customer_id'=>1, 'total'=>4500]);


       $d1 = OrderDetail::create(['order_id'=>1, 'product_id'=>2,'quantity'=>2,'total'=>4000]);
       $d2 = OrderDetail::create(['order_id'=>2, 'product_id'=>1,'quantity'=>3,'total'=>4000]);
       $d3 = OrderDetail::create(['order_id'=>3, 'product_id'=>4,'quantity'=>1,'total'=>4000]);

    }
}
