<!DOCTYPE HTML>
@extends('layouts.master')
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>體育用品系統</title>

    <!-- Favicon  -->
    <link rel="icon" href="../img/core-img/plant.ico">

    <!-- Core Style CSS -->
	<link href="{{ asset('css/style2.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/bootstrap2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/core-style.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
	<div class="breadcumb_area bg-img" style="background-image: url(../img/core-img/cartbp.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>購物車</h2>
                    </div>
                </div>
            </div>
        </div>
	</div>
	    <div class="container"> 
    <ul class="nav nav-pills nav-justified step step-arrow"> 
        <li style="width:320px;"> 
            <a href="{{ route('main.shop') }}">購買商品</a> 
        </li> 
        <li style="width:320px;"> 
            <a>確認購買內容</a> 
        </li> 
        <li style="width:320px;"> 
            <a>填寫基本資料</a> 
        </li> 
       
    </ul> 
 
 
</div>
	<div class="clearfix mr-50 mt-50 mb-50">
	</div>
	<div class="clearfix mr-50 mt-50 mb-50">
	</div>
    @if(count($carts)<1)
        <center>
        <h2>Nothing in Cart!</h2>
        </center>
    @else
		<center>
		<table>
        <tr>
        <td width="200" align="center" valign="center">
			<div class="product-left">
			    <h5></h5>
			</div>
		</td>
		<td width="250" align="center" valign="center">
			<div class="product-right">
				<h5>商品名稱</h5>
			</div>
		</td>
		<td width="20" align="center" valign="center">
				<h5>商品價格</h5>
		</td>
		<td width="50" align="center" valign="center">
			<div class="product-right1">
			    <h5>數量</h5>
			</div>
		</td>
		<td width="5" align="center" valign="center">
			<div class="product-right1">
			    <h5></h5>
			</div>
		</td>
		<td width="200" align="center" valign="center">
			<div class="product-right1">
			    <h5>總金額</h5>
			</div>
		</td>
		<td width="200" align="center" valign="center">
			
		</td>
		</tr>
		@foreach ($carts as $cart)
        <tr >
        <td width="200" align="center" valign="center">
			<div class="product-left">
				<img src={{$cart->photo}}>
			</div>
		</td>
		<td width="250" align="center" valign="center">
			<div class="product-right">
				<h6>{{$cart->product}}</h6>

			</div>
		</td>
		<td width="200" align="center" valign="center">
			<div class="product-right1">
				<h6>$ {{$cart->cost}}</h6>
				<div class="close"> </div>
			</div>
		</td>
		<td width="50" align="center" valign="center">
			<div class="product-right1">
			    <h6>{{$cart->qty}}</h6>
			</div>
		</td>
		<td width="5" align="center" valign="center">
			<div class="product-right1">
				<select name="qty" onchange="javascript:location.href=this.value;">
					<option value="">數量修改</option>
					<?php
					$link=mysqli_connect("localhost:33060","root","root","homestead");
					$sql ="SELECT * FROM goods WHERE id='$cart->product_id'";
					$rec = $link->query($sql);	
					//$rNum = $rec->num_rows;
					$rs = $rec->fetch_array();
					$S1=$rs['value'];
					
					
					?>
					
					@for($i=1;$i<=$S1;$i++)
					<option value="{{route('cart.update',['id'=>$cart->id,'q'=>$i])}}">{{$i}}</option>
				    @endfor
					
				</select>
            </div>
		</td>
		<td width="200" align="center" valign="center">
			<div class="product-right1">
				<h6>$ {{($cart->total)}}</h6>
				<div class="close"> </div>
			</div>

		</td>
		<td width="200" align="center" valign="center">
			<div class="clear">
                <form action="{{ route('cart.delete', $cart->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-link"><img src="{{asset('/img/core-img/close.png')}}"></button>
                </form>
             </div>
		</td>
		</tr>
		@endforeach
		</table>
		
			<h3>運費：$<?php echo $q;?>       購買金額 : $ <?php echo $b; ?></h3>
			@if($vip=='1')
			<h3>結帳總金額為：$<DEL><?php echo $a; ?></DEL>   <font color="#FF0000" >$<?php echo $vip_all;?></h3>
			<h3><font color="#FF0000"  >VIP可享{{$vip_discount}}折優惠</h3>
		    @else
				<h3>結帳總金額為：$<?php echo $a; ?></h3>
			<h3><font color="#FF0000"  >購物金額達$<?php echo $low_price; ?>免運費</h3>
		    @endif
			<div class="add-to-cart-btn">
				<a href="{{route('checkout')}}" class="btn essence-btn">下單</a>
			</div>




    @endif
	<div class="clearfix mr-50 mt-50 mb-50">
	</div>
	<div class="clearfix mr-50 mt-50 mb-50">
	</div>
</body>
</html>
<script src="{{ asset('js/jquery2.min.js') }}"></script>
     <script src="{{ asset('js/lib.js') }}"></script>
<script type="text/javascript"> 
$(function() { 
    bsStep(1)/bsStep(2); 
    //bsStep(i) i 为number 可定位到第几步 如bsStep(2)/bsStep(3) 
}) 
</script>