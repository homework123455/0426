<?php

namespace App\Http\Controllers;
use App\Application;
use App\Department;
use App\Previlege;
use App\User;
use App\Wrong;
use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use App\Http\Requests\WrongRequest;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Hash;


class UsersController extends Controller
{
	/*
    public function __construct()
    {
        $this->middleware('auth');
    }
	*/
    //
    public function index()
    {
        $users=User::orderBy('created_at', 'DESC')->get();
        $previleges=Previlege::orderBy('created_at','DESC')->get();
        $departments=Department::orderBy('created_at','DESC')->get();
        $data=['users'=>$users,'previleges'=>$previleges,'departments'=>$departments];
        return view('admin.users.index', $data);
    }

    public function create()
    {
        $previleges=Previlege::orderBy('created_at','DESC')->get();
        $departments=Department::orderBy('created_at','DESC')->get();
        $data=['previleges'=>$previleges,'departments'=>$departments];
        return view('admin.users.create',$data);
    }

    public function edit($id)
    {
        $user=User::find($id);
        $previleges=Previlege::orderBy('created_at','DESC')->get();
        $departments=Department::orderBy('created_at','DESC')->get();
        $data = ['user'=>$user,'previleges'=>$previleges,'departments'=>$departments];
        return view('admin.users.edit', $data);
    }



    public function update(Request $request, $id)
    {

        $user=User::find($id);
        $user->update($request->all());

        return redirect()->route('admin.users.index');
    }

    public function store(userRequest $request)
    {
        /*$department_id = $request->input('department_id');
         $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'department_id'=>'required',
            'previlege_id'=>'required'
        ]);*/
        User::create($request->all());
        $request->password=bcrypt($request->password);
        $user=User::orderBy('created_at', 'DESC')->first();
        $user->update([
            'password'=>bcrypt($user->password),
			'check'=>1

        ]);

        return redirect()->route('admin.users.index');
    }
    public function destroy($id)
    {
		$applications=Application::orderBy('created_at', 'DESC')->get();
		//$applications1=Application::orderBy('created_at', 'DESC')->get();
		$wrongs=Wrong::orderBy('id','ASC')->get();
		foreach($wrongs as $wrong)
		{
		if($wrong->user_id==$id)
		{
			$wrong_id=$wrong->id;
			Wrong::destroy($wrong_id);
		}
		}
		foreach($applications as $application)
		{
		if($application->user_id==$id)
		{
			$application_id=$application->id;
			Application::destroy($application_id);
		}
		}
		
		//Wrong::destroy($wrong_id);
		
        User::destroy($id);
        return redirect()->route('admin.users.index');
    }

    public function data($id)
    {
        $user=User::find($id);
        $previlege=Previlege::find($user->previlege_id);
        $departments=Department::orderBy('created_at','DESC')->get(); 
        $data = ['user'=>$user,'previlege'=>$previlege,'departments'=>$departments];
        return view('admin.users.show', $data);
    }

    public function Search(Request $request)
    {
		$previleges=Previlege::orderBy('created_at','DESC')->get();
        $departments=Department::orderBy('created_at','DESC')->get();
        $Search =$request->input('Search');
        $users = User::orderBy('created_at', 'DESC')
            ->where('name', 'like','%'.$Search.'%')
            ->get();
        $data=['users'=>$users,'previleges'=>$previleges,'departments'=>$departments];
        return view('admin.users.index' ,$data);
    }
    public function wrongdata($id)
    {
        $user=User::find($id);
        $wrong=Wrong::orderBy('id','ASC')->get();
        $data = ['user'=>$user,'wrong'=>$wrong];
        return view('admin.users.showwrong', $data);
    }
    public function wrongcreate($id)
    {
        $user=User::find($id);

        $data=['user'=>$user];
        return view('admin.users.wrongcreate',$data);
    }
    public function wrongstore(WrongRequest $request,$id)
    {
        $user=User::find($id);
        $wrong=Wrong::orderBy('id','ASC')->get();
        $data = ['user'=>$user,'wrong'=>$wrong];
        Wrong::create([
            'user_id'=>$id,
            'wrongname'=>$request->wrongname,
            'date'=>$request->date
        ]);
        return redirect()->route('admin.users.showwrong', $data);
    }
	public function destroy1($id,$wid)
    {
		
		$user=User::find($id);
        $wrong=Wrong::orderBy('id','ASC')->get();
        $data = ['user'=>$user,'wrong'=>$wrong];
        Wrong::destroy($wid);
		
        return redirect()->route('admin.users.showwrong', $data);
    }
	public function wrongedit($id,$wid)
    {
        $user=User::find($id);
		$wid=Wrong::find($wid);
        $wrong=Wrong::orderBy('id','ASC')->get();
        $data = ['user'=>$user,'wrong'=>$wrong,'wid'=>$wid];
        return view('admin.users.wrongedit', $data);
    }



    public function update1(Request $request,$id,$wid)
    {

        $user=User::find($id);
        $wrong=Wrong::find($wid);
        $data = ['user'=>$user,'wrong'=>$wrong];
        $wrong->update($request->all());

        return redirect()->route('admin.users.showwrong', $data);
    }
	public function checkupdate($id)
    {
  $check =User::where('id',$id);
  $check->update(['check'=>1]);
 
        return redirect()->route('check');

}
	public function checkindex()
    {

        return view('check');

}
	public function editpassword($id)
    {
        $user=User::find($id);
        $data = ['user'=>$user,];
        return view('admin.users.editpassword', $data);
    }
	public function updatepassword(Request $request,$id)
    {

       $user=User::find($id);
       $oldpassword=$request->oldpassword;
	   $newpassword=$request->newpassword;
	   $newpasswordcheck=$request->newpasswordcheck;
        $data = ['user'=>$user,];
		if($newpassword!=null&&$newpasswordcheck!=null&&$oldpassword!=null){
			if(Hash::check($oldpassword,$user->password))
			{
			if($newpassword==$newpasswordcheck)
			{
			$user->update(['password'=>bcrypt($newpassword)]);
			return redirect()->route('admin.dashboard.index')->with('alert', '更新成功');
			}
			else{
			return redirect()->route('admin.users.editpassword',$id)->with('alert', '兩次密碼不相同');
			}
		}
		else{
			return redirect()->route('admin.users.editpassword',$id)->with('alert', '原始密碼錯誤');
			}
		}
		else{
			return redirect()->route('admin.users.editpassword',$id)->with('alert', '欄位不可為空');
		}

    }
  public function checkmail()
    {

        return view('checkmail');

}
  
	
}