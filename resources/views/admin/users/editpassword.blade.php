@extends('admin.layouts.master')

@section('title', '修改密碼')

@section('content')
<!-- Page Heading -->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            修改密碼 <small></small>
        </h1>
    </div>
</div>
<!-- /.row -->
@include('admin.layouts.partials.validation')
<!-- /.row -->

@if(!(Auth::user()->previlege_id==3))
    <div class="col-sm-12">
        <h1 class="page-header">
            <small></small>
        </h1>
    </div>
@endif
<div class="row">
    <div class="col-lg-12">
			<div class="form-group">
                <label width="80">姓名：</label>
                <input name="name" class="form-control" value="{{$user->name}}" readonly >
            </div>
	
        <form action="/admin/users/{{$user->id}}/editpassword" method="POST" role="form">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
			
            <div class="form-group">
                <label width="80">請輸入原始密碼：</label>
                <input type="password" name="oldpassword" class="form-control" placeholder="請輸入原始密碼" >
            </div>

            <div class="form-group">
                <label width="80">請輸入新密碼：</label>
                <input type="password" name="newpassword" class="form-control" placeholder="請輸入新密碼" >
            </div>

            

            <div class="form-group">
                <label width="80">再次輸入新密碼：</label>
                <input type="password" name="newpasswordcheck" class="form-control" placeholder="再次輸入新密碼" >
            </div>

	
           


            <div class="text-right">
                <button type="submit" class="btn btn-success">更新</button>
            </div>

        </form>

        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

    </div>
</div>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>	

<!-- /.row -->
@endsection
