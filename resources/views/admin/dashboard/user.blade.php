@extends('admin.layouts.master')

@section('title', '主控台')

@section('content')
<!-- Page Heading -->\

<div class="row">
    <div class="col-sm-12">
        <h1 class="page-header">
           <small></small>
        </h1>
    </div>
        
        <div class="col-lg-12">
        <div class="row,page-header" style="margin-bottom: 20px; text-align: right" >
            <div>
                <a href="{{ route('main.shop') }}" class="btn btn-primary">前往商城</a>
        </div>
        </div>

		@if(count($place_overtimes1) > 0)
	<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <script language="JavaScript">

function ShowTime(){
　var NowDate=new Date();
　var h=NowDate.getHours();
　var m=NowDate.getMinutes();
　var s=NowDate.getSeconds();　

document.getElementById('showbox').innerHTML = '現在是'+h+'點'+m+'分'+s+'秒';

setTimeout('ShowTime()',1000);
}
</script>
<body onload="ShowTime()">


                <i class="fa fa-dashboard" ></i> 超過時間 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-dashboard" id="showbox"></i>  
	</body>			
				
				
            </li>
        </ol>
		 <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="100" style="text-align: center">場地編號</th>
                                <th width="300" style="text-align: center">場地名稱</th>
                                
								</tr>
                            </thead>
                            <tbody>
							@foreach($place_overtimes1 as $place_overtime)
                                

                                    <tr>
                                        <td style="text-align: center">
                                            {{ $place_overtime->id }}
                                        </td>
                                        <td style="text-align: center">
                                            
                                                    {{ $place_overtime->name }}
                                               
                                        </td>
										
                                        
										</tr>
                                    
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
		</div>
		
		@endif
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> 公告
            </li>
        </ol>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="100" style="text-align: center">標題</th>
                            <th style="text-align: center">內容</th>
                            <th width="100" style="text-align: center">日期</th>
                            <th style="text-align: center">發布者</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $new)
                            <tr>
                                <td style="text-align: center">{{ $new->title}}</td>
                                <td style="text-align: center">{{ $new->content1 }}</td>
                                <td style="text-align: center">{{ $new->created_at}}</td>
                                <td style="text-align: center">
                                    @foreach($users as $user)
                                        @if($new->user_id==$user->id)
                                            {{ $user->name }}
                                        @endif
                                    @endforeach
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
	 <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> 我的訂單
            </li>
        </ol>
	<ul id="myTab" class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">
            未處理訂單</a>
    </li>
    <li><a href="#ios" data-toggle="tab">處理中訂單</a></li>
     <li><a href="#ios1" data-toggle="tab">已完成訂單</a></li>
</ul>
       
		<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="home">
        @if(count($order_users) > 0)
			
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="100" style="text-align: center">訂單編號</th>
                        <th style="text-align: center">訂單內容</th>
                        <th width="100" style="text-align: center">訂單狀態</th>
                        <th width="120" style="text-align: center">訂單日期</th>
						
						<th width="80" style="text-align: center">功能</th> 
						
						  
                    </tr>
                    </thead>
					
                    @foreach($order_users as $order_user)
						@if($order_user->status=='未處理')
					
					
                        
						
						<tbody>
                        
                                <tr>
                                    <td style="text-align: center">
                                        {{ $order_user->id }}
                                    </td>

                                    <td style="text-align: center">
                                        
                                                {{ $order_user->name }}
                                          
                                    </td>

                                    <td style="text-align: center">{{ $order_user->status }}</td>
                                    <td style="text-align: center">
                                       
                                            {{ $order_user->created_at}}
                                        
                                    </td>

									<td class="table-text" style="text-align: center">
                                     @if($order_user->status=='處理中'||$order_user->status=='未處理')
                                                                        
																			  <div> <a href="{{ route('orders.show2', $order_user->id) }}" class="btn btn-danger" role="button">取消</a></div>
      
                                        @else
                                            <a class="btn btn-danger disabled" role="button">取消</a>
                                        @endif
                                                                    
											
                                        </td>


                                </tr>
                       
						
                        </tbody>
						
						@endif
                    @endforeach
                </table>
				
            </div>
			
        @endif
		
		</div>
		 <div class="tab-pane fade" id="ios">
        @if(count($order_users) > 0)
			
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="100" style="text-align: center">訂單編號</th>
                        <th style="text-align: center">訂單內容</th>
                        <th width="100" style="text-align: center">訂單狀態</th>
                        <th width="120" style="text-align: center">訂單日期</th>
						
						<th width="80" style="text-align: center">功能</th> 
						
						  
                    </tr>
                    </thead>
					
                    @foreach($order_users as $order_user)
						@if($order_user->status=='處理中'||$order_user->status=='已出貨'||$order_user->status=='取消審核中')
					
					
                        
						
						<tbody>
                        
                                <tr>
                                    <td style="text-align: center">
                                        {{ $order_user->id }}
                                    </td>

                                    <td style="text-align: center">
                                        
                                                {{ $order_user->name }}
                                          
                                    </td>

                                    <td style="text-align: center">{{ $order_user->status }}</td>
                                    <td style="text-align: center">
                                       
                                            {{ $order_user->created_at}}
                                        
                                    </td>

									<td class="table-text" style="text-align: center">
                                     @if($order_user->status=='處理中'||$order_user->status=='未處理')
                                                                        
																			  <div> <a href="{{ route('orders.show2', $order_user->id) }}" class="btn btn-danger" role="button">取消</a></div>
																		
                                                                           
                                                                        </form>
                                        @elseif($order_user->status=='已出貨'||$order_user->status=='已完成')
                                                               
                                                                           
                                                                             <div> <a href="{{ route('orders.show1', $order_user->id) }}" class="btn btn-primary" role="button">查看</a></div>
                                                                                
                                                                           
                                                                                </div>
                                                                            </div>
										 @elseif($order_user->status=='已處理'||$order_user->status=='已取消')
                                                               
                                                                           
                                         <div> <a href="{{ route('orders.show1', $order_user->id) }}" class="btn btn-danger" role="button">查看</a></div>
                                                                                
                                                                           
                                                                                </div>
                                                                            </div>
                                                                  
                                        @else
                                            <a class="btn btn-danger disabled" role="button">取消</a>
                                        @endif
                                                                    
											
                                        </td>


                                </tr>
                       
						
                        </tbody>
						
						@endif
                    @endforeach
                </table>
				
            </div>
			
        @endif
		
		</div>
		<div class="tab-pane fade" id="ios1">
        @if(count($order_users) > 0)
			
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="100" style="text-align: center">訂單編號</th>
                        <th style="text-align: center">訂單內容</th>
                        <th width="100" style="text-align: center">訂單狀態</th>
                        <th width="120" style="text-align: center">訂單日期</th>
						
						<th width="80" style="text-align: center">功能</th> 
						
						  
                    </tr>
                    </thead>
					
                    @foreach($order_users as $order_user)
						@if($order_user->status=='已完成'||$order_user->status=='已完成'||$order_user->status=='已取消'||$order_user->status=='駁回')
					
					
                        
						
						<tbody>
                        
                                <tr>
                                    <td style="text-align: center">
                                        {{ $order_user->id }}
                                    </td>

                                    <td style="text-align: center">
                                        
                                                {{ $order_user->name }}
                                          
                                    </td>

                                    <td style="text-align: center">{{ $order_user->status }}</td>
                                    <td style="text-align: center">
                                       
                                            {{ $order_user->created_at}}
                                        
                                    </td>

									<td class="table-text" style="text-align: center">
                                     @if($order_user->status=='處理中'||$order_user->status=='未處理')
                                                                        
																			  <div> <a href="{{ route('orders.show2', $order_user->id) }}" class="btn btn-danger" role="button">取消</a></div>
																		
                                                                           
                                                                        </form>
                                        @elseif($order_user->status=='已出貨'||$order_user->status=='已完成')
                                                               
                                                                           
                                                                             <div> <a href="{{ route('orders.show1', $order_user->id) }}" class="btn btn-primary" role="button">查看</a></div>
                                                                                
                                                                           
                                                                                </div>
                                                                            </div>
										 @elseif($order_user->status=='已處理'||$order_user->status=='已取消'||$order_user->status=='駁回')
                                                               
                                                                           
                                         <div> <a href="{{ route('orders.show1', $order_user->id) }}" class="btn btn-danger" role="button">查看</a></div>
                                                                                
                                                                           
                                                                                </div>
                                                                            </div>
                                                                  
                                        @else
                                            <a class="btn btn-danger disabled" role="button">取消</a>
                                        @endif
                                                                    
											
                                        </td>


                                </tr>
                       
						
                        </tbody>
						
						@endif
                    @endforeach
                </table>
				
            </div>
			
        @endif
		
		</div>
</div>
    </div>
</div>

	<script>
    $(function () {
        $('#myTab li:eq(0) a').tab('show');
    });
	

    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

</script>

<!-- /.row -->

<div class="row">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
<!-- /.row -->

@endsection
