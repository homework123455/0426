<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Good;
use DB;
use App\Cart;
use App\Order;
use App\Setting;
use App\Addstock;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
class CheckoutController extends Controller
{
    public function store(Request $request)
    {
		$low_prices =Setting::where('id','1')->value('low_prices');
		$good =Good::all();
		$all = 0;
		$i=0;
		 $data = DB::table('carts')
                ->where('users_id',Auth::user()->id)
                ->get();
            foreach ($data as $s){
                $all = $all + $s->total;
				$i = $i + $s->total;
            }
			
		if(Auth::user()->vip ==1&&$i>$low_prices){
       
	      Order::create([
            'name' => $request->name,
            'address' => $request->address,
            'postcode' => $request->postcode,
			'ph_number'=>$request->ph_number,
			'car_money'=>0,
			'vip_check'=>1
            
        ]);
		}
		elseif(Auth::user()->vip ==1&&$i<$low_prices){
		
	      Order::create([
            'name' => $request->name,
            'address' => $request->address,
            'postcode' => $request->postcode,
			'ph_number'=>$request->ph_number,
			'car_money'=>1,
			'vip_check'=>1
            
        ]);
		}
		elseif(Auth::user()->vip ==0&&$i>$low_prices){
		
	      Order::create([
            'name' => $request->name,
            'address' => $request->address,
            'postcode' => $request->postcode,
			'ph_number'=>$request->ph_number,
			'car_money'=>0,
			'vip_check'=>0,
			'buytime'=>Carbon::now()->toDateString(),
            
        ]);
		}
		elseif(Auth::user()->vip==0&&$i<$low_prices){
		
	       Order::create([
            'name' => $request->name,
            'address' => $request->address,
            'postcode' => $request->postcode,
			'ph_number'=>$request->ph_number,
			'car_money'=>1,
			'vip_check'=>0,
            'buytime'=>Carbon::now()->toDateString(),
        ]);
		}

		
        $count =  DB::table('orders')->orderby('id','Desc')->value('id');
        DB::table('orders')->where('users_id',null)->update(
            [
                'users_id'=>Auth::user()->id,
				'status'=>"未處理",
				'created_at'=>Carbon::now(),
            ]
        );
		
        while 
		($row = Cart::where('users_id',Auth::user()->id)->first() != null){
            $cart = Cart::where('users_id',Auth::user()->id)->first();
			foreach($good as $good1){
				if($cart->product==$good1->name){
					$product_id=$good1->id;
				}
			}
			/*
		$link=mysqli_connect("localhost:33060","root","root","homestead");
		$sql1 ="SELECT * FROM addstock WHERE good_id='$product_id'";
		$rec1 = $link->query($sql1);	
		$rNum = $rec1->num_rows;
		$rs1 = $rec1->fetch_array();
		$S2=$rs1['supply_id'];
		*/
            
		$value=$cart->qty;
		$addstocks=Addstock::where('good_id',$product_id)->where('value','>','0')->orderby('id','ASC')->get();
		foreach($addstocks as $addstock){
			
		$link=mysqli_connect("localhost:33060","root","root","homestead");
		$sql ="SELECT * FROM addstock WHERE id='$addstock->id'";
		$rec = $link->query($sql);	
		$rNum = $rec->num_rows;
		$rs = $rec->fetch_array();
		$S1=$rs['value'];
		$S2=$rs['supply_id'];
		
		
		if($value >= $S1){
			DB::table('ordersdetail')->insert(
                [
                    'qty' => $S1,
                    'product' => $cart->product,
                    'cost' => $cart->cost,
                    'total' => $S1*$cart->cost,
                    'users_id' => Auth::user()->id,
                    'orders_id' => $count,
					'product_id'=>$product_id,
					'supply_id'=>$S2
					
                ] );
		$addstock->update([
             'value' => '0'
			 
        ]);
		$value= $value - $S1;
		}
		else{
			DB::table('ordersdetail')->insert(
                [
                    'qty' => $value,
                    'product' => $cart->product,
                    'cost' => $cart->cost,
                    'total' => $value*$cart->cost,
                    'users_id' => Auth::user()->id,
                    'orders_id' => $count,
					'product_id'=>$product_id,
					'supply_id'=>$S2
					
                ] );
			$addstock->update([
             'value' => $S1 - $value
			 
        ]);
			break;
		}
		}	
           
			$level = DB::table('users')->where('id', Auth::user()->id)->value('level');
		DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
            'level' =>$level+$cart->total,
			
        ]);
		$level1 = DB::table('users')->where('id', Auth::user()->id)->value('level');
		$vip=Setting::where('id',1)->value('vip');
		if($level1>$vip){
			DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
            'vip' => 1,
			'vip_time'=>Carbon::now()
			
        ]);
		}
			$stock=Good::where('name',$cart->product)->get()->first();
			//$result = $stock->stock-$cart->qty;
			/*DB::table('goods')->where('name',$cart->product)->update(
			[
			'stock'=>$result
			]);*/
			
			
            Cart::where('users_id',Auth::user()->id)->first()->delete();
        }
        return redirect()->route('main.shop');
    }

    public function cartdetail()
    {
		$low_prices =Setting::where('id','1')->value('low_prices');
		$vip_discount=Setting::where('id',1)->value('vip_discount');
		$price=Setting::where('id',1)->value('prices');
		$low_price=Setting::where('id',1)->value('low_prices');
		$vip=User::where('id',Auth::user()->id)->value('vip');
        $all = 0;
		$q=0;
        $data = DB::table('carts')
            ->where('users_id', Auth::user()->id)
            ->get();
        foreach ($data as $s) {
            $all = $all + $s->total;
        }
		if($vip==0){
			$vip_all=0;
			if($all < $low_price){
				$all =$all + $price;
				$q = $price;
				
			}
			else
			{
			$all =$all;
			$q =0;
			}
			}
		elseif($vip==1){

			if($all < $low_price){
			$q =$price;	
			$all =$all+$q;
			$vip_all=ceil($all*$vip_discount/10);
			
			}
			else
			{
				$all=$all;
				$q=0;
				$vip_all=ceil($all*$vip_discount/10);
			}
			}
			
			
        return view('checkout', ['checkouts' => $data, 'a' => $all,'q'=>$q,'vip'=>$vip,'vip_all'=>$vip_all]);

    }

}
