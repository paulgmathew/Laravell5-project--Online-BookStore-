<?php

namespace App\Http\Controllers;
use Session;
use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class UserController extends Controller
{
  
    public function getLogin()
    {
return view('login');
    }
     public function getSignup()
    {
return view('signup');
    }
     public function getLogout()
    {
     Session::flush();
        Auth::logout();
        
        return redirect() -> route('home2');
    }
  
  
   public function postLogin(Request $request)
   {
        $this ->validate($request,['username' => 'required',
        'password' => 'required']);
        
        if(!Auth::attempt(['username' => $request['username'],'password' => $request['password'] ])){
            return redirect()->back()->with(['fail' => 'Could not log you in ']);
        }
        
        
        Session::put('username',$request['username']);
         Session::put('email',$request['email']);
         
        $user = DB::table('users')->where('username',$request['username'])->first();
        $usertype = (int)$user->type;
        Session::put('usertype',$usertype);
        
          $value =(int)Session::get('usertype');
          if($value==0)
           {
            return redirect()->route('adminhome');
           }
        
       //return redirect() -> route('home')->with(['username' => $request['username']]);
       return redirect() -> route('home');
   }
   
     public function signup(Request $request)
   {
        $this ->validate($request,['username' => 'required',
        'password' => 'Required|AlphaNum|Between:4,8',
        'repassword' => 'Required|AlphaNum|Between:4,8',
        'fullname' => 'required']);
        $username = $request['username'];
        $password =  bcrypt($request['password']);
        $repassword =  bcrypt($request['repassword']);
        $email = $request['email'];
       $fullname = $request['fullname'];
        
         $user = DB::table('users')->where('email',$email)->first();
         if($user)
         {
            return redirect()->back()->with(['fail' => 'Email already registered']);
         }
         
         if($password != $password)
         {
          return redirect()->back()->with(['fail' => 'Password and rewrite password does not match']);
         }
        // $userid = $user->email;
         
       
        
       DB::table('users') ->insert(['username' =>$username,'password'=>$password,'email' =>$email,'fullname' => $fullname,'type' => 1 ]);
       //return redirect() -> route('home')->with(['username' => $request['username']]);
       return redirect() -> route('user.login');
   }
   
    public function editSave(Request $request)
   {
        $this ->validate($request,['fullname' => 'required',
        'address' => 'required',
        'phone' => 'required']);
        
        $user = DB::table('users')->where('id',$request['id'])->update(array('fullName'=>$request['fullname'],'address'=>$request['address'],'email'=>$request['email'],'phone'=>$request['phone']));
       // $user = new User();
    //    $user->fullName = 
        
        
       // Session::put('username',$request['username']);
       //return redirect() -> route('home')->with(['username' => $request['username']]);
       //return redirect() -> route('home');
         if(!Auth::check())
       {
            return redirect()->route('user.login');
        }
         $value = Session::get('username');
         $user = User::all() ->where('username',$value);
        
        //  return view('home',['username' => $request['username'],'books' =>$books,'items' => $items]);
        //return view('actions.account',['user' => $user])->with(['success'=>'Account Edited']);
        return  redirect()->back()->with(['success'=>'Account Edited']);
   }
   
    public function getAccount()
    {
         if(!Auth::check())
       {
            return redirect()->route('user.login');
        }
         $value = Session::get('username');
         $user = User::all() ->where('username',$value);
      //  foreach ($user as $value) {
    //        $uid = (int)$user->id;
     //    }
      //   $user->id;
         
       //  $order =DB::table('orders')
        //            ->join('items','items.id','=','orders.item_id')
         //           ->join('user','items.user_id','=','users.id')
          //          ->join('user','users.id','=',$uid)
        //            ->get();
        
        
        
        //  return view('home',['username' => $request['username'],'books' =>$books,'items' => $items]);
        return view('actions.account',['user' => $user]);
    }
     public function getCart()
    {
        if(!Auth::check())
       {
            return redirect()->route('user.login');
        }
      $value = Session::get('username');
       $user = DB::table('users')->where('username',$value)->first();
       $userid = (int)$user->id;
       
       //SELECT * FROM `orders` join items on orders.item_id = items.id join books on items.books_id =books.id 
//where orders.user_id = 1
      // <div class="booksChecked" itemid ="'+item+'" quantity="'+quantity+'" id="'+id+'" title="'+bookTitle+'" quantity="'+quantity+'" type="'+type+'" price="'+price+'"  need="'+need+'">'+bookTitle+'<button id="db">Delete</button></div></li>';
//      
       
         $order = DB::table('orders')
         ->join('items','items.id','=','orders.item_id')
         ->join('books','books.id','=','items.books_id')
         ->where('orders.user_id',$userid)
         ->where('orders.status',0)
         ->select('items.id as item_id','orders.quantity as need','orders.id as id','items.quantity as quantity','books.bookname as bookname','items.type as type','items.price as price','books.titleimage as titleimage')
         ->paginate(10);
        
        
        //  return view('home',['username' => $request['username'],'books' =>$books,'items' => $items]);
        return view('actions.cart',['order' => $order]);
    }
     public function purchaseHistory()
    {
         $value = Session::get('username');
       $user = DB::table('users')->where('username',$value)->first();
       $userid = (int)$user->id;
       
         $order = DB::table('orders')
         ->join('items','items.id','=','orders.item_id')
         ->join('books','books.id','=','items.books_id')
         ->where('orders.user_id',$userid)
         ->where('orders.status',1)
         ->select('items.id as item_id','orders.order_date as order_date','orders.quantity as need','orders.id as id','items.quantity as quantity','books.bookname as bookname','items.type as type','items.price as price','books.book_status as book_status','books.titleimage as titleimage')
         ->get();
        
        
        //  return view('home',['username' => $request['username'],'books' =>$books,'items' => $items]);
        return view('list',['order' => $order]);
        //
       
    }
}