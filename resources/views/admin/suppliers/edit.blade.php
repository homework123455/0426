@extends('admin.layouts.master')

@section('title', '修改場地')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            修改場地 <small>編輯場地資料</small>
        </h1>
    </div>
</div>
<!-- /.row -->
@include('admin.layouts.partials.validation')
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">

        <form action="/admin/suppliers/{{$suppliers->id}}" method="POST" role="form" >
            {{ csrf_field() }}
			{{ method_field('PATCH') }}

            
            <div class="form-group">
			 
               
                <label>供應商名稱：</label>
                <input name="name" class="form-control" placeholder="請輸入供應商名稱" value="{{$suppliers->name}}">
            </div>


            <div class="form-group">
                <label>供應商電話：</label>

                <input name="phone" class="form-control" placeholder="請輸入供應商電話" value="{{$suppliers->phone}}">
            </div>

            
           

            <div class="form-group">
                <label>供應商地址：</label>

                <input name="address" class="form-control" placeholder="請輸入供應商地址" value="{{$suppliers->address}}">
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success">更新</button>
                <a class="btn btn-success" href="{{ route('admin.suppliers.index') }}"  role="button">返回</a>
            </div>
@if(isset($msg))
<div class="alert alert-danger">{{$msg}}</div>


@endif
        </form>

        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

    </div>
</div>

<!-- /.row -->
@endsection
