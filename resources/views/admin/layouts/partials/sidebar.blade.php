<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="{{ route('admin.dashboard.index') }}">
        <img  src="http://www.ncut.edu.tw/ncutnew/newncit/exampage/logo.gif"  class="img-circle" href="{{ route('admin.dashboard.index') }}"  width="65" height="50">
        </a>
    </div>
    <a class="navbar-brand" href="{{ route('admin.dashboard.index') }}">體育用品系統</a>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>{{Auth::user()->name}} <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('admin.users.data', Auth::user()->id) }}"><i class="fa fa-fw fa-user"></i>查看個人資料</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.editpassword', Auth::user()->id) }}"><i class="fa fa-fw fa-envelope"></i>修改密碼</a>
                </li>
              
                <li class="divider"></li>
                <li>
                <li>
                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-gear"></i>
                       登出
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">

            @if(Auth::user()->previlege_id==3)
                <li class="active">
                    <a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-fw fa-dashboard"></i> 首頁</a>
                </li>
				<li class="active">
                    <a href="{{ route('main.shop') }}"><i class="fa fa-fw fa-dashboard"></i> 商店</a>
                </li>
                <li>
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#collapse6">
				   <i class="fa fa-fw fa-edit"></i>商品管理<b class="caret"></b>
				    <div id="collapse6" class="panel-collapse collapse">
				<div class="panel-body">
                    <a href="{{ route('admin.places.index') }}"><i class="fa fa-fw fa-edit"></i> 商品管理</a></br>
					 <a href="{{ route('admin.shops.suppliersdetail') }}"><i class="fa fa-fw fa-edit"></i> 進貨</a>
					 </div>
				</div>
				<script type="text/javascript">
	$(function () { $('#collapse6').collapse({
		'hide'
	})});
	
</script>
                </li>
				<li>
                    <a href="{{ route('admin.categories.index') }}"><i class="fa fa-fw fa-edit"></i> 商品分類管理</a>
                </li>
				
				
				
				
	<li>
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#collapse5">
					<i class="fa fa-fw fa-edit"></i>訂單處理<b class="caret"></b>
				</a>
			
		
                <div id="collapse5" class="panel-collapse collapse">
				<div class="panel-body">
				
				<a href="{{ route('orders.index') }}"><i class="fa fa-fw fa-edit"></i> 進行中</a></br>
				
				<a href="{{ route('orders.index1') }}"><i class="fa fa-fw fa-edit"></i> 已完成</a></br>

				<a href="{{ route('orders.backindex') }}"><i class="fa fa-fw fa-edit"></i> 退貨</a>

				</div>
				</div>
				<script type="text/javascript">
	$(function () { $('#collapse5').collapse({
		'hide'
	})});
	
</script>
				</li>
				
            
           
               <li>
                    <a href="{{ route('admin.news.index') }}"><i class="fa fa-fw fa-edit"></i> 公告管理</a>
               </li>
            <li>
                <a href="{{ route('admin.users.index') }}"><i class="fa fa-fw fa-edit"></i> 使用者管理</a>
            </li>
			<li>
                <a href="{{ route('admin.suppliers.index') }}"><i class="fa fa-fw fa-edit"></i> 供應商管理</a>
            </li>
			<li>
                <a href="{{ route('admin.reports.all') }}"><i class="fa fa-fw fa-edit"></i> 每月報表管理</a>
            </li>
			<li>
                <a href="{{ route('admin.setting.edit') }}"><i class="fa fa-fw fa-edit"></i> 系統管理</a>
            </li>
			@elseif(Auth::user()->previlege_id==2)
			<li class="active">
                    <a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-fw fa-dashboard"></i> 首頁</a>
                </li>
				<li class="active">
                    <a href="{{ route('main.shop') }}"><i class="fa fa-fw fa-dashboard"></i> 商店</a>
                </li>
                <li>
				<a data-toggle="collapse" data-parent="#accordion" 
				   href="#collapse6">
				   <i class="fa fa-fw fa-edit"></i>商品管理<b class="caret"></b>
				    <div id="collapse6" class="panel-collapse collapse">
				<div class="panel-body">
                    <a href="{{ route('admin.places.index') }}"><i class="fa fa-fw fa-edit"></i> 商品管理</a></br>
					 
					 </div>
				</div>
				<script type="text/javascript">
	$(function () { $('#collapse6').collapse({
		'hide'
	})});
	
</script>
                </li>
				
				
				
				
				
	<li>
				<a data-toggle="collapse" data-parent="#accordion" 

				href="#collapse5">
					<i class="fa fa-fw fa-edit"></i>訂單處理<b class="caret"></b>
				</a>
			
		
                <div id="collapse5" class="panel-collapse collapse">
				<div class="panel-body">
				
				<a href="{{ route('orders.index') }}"><i class="fa fa-fw fa-edit"></i> 進行中</a></br>
				
				<a href="{{ route('orders.index1') }}"><i class="fa fa-fw fa-edit"></i> 已完成</a></br>

				<a href="{{ route('orders.backindex') }}"><i class="fa fa-fw fa-edit"></i> 退貨</a>

				</div>
				</div>
				<script type="text/javascript">
	$(function () { $('#collapse5').collapse({
		'hide'
	})});
	
</script>
				</li>
				
            
           
               <li>
                    <a href="{{ route('admin.news.index') }}"><i class="fa fa-fw fa-edit"></i> 公告管理</a>
               </li>

            @endif
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
