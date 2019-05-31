<!DOCTYPE html>
<html lang="en">
@extends('layouts.master')

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>體育用品系統</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Favicon  -->
    <link rel="icon" href="/img/core-img/plant.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="/css/core-style.css">
    <link rel="stylesheet" href="/style.css">


</head>

<body>
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(/img/bg-img/test2.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>商品</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="clearfix mr-50 mt-50 mb-50">
	<div class="container coverflow">
	<div id="myCarousel" class="carousel slide">

	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" 
			class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>   
	
	<div class="carousel-inner">
		<div class="item active">
			<img src={{$setting->photo1}} height="200"  alt="First slide">
		</div>
		<div class="item">
			<img src={{$setting->photo2}}  height="200" alt="Second slide">
		</div>
		<div class="item">
			<img src={{$setting->photo3}} height="200" alt="Third slide">
		</div>
	</div>
	
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	</a>
</div> 
</div>
	
	    
	</div>

	
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">分類</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#clothing">
                                      
                                        <ul class="sub-menu collapse show" id="clothing"> 
										<li><a href="{{route('main.shop')}}">全部</a></li>
										@foreach($categories as $category)
										
										 <li><a href="{{route('cleanup.shop',$category->id)}}">{{$category->name}}</a></li>
										@endforeach
                                        
                                          
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                                                        <!--  Catagories  -->
														<!--
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">
                                    
                                    <li data-toggle="collapse" data-target="#clothing">
                                        <a>滯塵能力</a>
                                        <ul class="sub-menu collapse show" id="clothing">
                                            <li><a href="{{route('dustup.shop')}}">高</a></li>
                                            <li><a href="{{route('dustdown.shop')}}">低</a></li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </div>
							-->
                        </div>
					<!--	<<div class="container theme-showcase" role="main">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item"><img data-src="holder.js/1000*300/auto/#777:#555/text:First slide" alt="One" src={{$setting->photo1}} data-holder-rendered="true" ></div>
                <div class="item active"><img data-src="holder.js/1000*300/auto/#666:#444/text:Second slide" alt="Two" src={{$setting->photo2}} data-holder-rendered="true" ></div>
                <div class="item"><img data-src="holder.js/1000*300/auto/#555:#333/text:Third slide" alt="Three" src={{$setting->photo3}} data-holder-rendered="true" ></div>
            </div>
            <a class="left carousel-control" href="https://kkbruce.tw/bs3/Examples/theme#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="https://kkbruce.tw/bs3/Examples/theme#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div> -->
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        
                                    </div>
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort</p>
                                        <form name="jump">
                                            <select onchange="location=document.jump.menu.options[document.jump.menu.selectedIndex].value;" value="GO" name="menu"><br />
                                            <option value="" selected="selected">價格排序</option>
											
											@if(dirname($_SERVER["REQUEST_URI"])=="/shopcleanup"||$_SERVER["REQUEST_URI"]=="/shopprice/asc/$id"||$_SERVER["REQUEST_URI"]=="/shopprice/desc/$id")
											<option value="{{route('sort.shop',['type'=>'asc','id'=>$id])}}">低到高</option>
											<option value="{{route('sort.shop',['type'=>'desc','id'=>$id])}}">高到低</option>
											
											
											
											@else
                                            <option value="{{route('sort.shop.id',['type'=>'asc'])}}">低到高</option>
                                            <option value="{{route('sort.shop.id',['type'=>'desc'])}}">高到低</option>
											
											@endif
											
											
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                        @foreach ($goods as $good)
						@if($good->status!="下架中"&&$good->value>0)
                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img src={{ $good->photo1}} alt="">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src={{ $good->photo2}} alt="">
                                    </div>
                                    <!-- Product Description -->
                                    <div class="product-description">

                                        <a href="{{route('detail',['id'=>$good->id])}}">
                                            <h6> {{$good->name}}</h6>
                                        </a>
                                        <p class="product-price"> $ {{$good->price}}</p>

                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <a href="{{route('cart.add',['id'=>$good->id])}}" class="btn essence-btn">加到購物車</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    

</body>
<script>
$(function() {
	$('.coverflow').css('max-width',$('.coverflow img').width());
    carouselNormalization();
});
function carouselNormalization() {
    var items = $('.carousel .carousel-inner .item'), heights = [], tallest, bwidth, height, width;
    if( items.length ) {
        function normalizeHeights() {
            bwidth = $('.carousel').width();
            items.each(function() {
                height = $(this).height();
                width = $(this).width();
                if( width > bwidth ) {
                    height = height * ( bwidth / width );
                }
                heights.push(height);
            });
            tallest = Math.max.apply(null, heights);
            if( tallest > bwidth ) {
                tallest = bwidth;
            }
            items.each(function() {
                $(this).css('height', tallest + 'px');
            });
        };
        normalizeHeights();
        $(window).on('resize', function() {
            bwidth = $('.carousel').width();
            heights = [];
            items.each(function() {
                $(this).css('height', 'auto');
            });
            normalizeHeights();
        });
    }
}

</script>

</html>
