<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
$username = ""; 

//Route::get('/art', function () {
 //   return view('actions.art');/*give the name of php */
//})->name('art');
//Route::get('/checkout', function () {
//    return view('actions.checkout');/*give the name of php */
//})->name('checkout');
//*/

//Route::post('/check', function (\Illuminate\Http\Request $request) {
//    if(isset($request['username']))
//    {
//        if(strlen($request['username'])> 0 ){
 //           $username = $request['username'];
  //           return view('home',['username' => $request['username'] ]);
//        }
 //       return redirect()->back();
  ///      
//    }
 //    return redirect()->back();
  //  return view('home');/*give the name of php */
//})->name('check');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web']], function () {
//    Route::get('/', function () {
//    return view('home');/*give the name of php */
//})->name('home');
Route::group(['middleware' => ['web']], function(){
 
 
 Route::get('/',[
 'uses' => 'NiceActionController@getHome',
 'as' => 'home'
 ]);
 
  Route::get('/management',[
        'uses' => 'ManagementController@getHome',
        'as' => 'adminhome'
     ]);
    
    
      Route::group(['prefix'=>'management'],function(){
         Route::get('/{action}', [
                'uses' => 'ManagementController@getManagementAction',
                'as' => 'managementaction'
             ]);
        
        Route::post('/searchBook', [
                'uses' => 'ManagementController@postBookManageAction',
                'as' => 'searchBook'
            ]);
            
        Route::post('/add_book', [
                'uses' => 'ManagementController@postAddbookAction',
                'as' => 'add_book'
            ]);
            
        Route::post('/update_book/{id}', [
                'uses' => 'ManagementController@postUpdatebookAction',
                'as' => 'update_book'
            ]);
        
         /**Route::delete('/delete_book', [
                'uses' => 'ManagementController@postDeletebookAction',
                'as' => 'delete_book'
            ]);**/
        
        Route::post('/delete_book', [
                'uses' => 'ManagementController@postDeletebookAction',
                'as' => 'delete_book'
            ]);
            
            
        ////////////////item_route/////////////
        Route::post('/update_item/{id}', [
            'uses' => 'ManagementController@postUpdateitemAction',
            'as' => 'update_item'
        ]);
        
        Route::post('/searchItem', [
             'uses' => 'ManagementController@postItemManageAction',
             'as' => 'searchItem'
        ]);
            
        Route::post('/searchBook_item', [
                'uses' => 'ManagementController@searchBook_itemAction',
                'as' => 'searchBook_item'
            ]);
            
        Route::post('/add_item', [
                'uses' => 'ManagementController@postAdditemAction',
                'as' => 'add_item'
            ]);
            
        Route::post('/delete_item', [
                'uses' => 'ManagementController@postDeleteitemAction',
                'as' => 'delete_item'
            ]);
            
        //////////////others/////////////////
        Route::get('titleimage/{filename}',[
            'uses' => 'ManagementController@getTitleImage',
            'as' => 'book.image'
        ]);
        
            
        
        Route::post('/delete_category', [
                'uses' => 'ManagementController@postDeletecategoryAction',
                'as' => 'delete_category'
            ]);
            
        Route::post('/update_category', [
                'uses' => 'ManagementController@postUpdatecategoryAction',
                'as' => 'update_category'
            ]);
            
        Route::post('/add_category', [
                'uses' => 'ManagementController@postAddcategoryAction',
                'as' => 'add_category'
            ]);
        /**Route::get('/test/{id}', [
                'uses' => 'ManagementController@getBooks',
                'as' => 'getbookaction'
        ]);**/
        
        // Route::get('/test/{id}', [
        //         'uses' => 'ManagementController@getBookDetail',
        //         'as' => 'getbookdetailaction'
        // ]);
    });
    
 Route::get('/index',[
 'uses' => 'NiceActionController@getHome2',
 'as' => 'home2'
 ]);

 Route::get('/account',[
 'uses' => 'UserController@getAccount',
 'as' => 'account'
 ]);
 Route::get('/list',[
    'uses' => 'UserController@purchaseHistory',
    'as' => 'purchaseHistory'
    ]);
Route::get('/cart',[
 'uses' => 'UserController@getCart',
 'as' => 'cart'
 ]);
//Route::get('/login', function () {
//    return view('login');/*give the name of php */
//})->name('login');

Route::get('/login',[
 'uses' => 'UserController@getLogin',
 'as' => 'user.login'
 ]);
 Route::get('/logout',[
    'uses' => 'UserController@getLogout',
    'as' => 'user.logout'
    ]);
    
    Route::get('/signup',[
    'uses' => 'UserController@getSignup',
    'as' => 'user.signupform'
    ]);
Route::post('/login',[
 'uses' => 'UserController@postLogin',
 'as' => 'user.login'
 ]);
 
 Route::post('/signup',[
 'uses' => 'UserController@signup',
 'as' => 'user.signup'
 ]);
 

Route::post('/check',[
    'uses' => 'NiceActionController@postNiceAction',
    'as' => 'check'
    ]);
Route::post('/checkOutAction',[
    'uses' => 'NiceActionController@checkOut_Action',
    'as' => 'checkOutAction'
    ]);
    //autoComplete
    Route::post('/autoComplete',[
    'uses' => 'NiceActionController@autoComplete',
    'as' => 'autoComplete'
    ]);
    
    Route::post('/editsave',[
 'uses' => 'UserController@editSave',
 'as' => 'useredit'
 ]);
 
 Route::post('/deleteOrder',[
    'uses' => 'NiceActionController@deleteOrder',
    'as' => 'deleteOrder'
    ]);
 Route::post('/checkUserName',[
    'uses' => 'NiceActionController@checkUserName',
    'as' => 'checkUserName'
    ]);
    //deleteOrder//buyOrder
    Route::post('/buyOrder',[
    'uses' => 'NiceActionController@buyOrder',
    'as' => 'buyOrder'
    ]);
    Route::get('/{action}/{id?}',[
    'uses' => 'NiceActionController@getNiceAction',
    'as' => 'niceaction'
    ]);
    
});
