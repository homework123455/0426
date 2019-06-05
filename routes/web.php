<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::auth();
Route::get('/home',
    function (){return redirect()->action('AdminDashboardController@index');
});
//Route::get('/', ['as' => 'admin.dashboard.index', 'uses' => 'AdminDashboardController@index']);
Route::get('/'         , ['as' => 'home.index' , 'uses' => 'HomeController@index']);
//Route::get('posts'     , ['as' => 'posts.index', 'uses' => 'PostsController@index']);
//Route::get('posts/{id}', ['as' => 'posts.show' , 'uses' => 'PostsController@show']);
Route::get('checkmail'   , ['as' => 'checkmail' , 'uses' => 'UsersController@checkmail']);

//顯示商品頁面
Route::get('shop/main', ['as' => 'main.shop', 'uses' => 'ShopController@index']);
//顯示購物車頁面
Route::get('cart', ['as' => 'cart', 'uses' => 'CartController@index']);

//購物車商品新增
Route::get('cart/{id}', ['as' => 'cart.add', 'uses' => 'CartController@add',function($id){
}]);

//購物車數量修改
Route::get('cart/{id}/{q}', ['as' => 'cart.update', 'uses' => 'CartController@update',function($id,$q){
}]);

//購物車項目刪除
Route::delete('cart/{id}',['as'=>'cart.delete','uses'=>'CartController@delete',function($id){
}]);

//顯示商品詳細資訊頁面
Route::get('detail/{id}', ['as' => 'detail', 'uses' => 'ShopDetailController@index',function($id){

}]);

//價格排序
Route::get('shopprice/{type}/{id}', ['as' => 'sort.shop', 'uses' => 'ShopController@price',function($id,$type){
}]);
Route::get('shopprice/{type}', ['as' => 'sort.shop.id', 'uses' => 'ShopController@pricesort',function($type){
}]);


//淨化能力篩選
Route::get('shopcleanup/{id}', ['as' => 'cleanup.shop', 'uses' => 'ShopController@cleanup',function($id){
}]);
Route::get('shop/cleandown', ['as' => 'cleandown.shop', 'uses' => 'ShopController@cleandown',function(){
}]);

//滯塵能力篩選
Route::get('shop/dustup', ['as' => 'dustup.shop', 'uses' => 'ShopController@dustup',function(){
}]);
Route::get('shop/dustdown', ['as' => 'dustdown.shop', 'uses' => 'ShopController@dustdown',function(){
}]);

//聯絡我們
Route::get('contact', ['as' => 'main.contact', 'uses' => 'ContactController@index']);

//植物新聞
Route::get('news', ['as' => 'main.news', 'uses' => 'NewsController1@index']);
Route::get('news/detail/{id}', ['as' => 'news.detail', 'uses' => 'NewsDetailController@news',function($id){
}]);


//搜尋
Route::post('/shop/search',['as'=> 'search','uses'=>'ShopController@search']);

Route::get('orders', ['as' => 'orders.index' , 'uses' => 'MaintaincesController@index']);
Route::get('ordersback', ['as' => 'orders.backindex' , 'uses' => 'MaintaincesController@backindex']);
Route::get('ordersback/{id}/backshow', ['as' => 'orders.backshow' , 'uses' => 'MaintaincesController@backshow']);
Route::patch('ordersback/{id}/backshow', ['as' => 'orders.backshowupdate' , 'uses' => 'MaintaincesController@backshowupdate']);
Route::get('orders1', ['as' => 'orders.index1' , 'uses' => 'MaintaincesController@index1']);
Route::delete('orders/{id}'  , ['as' => 'orders.destroy', 'uses' => 'MaintaincesController@destroy']);
Route::get('orders/{id}/show', ['as' => 'orders.show', 'uses' => 'MaintaincesController@show']); 
Route::get('orders/{id}/show1', ['as' => 'orders.show1', 'uses' => 'MaintaincesController@show1']);
Route::get('orders/{id}/show2', ['as' => 'orders.show2', 'uses' => 'MaintaincesController@show2']);
Route::get('orders/{id}/cancelshow', ['as' => 'orders.cancelshow', 'uses' => 'MaintaincesController@cancelshow']);
Route::patch('orders/{id}/cancel'  , ['as' => 'orders.cancel', 'uses' => 'MaintaincesController@cancel']);
Route::patch('orders/{id}'  , ['as' => 'orders.process', 'uses' => 'MaintaincesController@process']);
Route::patch('orders/{id}/scrapped', ['as' => 'orders.scrapped', 'uses' => 'MaintaincesController@scrapped']);
Route::patch('orders/{id}/ordercancel', ['as' => 'orders.ordercancel'  , 'uses' => 'MaintaincesController@cancelupdate']);
Route::get('orders/{id}/show/{users_id}/show5', ['as' => 'orders.show5', 'uses' => 'MaintaincesController@show5']);
Route::get('orders/{id}/show1/{product_id}/orderback', ['as' => 'orders.back', 'uses' => 'MaintaincesController@orderback']);
Route::patch('orders/{id}/show1/{product_id}/orderback', ['as' => 'orders.backupdate', 'uses' => 'MaintaincesController@orderbackupdate']);
Route::get('users/{id}/open', ['as' => 'checkupdate', 'uses' => 'UsersController@checkupdate']);
Route::get('users/check', ['as' => 'check', 'uses' => 'UsersController@checkindex']); 

//checkout
Route::get('checkout',['as'=> 'checkout','uses'=>'CheckoutController@cartdetail']);

Route::post('/orders',['as'=> 'orders.store','uses'=>'CheckoutController@store',function(Request $request){}]);

// 後台
Route::group(['prefix' => 'admin'], function() {
	
    Route::get('/', ['as' => 'admin.dashboard.index', 'uses' => 'AdminDashboardController@index']);	
	/////系統設定
	Route::get('setting/edit'   , ['as' => 'admin.setting.edit' , 'uses' => 'AdminDashboardController@edit']);
	Route::post('setting'   , ['as' => 'admin.setting.update' , 'uses' => 'AdminDashboardController@update']);
	////////
	Route::get('news'         , ['as' => 'admin.news.index' , 'uses' => 'NewsController@index']);
    Route::get('news/create'   , ['as' => 'admin.news.create' , 'uses' => 'NewsController@create']);
    Route::post('news'         , ['as' => 'admin.news.store'  , 'uses' => 'NewsController@store']);
    Route::get('news/{id}/edit', ['as' => 'admin.news.edit'   , 'uses' => 'NewsController@edit']);
    Route::patch('news/{id}'   , ['as' => 'admin.news.update' , 'uses' => 'NewsController@update']);
    Route::delete('news/{id}'  , ['as' => 'admin.news.destroy', 'uses' => 'NewsController@destroy']);
    Route::post('news/show'  , ['as' => 'admin.news.show', 'uses' => 'NewsController@show']);
    Route::get('user',['as' => 'admin.dashboard.user', 'uses' => 'AdminDashboardController@index']);
    //Route::get('user',['as' => 'admin.dashboard.user', 'uses' => 'AdminDashboardController@index1',function(Request $request){}]);
    Route::get('mis',['as' => 'admin.dashboard.mis', 'uses' => 'AdminDashboardController@index']);
/////
    Route::get('shops', ['as' => 'admin.shops.index', 'uses' => 'ShopController@index1']);
	 Route::get('shops/{id}/data', ['as' => 'admin.shops.data', 'uses' => 'ShopController@data']);
	////
	Route::get('places', ['as' => 'admin.places.index', 'uses' => 'PlaceController@index']);
	Route::get('places/create', ['as' => 'admin.places.create', 'uses' => 'PlaceController@create']);       //新增資產(1)
	Route::post('places', ['as' => 'admin.places.store', 'uses' => 'PlaceController@store']);               //新增資產(2)
	////商品
	Route::get('shops/create', ['as' => 'admin.shops.create', 'uses' => 'ShopController@create']); 
    Route::post('places', ['as' => 'admin.shops.store', 'uses' => 'ShopController@store']);
	Route::get('shops/suppliersdetail', ['as' => 'admin.shops.suppliersdetail', 'uses' => 'ShopController@suppliersdetail']); 
	Route::delete('shops/suppliersdetail/{id}', ['as' => 'admin.shops.suppliersdetail.destroy', 'uses' => 'ShopController@suppliersdetaildestroy']); 
	Route::get('shops/suppliersdetail/search1'  , ['as' => 'admin.shops.suppliersdetail.search1', 'uses' => 'ShopController@Search1']);
    Route::get('shops/suppliersdetail/searchALL'  , ['as' => 'admin.shops.suppliersdetail.searchALL', 'uses' => 'ShopController@searchALL']);
	Route::get('shops/{id}/suppliers', ['as' => 'admin.shops.suppliers', 'uses' => 'ShopController@suppliers']); 	//新增資產(1)
	Route::post('shops/suppliers/store/{id}', ['as' => 'admin.shops.supplierstore', 'uses' => 'ShopController@supplierstore']); 
	Route::delete('shops/{id}', ['as' => 'admin.shops.destroy', 'uses' => 'ShopController@destroy']); 
	Route::get('shops/{id}/edit', ['as' => 'admin.shops.edit', 'uses' => 'ShopController@edit']);        //修改資產(1)
    Route::patch('shops/{id}', ['as' => 'admin.shops.update', 'uses' => 'ShopController@update']);
	////
	Route::get('reports/index1/{id}', ['as' => 'admin.reports.index1', 'uses' => 'ReportController@index']);
	Route::get('reports/all', ['as' => 'admin.reports.all', 'uses' => 'ReportController@index1']);
	Route::get('reports/{id}', ['as' => 'admin.reports.all.sort1', 'uses' => 'ReportController@sort1',function($id){}]);
	
	////供應商
	 Route::get('suppliers', ['as' => 'admin.suppliers.index', 'uses' => 'SuppilerController@index']);
	 Route::get('suppliers/create', ['as' => 'admin.suppliers.create', 'uses' => 'SuppilerController@create']);
	 Route::get('suppliers/{id}/edit', ['as' => 'admin.suppliers.edit', 'uses' => 'SuppilerController@edit']);
	 Route::patch('suppliers/{id}', ['as' => 'admin.suppliers.update', 'uses' => 'SuppilerController@update']);
	 Route::post('suppliers', ['as' => 'admin.suppliers.store', 'uses' => 'SuppilerController@store']);
	 Route::delete('suppliers/{id}', ['as' => 'admin.suppliers.destroy', 'uses' => 'SuppilerController@destroy']);
	 Route::patch('suppliers/{id}/scrapped', ['as' => 'admin.suppliers.scrapped', 'uses' => 'SuppilerController@scrapped']);
	 Route::patch('suppliers/{id}/scrapped1', ['as' => 'admin.suppliers.scrapped1', 'uses' => 'SuppilerController@scrapped1']);
	/////分類
    Route::get('categories', ['as' => 'admin.categories.index', 'uses' => 'CategorieController@index']);
	Route::get('categories/create', ['as' => 'admin.categories.create', 'uses' => 'CategorieController@create']);       
	Route::post('categories', ['as' => 'admin.categories.store', 'uses' => 'CategorieController@store']);
	Route::get('categories/{id}/edit', ['as' => 'admin.categories.edit', 'uses' => 'CategorieController@edit']);        //修改資產(1)
    Route::patch('categories/{id}', ['as' => 'admin.categories.update', 'uses' => 'CategorieController@update']); 
	Route::delete('categories/{id}', ['as' => 'admin.categories.destroy', 'uses' => 'CategorieController@destroy']);
	Route::post('categories/search2'  , ['as' => 'admin.categories.search2', 'uses' => 'CategorieController@Search2']);
Route::post('categories/searchALL1'  , ['as' => 'admin.categories.searchALL1', 'uses' => 'CategorieController@searchALL1']);
    /////   
    /////補貨
	Route::get('shops/{id}/{q}/supplement', ['as' => 'admin.shops.update2', 'uses' => 'ShopController@update2',function($id,$q){}]);
    Route::get('shops/{id}/supplement', ['as' => 'admin.shops.supplement', 'uses' => 'ShopController@supplement']);        
    Route::patch('shops/supplement/{id}', ['as' => 'admin.shops.update1', 'uses' => 'ShopController@update1']);    
     /////////	

    Route::get('places/{id}/edit', ['as' => 'admin.places.edit', 'uses' => 'PlaceController@edit']);        //修改資產(1)
    Route::patch('places/{id}', ['as' => 'admin.places.update', 'uses' => 'PlaceController@update']);     //修改資產(2)
    Route::delete('places/{id}', ['as' => 'admin.places.destroy', 'uses' => 'PlaceController@destroy']);   //刪除資產
    Route::post('places/search'  , ['as' => 'admin.places.search', 'uses' => 'PlaceController@Search']); //查詢星期
	
    Route::post('places/search1'  , ['as' => 'admin.places.search1', 'uses' => 'PlaceController@Search1']);	//查詢場地類別
	Route::get('places/search10'  , ['as' => 'admin.places.search10', 'uses' => 'PlaceController@Search10']);	//查詢開放時段
	Route::get('places/searchALL1'  , ['as' => 'admin.places.searchALL1', 'uses' => 'PlaceController@searchALL1']);	//查詢開放時段
    Route::get('places/{id}/data', ['as' => 'admin.places.data', 'uses' => 'PlaceController@data']);       //資產詳細資料

    Route::get('places/instascan', ['as' => 'admin.places.instascan', 'uses' => 'PlaceController@instascan']);

    //未做
    Route::post('places/searchAll'  , ['as' => 'admin.places.searchAll', 'uses' => 'PlaceController@SearchAll']);  //查詢資產(複雜)

    //報廢資產
    Route::patch('places/{id}/scrapped', ['as' => 'admin.places.scrapped', 'uses' => 'PlaceController@scrapped']);  
Route::patch('places/{id}/scrapped1', ['as' => 'admin.places.scrapped1', 'uses' => 'PlaceController@scrapped1']); 
	//報廢資產

    //未做
    //Route::patch('places/{id}/scrapped', ['as' => 'admin.places.update', 'uses' => 'PlaceController@update']);     //取消報修資產

    //租用資產
    Route::get('places/{id}/lending', ['as' => 'admin.lendings.create', 'uses' => 'PlaceController@lendings_create']);     //租用資產(1)
    Route::post('places/{id}/lending', ['as' => 'admin.lendings.store', 'uses' => 'PlaceController@lendings_store']);     //租用資產(2)
    Route::patch('places/{aid}/lending/{id}', ['as' => 'admin.lendings.return', 'uses' => 'PlaceController@lendings_return']);     //歸還資產

    //申請
    Route::get('places/{id}/application', ['as' => 'admin.places.application', 'uses' => 'MaintaincesController@create']);             //員工申請資產(1)
    Route::patch('places/{id}/application/store', ['as' => 'admin.places.application.store', 'uses' => 'MaintaincesController@store']);  //員工申請資產(2)

    //報修
    Route::get('maintainces', ['as' => 'admin.maintainces.index', 'uses' => 'MaintaincesController@index']);                        //報修主畫面
    Route::get('maintainces/{id}/show', ['as' => 'admin.maintainces.show', 'uses' => 'MaintaincesController@show']);    
	  	//選擇維修方式(1)
    Route::patch('maintainces/{id}'  , ['as' => 'admin.maintainces.process', 'uses' => 'MaintaincesController@process']);            //選擇維修方式(2)
    //Route::get('maintainces/{id}/details'  , ['as' => 'admin.maintainces.details', 'uses' => 'MaintainceItemsController@index']);      //輸入維修項目資料
   // Route::post('maintainces/{id}/detail'  , ['as' => 'admin.maintainces.details.store', 'uses' => 'MaintainceItemsController@store']);  //新增維修項目
    Route::post('maintainces/{id}/complete'  , ['as' => 'admin.maintainces.complete', 'uses' => 'MaintaincesController@complete']);  //完成維修
   // Route::get('maintainces/{mid}/details/{id}'  , ['as' => 'admin.maintainces.edit', 'uses' => 'MaintainceItemsController@edit']);                 //修改維修項目資料(1)
    //Route::patch('maintainces/{mid}/details/{id}'  , ['as' => 'admin.maintainces.details.update', 'uses' => 'MaintainceItemsController@update']);   //修改維修項目資料(2)
    Route::delete('maintainces/{id}'  , ['as' => 'admin.maintainces.destroy', 'uses' => 'MaintaincesController@destroy']);  //刪除維修項目

    
	//使用者
    Route::get('users', ['as' => 'admin.users.index', 'uses' => 'UsersController@index']);              //使用者主畫面
    Route::get('users/create', ['as' => 'admin.users.create', 'uses' => 'UsersController@create']);       //新增使用者(1)
    Route::post('users', ['as' => 'admin.users.store', 'uses' => 'UsersController@store']);               //新增使用者(2)
    Route::get('users/{id}/edit', ['as' => 'admin.users.edit', 'uses' => 'UsersController@edit']);        //修改使用者(1)
    Route::patch('users/{id}', ['as' => 'admin.users.update', 'uses' => 'UsersController@update']);     //修改使用者(2)
    Route::delete('users/{id}', ['as' => 'admin.users.destroy', 'uses' => 'UsersController@destroy']);   //刪除使用者
    Route::post('users/search'  , ['as' => 'admin.users.search', 'uses' => 'UsersController@Search']);  //查詢使用者
    Route::get('users/{id}/data', ['as' => 'admin.users.data', 'uses' => 'UsersController@data']);
    Route::get('users/{id}/wrongdata', ['as' => 'admin.users.showwrong', 'uses' => 'UsersController@wrongdata']);
    Route::get('users/{id}/wrongdata/create', ['as' => 'admin.users.showwrong.wrongcreate', 'uses' => 'UsersController@wrongcreate']);
    Route::patch('users/{id}/wrongdata', ['as' => 'admin.users.showwrong.wrongstore', 'uses' => 'UsersController@wrongstore']);
	Route::delete('users/{id}/wrongdata/{wid}', ['as' => 'admin.users.showwrong.destroy1', 'uses' => 'UsersController@destroy1']);
	Route::get('users/{id}/wrongdata/{wid}/wrongedit', ['as' => 'admin.users.showwrong.wrongedit'   , 'uses' => 'UsersController@wrongedit']);
    Route::patch('users/{id}/wrongdata/{wid}'   , ['as' => 'admin.users.showwrong.update1' , 'uses' => 'UsersController@update1']);
	Route::get('users/{id}/editpassword', ['as' => 'admin.users.editpassword', 'uses' => 'UsersController@editpassword']);
	Route::patch('users/{id}/editpassword', ['as' => 'admin.users.updatepassword', 'uses' => 'UsersController@updatepassword']); 

});

Route::get('/tracy',function(){throw new \Exception('Tracy works');} );