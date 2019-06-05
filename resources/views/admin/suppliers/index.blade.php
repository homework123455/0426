@extends('admin.layouts.master')

@section('title', '商品類別管理')

@section('content')
<!-- Page Heading -->


<div class="row">
    <div class="col-sm-12">
        <h1 class="page-header">
           <small></small>
        </h1>
    </div>
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                
                   供應商管理 <small>所有供應商資訊</small>
               
            </h1>
        </div>
    </div>
<!-- /.row -->


</div>
<div class="row" style="margin-bottom: 20px; text-align: right" >

    <div class="col-lg-12">

        
        @if(Auth::user()->previlege_id==3)
            <a href="{{ route('admin.suppliers.create') }}" class="btn btn-success">建立新供應商</a>
        @endif
    </div>

</div>
<!-- /.row -->

<div class="row">
@foreach($suppliers as $supplier)
    <div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#{{ $supplier->name }}">
				 <?php
	$link=mysqli_connect("localhost:33060","root","root","homestead");
	$sql ="SELECT * FROM goods WHERE supplier_id='$supplier->id'";
	$rec = $link->query($sql);	
	$rNum = $rec->num_rows;
	$rs = $rec->fetch_array();
	$S1=$rs['id'];
	//echo "$S1"; 
	if(isset($S1)){

			$i=1;

	}
	else{
		$i=0;
	}
		?>  
				  @if($i=="0")
					<i class="fa fa-user"></i>{{ $supplier->name }}<span class="badge"></span></a> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal1">
                                                                刪除
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">提示訊息</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            確定要刪除供應商？
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <table style="text-align: right">
                                                                                <tbody style="text-align: right">
                                                                                <tr class="table-text" style="text-align: center">
                                                                                    <td width="100" >
                                                                                       <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('DELETE') }}
																		<button class="btn btn-danger ">刪除</button>
                                                                        </form>
                                                                                    </td>
                                                                                    <td width="100">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
	
	
	 
	

	


                                        
	                                 
									 
                                       
                                                                       
                                              
                                        
										@elseif($i=="1")
											
                                                                      
                                                                           <i class="fa fa-user"></i>{{ $supplier->name }}<span class="badge"></span></a> <button class="btn btn-danger disabled" >刪除</button>
                                                                      
                                              
                                       
										@endif
					@if($supplier->status!='配合中')
				  <form action="{{ route('admin.suppliers.scrapped', $supplier->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <button class="btn btn-success">啟用</button>
										
                                                </form>
											
												@elseif($supplier->status!='已終止')
				  <form action="{{ route('admin.suppliers.scrapped1', $supplier->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <button class="btn btn-danger">終止</button>
													
                                                </form>
												@endif
			</h4>
		</div>
<div id="{{ $supplier->name }}" class="panel-collapse collapse in">
			<div class="panel-body">
           <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                                         

                        <th width="300" style="text-align: center">供應商名稱</th>
						<th width="300" style="text-align: center">供應商地址</th>
						<th width="300" style="text-align: center">供應商狀態</th>
						<th width="300" style="text-align: center">供應商電話</th>
                        <th width="150" style="text-align: center">創建時間</th>
                        <th width="150" style="text-align: center">功能</th>                       

                </thead>
                <tbody>
                
<tr class="success">

                       
                        <td style="text-align: center">
					
                        <div> {{ $supplier->name }}</div>
					 
                        </td>
                        
                        <td style="text-align: center">
						<div>{{ $supplier->address }}</div>
						</td>
						 <td style="text-align: center">
						<div>{{ $supplier->status }}</div>
						</td>
						 <td style="text-align: center">
						<div>{{ $supplier->phone }}</div>
						</td>
						 <td style="text-align: center">
						<div>{{ $supplier->created_at }}</div>
						</td>
						 <td style="text-align: center">
						<div>  <a class="btn btn-primary" role="button" href="{{ route('admin.suppliers.edit', $supplier->id) }}" >修改</a></div>
						</td>
						</tr>

                       

               
                </tbody>
            </table>


			<table class="table table-bordered table-hover">
                <thead>
                                         

                        <th width="300" style="text-align: center">商品名稱</th>
						 <th width="300" style="text-align: center">庫存數量</th>

                        <th width="400" style="text-align: center">功能</th>                        

                </thead>
				<tbody> 
				@foreach($goods as $good)
				
					@if($supplier->id == $good->supplier_id)
						<tr>
                            <!-- 任務名稱 -->
                            <td style="text-align: center">
                                
                         {{ $good->name }}
						
                            </td>
							<td style="text-align: center">
                                
                         {{ $good->stock }}
						
                            </td>
				@if($supplier->status!='配合中')
                        <td class="table-text" style="text-align: center">

                                 <a class="btn btn-primary disabled" role="button"  >進貨</a>
												
                                
                        </td>
						@elseif($supplier->status!='終止中')
						<td class="table-text" style="text-align: center">

                                 <a class="btn btn-primary" role="button" href="{{ route('admin.shops.suppliers', $good->id) }}" >進貨</a>
												
                                
                        </td>
                    @endif
						
                    
	
                    
                

                        </tr>

							@endif			
               @endforeach
                </tbody>
            </table>	
</div>
        </div>
    </div>
</div>
</div>
@endforeach
</div>


{!! $suppliers->render() !!}

<!-- /.row -->
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>	
<script type="text/javascript">
var a =<?php echo $a ?>';
	$(function () { $('#'a).collapse('toggle')});

</script>
@endsection
