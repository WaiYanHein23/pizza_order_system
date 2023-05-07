<?php

namespace App\Http\Controllers\User;

use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizza=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
     //direct user list page
     public function userList(){
        $users=User::where('role','user')->get();
        return view('admin.user.list',compact('users'));
    }
    //change user role
    public function userChangeRole(Request $request){
      $updateSource=[
        'role'=>$request->role
      ];
      User::where('id',$request->userId)->update($updateSource);
    }
    //change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user=User::select('password')->where('id',Auth::user()->id)->first();
       $dbHashvalue=$user->password;
       if(Hash::check($request->oldPassword,$dbHashvalue)){
        $data=[
            'password'=>Hash::make($request->newPassword)
        ];
        User::where('id',Auth::user()->id)->update($data);
        Auth::logout();
        return redirect()->route('auth#loginPage');
       }
       return back()->with(['notMatch'=>'Old Password not Match !Try Again..']);
    }
    //user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }
    //filter pizza
    public function filter($categoryId){
        $pizza=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //user change page
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data=$this->getUserData($request);
        //for image
        if($request->hasFile('image')){
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;
            if($dbImage!=null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Admin Acount Updated..']);
    }

    //direct pizza details
    public function pizzaDetails($pizzaId){
        $pizza=Product::where('id',$pizzaId)->first();
        $pizzaList=Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }
    //cart list
    public function cartList(){
        $cartList=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                        ->leftJoin('products','products.id','carts.product_id')
                       ->where('carts.user_id',Auth::user()->id)
                       ->get();
        $totalPrice=0;
        foreach($cartList as $c){
            $totalPrice +=$c->pizza_price * $c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }
    //request user data
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'updated_at'=>Carbon::now()
        ];
    }
    //direct history page
    public function history(){
        $order=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('6');
        return view('user.main.history',compact('order'));
    }
    //acountValidation Check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'gender'=>'required',
            'phone'=>'required',
            'image'=>'mimes:jng,jpg,jpeg,webp|file',
            'address'=>'required',

        ])->validate();
    }
    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|same:newPassword'
        ])->validate();
    }
}
