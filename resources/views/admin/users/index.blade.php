@extends('admin.layouts.master')

@section('title', '使用者管理')

@section('content')
<!-- Page Heading -->

@if(!(Auth::user()->previlege_id==3))
    <div class="col-sm-12">
        <h1 class="page-header">
            <small></small>
        </h1>
    </div>
@endif
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            使用者管理 <small>所有使用者列表</small>
        </h1>
    </div>
</div>
@if(Auth::user()->previlege_id==3)
<!-- /.row -->
<div class="input-group custom-search-form">
<form action="{{ route('admin.users.search') }}" method="POST">
    {{ csrf_field() }}
    <span class="input-group-btn">
    <input name="Search" class="form-control" placeholder="Search...">
    <button class="btn btn-info"><i class="fa fa-search"></i></button>
    </span>
</form>
</div>
@endif
@if(Auth::user()->previlege_id==3)
<div class="row" style="margin-bottom: 20px; text-align: right" >

    <div class="col-lg-12">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success">建立新管理者</a>
    </div>
</div>
@endif
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="text-align: center">E-mail</th>
                        <th width="120" style="text-align: center">姓名</th>
                        <th width="100" style="text-align: center">性別</th>
                       
                        <th width="80 " style="text-align: center">手機</th>
                        <th width="100" style="text-align: center">權限</th>
                        <th width="200" style="text-align: center">功能</th>
                    </tr>
                </thead>
				@if(Auth::user()->previlege_id==3)
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="text-align: center"><a href="{{ route('admin.users.data', $user->id) }}">{{ $user->email }}</a></td>
						@if($user->vip==0)
                        <td style="text-align: center">{{ $user->name }}</td>
					@else
						 <td style="text-align: center"><font color="#CC00CC">{{ $user->name }}</td>
					@endif
                        <td style="text-align: center">
                            
                                    {{ $user->gender }}
                                
                        </td>
                        
                        <td style="text-align: center">{{ $user->phone }}</td>
                        <td style="text-align: center">
                            @foreach($previleges as $previlege)
                            @if($user->previlege_id==$previlege->id)
                                    {{$previlege->name}}
                            @endif
                                @endforeach
                        </td>
                        <td>
                                    <table >
                                        <tbody>
                                            <tr class="table-text" style="text-align: center">
                                                <td width="100" >
                                                    <a class="btn btn-primary" role="button" href="{{ route('admin.users.edit', $user->id) }}" >修改</a>
                                                </td>

                                                <!-- 刪除按鈕 -->
                                                <td width="100">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                                        刪除
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">提示訊息</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    確定刪除？
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <table style="text-align: right">
                                                                        <tbody style="text-align: right">
                                                                        <tr class="table-text" style="text-align: center">
                                                                            <td width="100" >
                                                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                                                    {{ csrf_field() }}
                                                                                    {{ method_field('DELETE') }}
                                                                                    <button class="btn btn-danger">刪除</button>
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

                                                </td>
                                                <td width="100" >
                                                    <a class="btn btn-warning" role="button"  href="{{ route('admin.users.showwrong', $user->id) }}" >違規</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                        </td>
                    </tr>
                @endforeach
                </tbody>
				@elseif(Auth::user()->previlege_id==1||Auth::user()->previlege_id==2)
				 <tbody>
		
                @foreach($users as $user)
						@if($user->email == Auth::user()->email)
                    <tr>
                      <td style="text-align: center"><a href="{{ route('admin.users.data', $user->id) }}">{{ $user->email }}</a></td>
					@if($user->vip==0)
                        <td style="text-align: center">{{ $user->name }}</td>
					@else
						 <td style="text-align: center"><font color="#CC00CC">{{ $user->name }}</td>
					@endif
                        <td style="text-align: center">
                            @foreach($departments as $department)
                                @if($user->department_id==$department->id)
                                    {{ $department->name }}
                                @endif
                                @endforeach
                        </td>
                        <td style="text-align: center">{{ $user->phone}}</td>
                       
                        <td style="text-align: center">
                            @foreach($previleges as $previlege)
                            @if($user->previlege_id==$previlege->id)
                                    {{$previlege->name}}
                            @endif
                                @endforeach
                        </td>
                        <td>
                                    <table >
                                        <tbody>
                                            <tr class="table-text" style="text-align: center">
                                                <td width="100" >
                                                    <a class="btn btn-primary" role="button" href="{{ route('admin.users.edit', $user->id) }}" >修改</a>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                        </td>
                    </tr>
					@endif
                @endforeach
				
                </tbody>
				@endif
            </table>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
