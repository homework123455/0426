<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Good;
use App\Suppliersdetail;
use App\Http\Requests;
use App\Http\Requests\SupplierRequest;
class SuppilerController extends Controller
{
   public function index()
    {
		
		$supplier = Supplier::orderBy('created_at', 'DESC')->paginate(2);
		$suppliersdetails = Suppliersdetail::orderBy('created_at', 'DESC')->get();
		$good = Good::all();
		$i=0;
		$a="";
		
		
		$data = ['suppliers'=>$supplier,'goods'=>$good,'i'=>$i,'a'=>$a,'suppliersdetails'=>$suppliersdetails];
        return view('admin.suppliers.index', $data);
    }
	public function create()
	{
		$supplier = Supplier::orderBy('created_at', 'DESC')->get();
		
		$data = ['suppliers' => $supplier ];
		
		return view('admin.suppliers.create', $data);
	}
	public function edit($id)
	{
		$supplier = Supplier::find($id);
		
		$data = ['suppliers' => $supplier ];
		
		return view('admin.suppliers.edit', $data);
	}
	 public function scrapped($id)
    {

        $supplier=Supplier::find($id);
        $supplier->update([
            'status'=>'配合中',
			
			
        ]);
		
        return redirect()->route('admin.suppliers.index');
    }
	 public function scrapped1($id)
    {

        $supplier=Supplier::find($id);
        $supplier->update([
            'status'=>'已終止',

        ]);
		
        return redirect()->route('admin.suppliers.index');
    }
	public function store(SupplierRequest $request)
    {
		$supplier = Supplier::orderBy('created_at', 'DESC')->get();
        $Suppliers = Supplier::where('name',$request->name )->get();
		$msg="";
		if(count($Suppliers)<=0){
        Supplier::create([
            'name' => $request->name,
			'phone'=> $request->phone,
			'address'=>$request->address
            ]);
			$msg="成功新增供應商:".$request->name;
			return redirect()->route('admin.suppliers.index')->with('alert', "成功新增供應商:".$request->name);
			}
			else{
			$msg="供應商:".$request->name."已存在!";
			 $data = ['msg'=>$msg,'suppliers' => $supplier];
		
          return view('admin.suppliers.create', $data);
			}
		
        //return redirect()->route('admin.categories.index');
    }
	public function update(SupplierRequest $request,$id)
    {
		$supplier = Supplier::find($id);
      
		
        $supplier->update([
            'name' => $request->name,
			'phone'=> $request->phone,
			'address'=>$request->address
            ]);
			$msg="成功修改供應商:".$request->name;
			
			return redirect()->route('admin.suppliers.index')->with('alert', "成功修改供應商:".$request->name);
			
		
        //return redirect()->route('admin.categories.index');
    }
	 public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect()->route('admin.suppliers.index');
    }
}
