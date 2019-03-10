﻿@extends('admin.layouts.master')

@section('title', '進貨管理')

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
                
                   進貨管理 <small>所有進貨資訊</small>
               
            </h1>
        </div>
    </div>
<!-- /.row -->


</div>
<div class="row" style="margin-bottom: 20px; text-align: right" >

    <div class="col-lg-12">

        
        @if(Auth::user()->previlege_id==3)
            <a href="{{ route('admin.shops.suppliers') }}" class="btn btn-success">商品進貨</a>
        @endif
    </div>

</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
	<div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        @if(Auth::user()->previlege_id==3)
            			<th width="120" style="text-align: center">編號</th>
                        	<th width="300" style="text-align: center">產品名稱</th>
                       	 	
                        	<th width="150" style="text-align: center">供應商名稱</th>
                            	<th width="400" style="text-align: center">進貨數量</th>
								<th width="400" style="text-align: center">進貨時間</th>
								<th width="30" style="text-align: center">功能</th>  
								
			@else
				<th width="220" style="text-align: center">供應商編號</th>
                        	<th width="100" style="text-align: center">供應商名稱</th>
                       	 	
							<th width="250" style="text-align: center">創建時間</th>
							
                        	
                            	<th width="30" style="text-align: center">功能</th>                        
			@endif
                        
                    </tr>
                </thead>
                <tbody>
                @foreach($suppliersdetails as $suppliersdetail)
                    <tr>
                        <td style="text-align: center">
                            {{ $suppliersdetail->id }}
                        </td>
                        <td style="text-align: center">
						@foreach($goods as $good)
						@if($suppliersdetail->name==$good->id)
                         {{ $good->name }}
						 @endif
						 @endforeach
					 
                        </td>
						<td style="text-align: center">
						@foreach($suppliers as $supplier)
						@if($supplier->id==$suppliersdetail->supplier_id)
                         {{ $supplier->name }}
					 @endif
						 @endforeach
                        </td>
						<td style="text-align: center">
						
                         {{ $suppliersdetail->value }}
					 
                        </td>
                        
                        <td style="text-align: center">
						{{ $suppliersdetail->created_at }}
						</td>
						 <td>
                            <table>
                                <tbody>
    <?php
	
	$link=mysqli_connect("localhost:33060","root","root","homestead");
	$sql ="SELECT * FROM goods WHERE supplier_id='$suppliersdetail->supplier_id'";
	$rec = $link->query($sql);	
	$rNum = $rec->num_rows;
	$rs = $rec->fetch_array();
	$S1=$rs['id'];
	//echo "$rNum"; 
	if($rNum>=1){
		
			$i=1;
		
	}
	else{
		$i=0;
	}
		
	
	
	
	?>


                                        
	                                    @if($i=="0")
                                        <td class="table-text" style="text-align: center">
                                                                        <form action="{{ route('admin.shops.suppliersdetail.destroy', $suppliersdetail->id) }}" method="POST">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('DELETE') }}
                                                                            <button class="btn btn-danger ">刪除</button>
                                                                        </form>
                                              
                                        </td>
										@elseif($i=="1")
											<td class="table-text" style="text-align: center">
                                                                        <form action="{{ route('admin.shops.suppliersdetail.destroy', $suppliersdetail->id) }}" method="POST">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('DELETE') }}
                                                                            <button class="btn btn-danger disabled" >刪除</button>
                                                                        </form>
                                              
                                        </td>
										@endif
                                        </td>
											
                                            
                                            
                                    
                                    
                                </tr>
                                </tbody>
                            </table>
                        </td>

                @endforeach
                </tbody>
            </table>
</div>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
