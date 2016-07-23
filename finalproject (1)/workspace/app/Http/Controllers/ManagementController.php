<?php
namespace App\Http\Controllers;
use Session;
use \Illuminate\Http\Request;
use \Illuminate\Http\Response;
use App\books;
use App\Items;
use App\Category;
use DB;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\File;
use \Illuminate\Support\Facades\Storage;

class ManagementController extends Controller
{
    public function getHome(){
        
          $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        // if(!Auth::check()){
        //     return view('admin.login');
        // }
        //$actions = books::all();
        //$items = Items::all();
        //return view('home', ['actions'=>$actions, 'items'=>$items]);
        return view('management.dashboard');
    }
    
   public function getManagementAction($action){
           $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        if($action == 'bookmanager'){
            $categories = Category::all();
            $actions = DB::table('books')
            ->leftJoin('categories', 'books.category', '=', 'categories.id')
            ->where('books.book_status', 1)->select('books.*', 'categories.category_name')->paginate(10);
            //->get(array('books.*', 'categories.category_name'));
            
            return view('management.bookmanager', ['actions'=>$actions, 'categories'=>$categories]);
        }
        else if($action == 'itemmanager'){
            //$actions = Items::all();
            $actions = DB::table('items')
                            ->leftJoin('books','items.books_id','=','books.id')
                            ->where('items.item_status', 1)->select('items.id as items_id', 'items.created_at as items_created_at', 'items.updated_at as items_updated_at','items.*',  'books.*')->paginate(10);
                           // ->get(array('items.id as items_id', 'items.created_at as items_created_at', 'items.updated_at as items_updated_at','items.*',  'books.*'));
            return view('management.itemmanager', ['actions'=>$actions]);
            //return view('management.test', ['vehicleString'=>$actions]);
        }
        else if($action == 'categorymanager'){
            //$actions = Items::all();
            $categories = Category::paginate(8);
            return view('management.categorymanager', ['categories'=>$categories]);
            //return view('management.test', ['vehicleString'=>$actions]);
        }
        return view('management.'.$action);
    }
    
    /**public function getBooks($id){
        
        $book = books::where('id',$id)->first();
        $items = new Items();
        $book->items()->save($items);
        
        return view('management.test', ['id'=>$id]);
        //$actions = books::all();
        //return view('management.bookmanager', ['actions'=>$actions]);
    }**/
    
    // public function getBookDetail($id){
    //     $actions = books::all();
    //     $book = books::where('id',$id)->first();
    //     return view('management.bookmanager', ['actions'=>$actions, 'book'=>$book]);
    // }
    
    
    public function postBookManageAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        //if(isset($request['keyword'])){
            $bookid = $request['bookid'];
            $bookname = $request['bookname'];
            $author = $request['author'];
            $publisher = $request['publisher'];
            $item_category = $request['item_category'];
            $item_sort = $request['item_sort'];
            if($item_sort == 'Book ID'){
                $item_sort = 'books.id';
            }
            else if($item_sort == 'BookName'){
                $item_sort = 'books.bookname';
            }
            
            $query = "SELECT books.*,categories.category_name FROM books left join categories on books.category = categories.id WHERE books.book_status = 1";
            $queryparam = array();
            if($bookid != ""){
                $query = $query . " And books.id = :bookidvariable";
                $queryparam['bookidvariable']=$bookid;
            }
            if($bookname != ""){
                $query = $query . " And books.bookname = :booknamevariable";
                $queryparam['booknamevariable']=$bookname;
            }
            if($author != ""){
                $query = $query . " And books.author_name = :author_namevariable";
                $queryparam['author_namevariable']=$author;
            }
            if($publisher != ""){
                $query = $query . " And books.publisher = :bookpublishervariable";
                $queryparam['bookpublishervariable']=$publisher;
            }
            if($item_category != ""){
                $query = $query . " And categories.category_name = :categories_namevariable";
                $queryparam['categories_namevariable']=$item_category;
            }
            if($item_sort != ""){
                $query = $query . " order by ".$item_sort;
            }

            $actions = DB::select( DB::raw($query), $queryparam);
            $categories = Category::all();
            return view('management.bookmanager', ['actions'=>$actions, 'categories'=>$categories]);
            
            
            //return view('management.test', ['actions'=>$actions]);
        //}
        //return redirect()->back();
    }
    
    public function postAddbookAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
       //return view('management.test', ['vehicleString'=>$request->all()]);
        $this->validate($request,[
            'bookName' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'version' => 'required|integer',
            'pages' => 'required|integer',
            'year' => 'required|integer',
            'month' => 'required|integer',
        ]);
        $action = new books();
        $action->bookname = $request['bookName'];
        $action->author_name = $request['author'];
        $action->publisher = $request['publisher'];
        $action->pages = $request['pages'];
        $action->version = $request['version'];
        //$action -> publish_date = date('Y-m',strtotime($request['year'].'-'.$request['month']));
        $action -> publish_date = $request['year'].'-'.$request['month'];
        $action -> book_status = 1;
        $category = Category::where('category_name',$request['category'])->first();
        $categoryid = $category['id'];
        $action->category = $categoryid;
        //$action->category = $request['category'];
        $action->description = $request['description'];
        //$action->category = $request['categoryid'];
        
        
        $file = $request->file('titleimage_add');
        $filename = $request['bookName'].'_'.time().'.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file));
            $action->titleimage = $filename;
        }
        
        $action -> save();
        return redirect()->route('managementaction',['action'=> 'bookmanager'])->with([
                'success' => 'Book Added!'
            ]);
        //$lastid = $action->id;
        // $actions = DB::table('books')
        //     ->leftJoin('categories', 'books.category', '=', 'categories.id')
        //     ->get(array('books.*', 'categories.category_name'));
        
        // return response()->json($action);
        
        //return redirect()->route('managementaction',['action'=> 'bookmanager'])->with('$lastid', $lastid);
    }
    
    public function postUpdatebookAction(Request $request, $id)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        $this->validate($request,[
            'bookName' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'version' => 'required|integer',
            'pages' => 'required|integer',
            'year' => 'required|integer',
            'month' => 'required|integer',
        ]);

        $book = books::where('id',$id)->first();

        $book->bookname = $request['bookName'];
        $book->author_name = $request['author'];
        $book->publisher = $request['publisher'];
        $book->pages = $request['pages'];
        $book->version = $request['version'];
        //$action -> publish_date = date('Y-m',strtotime($request['year'].'-'.$request['month']));
        $book -> publish_date = $request['year'].'-'.$request['month'];
        //$book->category = $request['category'];
        //$book->category = $request['categoryid'];
        //$categoryid = Category::where('')
        $category = Category::where('category_name',$request['category'])->first();
        $categoryid = $category['id'];
        $book->category = $categoryid;
        $book->description = $request['description'];
        
        
        $file = $request->file('titleimage_edit');
        $filename = $request['bookName'].'_'.time().'.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file));
            $book->titleimage = $filename;
        }
        $book -> update();
        //return view('management.test', ['vehicleString'=>$book]);
        return redirect()->route('managementaction',['action'=> 'bookmanager'])->with([
                'success' => 'Book Updated!'
            ]);
    }
    
    
    public function postDeletebookAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        //$checked = Input::only('checked')['checked'];
        // Do whatever you want with this array
        $this->validate($request,[
            'checked' => 'required'
        ]);
        
        foreach ($request->get('checked') as $bookid) {
            $item = Items::where('books_id',$bookid)->first();
            $item = DB::table('items')
            ->where('items.books_id', $bookid)
            ->where('items.item_status', 1)
            ->get(array('items.*'));
            if($item == null){
                // return redirect()->back()->withErrors([
                //     'error' => 'Just test '.$bookid
                // ]);
                foreach ($request->get('checked') as $booid) {
                    $book = books::where('id',$booid)->first();
                    $book->book_status = 0;
                    $book->update();
                }
            }
            else{
                return redirect()->back()->withErrors([
                    'error' => 'Some item is related to this book, please go to itemmanage page find and delete those items first'
                ]);
            }
            //$item->delete();
        }

        return redirect()->route('managementaction',['action'=> 'bookmanager']);
        
    }
    
    
    ////////////////////item_actions//////////////////////////
    public function postUpdateitemAction(Request $request, $id)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        $this->validate($request,[
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'type' => 'required'
        ]);
        $item = Items::where('id',$id)->first();
        // $this->validate($request,[
        //     'bookName' => 'required',
        //     'author' => 'required',
        //     'publisher' => 'required',
        //     'version' => 'required',
        //     'category' => 'required',
        //     'pages' => 'required',
        //     'year' => 'required',
        //     'month' => 'required'
        // ]);
        $item->price = $request['price'];
        $item->type = $request['type'];
        $item->quantity = $request['quantity'];
        $item -> update();
        //return view('management.test', ['vehicleString'=>$item]);
        return redirect()->route('managementaction',['action'=> 'itemmanager'])->with([
                'success' => 'Item Updated!'
            ]);
    }
    
    public function postItemManageAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        //if(isset($request['keyword'])){
        $itemid = $request['itemid'];
        $bookid = $request['bookid'];
        $bookname = $request['bookname'];
        $author = $request['author'];
        $publisher = $request['publisher'];
        $item_type = $request['item_type'];
        $item_sort = $request['item_sort'];
        
        if($item_sort = "item ID"){
            $item_sort = 'items.id';
        }
        else if($item_sort = "Book ID"){
            $item_sort = 'books.id';
        }
        else if($item_sort = "BookName"){
            $item_sort = 'books.bookname';
        }
        else if($item_sort = "Price"){
            $item_sort = 'items.price';
        }
        
        $query = "SELECT items.id as items_id, items.created_at as items_created_at, items.updated_at as items_updated_at, items.*, books.*";
        $query = $query. " FROM items left join books on items.books_id = books.id WHERE items.item_status = 1";
        $queryparam = array();
        if($itemid != ""){
            $query = $query . " And items.id = :itemidvariable";
            $queryparam['itemidvariable']=$itemid;
        }
        if($bookid != ""){
            $query = $query . " And books.id = :bookidvariable";
            $queryparam['bookidvariable']=$bookid;
        }
        if($bookname != ""){
            $query = $query . " And books.bookname = :booknamevariable";
            $queryparam['booknamevariable']=$bookname;
        }
        if($author != ""){
            $query = $query . " And books.author_name = :author_namevariable";
            $queryparam['author_namevariable']=$author;
        }
        if($publisher != ""){
            $query = $query . " And books.publisher = :bookpublishervariable";
            $queryparam['bookpublishervariable']=$publisher;
        }
        if($item_type != ""){
            $query = $query . " And items.type = :item_typevariable";
            $queryparam['item_typevariable']=$item_type;
        }
        if($item_sort != ""){
            $query = $query . " order by ".$item_sort;
        }

        $actions = DB::select( DB::raw($query), $queryparam);
        
        return view('management.itemmanager', ['actions'=>$actions]);
            
            
        //return view('management.test', ['actions'=>$actions]);
        //}
        //return redirect()->back();
    }
    
     public function searchBook_itemAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
         
        $bookid = $request['bookid'];
        $bookName = $request['bookName'];
        
        $query = "SELECT books.* FROM books WHERE books.book_status = 1";
        $queryparam = array();
        if($bookid != ""){
            $query = $query . " And books.id = :bookidvariable";
            $queryparam['bookidvariable']=$bookid;
        }
        if($bookName != ""){
            $query = $query . " And books.bookname = :booknamevariable";
            $queryparam['booknamevariable']=$bookname;
        }

        $book = DB::select( DB::raw($query), $queryparam);
        return response()->json($book);
        
    }
    
    public function postAdditemAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        //$id = $request->get('optradio');
        $this->validate($request,[
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'type' => 'required',
            'optradio' => 'required'
        ]);
        
        
        $action = new Items();
        $action->price = $request->get('price');
        $action->quantity = $request->get('quantity');
        $action->type = $request->get('type');
        $action -> item_status = 1;
        $action->books_id = $request->get('optradio');
        $action -> save();
        
        return redirect()->route('managementaction',['action'=> 'itemmanager'])->with([
                'success' => 'Item Added!'
            ]);
        // $action = new books();
        // $action->bookname = $request['bookName'];
        // $action->author_name = $request['author'];
        // $action->publisher = $request['publisher'];
        // $action->pages = $request['pages'];
        // $action->version = $request['version'];
        // //$action -> publish_date = date('Y-m',strtotime($request['year'].'-'.$request['month']));
        // $action -> publish_date = $request['year'].'-'.$request['month'];
        // $action->category = $request['category'];
        // $action -> save();
        
        // return redirect()->route('managementaction',['action'=> 'bookmanager']);
       //return view('management.test', ['price'=>$request->get('price'), 'quantity'=>$request->get('quantity'), 'type'=>$request->get('type'), 'vehicleString'=>$id]);
    }
    
    public function postDeleteitemAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        //$checked = Input::only('checked')['checked'];
        // Do whatever you want with this array
        $this->validate($request,[
            'checked' => 'required'
        ]);
        
        foreach ($request->get('checked') as $itemid) {
            $item = Items::where('id',$itemid)->first();
            $item -> item_status = 0;
            $item -> update();
            //$item->delete();
        }

        return redirect()->route('managementaction',['action'=> 'itemmanager']);
        //$vehicleString = implode(",", $request->get('checked'));
        
        //return view('management.test', ['vehicleString'=>$vehicleString]);
    }
    
    public function postDeletecategoryAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        $this->validate($request,[
            'checked' => 'required'
        ]);
        //$checked = Input::only('checked')['checked'];
        // Do whatever you want with this array
        foreach ($request->get('checked') as $categoryid) {
            $category = Category::where('id',$categoryid)->first();
            $category->delete();
        }
    }
    
    public function postUpdatecategoryAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        $id =  $request['categoryid'];

        $category->category_name = $request['categoryName'];

        $category -> update();
        
        return response()->json('{success:true}');
        
    }
    
    public function postAddcategoryAction(Request $request)
    {
            $value =(int)Session::get('usertype');
          if(!Auth::check())
       {
            return redirect()->route('user.login');
          
        }
        
          if($value==1)
           {
            return redirect()->route('user.login');
           }
        $this->validate($request,[
            'categoryName' => 'required'

        ]);
        $category = new Category();
        $category->category_name = $request['categoryName'];
        
        $category -> save();
        return redirect()->route('managementaction',['action'=> 'categorymanager']);
    }
    
    public function getTitleImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
    
    
}

?>