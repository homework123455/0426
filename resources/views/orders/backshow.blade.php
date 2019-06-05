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
            訂單處理 <small>訂單處理</small>
        </h1>
    </div>
</div>
<!-- /.row -->
@include('admin.layouts.partials.validation')
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
       
        <div class="form-group">
            <label width="80">訂單編號：</label>
			{{$order->id}}
        </div>
		<div class="form-group">
            <label width="80">會員姓名：</label>
			{{$order->name}}
		

           
        </div>

		<div class="form-group">
            <label width="80">商品總價：</label>

			{{$ordersdetail->total}}
        </div>
		
		
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
					<th width="100" style="text-align: center">其他資訊</th>
                </tr>
                </thead>
                <tbody>
                
                    <tr>
					
                        <td style="text-align: center">{{$ordersdetail->product}}</td>
                          <td style="text-align: center">{{$ordersdetail->qty}}</td>  
                         <td style="text-align: center">{{$ordersdetail->cost}}</td>
						 

                        <td style="text-align: center">{{$order->created_at}}</td>
						<td style="text-align: center">{{$order->address}}</td>
						
                    </tr>
                
                </tbody>
            </table>
        </div>
		

        @if($ordersdetail->status=="退貨中")

               <div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">退貨原因</h3>
    </div>
    <div class="panel-body">
	{{$ordersdetail->backreason}}
    </div>

@endif

            </div>
        
                                    
                                

                <form action="backshow" method="POST" role="form">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label>選擇是否核准</label>

                <Script language="javascript">
                    function agree(){
                        var a=document.getElementById("method");
                        
                        var index=a.selectedIndex ;
                        var b=document.getElementById("reason");
						var text=b.text;
                        var c=a.options[index].value;
                        if(c=='0'){


                            b.readOnly=true;
							reason.value="";
                        }
                        else{
                            if(c=='1'){
                                b.removeAttribute('readOnly');
                                
                            }
                        }

                    }

                </Script>
                <select id="method" name="method" class="form-control" onchange="agree()">
                        <option value="0">是</option>
                        <option value="1">否</option>
                </select>

                <label>駁回原因：</label>
                <input type="text" value="" id="reason" name="reason" class="form-control" placeholder="請輸入駁回原因" readonly>



            </div>

                    

        <div class="text-right">
            <button type="submit" class="btn btn-success">確定</button>
            <a class="btn btn-success" href="{{ route('orders.backindex') }}"  role="button">返回</a>
        </div>
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

       </div> 
   
</div>
<!-- /.row -->
@endsection
