<?php

namespace App\Http\Controllers;
use App\Good;
use App\Order;
use App\OrdersDetail;
use App\Application;
use App\Place;
//use App\times;
use App\Category;
use App\Maintaince;
use App\MaintainceItem;
use App\User;
use App\Report;
use App\Vendor;
use App\Suppliersdetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Setting;

class MaintaincesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function create($id)
    {
        $place=Place::find($id);
        $category=Category::find($place->category);
        $user=User::find($place->keeper);
        $data = ['place' => $place,'category'=>$category,'user'=>$user];
        return view('admin.places.application', $data);
    }

    public function store(Requests\ApplicationRequest $request,$id)
    {
		
		$user_id=Auth::user()->id;
		
        $place=Place::find($id);
        if($place->status=='正常使用中'){
            $place->maintainces()->create([
                //'vendor_id'=>$place->vendor,
                'status'=>'申請中',
                //'method'=>'未選擇',
                'remark'=>null,
				
				'date'=>Carbon::now(),
				'user_id'=>$user_id
            ]);
            //
			$users=User::orderBy('created_at','DESC')->get();
			/*
		$maintaince=Maintaince::find($id);
		$applications=$maintaince->applications()->get();
		//$applications1=Maintaince::find($maintaince->user_id);
        
		foreach ($applications as $application){
		foreach($users as $user){
        if($application->user_id==$user->id){
			
		//$user1=User::find($application->user_id);
		$user2=$user->name;
		}
		}
		}*/
		
		foreach($users as $user){
        if($user_id==$user->id){
            $user2=$user->name;
		}
		}
            $place->update([
			
			'lendable'=>'0',
            'status'=>'申請中',
			'lendname'=>$user2
            ]);
			
            $maintainces=Maintaince::orderBy('created_at', 'DESC')->first();
            $maintainces->applications()->create([
                'user_id'=>$request->user()->id,
                'problem'=>$request->problem,
				'tool'=>$request->tool,
                'date'=>Carbon::now()
            ]);
			/*
			$place->lendings()->create([
            'user_id'=>$request->user()->id,
            'lenttime'=> Carbon::now(),
			
        ]);
		*/
			/*
            //Mail
            $users=User::where('previlege_id',3)->get();
            $userk=User::find($place->keeper);
            foreach ($users as $user)
            {
                $to = ['email'=>$user->email,
                    'name'=>$user->name];
                $data = [
                    'name'=>$place->name,
                    'location'=>$place->location,
                    'keeper'=>$userk->name,
                    'applications_user'=>Auth::user()->name,
                    'problem'=>$request->problem,
                ];
                Mail::later(1,' admin.mails.application',$data, function($message) use ($to) {
                    $message->to($to['email'], $to['name'])->subject('有新的報修訊息');
                });
            }
			*/
        }
        return redirect()->route('admin.places.index');
    }

    public function index()
    {
		
        $maintainces=Maintaince::orderBy('created_at', 'DESC')->whereNotIn('status',['通過'])->get();
        $maintaincesA=Maintaince::orderBy('created_at', 'DESC')->where('status','申請中')->get();

        $place=Place::orderBy('created_at', 'DESC')->get();

        $applications=Application::orderBy('created_at', 'DESC')->get();
       
		$set_order=Setting::orderBy('updated_at', 'DESC')->value('orders');
		$users=User::orderBy('created_at','DESC')->get();
		$orders = Order::orderBy('created_at','DESC')->get();
		$order_users = Order::where('users_id',Auth::user()->id)->get();
		$order_status1_ = Order::where('status',"未處理")->get();
		$order_status1 = Order::where('status',"未處理")->paginate($set_order,  ['*'],  'page1');
		
		$order_status2_ = Order::whereIn('status',["處理中","已處理"])->get();
		$order_status2 = Order::whereIn('status',["處理中","已處理"])->paginate($set_order,  ['*'],  'page2');
		$order_status3_ = Order::whereIn('status',['已完成','駁回'])->get();
		$order_status3 = Order::whereIn('status',['已完成','駁回'])->paginate($set_order,  ['*'],  'page3');
		$order_status4 = Order::where('status','已出貨')->paginate($set_order,  ['*'],  'page4');
		$order_status4_ = Order::where('status','已出貨')->get();
        $ordersdetail = OrdersDetail::where('users_id',Auth::user()->id)->get();
		//$nowtime=
		foreach($order_status4 as $order){
			$time=((strtotime("now")-strtotime($order->buytime))/ (60*60*24));
			if($time>7){
		    $order->update([
            'status'=>'已完成',
			
        ]);
				
			}
		}
		
		
		$data=['orders'=>$orders,'ordersdetail'=>$ordersdetail,'order_users'=>$order_users,'users'=>$users,'maintainces'=>$maintainces,
            'maintaincesA'=>$maintaincesA,
            'applications'=>$applications,
			'order_status1'=>$order_status1,
			'order_status2'=>$order_status2,
			'order_status3'=>$order_status3,
			'order_status4'=>$order_status4,
			'order_status1_'=>$order_status1_,
			'order_status2_'=>$order_status2_,
			'order_status3_'=>$order_status3_,
			'order_status4_'=>$order_status4_,
		//	'time'=>$time,
			'places'=>$place];
			
        //return view('home',['orders' => $order,'ordersdetails' => $ordersdetail]);
        return view('orders.index', $data);
    }
	 public function index1()
    {
		
        $maintainces=Maintaince::orderBy('created_at', 'DESC')->whereNotIn('status',['通過'])->get();
        $maintaincesA=Maintaince::orderBy('created_at', 'DESC')->where('status','申請中')->get();

        $place=Place::orderBy('created_at', 'DESC')->get();

        $applications=Application::orderBy('created_at', 'DESC')->get();
       
		
		$users=User::orderBy('created_at','DESC')->get();
		$orders = Order::orderBy('created_at','DESC')->get();
		$order_users = Order::where('users_id',Auth::user()->id)->get();
		//$order_status1 = Order::paginate(2)->where('status',"未處理")->get();
		$order_status1 = Order::where('status',"未處理")->paginate(2,  ['*'],  'page1');
		//$order_status2 = Order::where('status',"處理中")->get();
		$order_status2 = Order::where('status',"處理中")->paginate(2,  ['*'],  'page2');
		//$order_status3 = Order::whereIn('status',['已完成','駁回'])->get();
		$order_status3 = Order::whereIn('status',['已完成','駁回'])->paginate(3,  ['*'],  'page3');
		$order_status4 = Order::where('status','已出貨')->paginate(3,  ['*'],  'page4');
        $ordersdetail = OrdersDetail::where('users_id',Auth::user()->id)->get();
		//$nowtime=
		foreach($order_status4 as $order){
			$time=((strtotime("now")-strtotime($order->updated_at))/ (60*60*24));
			if($time>7){
		    $order->update([
            'status'=>'已完成',
			
        ]);
				
			}
		}
		
		
		$data=['orders'=>$orders,'ordersdetail'=>$ordersdetail,'order_users'=>$order_users,'users'=>$users,'maintainces'=>$maintainces,
            'maintaincesA'=>$maintaincesA,
            'applications'=>$applications,
			'order_status1'=>$order_status1,
			'order_status2'=>$order_status2,
			'order_status3'=>$order_status3,
			'order_status4'=>$order_status4,
		//	'time'=>$time,
			'places'=>$place];
			
        //return view('home',['orders' => $order,'ordersdetails' => $ordersdetail]);
        return view('orders.index1', $data);
    }
/*
    public function Search(Request $request)
    {
        $Search =$request->input('Search');
        $place = Place::orderBy('created_at', 'DESC')
            ->where('name', 'like','%'.$Search.'%')
            ->get();
        $category=Category::orderBy('created_at' ,'DESC') ->get();
        $data=['places'=>$place,'categories'=>$category];
        return view('admin.places.index' ,$data);
    }
*/
    public function show($id){
        

        $vip_discount=Setting::where('id','1')->value('vip_discount');
		$price=Setting::where('id','1')->value('prices');	
        $users=User::orderBy('created_at','DESC')->get();
		$order=Order::find($id);
		$vip_total=0;
		$F_times=0;
		$C_times=0;
		$orders = Order::where('users_id',$order->users_id)->get();
		$ordersing=$orders->whereIn('status',["已出貨","已完成","取消","退貨","已取消"]);
		$orders_C =$orders->whereIn('status',["取消","退貨"]);
		$C=count($orders_C);
		$F=count($ordersing)-$C;
		if(count($ordersing)>0){
		$C_times=ceil((count($orders_C)/count($ordersing))*100);
		
		$F_times=100-ceil($C_times);
		}
		$i=count($ordersing);
        $ordersdetail = OrdersDetail::where('orders_id',$id)->get();
		$ordertotal=0;
		foreach($ordersdetail as $order1){
		$ordertotal = $ordertotal+$order1->total;
		}   
		if($order->vip_check==1)
		{
			$vip_total=$ordertotal*$vip_discount/10;
			
		}
		

        $data=['C'=>$C,'F'=>$F,'i'=>$i,'F_times'=>$F_times,'C_times'=>$C_times,'orders_C'=>$orders_C,'orders'=>$orders,'users'=>$users,'order'=>$order,'ordersdetail'=>$ordersdetail,'ordertotal'=>$ordertotal,'vip_total'=>ceil($vip_total),'price'=>$price];
        return view('orders.show', $data);
    }
	public function cancelupdate(Request $request,$id){
		
		$users=User::orderBy('created_at','DESC')->get();
		$order=Order::find($id);
		$orders = Order::where('users_id',$order->users_id)->get();
		$order->update([
                'status'=>'取消審核中',
				'reason1'=> $request->input('cancel'),
				'updated_at'=>Carbon::now(),
            ]);
			
			return redirect()->route('admin.dashboard.index');
		
	}
	 public function show5($id,$users_id){
        

        
		
		$order1=Order::find($id);
		$orders = Order::where('users_id',$users_id)->whereIn('status',["已完成","已處理","已出貨","已取消","退貨"])->get();
 

        $data=['orders'=>$orders,'order1'=>$order1];
        return view('orders.show5', $data);
    }
	 public function show1($id){
        

        $vip_discount=Setting::where('id','1')->value('vip_discount');
		$price=Setting::where('id','1')->value('prices');	
        $users=User::orderBy('created_at','DESC')->get();
		$order=Order::find($id);
		$orders = Order::where('users_id',$order->users_id)->get();
        $ordersdetail = OrdersDetail::where('orders_id',$id)->get();
		$ordertotal=0;
		$vip_total=0;
		foreach($ordersdetail as $order1){
		$ordertotal = $ordertotal+$order1->total;
		}   
		if($order->vip_check==1)
		{
			$vip_total=$ordertotal*$vip_discount/10;
		}

        $data=['orders'=>$orders,'users'=>$users,'order'=>$order,'ordersdetail'=>$ordersdetail,'ordertotal'=>$ordertotal,'vip_total'=>ceil($vip_total),'price'=>$price];
        return view('orders.show1', $data);
    }
	public function show2($id){
         $vip_discount=Setting::where('id','1')->value('vip_discount');
		$price=Setting::where('id','1')->value('prices');	
        $users=User::orderBy('created_at','DESC')->get();
		$order=Order::find($id);
		$orders = Order::where('users_id',$order->users_id)->get();
        $ordersdetail = OrdersDetail::where('orders_id',$id)->get();
		$ordertotal=0;
		$vip_total=0;
		foreach($ordersdetail as $order1){
		$ordertotal = $ordertotal+$order1->total;
		}   
		if($order->vip_check==1)
		{
			$vip_total=$ordertotal*$vip_discount/10;
		}

        $data=['orders'=>$orders,'users'=>$users,'order'=>$order,'ordersdetail'=>$ordersdetail,'ordertotal'=>$ordertotal,'vip_total'=>ceil($vip_total),'price'=>$price];
        return view('orders.ordercancel', $data);
    }
	public function cancelshow($id){
        

        $F_times=0;
		$C_times=0;
        $users=User::orderBy('created_at','DESC')->get();
		$order=Order::find($id);
		$orders = Order::where('users_id',$order->users_id)->get();
		$ordersing=$orders->whereIn('status',["已出貨","已完成","已取消","退貨"]);
		$orders_C =$orders->whereIn('status',["已取消","退貨"]);
		$C=count($orders_C);
		$F=count($ordersing)-$C;
		if(count($ordersing)>0){
		$C_times=ceil((count($orders_C)/count($ordersing))*100);
		$F_times=100-ceil($C_times);
		}
		$i=count($ordersing);
        $ordersdetail = OrdersDetail::where('orders_id',$id)->get();
		$ordertotal=0;
		foreach($ordersdetail as $order1){
		$ordertotal = $ordertotal+$order1->total;
		}   

        $data=['C'=>$C,'F'=>$F,'i'=>$i,'F_times'=>$F_times,'C_times'=>$C_times,'orders_C'=>$orders_C,'orders'=>$orders,'users'=>$users,'order'=>$order,'ordersdetail'=>$ordersdetail,'ordertotal'=>$ordertotal];
        return view('orders.cancelshow', $data);
    }

    public function process(Request $request,$id){
        $order=Order::find($id);
		$ordersdetail = OrdersDetail::where('orders_id',$id)->get();
		$goods = Good::orderBy('created_at', 'DESC')->get();
		$price=Setting::where('id','1')->value('prices');	
		
        $reason = $request->input('reason');
        
        if($request->method=='1'){
				$order->update([
               'status'=>'駁回',
			   'reason'=>$reason,
			   'updated_at'=>Carbon::now(),
            ]);
		}
        elseif($request->method=='0'){
		//for($i=1;$i<=count($ordersdetail);$i++){
		
		foreach($ordersdetail as $order1){
		//while ($row = OrdersDetail::where('orders_id',$id)->first() != null){
		//$good=Good::where('name',$order1->product);
		//$good1=Good::where('name',$order1->product)->get();
		foreach($goods as $good){
		if($good->name==$order1->product)
		{
		//foreach($good as $good2){
		$value1=$good->value-$order1->qty;
		
		$good->update([
                'value' => $value1,
				
            ]);
		//}
		}
		}	
		$supply_cost=Suppliersdetail::where('id',$order1->supply_id)->value('price');
		$report=Report::where('good_id',$order1->product_id);
		$earn=Report::where('good_id',$order1->product_id)->value('earn');
		$trade=Report::where('good_id',$order1->product_id)->value('trade');
		$report->update([
			'earn'=>$earn + ($order1->cost - $supply_cost)*$order1->qty,
			'trade'=>$trade+$order1->qty
			]);
		
		
		}
			$order->update([
                'status'=>'處理中',
				'updated_at'=>Carbon::now(),
				
            ]);
			
        //}
		//OrdersDetail::where('orders_id',$id)->first()->delete();
		//}
		}
        //Mail
		 $total =0;
		 if($order->car_money==0){
        foreach($ordersdetail as $order2){
		$total = $total+$order2->total;
		}
		 }
		 elseif($order->car_money==1){
	foreach($ordersdetail as $order2){
		$total = $total+$order2->total;
		
		}
			 $total =$total+$price;
		 }

if($request->method=='0'){
			$orders123=Order::find($id);
            $user=User::find($orders123->users_id);
            $to = ['email'=>$user->email,
                'name'=>$user->name];
            $data = ['ordersdetail'=>$ordersdetail,
'total'=>$total,'order'=>$order,'price'=>$price];

                
           
            Mail::later(1,' mails.spend',$data, function($message) use ($to) {
                $message->to($to['email'], $to['name'])->subject('購物明細');
            });
}
        

        return redirect()->route('orders.index');
    }
	public function orderback($id,$product_id){
        

        $users=User::orderBy('created_at','DESC')->get();
		$order=Order::find($id);
		$orders = Order::where('users_id',$order->users_id)->get();
        $ordersdetail = OrdersDetail::where('orders_id',$id)->where('product_id',$product_id)->get();
		$ordertotal=0;
		foreach($ordersdetail as $order1){
		$ordertotal = $ordertotal+$order1->total;
		}   

        $data=['orders'=>$orders,'users'=>$users,'order'=>$order,'ordersdetail'=>$ordersdetail,'ordertotal'=>$ordertotal];
      
        return view('orders.orderback', $data);
    }
	public function backindex(){
        
		$orders =Order::all();
        $ordersdetail = OrdersDetail::all();
		
		$users = User::all();

        $data=['orders'=>$orders,'ordersdetail'=>$ordersdetail,'users'=>$users];
      
        return view('orders.backindex', $data);
    }
	public function backshow($id){
        
		$ordersdetail = OrdersDetail::find($id);
        
		$order=Order::where('id',$ordersdetail->orders_id)->first();
		$users=User::orderBy('created_at','DESC')->get();
        
		
		
        $data=['users'=>$users,'order'=>$order,'ordersdetail'=>$ordersdetail];
      
        return view('orders.backshow', $data);
    }
	public function backshowupdate(Request $request,$id){
        
		$ordersdetail = OrdersDetail::find($id);
        
		$order=Order::where('id',$ordersdetail->orders_id)->get();
		$report=Report::where('good_id',$ordersdetail->product_id);
		$earn=Report::where('good_id',$ordersdetail->product_id)->value('earn');
		$users =User::all();
        $vip=User::where('id',$ordersdetail->users_id);
		$vip_level=User::where('id',$ordersdetail->users_id)->value('level');
		
		if($request->method=='0'){
		$ordersdetail->update([
                'status'=>'已退貨'
            ]);
			$report->update([
                'earn'=>$earn-$ordersdetail->total
            ]);
			$vip->update([
                'level'=>$vip_level-$ordersdetail->total
            ]);
			
		}
		elseif($request->method=='1'){
			$ordersdetail->update([
			'status'=>'拒絕退貨',
				'backreason1'=>$request->input('reason')
			 ]);
		}
        $data=['users'=>$users,'order'=>$order,'ordersdetail'=>$ordersdetail];
      
        return redirect()->route('orders.backindex',$id);
    }
	public function orderbackupdate(Request $request,$id,$product_id){
        

        $users=User::orderBy('created_at','DESC')->get();
		$order=Order::find($id);
		$orders = Order::where('users_id',$order->users_id)->get();
        $ordersdetail = OrdersDetail::where('orders_id',$id)->where('product_id',$product_id);
		$ordertotal=0;
		foreach($ordersdetail as $order1){
		$ordertotal = $ordertotal+$order1->total;
		}   
		
		$ordersdetail->update([
                'status'=>'退貨中',
				'backreason'=>$request->input('reason')
				
            ]);
        $data=['orders'=>$orders,'users'=>$users,'order'=>$order,'ordersdetail'=>$ordersdetail,'ordertotal'=>$ordertotal];
      
        return redirect()->route('orders.show1',$id);
    }
	 public function scrapped($id)
    {

        $order=Order::find($id);
        $order->update([
            'status'=>'已出貨',
			'updated_at'=>Carbon::now(),
			'buytime'=>Carbon::now()->toDateString(),
			
        ]);
		
        return redirect()->route('orders.index');
    }
	 public function cancel(Request $request,$id)
    {
    if($request->method=='0'){
        $order=Order::find($id);
        $order->update([
            'status'=>'已取消',
			'updated_at'=>Carbon::now(),
			
        ]);
    }
	else{
		 $order=Order::find($id);
        $order->update([
            'status'=>'已處理',
			'updated_at'=>Carbon::now(),
			'reason'=>$request->reason,
			
			
        ]);
	}
        return redirect()->route('admin.dashboard.mis');
    }


    public function complete(Request $request,$id){
        $maintaince=Maintaince::find($id);
        $place=Place::find($maintaince->place_id);
        /*$maintaince->update([
            'status'=>'已完成維修',
            'date'=>Carbon::now()
        ]);*/
        $place->update([
            'status'=>'正常使用中'
        ]);
		/*
        //Mail
        foreach ($maintaince->applications()->get() as $application){
            $user=User::find($application->user_id);
            $to = ['email'=>$user->email,
                'name'=>$user->name];
            $data = [
                'name'=>$place->name,
                'date'=>Carbon::now(),
            ];
            Mail::later(1,' admin.mails.complete',$data, function($message) use ($to) {
                $message->to($to['email'], $to['name'])->subject('報修的資產已完成維修');
            });
        }


        $maintainceitems=$maintaince->maintainceitems()->get();
            $to = ['email'=>'moneyyinsh001@gmail.com',
                'name'=>'shark'];
            $data = ['maintainceitems'=>$maintainceitems,
                'name'=>$place->name,
                'location'=>$place->location,
                'total'=>$maintainceitems->sum('amount'),
            ];
            Mail::later(1,' admin.mails.spend',$data, function($message) use ($to) {
                $message->to($to['email'], $to['name'])->subject('報修明細');
            });
*/

        return redirect()->route('admin.maintainces.index');
    }
	
 public function destroy($id)
    {
		/*
		$maintainces=Maintaince::find($id);
		//$maintaince=Maintaince::select('id')->where('id',$id)->get();
		//$maintainces=Maintaince::orderBy('created_at', 'DESC')->get();
		//$applications=Application::find($maintaince->maintaince_id);
		$applications=Application::orderBy('created_at', 'DESC')->get();
		//$applications1=$applications->select('id')->where('maintaince_id',$id)->get();
		//$applications=$maintaince->applications()->get();
		//foreach($maintainces as $maintaince){
		foreach ($applications as $application){
		
        if($application->maintaince_id==$maintainces->id){
			
		
		$applicationA=$application->id;
		
		}
		//}
		}
		$place=Place::find($maintainces->place_id);
		/*
		$place->update([
                'status'=>'正常使用中',
				'lendable'=>'1',
				'lendname'=>NULL
            ]);
			*/
		//->where('maintaince_id', '==','7')
		//DB::table('applications')->where('maintaince_id', '==','7')->delete();
		//Application::destroy($applicationA);
		Order::destroy($id);
		
		
        return redirect()->route('admin.dashboard.user');
    }

    public function mail($id){

        $maintaince=Maintaince::find($id);
        $application=$maintaince->applications()->get();
        $place=Place::find($maintaince->place_id);
        $users=User::orderBy('created_at','DESC')->get();

        foreach ($users as $user)
        {
            $to = ['email'=>$user->email,
                'name'=>$user->name];
            $data = ['status'=>$place->status,
            ];
            Mail::later(10,' admin.mails.test01',$data, function($message) use ($to) {
                $message->to($to['email'], $to['name'])->subject('測試信件');
            });
        }

/*
        //從表單取得資料
        $from = ['email'=>$request['email'],
            'name'=>$request['name'],
            'subject'=>$request['subject']
        ];

        //填寫收信人信箱
        $to = ['email'=>$user->email,
            'name'=>$user->name];
        //信件的內容(即表單填寫的資料)
        $data = ['status'=>$place->status,
        ];
        //寄出信件
        Mail::raw(' 資產狀態變更成'.$place->status.' ！', function($message) use ($to) {
            //$message->from($from['email'], $from['name']);
            $message->to($to['email'], $to['name'])->subject('測試信件');
        });

        */
        return redirect()->route('admin.maintainces.show',$id);
    }





}
