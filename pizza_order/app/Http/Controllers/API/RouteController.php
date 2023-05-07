<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products=Product::get();
        $users=User::get();
        $data=[
            'product'=>$products,
            'user'=>$users
        ];
        return response()->json($data,200);
    }

    //get all category list
    public function categoryList(){
        $category=Category::get();
        return response()->json($category,200);

    }

    //Create Category
    public function categoryCreate(Request $request){
       $data=[
        'name'=>$request->name,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
       ];
$response=Category::create($data);
return response()->json($response,200);

    }

    //Delete Category
    public function deleteCategory($id){
        $data=Category::where('id',$id)->first();
        if(isset($data)){
           Category::where('id',$id)->delete();
            return response()->json(['status'=>'true','message'=>'delete success'],200);

        }
        return response()->json(['status'=>'false','message'=>'There is no Category'],200);


    }
    //Category Details
    public function categoryDetails($id){
      return $id;
    }

    //Update Data
    public function categoryUpdate(Request $request){
        $categoryId=$request->category_id;
        $dbSource=Category::where('id',$categoryId)->first();
      if(isset($dbSource)){
        $data=$this->getCategoryData($request);
        $response=Category::where('id',$categoryId)->first();
        return response()->json(['status'=>'true','message'=>'category update success','category'=>$response],200);

      }
      return response()->json(['status'=>'false','message'=>'There is no Category for update'],200);

    }
    //Create Contact
    public function createContact(Request $request){
      $data=$this->getContactData($request);
      Contact::create($data);
      $contact=Contact::orderBy('created_at','desc')->get();
      return response()->json($contact,200);
    }
    //Get Content Data
    private function getContactData($request){
        return[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->description,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
    //Get Category Data
    private function getCategoryData($request){
        return[
            'name'=>$request->category_name,
            'updated_at'=>Carbon::now()
        ];
    }

    }

