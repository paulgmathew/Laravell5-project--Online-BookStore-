<?php

namespace App\Http\Controllers;
use \Illuminate\Http\Request;
use App\books;
use App\Items;
use App\User;
use Session;
use App\Category;
use \Illuminate\Support\Facades\Auth;
use DB;
use DateTime;

class NiceActionController extends Controller
{
  
    public function getHome()
    {
       // if(!Auth::check())
//        {
 //           return redirect()->back();
  //      }
        $category = Category::all();
       $books= DB::table('books')->where('book_status', 1)->get();
      //  $books = books::all();
        $items =DB::table('items')->where('item_status', 1)->paginate(5);
        
        
        $actions = DB::table('items')
                            ->leftJoin('books','items.books_id','=','books.id')
                            ->where('items.item_status', 1)->select('items.id as items_id', 'items.created_at as items_created_at', 'items.updated_at as items_updated_at','items.*',  'books.*')->paginate(10);
             //return view('management.test', ['vehicleString'=>$actions]);
             return view('home',['items' => $actions,'category'=>$category]);
       // return view('home',['books' => $books,'items' => $items,'category'=>$category]);
    }
     public function getHome2()
    {
        $category = Category::all();
      $books= DB::table('books')->where('book_status', 1)->get();
          $items =DB::table('items')->where('item_status', 1)->paginate(5);
          $actions = DB::table('items')
                            ->leftJoin('books','items.books_id','=','books.id')
                            ->where('items.item_status', 1)->select('items.id as items_id', 'items.created_at as items_created_at', 'items.updated_at as items_updated_at','items.*',  'books.*')->paginate(10);
             //return view('management.test', ['vehicleString'=>$actions]);
             return view('home',['items' => $actions,'category'=>$category]);
       // return view('home',['books' => $books,'items' => $items,'category'=>$category]);
    }
  
  
   
    
    
    public function postNiceAction(Request $request)
    {
   /*       if(isset($request['username']))
    {
        if(strlen($request['username'])> 0 ){
            $username = $request['username'];
             return view('home',['username' => $request['username'] ]);
        }
        return redirect()->back();
        
    }
     return redirect()->back();
        */
         $books = books::all();
       // return view('home',['books' => $books]);
         $items = Items::all();
         $category = Category::all();
        $this ->validate($request,['username' => 'required',
        'password' => 'required']);
        
        $it = DB::table('books')
         ->leftJoin('items','books.id','=','items.books_id')
         ->leftJoin('categories','categories.id','=','books.category')
        ->where('books.status',1)
         ->select('items.id as item_id','categories.category_name as category_name','items.quantity as quantity','items.type as type','items.price as price','books.bookname as bookname','books.id as book_id','books.author_name as author_name','books.category as category','books.publisher as publisher','books.pages as pages','books.version as version','books.titleimage as titleimage','books.publish_date as publish_date','books.description as description' )
         ->get();
         return view('home',['username' => $request['username'],'books' =>$books,'items' => $items,'category'=>$category,'it'=>$it]);
         
         //  $item = DB::table('items')
       //  ->join('books','books.id','=','items.books_id')
        // ->where('books.status',1)
         //->select('items.id as item_id','items.quantity as quantity','items.type as type','items.price as price','books.bookname as bookname','books.id as book_id','books.author_name as author_name','books.category as category','books.publisher as publisher','books.pages as pages','books.version as version','books.titleimage as titleimage','books.publish_date as publish_date','books.description as description' )
        // ->get();
        
    }
    private function transformName($name)
    {
        $prefix = 'KING';
        return $prefix . strtoupper($name);
        
    }
    
    public function checkOut_Action(Request $request)
    {
        //$bk = $request["id"];
        $itemid =(int)$request["itemid"];
       $need =(int)$request["need"];
       
       $value = Session::get('username');
       $user = DB::table('users')->where('username',$value)->first();
       $userid = (int)$user->id;
       
         $item = DB::table('items')->where('id',$itemid)->first();
         $itemquantity =(int)$item->quantity;
        
//         $mytime = Carbon\Carbon::now();
 //        echo $mytime->toDateTimeString();
         
       
            if($itemquantity - $need < 0 )
            {
              return response()->json("success");
            }
            else{
              DB::table('orders')->insert(array('item_id'=>$itemid,'user_id' => $userid,'quantity' => $need,'status'=>0));//status 0 means not bought
         //$book = books::where('id',$bk)->first();
            }

      // DB::table('orders')->insert(array('item_id'=>$itemid,'user_id' => $userid,'type'=>$type,'quantity' => $quantity ));
         //$book = books::where('id',$bk)->first();
         return response()->json("success");
    }
    //autoComplete
    
     public function deleteOrder(Request $request)
    {
        //$bk = $request["id"];
        $orderid =(int)$request["orderid"];
      
         
    
              DB::table('orders')->where('id','=',$orderid)
              ->delete();//status 0 means not bought
        
         

      // DB::table('orders')->insert(array('item_id'=>$itemid,'user_id' => $userid,'type'=>$type,'quantity' => $quantity ));
         //$book = books::where('id',$bk)->first();
         return response()->json("success");
    }
    
      public function checkUserName(Request $request)
    {
        
        $username =$request["username"];
      
         
       $user = DB::table('users')->where('username',$username)->first();
       $usertype = (int)$user->id;     
        
        if($usertype > 0) 
        {
            return response()->json("Username present");
            
        }
      // DB::table('orders')->insert(array('item_id'=>$itemid,'user_id' => $userid,'type'=>$type,'quantity' => $quantity ));
         //$book = books::where('id',$bk)->first();
         return response()->json("Username not present ");
    }
    
     public function buyOrder(Request $request)
    {
        //$bk = $request["id"];
        $orderid =(int)$request["orderid"];
    //  itemid,need:need,
        $itemid =(int)$request["itemid"];
        $need = (int)$request["need"];
        
        $item = DB::table('items')->where('id',$itemid)->first();
        $itemquantity = (int)$item->quantity;
        
        $newquantity = $itemquantity - $need;
        
        if($newquantity < 0)
        {
             return response()->json("failure");
            
        }
        $dt = new DateTime;
       $usableDate = $dt->format('m-d-y H:i:s');
         
        DB::table('items')->where('id','=',$itemid)
              ->update(['quantity' => $newquantity]);//status 0 means not bought
 
        
              DB::table('orders')->where('id','=',$orderid)
              ->update(['status' => 1,'order_date' => $usableDate ]);//status 0 means not bought
        
         

      // DB::table('orders')->insert(array('item_id'=>$itemid,'user_id' => $userid,'type'=>$type,'quantity' => $quantity ));
         //$book = books::where('id',$bk)->first();
         return response()->json("success");
    }
     public function getNiceAction($action,$id=null)
    {
        
        echo($id);
       return view('actions.'. $action); 
        
    }
    
    public function getTitleImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}