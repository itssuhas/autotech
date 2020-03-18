<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\User;

class CommonController extends Controller
{
    protected $guard = 'user';

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showLogin', 'doLogin']]);
    }

    public function showLogin()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {

        $rules = array(
            'username' => 'required', 
            'password' => 'required' 
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('/')
                ->withErrors($validator)
                ->withInput($request->except('password')); 
        } else {
           $userdata = array(
                'mob' => $request->input('username'),
                'password' => $request->input('password'),
            );
            if (Auth::attempt($userdata, true)) {
                $data = Array('type' => 'success', 'message' => 'Login Successful');
                Session::put('alert', $data);

                if (Auth::user()->user_type == 'ADMIN' || Auth::user()->user_type == 'SUPPLIER'|| Auth::user()->user_type == 'INSPECTOR' ||Auth::user()->user_type == 'APPROVER') {
                    return redirect('/dashboard');
                }
             else {
                    $data = Array('type' => 'failure', 'message' => '<span class="text-semibold">Oops!</span> You are not allowed to login here.');
                    Session::put('alert', $data);
                    return redirect("/");
                }
            } else {
                $data = Array('type' => 'failure', 'message' => '<span class="text-semibold">Oops!</span> The username or password you\'ve entered is wrong.');
                Session::put('alert', $data);
                return redirect("/");
            }
        }
    }

    public function master()
    {

        return ([]);
    }

    public function dashboard()
    {
        $data = $this->master();
            
        return view('index', ['data' => $data]);
    }

    public function getSignOutadmin()
    {
        Auth::logout();
        $data = Array('type' => 'success', 'message' => 'You have logged out successfully,login again to continue');
        Session::put('alert', $data);
        return redirect("/");

    }
    public function passwordindex()
    {
        $id = Auth::user()->id;
        $pack=DB::table('users')->where('id', '=', $id)->get();
        $data = $this->master();

        return view('changePassword', ['pack' => $pack,'data' => $data]);
    } 


 public function store(Request $request)
 {
    $request->validate([
        'current_password' => ['required', new MatchOldPassword],
        'new_password' => ['required'],
        'name' => ['required'],
        'mob' => ['required'],
        'address' => ['required'],
        'image'=> ['required'],
        'new_confirm_password' => ['same:new_password'],
    ]);

    $id = Auth::user()->id;
    $admin=DB::table('users')->where('id','=',$id);
    $admin =Hash::make($request->get('new_password'));

                    if(Input::file('image'))
                    {
                        $file=Input::file('image');

                        $file->move('dist/img/',$file->getClientOriginalName());
                       
                        $filename = $file->getClientOriginalName();
                    
                    }

    DB::table('users')->where('id','=',$id)->update(['name'=>$request->get('name'),'mob'=>$request->get('mob'),'image'=>$filename,'address'=>$request->get('address'),'password'=> Hash::make($request->get('new_password'))]);

        $data = Array('type' => 'success', 'message' => 'Password Changed Successfully');
        Session::put('alert', $data);
        return redirect('dashboard');

}


    public function SupplierDeatils()
    {
        if (isset($_GET['text'])) {

            $text = $_GET['text'];
            
            $supplier = DB::table('users')
                ->select('id','name','mob','gmail','address')
                ->orWhere('name', 'like', '%' . $text . '%')
                ->where('user_type','=','SUPPLIER')
                ->paginate(10);
            $retailer->appends(array(
                'text' => $text,
            ));
        } else {

            $supplier = DB::table('users')
                ->select('id','name','mob','gmail','address')
                ->where('user_type','=','SUPPLIER')
                ->get();
        }

        $data = $this->master();
        return view('supplier', ['supplier' => $supplier,'data' => $data]);
    }

    public function supplierSubmit(Request $request)
    {
        $rules = array(

            'name'=> 'required',
            'mob'=>'required',
            'gmail'=> 'required',
            'address'=>'required',
            'password'=>'required',

        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/supplier_deatils')
                ->withErrors($validator)
                ->with('errorModal', 'retailerRegistration')
                ->withInput($request->except('password'));  
        } else {

            try {

                $retailerdata = DB::table('users')->count();

                if ($retailerdata < 1000) {

                     $name = $request->input("name");
                     $mob = $request->input("mob");
                     $gmail = $request->input("gmail");
                     $address = $request->input("address");
                     $password = $request->input("password");
                     $user_type = 'SUPPLIER'; 
                    $id = DB::table('users')->insertGetId(
                        ['name'=>$name,'mob'=>$mob,'gmail'=>$gmail,'address'=>$address,'password'=>Hash::make($password),'user_type'=>$user_type]
                    ); 
                    $data = Array('type' => 'success', 'message' => 'Supplier Added Successfully');
                    DB::commit();
                } else {
                    DB::rollback();
                    $data = Array('type' => 'error', 'message' => 'Supplier Exceed Limit');
                }
            } catch (QueryException $e) {
                DB::rollback();
                if ($e->errorInfo[1] == 1062) {
                    $data = Array('type' => 'error', 'message' => 'Duplicate entry for Mobile Number');
                } else {
                    $data = Array('type' => 'error', 'message' => 'Error! Something went wrong...');
                }
            }
            Session::put('alert', $data);
            return redirect('/supplier_deatils');
        }
    }

    public function Supplierdelete($id) 
    {
      
      $select=DB::delete('delete from users where id = ?',[$id]);
     
            return redirect('/supplier_deatils');
    }

    public function getSuppliers($id)
    {

         $pack=DB::table('users')->where('id', '=', $id)->get();

         $data = $this->master();

        return view('updatesupplier', ['pack' => $pack,'data' => $data]);
    }

    public function SupplierUpdateSubmit(Request $request)
    {
        $rules = array(
            
            'name'=> 'required',
            'mob'=>'required',
            'gmail'=> 'required',
            'address'=>'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/supplier_deatils')
                ->withErrors($validator)
                ->with('errorModal', 'retailerRegistration')
                ->withInput($request->except('password'));  
        } else {

            try {
                
                $retailerdata = DB::table('users')->count();
                if ($retailerdata < 1000) {

                    $id = $request->input("id");
                     $name = $request->input("name");
                     $mob = $request->input("mob");
                     $gmail = $request->input("gmail");
                     $address = $request->input("address");

                    $id = DB::table('users')
                            ->where('id','=',$id)
                            ->update(['name' => $name,'mob'=>$mob,'gmail'=>$gmail,'address'=>$address]
                    ); 

                    $data = Array('type' => 'success', 'message' => 'Supplier Updated Successfully');
                    DB::commit();
                } else {
                    DB::rollback();
                    $data = Array('type' => 'error', 'message' => 'Supplier Registration Exceed Limit');
                }
            } catch (QueryException $e) {
                DB::rollback();
                if ($e->errorInfo[1] == 1062) {
                    $data = Array('type' => 'error', 'message' => 'Duplicate entry for Mobile Number');
                } else {
                    $data = Array('type' => 'error', 'message' => 'Error! Something went wrong...');
                }
            }
            Session::put('alert', $data);
            return redirect('/supplier_deatils');
        }
    }

    public function InspectorDeatils()
    {
        if (isset($_GET['text'])) {

            $text = $_GET['text'];
            
            $supplier = DB::table('users')
                ->select('id','name','mob','gmail','address')
                ->orWhere('name', 'like', '%' . $text . '%')
                ->where('user_type','=','INSPECTOR')
                ->paginate(10);
            $retailer->appends(array(
                'text' => $text,
            ));
        } else {

            $supplier = DB::table('users')
                ->select('id','name','mob','gmail','address')
                ->where('user_type','=','INSPECTOR')
                ->get();
        }

        $data = $this->master();
        return view('inspector', ['supplier' => $supplier,'data' => $data]);
    }

    public function inspectorSubmit(Request $request)
    {
        $rules = array(

            'name'=> 'required',
            'mob'=>'required',
            'gmail'=> 'required',
            'address'=>'required',
            'password'=>'required',

        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/inspector_deatils')
                ->withErrors($validator)
                ->with('errorModal', 'retailerRegistration')
                ->withInput($request->except('password'));  
        } else {

            try {

                $retailerdata = DB::table('users')->count();

                if ($retailerdata < 1000) {

                     $name = $request->input("name");
                     $mob = $request->input("mob");
                     $gmail = $request->input("gmail");
                     $address = $request->input("address");
                     $password = $request->input("password");
                     $user_type = 'INSPECTOR'; 
                    $id = DB::table('users')->insertGetId(
                        ['name'=>$name,'mob'=>$mob,'gmail'=>$gmail,'address'=>$address,'password'=>Hash::make($password),'user_type'=>$user_type]
                    ); 
                    $data = Array('type' => 'success', 'message' => 'Inspector Added Successfully');
                    DB::commit();
                } else {
                    DB::rollback();
                    $data = Array('type' => 'error', 'message' => 'Inspector Exceed Limit');
                }
            } catch (QueryException $e) {
                DB::rollback();
                if ($e->errorInfo[1] == 1062) {
                    $data = Array('type' => 'error', 'message' => 'Duplicate entry for Mobile Number');
                } else {
                    $data = Array('type' => 'error', 'message' => 'Error! Something went wrong...');
                }
            }
            Session::put('alert', $data);
            return redirect('/inspector_deatils');
        }
    }

    public function Inspectordelete($id) 
    {
      
      $select=DB::delete('delete from users where id = ?',[$id]);
     
        return redirect('/inspector_deatils');
    }

    public function getInspector($id)
    {

         $pack=DB::table('users')->where('id', '=', $id)->get();

         $data = $this->master();

        return view('updateinspector', ['pack' => $pack,'data' => $data]);
    }

    public function InspectorUpdateSubmit(Request $request)
    {
        $rules = array(
            
            'name'=> 'required',
            'mob'=>'required',
            'gmail'=> 'required',
            'address'=>'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/inspector_deatils')
                ->withErrors($validator)
                ->with('errorModal', 'retailerRegistration')
                ->withInput($request->except('password'));  
        } else {

            try {
                
                $retailerdata = DB::table('users')->count();
                if ($retailerdata < 1000) {

                    $id = $request->input("id");
                     $name = $request->input("name");
                     $mob = $request->input("mob");
                     $gmail = $request->input("gmail");
                     $address = $request->input("address");

                    $id = DB::table('users')
                            ->where('id','=',$id)
                            ->update(['name' => $name,'mob'=>$mob,'gmail'=>$gmail,'address'=>$address]
                    ); 

                    $data = Array('type' => 'success', 'message' => 'Inspector Updated Successfully');
                    DB::commit();
                } else {
                    DB::rollback();
                    $data = Array('type' => 'error', 'message' => 'Supplier Registration Exceed Limit');
                }
            } catch (QueryException $e) {
                DB::rollback();
                if ($e->errorInfo[1] == 1062) {
                    $data = Array('type' => 'error', 'message' => 'Duplicate entry for Mobile Number');
                } else {
                    $data = Array('type' => 'error', 'message' => 'Error! Something went wrong...');
                }
            }
            Session::put('alert', $data);
            return redirect('/inspector_deatils');
        }
    }

    public function ApproverDeatils()
    {
        if (isset($_GET['text'])) {

            $text = $_GET['text'];
            
            $supplier = DB::table('users')
                ->select('id','name','mob','gmail','address')
                ->orWhere('name', 'like', '%' . $text . '%')
                ->where('user_type','=','APPROVER')
                ->paginate(10);
            $retailer->appends(array(
                'text' => $text,
            ));
        } else {

            $supplier = DB::table('users')
                ->select('id','name','mob','gmail','address')
                ->where('user_type','=','APPROVER')
                ->get();
        }

        $data = $this->master();
        return view('approver', ['supplier' => $supplier,'data' => $data]);
    }

    public function approverSubmit(Request $request)
    {
        $rules = array(

            'name'=> 'required',
            'mob'=>'required',
            'gmail'=> 'required',
            'address'=>'required',
            'password'=>'required',

        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/approver_deatils')
                ->withErrors($validator)
                ->with('errorModal', 'retailerRegistration')
                ->withInput($request->except('password'));  
        } else {

            try {

                $retailerdata = DB::table('users')->count();

                if ($retailerdata < 1000) {

                     $name = $request->input("name");
                     $mob = $request->input("mob");
                     $gmail = $request->input("gmail");
                     $address = $request->input("address");
                     $password = $request->input("password");
                     $user_type = 'APPROVER'; 
                    $id = DB::table('users')->insertGetId(
                        ['name'=>$name,'mob'=>$mob,'gmail'=>$gmail,'address'=>$address,'password'=>Hash::make($password),'user_type'=>$user_type]
                    ); 
                    $data = Array('type' => 'success', 'message' => 'Approver Added Successfully');
                    DB::commit();
                } else {
                    DB::rollback();
                    $data = Array('type' => 'error', 'message' => 'Approver Exceed Limit');
                }
            } catch (QueryException $e) {
                DB::rollback();
                if ($e->errorInfo[1] == 1062) {
                    $data = Array('type' => 'error', 'message' => 'Duplicate entry for Mobile Number');
                } else {
                    $data = Array('type' => 'error', 'message' => 'Error! Something went wrong...');
                }
            }
            Session::put('alert', $data);
            return redirect('/approver_deatils');
        }
    }

    public function Approverdelete($id) 
    {
      
      $select=DB::delete('delete from users where id = ?',[$id]);
     
        return redirect('/approver_deatils');
    }

    public function getApporver($id)
    {

         $pack=DB::table('users')->where('id', '=', $id)->get();

         $data = $this->master();

        return view('updateapprover', ['pack' => $pack,'data' => $data]);
    }

    public function ApproverUpdateSubmit(Request $request)
    {
        $rules = array(
            
            'name'=> 'required',
            'mob'=>'required',
            'gmail'=> 'required',
            'address'=>'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('/approver_deatils')
                ->withErrors($validator)
                ->with('errorModal', 'retailerRegistration')
                ->withInput($request->except('password'));  
        } else {

            try {
                
                $retailerdata = DB::table('users')->count();
                if ($retailerdata < 1000) {

                    $id = $request->input("id");
                     $name = $request->input("name");
                     $mob = $request->input("mob");
                     $gmail = $request->input("gmail");
                     $address = $request->input("address");

                    $id = DB::table('users')
                            ->where('id','=',$id)
                            ->update(['name' => $name,'mob'=>$mob,'gmail'=>$gmail,'address'=>$address]
                    ); 

                    $data = Array('type' => 'success', 'message' => 'Inspector Updated Successfully');
                    DB::commit();
                } else {
                    DB::rollback();
                    $data = Array('type' => 'error', 'message' => 'Supplier Registration Exceed Limit');
                }
            } catch (QueryException $e) {
                DB::rollback();
                if ($e->errorInfo[1] == 1062) {
                    $data = Array('type' => 'error', 'message' => 'Duplicate entry for Mobile Number');
                } else {
                    $data = Array('type' => 'error', 'message' => 'Error! Something went wrong...');
                }
            }
            Session::put('alert', $data);
            return redirect('/approver_deatils');
        }
    }
}


