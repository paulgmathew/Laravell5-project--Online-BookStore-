@extends('layouts.master_admin')

@section('styles')
<link rel="stylesheet" href="{{ URL::secure('src/css/sidebar.css')}}" />
@endsection
@section('navbarli')
        <li><a href="{{ route('managementaction',['action'=> 'dashboard']) }}">Dashboard</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'bookmanager']) }}">Book Management</a></li>
        <li class="active"><a href="{{ route('managementaction',['action'=> 'itemmanager']) }}">Item Management</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'categorymanager']) }}">Category Management</a></li>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::secure('src/js/itemmange.js') }}"></script>
@endsection

@section('content')
<!--items_id items_created_at items_updated_at id created_at updated_at price type quantity books_id bookname author_name publisher pages version publish_date description category -->
<div class="container-fluid contentcontainer">
  <div class="row content">
      
      @include('includes.itemsidebar')
      
          <div class="col-sm-10">
        
            <form action="{{ route('delete_item') }}" id="itemdeleteform" method="post">
    
            <div class="row right-content">
                <h2 class = "margin-top-0">Item Management</h2>
                <p>The general items information will be listed in the following table. Click the Item ID if you want to see details or edit the Item.</p>                                                                                      
                @if(count($errors)>0)
                    <section class="info-box fail">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endif
                @if(Session::has('success'))
                    <section class="info-box success">
                        {{ Session::get('success') }}
                    </section>
                @endif
                <div class="table-responsive">          
                  <table class="table">
                    <thead>
                      <tr>
                        <th>select</th>
                        <th>Item ID</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>quantity</th>
                        <th>type</th>
                        <th>price</th>
                        <th>update Time</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($actions) > 0)
                      @foreach($actions as $action)
                      <tr>
                        <td class = "check-pos"><input type="checkbox" class="checkbox" name="checked[]" value="{{$action->items_id}}"></td>
                        <td><a href="" data-itemid= "{{ $action->items_id }}" data-price="{{ $action->price }}" data-type="{{ $action->type }}" data-quantity="{{ $action->quantity }}" data-category="{{ $action->category }}" 
                        data-books_id="{{ $action->books_id }}" data-bookname="{{ $action->bookname }}" data-author_name="{{ $action->author_name }}" data-publisher="{{ $action->publisher }}" 
                        data-pages="{{ $action->pages }}" data-version="{{ $action->version }}" data-titleimage ="{{ $action->titleimage }}" data-publish_date="{{ $action->publish_date }}" data-description="{{ $action->description }}" 
                        data-toggle="modal" data-target="#itemmodal" id="{{$action->items_id}}" class="itemid">{{$action->items_id}}</a></td>
                        <td>{{$action->bookname}}</td>
                        <td>{{$action->author_name}}</td>
                        <td>{{$action->quantity}}</td>
                        <td>{{$action->type}}</td>
                        <td>{{$action->price}}</td>
                        <td>{{$action->items_updated_at}}</td>
                      </tr>
                       @endforeach
                       @endif
                    </tbody>
                  </table>
                  <div class="col-sm-12 center">
                    {!! $actions->links() !!}
                  </div>
                </div>
                <div>
                    
                </div>
    
            </div><hr>
            
            <div class="row right-content">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addItemModal" id="addbtn">Add new item</button>
                </div>
                <div class="col-sm-offset-4 col-sm-2">
                    <button type="submit" id='deletItem' class="btn btn-danger">Delete Items</button>
                </div>
                <input type="hidden" value="{{ Session::token() }}" name="_token"/>
            </div>
            
            </form>
        
        
        <!-- Modal -->
        @if(count($actions) > 0)
        <div class="modal fade" id="itemmodal" role="dialog">
        <!--<div class="modal fade bannerformmodal" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true" id="myModal">-->
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modal-items-edit">
                    <div id="modal-content-show">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Item details</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" id="edit_item_form" method="post" class="form-horizontal" role="form">
                                <div id="edit-item">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="price-modal_edit">price</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="price-modal_edit" name="price"  value="$39.99">
                                        </div>
                                        <label class="control-label col-sm-2" for="quantity-modal_edit">Quanitity</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="quantity-modal_edit" name="quantity" value="140">
                                        </div>
                                        <label class="control-label col-sm-2" for="type-modal_edit">type</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="type" id="type-modal_edit">
                                                <option value="" disabled selected>Select Category</option>
                                                <option>New</option>
                                                <option>Used</option>
                                                <option>Rent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="show-item">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="price-modal">price</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="price-modal"  value="$39.99" readonly="readonly">
                                        </div>
                                        <label class="control-label col-sm-2" for="quantity-modal">Quanitity</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="quantity-modal"  value="140" readonly="readonly">
                                        </div>
                                        <label class="control-label col-sm-2" for="type-modal">type</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="type-modal"  value="new" readonly="readonly">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="bookName-modal">Book ID</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="bookid-modal"  value="1" readonly="readonly">
                                    </div>
                                    <label class="control-label col-sm-2" for="bookName-modal">Book Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="bookName-modal"  value="book1" readonly="readonly">
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="author-modal">Author:</label>
                                    <div class="col-sm-4">          
                                        <input type="text" class="form-control" id="author-modal"  value="author1" readonly="readonly">
                                    </div>
                                    <label class="control-label col-sm-2" for="publisher-modal">Publisher:</label>
                                    <div class="col-sm-4">          
                                        <input type="text" class="form-control" id="publisher-modal"  value="publisher1" readonly="readonly">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2">title image:</label>
                                     <div class="col-sm-2">
                                        <img src="" class="img-rounded float-left" id="titleimage-modal" alt="Title Image" width="100" height="130">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <label class="control-label col-sm-3" for="version-modal">version:</label>
                                            <div class="col-sm-3">          
                                                <input type="text" class="form-control" id="version-modal" value="version1" readonly="readonly">
                                            </div>
                                            <label class="control-label col-sm-2" for="category-modal">Category:</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="category-modal"  value="category1" readonly="readonly">
                                            </div>
                                            
                                        </div>
                                        <div class="row top-10">
                                            <label class="control-label col-sm-3" for="pages-modal">Pages:</label>
                                            <div class="col-sm-3">          
                                                <input type="text" class="form-control" id="pages-modal" value="400" readonly="readonly">
                                            </div>
                                            <label class="control-label col-sm-2">Publish Date:</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="year-modal" value="2013" readonly="readonly">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="month-modal" value="11" readonly="readonly">
                                                    
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="description">Abstract</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" id="description" readonly="readonly">sjdfklsdfjlksdfjlk</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" id="modal-edit-btn">edit</button>
                                    <button type="submit" class="btn btn-info" id="modal-submit-btn">submit</button>
                                </div>
                                <input type="hidden" value="{{ Session::token() }}" name="_token"/>
                              </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        @endif            
                    
        
                <!-- Modal -->
        <div class="modal fade" id="addItemModal" role="dialog">
        <!--<div class="modal fade bannerformmodal" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true" id="myModal">-->
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modal-items-edit">
                    <div id="modal-content-show">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add Item</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add_item') }}" method="post" class="form-horizontal" role="form">
                                <div id="add-item">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="price-modal_add">price</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="price-modal_add" name="price"  value="">
                                        </div>
                                        <label class="control-label col-sm-2" for="quantity-modal_add">Quanitity</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="quantity-modal_add" name="quantity" value="">
                                        </div>
                                        <label class="control-label col-sm-2" for="type-modal_add">type</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="type" id="type-modal_add">
                                                <option value="" disabled selected>Select Category</option>
                                                <option>New</option>
                                                <option>Used</option>
                                                <option>Rent</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-horizontal form-group searchBook_item">
                                    <!--<form action="123" method="post" role="form" id="searchBook_item">-->
                                    <label class="control-label col-sm-2" for="bookid_search-modal">Book ID</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="bookid_search-modal"  value="" >
                                    </div>
                                    <label class="control-label col-sm-2" for="bookName_search-modal">Book Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="bookName_search-modal"  value="" >
                                        <input type="hidden" value="{{ Session::token() }}" name="_token"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-success" onclick="send(event)" id="book_search" name="book_search">Book Search</button>
                                    </div>
                                <!--</form>-->
                                    
                                </div>
                                
                                <hr>
                                <div class="table-responsive" id="book_detail">          
                                  <table class="table" id="searchBook_item_table">
                                      <thead>
                                        <tr>
                                          <th>select</th>
                                          <th>Book ID</th>
                                          <th>Book Name</th>
                                          <th>Author</th>
                                          <th>Publisher</th>
                                          <th>Version</th>
                                          <th>Publish Date</th>
                                        </tr>
                                      </thead>
                                      <tbody id="searchBook_item_tbody">
                                      
                
                                    </tbody>
                                  </table>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info" id="modal-submit-btn">Add</button>
                                </div>
                                <input type="hidden" value="{{ Session::token() }}" name="_token"/>
                              </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        
                    
                    
        </div>
        
        
  </div>
  <script type="text/javascript">
      function send(event){
          event.preventDefault();
        //   var newRowContent = "<tr><td class='check-pos'><label><input type='radio' name='optradio'></label></td>"
        //                                 +"<td>asdad</td>"
        //                                 +"<td>asda</td>"
        //                                 +"<td>as</td>"
        //                                 +"<td>asdad</td>"
        //                                 +"<td>asdad</td>"
        //                                 +"<td>asdad</td>"
        //                                 +"</tr>";
        // $("#searchBook_item_table tbody").append(newRowContent);
        
          $.ajax({
          type: "POST",
          url: "{{ route('searchBook_item') }}",
          data: {bookid: $("#bookid_search-modal").val(), bookName: $("#bookName_search-modal").val(), _token: "{{ Session::token() }}"}
            })
            .done(function(data) {
    			// log data to the console so we can see
				//alert(data.length);
				if(data.length>=1){
    				$.each( data, function( key, value ) {
                        //console.log( value );
                        var newRowContent = "<tr><td class='check-pos'><label><input type='radio' name='optradio' value='"+value.id+"'></label></td>"
                                            +"<td>"+value.id+"</td>"
                                            +"<td>"+value.bookname+"</td>"
                                            +"<td>"+value.author_name+"</td>"
                                            +"<td>"+value.publisher+"</td>"
                                            +"<td>"+value.version+"</td>"
                                            +"<td>"+value.publish_date+"</td>"
                                            +"</tr>";
                        $("#searchBook_item_table tbody").append(newRowContent);
                        // $.each( value, function( key1, value1 ) {
                        //     console.log( key1 + ": " + value1 );
                        // });
                    });
				}
				//console.log(data); 
            });
        

      }
  </script>
  
</div>
@endsection