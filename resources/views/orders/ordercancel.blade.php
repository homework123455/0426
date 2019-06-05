@extends('admin.layouts.master')

@section('title', '訂單處理')

@section('content')
<!-- Page Heading -->

<div class="row">
    @if(!(Auth::user()->previlege_id>=3))
        <div class="col-sm-12">
            <h1 class="page-header">
                <small></small>
            </h1>
        </div>
    @endif

    <div class="col-lg-12">
        <h1 class="page-header">
            訂單取消 <small>訂單取消</small>
        </h1>
    </div>
</div>
<!-- /.row -->
@include('admin.layouts.partials.validation')
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
       <form action="ordercancel" method="POST" role="form" >
	             {{ csrf_field() }}
			{{ method_field('PATCH') }}
        <div class="form-group">
            <label width="80">訂單編號：</label>
			{{$order->id}}
        </div>
		<div class="form-group">
            <label width="80">會員姓名：</label>
			@foreach($users as $user)
			@if($order->users_id==$user->id)
			{{$user->name}}
		@endif
		@endforeach

           
        </div>

		<div class="form-group">
            <label width="80">商品總價：</label>

			{{$ordertotal}}
        </div>
		@if($order->car_money==0)
		<div class="form-group">
            <label width="80">運費：</label>
			0
        </div>
		@elseif($order->car_money==1)
		<div class="form-group">
            <label width="80">運費：</label>
			{{$price}}
        </div>
		@endif
		@if($order->vip_check==1)
		<div class="form-group">
            <label width="80">折扣後金額：</label>
			{{$vip_total}}
        </div>
		@endif
		
		
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-edit"></i> 訂單資訊
            </li>
        </ol>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    
					<th width="100" style="text-align: center">商品名稱</th>
					<th width="100" style="text-align: center">商品數量</th>
					<th width="100" style="text-align: center">商品單價</th>
                    <th width="100" style="text-align: center">下單時間</th>
					@if($order->status=="已出貨"||$order->status=="已完成")
					<th width="100" style="text-align: center">出貨時間</th>
				    @elseif($order->status=="駁回")
					<th width="100" style="text-align: center">處理時間</th>
					
					
					@endif
					<th width="100" style="text-align: center">訂單狀態</th>
                </tr>
                </thead>
                <tbody>
                
                    <tr>
					@foreach($ordersdetail as $order1)
                        <td style="text-align: center">{{$order1->product}}</td>
                          <td style="text-align: center">{{$order1->qty}}</td>  
                         <td style="text-align: center">{{$order1->cost}}</td>
						 

                        <td style="text-align: center">{{$order->created_at}}</td>
						@if($order->status=="已出貨"||$order->status=="已完成")
						<td style="text-align: center">{{$order->updated_at}}</td>
					@elseif($order->status=="駁回")
					<td style="text-align: center">{{$order->status}}</td>
					@endif
						<td style="text-align: center">{{$order->status}}</td>
						
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        
                                    
                                
       
        @if($order->status=="駁回")

                <label>駁回原因：</label>
               <label>{{$order->reason}}</label>

@endif

            </div>
			
		</div>
		<div class="form-group">
            <label width="80">填寫取消原因：</label>
			  <input name="cancel" class="form-control" placeholder="請輸入取消原因" >
        </div>

                    

        <div class="text-right">
       <button type="submit" class="btn btn-success">送出</button>
	   <a class="btn btn-success" href="{{ route('admin.dashboard.index') }}"  role="button">返回</a>
        </div>
		
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

       </div> 
   
</div>
<!-- /.row -->
@endsection
