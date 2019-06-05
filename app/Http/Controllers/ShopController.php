<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\PlaceRequest;
use App\Http\Requests\SupplyRequest;
use App\Good;
use App\Report;
use App\Plant;
use DB;
use App\Category;
use App\Supplier;
use App\Setting;
use App\User;
use App\Addstock;
use App\Suppliersdetail;
use App\Suppliersdetail1;
use Carbon\Carbon;
class ShopController extends Controller
{
    public function index()
    {
		$setting=Setting::where('id','1')->get()->first();
        $data=Good::all();
		$category = Category::all();
		$id=1;
		$good = Good::where('id','1')->get()->first();
		if(Auth::check()){
		$vip_time=User::where('id',Auth::user()->id)->value('vip_time');
	    $vip_time1=Carbon::parse($vip_time)->addDays(30)->format('Y-m-d');
		if(Carbon::now()>=$vip_time1){
		DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
            'vip' => 0,
			'vip_time'=>null,
			'level'=>0
			
        ]);
		}}
        return view('Shop', ['goods' => $data,'categories'=>$category,'good'=>$good,'setting'=>$setting,'id'=>$id]);
    }


    //淨化力
    public function cleanup($id)
    {
		$setting=Setting::where('id','1')->get()->first();
		$category = Category::all();	
        $i=1;		
        $data = Good::where('category',$id)->get();
        return view('Shop', ['goods' => $data,'categories'=>$category,'setting'=>$setting,'i'=>$i,'id'=>$id]);
        
    }
    public function cleandown()
    {

        $data = DB::table('goods')
        ->join('plants', 'goods.id', '=', 'plants.goods_id')
        ->where('cleanup_co2','<',6)
        ->get();
        return view('Shop', ['goods' => $data]);
    }

    //滯塵能力
    public function dustup()
    {
        $data = DB::table('goods')
        ->join('plants', 'goods.id', '=', 'plants.goods_id')
        ->where('dust','>',5)
        ->get();
        return view('Shop', ['goods' => $data]);
    }
    public function dustdown()
    {
        $data = DB::table('goods')
        ->join('plants', 'goods.id', '=', 'plants.goods_id')
        ->where('dust','<',6)
        ->get();
        return view('Shop', ['goods' => $data]);
    }
     
     
    //價格排序
    public function price($tpye,$id)
    {
		$setting=Setting::where('id','1')->get()->first();
		$category = Category::all();
		$i=1;
		if(isset($id)){
			$data = Good::where('category',$id)->orderBy('price', $tpye)->get();
		}
		else{
			$data = Good::orderBy('price', $tpye)->get();
		}
        return view('Shop', ['goods' => $data,'categories'=>$category,'setting'=>$setting,'id'=>$id]);
    }
	public function pricesort($tpye)
    {
		$setting=Setting::where('id','1')->get()->first();
		$category = Category::all();
		$id=1;
		
        $data = Good::orderBy('price', $tpye)->get();
		
        return view('Shop', ['goods' => $data,'categories'=>$category,'setting'=>$setting,'id'=>$id]);
    }


    //搜尋
    public function search(Request $request)
    {
		$id=1;
        $search = $request->input("search");
		$setting=Setting::where('id','1')->get()->first();
		$category = Category::all();
        $data =DB::table('goods')
            ->where('name','like','%'.$search.'%')
            ->get();
        return view('Shop', ['goods' => $data,'setting'=>$setting,'categories'=>$category,'id'=>$id]);
    }
	  public function index1(Request $request)
    {
        //if(!Auth:user()->previlege_id==3)){
		$order=Order::where('users_id',Auth::user()->id)->get();

        //$good = Good::orderBy('created_at', 'DESC')->get();
		$ordersdetail= OrdersDetail::where('orders_id',$order)->get();

        //$category = Category::orderBy('created_at', 'DESC')->get();
		//}
		//else{
			$order =Order::all();
			$ordersdetail=OrdersDetail::find($order);
			
		//}
        /*
        if(!(Auth::user()->previlege_id==3)){

           $place=Place::where('id','0')->get();
       }
*/
        $data = ['orders' => $order,'ordersdetails'=>$ordersdetail, 'categories' => $category,  'Search' => $Search, 'Search1' => $Search1, 'Search2' => $Search2];

        return view('admin.shops.index', $data);
    }

	public function create()
	{
		$suppliers = Supplier::orderBy('created_at', 'DESC')->get();
		$category = Category::orderBy('created_at', 'DESC')->get();
		$good=Good::orderBy('created_at','DESC')->get();
		$data = ['categories' => $category ,'goods'=>$good,'suppliers' => $suppliers];
		
		return view('admin.shops.create', $data);
	}
	public function suppliersdetail(Request $request)
	{
		$suppliersdetails = Suppliersdetail1::orderBy('created_at', 'DESC')->paginate(5);
		$suppliers = Supplier::orderBy('created_at', 'DESC')->get();
		$goods=Good::orderBy('created_at','DESC')->get();
		$Search = $request->input('good_search');
        
        $Search1 = $request->input('supplier_search');
		$data = ['goods'=>$goods,'suppliersdetails' => $suppliersdetails ,'suppliers' => $suppliers, 'Search' => $Search, 'Search1' => $Search1];
		
		return view('admin.shops.suppliersdetail', $data);
	}
	 public function suppliersdetaildestroy($id)
    {
        Suppliersdetail::destroy($id);
        return redirect()->route('admin.shops.suppliersdetail');
    }
	public function suppliers($id)
	{
		$suppliers = Supplier::orderBy('created_at', 'DESC')->get();
		$category = Category::orderBy('created_at', 'DESC')->get();
		//$goods=Good::orderBy('created_at','DESC')->get();
		$good = Good::find($id);
		$data = ['categories' => $category ,'good'=>$good,'suppliers' => $suppliers ];
		
		return view('admin.shops.suppliers', $data);
	}
	   public function supplierstore(SupplyRequest $request,$id)
    {
        
        $good = Good::find($id);
		//if(!empty($request->value)&&!empty($request->price)){
        Suppliersdetail::create([
            'name' => $request->name,
			'supplier_id'=>$request->supplier_id,
            'value' => $request->value,
            'price' => $request->price,
          
        ]);
		Suppliersdetail1::create([
            'name' => $request->name,
			'supplier_id'=>$request->supplier_id,
            'value' => $request->value,
            'price' => $request->price,
          
        ]);
		$stock=$good->stock;
		
		 $good->update([
            
            'stock' => $stock+$request->value,
           

        ]);
		//}

        return redirect()->route('admin.suppliers.index');
    }

    public function edit($id)
    {
     
      
        $categories = Category::orderBy('created_at', 'DESC')->get();

		


        $good = Good::find($id);
        $data = ['good' => $good, 'categories' => $categories];

        return view('admin.shops.edit', $data);
    }

    public function update(PlaceRequest $request, $id)
    {

        $good = Good::find($id);
$file = $request->file('img1');
            if (!empty($file)) {//此处防止没有多文件上传的情况
                $allowed_extensions = ["png", "jpg", "gif","JPG"];

                if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                    exit('您只能上傳PNG、JPG或GIF格式的圖片！');
                }
                $destinationPath = '/uploads/' . date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
                $extension = $file->getClientOriginalExtension();   // 上传文件后缀
                $fileName = date('YmdHis') . mt_rand(100, 999) . '.' . $extension; // 重命名
                $file->move(public_path() . $destinationPath, $fileName); // 保存图片
                $filePath= $destinationPath . '/' . $fileName;

            }
			
			$file1 = $request->file('img2');
            if (!empty($file1)) {//此处防止没有多文件上传的情况
                $allowed_extensions = ["png", "jpg", "gif","JPG"];

                if ($file1->getClientOriginalExtension() && !in_array($file1->getClientOriginalExtension(), $allowed_extensions)) {
                    exit('您只能上傳PNG、JPG或GIF格式的圖片！');
                }
                $destinationPath = '/uploads/' . date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
                $extension = $file1->getClientOriginalExtension();   // 上传文件后缀
                $fileName = date('YmdHis') . mt_rand(100, 999) . '.' . $extension; // 重命名
                $file1->move(public_path() . $destinationPath, $fileName); // 保存图片
                $filePath1= $destinationPath . '/' . $fileName;

            }
			$file2 = $request->file('img3');
            if (!empty($file2)) {//此处防止没有多文件上传的情况
                $allowed_extensions = ["png", "jpg", "gif","JPG"];

                if ($file2->getClientOriginalExtension() && !in_array($file2->getClientOriginalExtension(), $allowed_extensions)) {
                    exit('您只能上傳PNG、JPG或GIF格式的圖片！');
                }
                $destinationPath = '/uploads/' . date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
                $extension = $file2->getClientOriginalExtension();   // 上传文件后缀
                $fileName = date('YmdHis') . mt_rand(100, 999) . '.' . $extension; // 重命名
                $file2->move(public_path() . $destinationPath, $fileName); // 保存图片
                $filePath2= $destinationPath . '/' . $fileName;

            }
			$file3 = $request->file('img4');
            if (!empty($file3)) {//此处防止没有多文件上传的情况
                $allowed_extensions = ["png", "jpg", "gif","JPG"];

                if ($file3->getClientOriginalExtension() && !in_array($file3->getClientOriginalExtension(), $allowed_extensions)) {
                    exit('您只能上傳PNG、JPG或GIF格式的圖片！');
                }
                $destinationPath = '/uploads/' . date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
                $extension = $file3->getClientOriginalExtension();   // 上传文件后缀
                $fileName = date('YmdHis') . mt_rand(100, 999) . '.' . $extension; // 重命名
                $file3->move(public_path() . $destinationPath, $fileName); // 保存图片
                $filePath3= $destinationPath . '/' . $fileName;

            }
		if(!empty($file)&&!empty($file1)&&!empty($file2)&&!empty($file3)){
        $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
            'photo1'=>$filePath,
			'photo2'=>$filePath1,
			'photo3'=>$filePath2,
			'photo4'=>$filePath3
        ]);
	}
	elseif(!empty($file)&&!empty($file1)&&!empty($file2)&&empty($file3)){
 $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			 'photo1'=>$filePath,
			'photo2'=>$filePath1,
			'photo3'=>$filePath2,
			
        ]);
	}
	elseif(!empty($file)&&!empty($file1)&&empty($file2)&&!empty($file3)){
 $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			   'photo1'=>$filePath,
			'photo2'=>$filePath1,
			
			'photo4'=>$filePath3
        ]);
	}
	elseif(!empty($file)&&empty($file1)&&!empty($file2)&&!empty($file3)){
		$good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			 'photo1'=>$filePath,
			
			'photo3'=>$filePath2,
			'photo4'=>$filePath3
        ]);
	}
elseif(empty($file)&&!empty($file1)&&!empty($file2)&&!empty($file3)){
 $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			'photo2'=>$filePath1,
			'photo3'=>$filePath2,
			'photo4'=>$filePath3
        ]);
	}
		elseif(!empty($file)&&!empty($file1)&&empty($file2)&&empty($file3)){
 $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			 'photo1'=>$filePath,
			'photo2'=>$filePath1,
			
        ]);
	}
	elseif(!empty($file)&&empty($file1)&&!empty($file2)&&empty($file3)){
 $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			'photo1'=>$filePath,
			
			'photo3'=>$filePath2,
			
        ]);
	}
	elseif(empty($file)&&!empty($file1)&&!empty($file2)&&empty($file3)){
 $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			'photo2'=>$filePath1,
			'photo3'=>$filePath2,


        ]);
	}
elseif(empty($file)&&!empty($file1)&&empty($file2)&&!empty($file3)){
       $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
            
			'photo2'=>$filePath1,
			
			'photo4'=>$filePath3
        ]);
		}
		elseif(!empty($file)&&empty($file1)&&empty($file2)&&!empty($file3)){
       $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,

            'photo1'=>$filePath,

			'photo4'=>$filePath3
        ]);
		}
		
		elseif(empty($file)&&empty($file1)&&!empty($file2)&&!empty($file3)){
       $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			'photo3'=>$filePath2,
			'photo4'=>$filePath3
        ]);
		}
		elseif(!empty($file)&&empty($file1)&&empty($file2)&&empty($file3)){
       $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
            'photo1'=>$filePath,
	
        ]);
		}
		elseif(empty($file)&&!empty($file1)&&empty($file2)&&empty($file3)){
       $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
      
			'photo2'=>$filePath1,

        ]);
		}
		elseif(empty($file)&&empty($file1)&&!empty($file2)&&empty($file3)){
       $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			'photo3'=>$filePath2,
	
        ]);
		}
		elseif(empty($file)&&empty($file1)&&empty($file2)&&!empty($file3)){
        $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			'photo4'=>$filePath3
        ]);
		}
		elseif(empty($file)&&empty($file1)&&empty($file2)&&empty($file3)){
 $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
			
        ]);
		}
      /*  $good->update([
             'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            
            
            'lendable' => $request->lendable,
            'price' => $request->price,
            //'warranty'=>$request->warranty,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,
            'photo1' => $filePath,
			'photo2' => $filePath1,
			'photo3' => $filePath2,
			'photo4' => $filePath3,


            



        ]);*/

        return redirect()->route('admin.places.index');
    }

    public function store(PlaceRequest $request)
    {
        $file = $request->file('img');
        $filePath = [];  // 定义空数组用来存放图片路径
        foreach ($file as $key => $value) {
            // 判断图片上传中是否出错

/*
                if (!$value->isValid()) {
                    exit('上傳圖片出錯，請重試！');
					//echo '<script>alert('.上傳圖片出錯，請重試！.');</script>';
                }
*/
            //if(!empty($value)){//此处防止没有多文件上传的情况
               // $allowed_extensions = ["png", "jpg", "gif","JPG"];

            /*
                            if (!$value->isValid()) {
                               // exit"<script> alert('上傳圖片出錯，請重試！')</script>";
                                echo '<script>alert('.上傳圖片出錯，請重試！.');</script>';
                            }
            */
            if (!empty($value)) {//此处防止没有多文件上传的情况
                $allowed_extensions = ["png", "jpg", "gif","JPG"];

                if ($value->getClientOriginalExtension() && !in_array($value->getClientOriginalExtension(), $allowed_extensions)) {
                    exit('您只能上傳PNG、JPG或GIF格式的圖片！');
                }
                $destinationPath = '/uploads/' . date('Y-m-d'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
                $extension = $value->getClientOriginalExtension();   // 上传文件后缀
                $fileName = date('YmdHis') . mt_rand(100, 999) . '.' . $extension; // 重命名
                $value->move(public_path() . $destinationPath, $fileName); // 保存图片
                $filePath[] = $destinationPath . '/' . $fileName;

            }
        }
        /*Place::create([
        $request->all()]);*/
        Good::create([
            'name' => $request->name,
            'category' => $request->category,
            //'date'=>$request->date,

            'status' => $request->status,
			'supplier_id'=>$request->supplier_id,
            'remark' => $request->remark,
			'details'=>$request->details,
			'details2'=>$request->details2,
			'details3'=>$request->details3,
			'save_stock'=>$request->save_stock,

            'photo1' => $filePath[0],
			'photo2' => $filePath[1],
			'photo3' => $filePath[2],
			'photo4' => $filePath[3],

        ]);
		$good=Good::orderby('id','desc')->first();
		Report::create([
            'good_id' => $good->id,
			
     
        ]);

        return redirect()->route('admin.places.index');
    }

    public function destroy($id)
    {
        Good::destroy($id);
        return redirect()->route('admin.places.index');
    }

    public function data($id)
    {

        $order = Order::find($id);
		$ordersdetail=OrdersDetail::where('orders_id',$order->id);
        /*$category = Category::find($place->category);
        //$vendor=Vendor::find($place->vendor);
        $user = User::find($place->keeper);
		
        $maintainceitems = MaintainceItem::orderBy('created_at', 'ASC')->get();
        $assetmaintainces = Maintaince::where('place_id', $place->id)->where('status', '通過')->get();
        $lendings = Lending::where('returntime', null)->get();
        $times = Time_::orderBy('id', 'ASC')->get();
        $weeks = Week::orderBy('id', 'ASC')->get();
		place' => $place, 'category' => $category, 'user' => $user,
            'assetmaintainces' => $assetmaintainces, 'maintainceitems' => $maintainceitems,
            'lendings' => $lendings, 'times' => $times, 'weeks' => $weeks*/
        $data = ['orders'=>$order,'ordersdetails'=>$ordersdetail];

        return view('admin.shops.show', $data);
    }

   
    public function scrapped($id)
    {

        $place=Place::find($id);
        $place->update([
            'status'=>'維修中',
			'lendable'=>'0'
        ]);
		
        return redirect()->route('admin.places.index');
    }
	public function scrapped1($id)
    {

        $place=Place::find($id);
        $place->update([
            'status'=>'正常使用中',
			'lendable'=>'1'
        ]);
        return redirect()->route('admin.places.index');
    }

    public function lendings_create($id)
    {

        $place=Place::find($id);
        $users=User::orderBy('created_at' ,'DESC') ->get();
        $today = Carbon::today();
        $data=['place'=>$place,'users'=>$users,'today'=>$today];
        return view('admin.places.lending' ,$data);
    }

    public function lendings_store(Request $request,$id)
    {

        $place=Place::find($id);
		$users=User::orderBy('created_at' ,'DESC') ->get();
        $place->lendings()->create([
            'user_id'=>$request->user_id,
            'lenttime'=> Carbon::now(),
			
        ]);
		//$lendname_id=$request->user_id;
		foreach($users as $user){
        if($request->user_id==$user->id){
			$lendname_name=$user->name;
		//$user1=User::find($application->user_id);
		//$user2=$user->name;
		}
		
		
		}
		

        $place->update([
            'status'=>'租借中',
			'lendable'=>'0',
			'lendname'=>$lendname_name,
        ]);
        return redirect()->route('admin.places.index');
    }

    public function lendings_return($aid,$id)
    {

        $place=Place::find($aid);
        $lending=Lending::find($id);
		/*
        $lending->update([
            'returntime'=>Carbon::now()
        ]);
		*/
		Lending::destroy($id);
        $place->update([
            'status'=>'正常使用中',
			'lendable'=>'1',
			'lendname'=>NULL
        ]);
        return redirect()->route('admin.places.index');
    }
    public function instascan()
{
    return view('admin.places.instascan');
}
 public function supplement($id)
    {
     
        $suppliersdetails = Suppliersdetail::orderBy('id', 'ASC')->where('name', $id)->where('value','>',0)->get();
		$suppliers = Supplier::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $good = Good::find($id);
		$total=0;
		$price=0;
		$link=mysqli_connect("localhost:33060","root","root","homestead");
		$sql ="SELECT * FROM suppliersdetail WHERE name='$id' and checked='1'";
		$rec = $link->query($sql);	
		$rNum = $rec->num_rows;
		if($rNum>0){
		$suppliersdetail2 = Suppliersdetail::where('name', $id)->where('checked',1)->get();
		foreach($suppliersdetail2 as $suppliersdetail){
		$total=$total + $suppliersdetail->value;
		if($price<=($suppliersdetail->price)*1.5){
			$price=($suppliersdetail->price)*1.5;
		}
		
		}
		}
		
        $data = ['price'=>$price,'total'=>$total,'suppliers'=>$suppliers,'good' => $good, 'categories' => $categories,'suppliersdetails'=>$suppliersdetails];

        return view('admin.shops.supplement', $data);
    }
	public function update2($id,$q)
    {
		$good = Good::find($id);
		$suppliersdetails = Suppliersdetail::orderBy('id', 'ASC')->where('id', $q);
		$checked=$suppliersdetails->value('checked');
		if($checked==0){
		$suppliersdetails->update([
            'checked'=>'1',
			
        ]);
        }
		else{
			$suppliersdetails->update([
            'checked'=>'0',
			
        ]);
		}
		
        return redirect()->route('admin.shops.supplement',$id);

    }

    public function update1(Request $request, $id)
    {
		

        $good = Good::find($id);
		//$select=$request->select;
		$value=$request->value;
		$suppliersdetails = Suppliersdetail::where('name', $id)->where('checked',1)->get();
		
		foreach($suppliersdetails as $suppliersdetail){
			
		$link=mysqli_connect("localhost:33060","root","root","homestead");
		$sql ="SELECT * FROM suppliersdetail WHERE id='$suppliersdetail->id'";
		$rec = $link->query($sql);	
		$rNum = $rec->num_rows;
		$rs = $rec->fetch_array();
		$S1=$rs['value'];
		
		//$S1=$suppliersdetail->value('value');
		if($value>=$S1){
		$suppliersdetail->update([
		'value' => '0',
		'checked'=>'0'
		]);
		Addstock::create([
            'value' => $S1,
			'supply_id' =>$suppliersdetail->id,
			'good_id' =>$good->id
       
        ]);
		$value=$value-$S1;
		}
		else{
		$suppliersdetail->update([
		'value' => $S1 -$value,
		
		'checked'=>'0'
		]);
		Addstock::create([
            'value' => $value,
			'supply_id' =>$suppliersdetail->id,
			'good_id' =>$good->id
       
        ]);
		break;
		}
		}
		if($request->price>$good->price)
		{
			$good->update([
             'value' => $good->value+$request->value,
			 'stock' => $good->stock-$request->value,
			 'price' => $request->price,
			 'status'=>'正常供貨中'
             
        ]);
		 
			
		}
		else	{
        $good->update([
             'value' => $good->value+$request->value,
			 'stock' => $good->stock-$request->value,
			 'status'=>'正常供貨中'
             
        ]);
		 
	
		}
        return redirect()->route('admin.places.index');
    }
	 public function Search1(Request $request)
    {
        $goodsALL = Good::orderBy('created_at', 'DESC');
		$goods=Good::orderBy('created_at', 'DESC')->get();
        //$maintainces = $maintaincesALL->whereIn('status', array('申請中'))->get();
        //$times = Time_::orderBy('id', 'ASC')->get();
        $Search = $request->input('good_search');
        
        $Search1 = $request->input('supplier_search');
		if(isset($_GET['Search1'])&& isset($_GET['Search'])){
			$i=$_GET['Search1'];
			$ii=$_GET['Search'];
			$suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')
                ->where('supplier_id', $i)->where('name', $ii)
                ->paginate(5);
				$suppliers = Supplier::orderBy('created_at', 'DESC')->get();
				$data = ['suppliers'=>$suppliers,'suppliersdetails' => $suppliersdetails,'goods' => $goods, 'Search' => $Search, 'Search1' => $Search1,'i'=>$i,'ii'=>$ii];
        return view('admin.shops.suppliersdetail', $data);
			
		}
		elseif(isset($_GET['Search1'])&& empty($_GET['Search'])){
			$i=$_GET['Search1'];
			
			$suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')
                ->where('supplier_id', $i)
                ->paginate(5);
				$suppliers = Supplier::orderBy('created_at', 'DESC')->get();
				$data = ['suppliers'=>$suppliers,'suppliersdetails' => $suppliersdetails,'goods' => $goods, 'Search' => $Search, 'Search1' => $Search1,'i'=>$i];
        return view('admin.shops.suppliersdetail', $data);
			
		}
		elseif(empty($_GET['Search1'])&& isset($_GET['Search'])){
			
			$ii=$_GET['Search'];
			$suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')
                ->where('name', $ii)
                ->paginate(5);
				$suppliers = Supplier::orderBy('created_at', 'DESC')->get();
				$data = ['suppliers'=>$suppliers,'suppliersdetails' => $suppliersdetails,'goods' => $goods, 'Search' => $Search, 'Search1' => $Search1,'ii'=>$ii];
        return view('admin.shops.suppliersdetail', $data);
			
		}
		else{
       $suppliers = Supplier::orderBy('created_at', 'DESC')->get();
        if( $Search == "" && $Search1 =="") {

            $suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')
                ->where('id', '0')
                ->paginate(5);
        }
        else if ( $Search1 =="") {

            $suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')
                ->where('name', $Search)
                ->paginate(5);
        } else if ( $Search == "") {
            $suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')
                ->where('supplier_id', $Search1)
                ->paginate(5);
        }
         else
        {

            $suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')
            ->where('supplier_id', $Search1)->where('name', $Search)
            ->paginate(5);
        }

        

        $data = ['suppliers'=>$suppliers,'suppliersdetails' => $suppliersdetails,'goods' => $goods, 'Search' => $Search, 'Search1' => $Search1];
        return view('admin.shops.suppliersdetail', $data);
        }
	}

		

    
	public function SearchALL(Request $request)
    {
		$Search = $request->input('good_search');
        
        $Search1 = $request->input('supplier_search');
	$suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')->paginate(5);
		$suppliers = Supplier::orderBy('created_at', 'DESC')->get();
		$goods=Good::orderBy('created_at','DESC')->get();
		$data = ['goods'=>$goods,'suppliersdetails' => $suppliersdetails ,'suppliers' => $suppliers, 'Search' => $Search, 'Search1' => $Search1];
		
		return view('admin.shops.suppliersdetail', $data);
    }
}




