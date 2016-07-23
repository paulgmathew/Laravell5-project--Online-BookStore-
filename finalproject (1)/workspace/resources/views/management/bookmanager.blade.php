@extends('layouts.master_admin')
@section('styles')
<link rel="stylesheet" href="{{ URL::secure('src/css/sidebar.css')}}" />
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::secure('src/js/script.js') }}"></script>
@endsection
@section('navbarli')
        <li><a href="{{ route('managementaction',['action'=> 'dashboard']) }}">Dashboard</a></li>
        <li class="active"><a href="{{ route('managementaction',['action'=> 'bookmanager']) }}">Book Management</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'itemmanager']) }}">Item Management</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'categorymanager']) }}">Category Management</a></li>
@endsection
@section('content')

<div class="container-fluid contentcontainer">
  <div class="row content">
      
      @include('includes.booksidebar')
    
    <div class="col-sm-10">

        <form action="{{ route('delete_book') }}" id="bookdeleteform" method="post">

        <div class="row right-content">
            <h2 class = "margin-top-0">Book Management</h2>
            <p>The general books information will be listed in the following table. Click the Book ID if you want to see details or edit the book.</p>                                                                                      
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
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>publisher</th>
                    <th>update Time</th>
                  </tr>
                </thead>
                <tbody id="booktbody">
                  @foreach($actions as $action)
                  <tr>
                    <td class = "check-pos"><input type="checkbox" class="checkbox" name="checked[]" value="{{$action->id}}"></td>
                    <td><a href="#" data-book_id = "{{ $action->id }}" data-bookname="{{ $action->bookname }}" data-author_name="{{ $action->author_name }}" data-publisher="{{ $action->publisher }}" data-pages="{{ $action->pages }}" 
                    data-version="{{ $action->version }}" data-titleimage ="{{ $action->titleimage }}" data-publish_date="{{ $action->publish_date }}" data-description="{{ $action->description }}" data-category="{{ $action->category_name }}" 
                    data-toggle="modal" data-target="#myModal" id="{{$action->id}}" class  = "bookid">{{$action->id}}</a></td>
                    <td>{{$action->bookname}}</td>
                    <td>{{$action->author_name}}</td>
                    <td>{{$action->publisher}}</td>
                    <td>{{$action->updated_at}}</td>
                  </tr>
                   @endforeach
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
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myAddModal" id="addbtn">Add new book</button>
            </div>
            <div class="col-sm-offset-4 col-sm-2">
                <button type="submit" id='deletBook' class="btn btn-danger">Delete Books</button>
            </div>
            <input type="hidden" value="{{ Session::token() }}" name="_token"/>
        </div>
        
        </form>
        
        @if(count($actions) > 0)
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
        <!--<div class="modal fade bannerformmodal" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true" id="myModal">-->
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modal-items-edit">
                    <div id="modal-content-show">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Book Details</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="bookName-modal">Book Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="bookName-modal"  value="book1" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="author-modal">Author:</label>
                                    <div class="col-sm-10">          
                                        <input type="text" class="form-control" id="author-modal"  value="author1" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="publisher-modal">Publisher:</label>
                                    <div class="col-sm-10">          
                                        <input type="text" class="form-control" id="publisher-modal"  value="publisher1" readonly="readonly">
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label class="control-label col-sm-2" for="type-modal">Type:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="type-modal"  value="type1" readonly="readonly">
                                    </div>
                                    <label class="control-label col-sm-2" for="category-modal">Category:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="category-modal"  value="category1" readonly="readonly">
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label class="control-label col-sm-2">title image:</label>
                                     <div class="col-sm-2">
                                        <img src="{{ route('book.image',['filename' => $action->titleimage ])}}" class="img-rounded float-left" id="titleimage-modal" alt="Title image" width="100" height="130">
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
                                            <!--<label class="control-label col-sm-3" for="price-modal">Price:</label>
                                            <div class="col-sm-3">          
                                                <input type="text" class="form-control" id="price-modal" value="$50.49" readonly="readonly">
                                            </div>-->
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

                          </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" id="modal-edit-btn">edit</button>
                        </div>          
                    </div>
                    <!--////////////edit modal////////////////////////////////////////////-->
                    <div id="modal-content-edit">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Edit Book</h4>
                        </div>
                        <div class="modal-body">
                                <form action="" id= "edit_book_form" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="bookName-modal_edit">Book Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="bookName" id="bookName-modal_edit" placeholder="Enter book name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="author-modal_eidt">Author:</label>
                                        <div class="col-sm-10">          
                                            <input type="text" class="form-control" name="author" id="author-modal_edit" placeholder="Enter author name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="publisher-modal_edit">Publisher:</label>
                                        <div class="col-sm-10">          
                                            <input type="text" class="form-control" name="publisher" id="publisher-modal_edit" placeholder="Enter publisher">
                                        </div>
                                    </div>

                                    <!--<div class="form-group">
                                        <label class="control-label col-sm-2" for="type-modal">Type:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="type-modal">
                                                <option value="" disabled selected>Select your option</option>
                                                <option>New</option>
                                                <option>Used</option>
                                                <option>Rent</option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-2" for="category-modal">Category:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="category-modal">
                                                <option value="" disabled selected>Select your option</option>
                                                <option>New</option>
                                                <option>Used</option>
                                                <option>Rent</option>
                                            </select>
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">title image:</label>
                                         <div class="col-sm-2">
                                            <input type="file" name="titleimage_edit" id="titleimage_edit">
                                            <img src="{{ route('book.image',['filename' => $action->titleimage ])}}" class="img-rounded float-left" id="titleimage-modal_edit" alt="Title image" width="100" height="130">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <label class="control-label col-sm-3" for="version-modal_edit">version:</label>
                                                <div class="col-sm-3">          
                                                    <input type="text" class="form-control"  name="version" id="version-modal_edit" placeholder="Enter Version">
                                                </div>
                                                <label class="control-label col-sm-2" for="category-modal_edit">Category:</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="category" id="category-modal_edit">
                                                        <option value="" disabled selected>Select Category</option>
                                                         @foreach($categories as $category)
                                                             <option id="{{$category->id}}">{{$category->category_name}}</option>
                                                         @endforeach
                                                        <!--<option>category1</option>-->
                                                        <!--<option>category2</option>-->
                                                        <!--<option>category3</option>-->
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="row top-10">
                                                <!--<label class="control-label col-sm-3" for="price-modal">Price:</label>
                                                <div class="col-sm-3">          
                                                    <input type="text" class="form-control" id="price-modal" placeholder="Enter password">
                                                </div>-->
                                                <label class="control-label col-sm-3" for="pages-modal_edit">Pages:</label>
                                                <div class="col-sm-3">          
                                                    <input type="text" class="form-control" name="pages" id="pages-modal_edit" placeholder="Enter Pages">
                                                </div>
                                                <label class="control-label col-sm-2">Publish Date:</label>
                                                <div class="col-sm-2">
                                                    <select class="form-control" name="year" id="year-modal_edit">
                                                        <option value="" disabled selected>Year</option>
                                                        <option>2016</option>
                                                        <option>2015</option>
                                                        <option>2014</option>
                                                        <option>2013</option>
                                                        <option>2013</option>
                                                        <option>2011</option>
                                                        <option>2010</option>
                                                        <option>2009</option>
                                                        <option>2008</option>
                                                        <option>2007</option>
                                                        <option>2006</option>
                                                        <option>2005</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select class="form-control"  name="month" id="month-modal_edit">
                                                        <option value="" disabled selected>Month</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="description_edit">Abstract</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="5" id="description_edit" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="Submit" class="btn btn-info"/>
                                    </div>
                                    <input type="hidden" value="{{ Session::token() }}" name="_token"/>

                              </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="modal fade" id="myAddModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modal-items-edit">
                      <!--////////////add modal////////////////////////////////////////////-->
                    <div id="modal-content-add">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add Book</h4>
                        </div>
                        <div class="modal-body">
                                <form action="{{ route('add_book') }}" method="post" id="addbook_form" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="bookName-modal_add">Book Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="bookName" id="bookName-modal_add" placeholder="Enter book name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="author-modal_eidt">Author:</label>
                                        <div class="col-sm-10">          
                                            <input type="text" class="form-control" name="author" id="author-modal_add" placeholder="Enter author name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="publisher-modal_add">Publisher:</label>
                                        <div class="col-sm-10">          
                                            <input type="text" class="form-control" name="publisher" id="publisher-modal_add" placeholder="Enter publisher">
                                        </div>
                                    </div>

                                    <!--<div class="form-group">
                                        <label class="control-label col-sm-2" for="type-modal">Type:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="type-modal">
                                                <option value="" disabled selected>Select your option</option>
                                                <option>New</option>
                                                <option>Used</option>
                                                <option>Rent</option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-2" for="category-modal">Category:</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="category-modal">
                                                <option value="" disabled selected>Select your option</option>
                                                <option>New</option>
                                                <option>Used</option>
                                                <option>Rent</option>
                                            </select>
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">title image:</label>
                                         <div class="col-sm-2">
                                            <input type="file" name="titleimage_add" id="titleimage_add">
                                            <!--<img src="" class="img-rounded float-left" alt="Title image" width="100" height="130">-->
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <label class="control-label col-sm-3" for="version-modal_add">version:</label>
                                                <div class="col-sm-3">          
                                                    <input type="text" class="form-control"  name="version" id="version-modal_add" placeholder="Enter Version">
                                                </div>
                                                <label class="control-label col-sm-2" for="category-modal_add">Category:</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="category" id="category-modal_add">
                                                        <option value="" disabled selected>Select Category</option>
                                                        @foreach($categories as $category)
                                                             <option id="{{$category->id}}">{{$category->category_name}}</option>
                                                         @endforeach
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="row top-10">
                                                <!--<label class="control-label col-sm-3" for="price-modal">Price:</label>
                                                <div class="col-sm-3">          
                                                    <input type="text" class="form-control" id="price-modal" placeholder="Enter password">
                                                </div>-->
                                                <label class="control-label col-sm-3" for="pages-modal_add">Pages:</label>
                                                <div class="col-sm-3">          
                                                    <input type="text" class="form-control" name="pages" id="pages-modal_add" placeholder="Enter Pages">
                                                </div>
                                                <label class="control-label col-sm-2">Publish Date:</label>
                                                <div class="col-sm-2">
                                                    <select class="form-control" name="year" id="year-modal_add">
                                                        <option value="" disabled selected>Year</option>
                                                        <option>2016</option>
                                                        <option>2015</option>
                                                        <option>2014</option>
                                                        <option>2013</option>
                                                        <option>2013</option>
                                                        <option>2011</option>
                                                        <option>2010</option>
                                                        <option>2009</option>
                                                        <option>2008</option>
                                                        <option>2007</option>
                                                        <option>2006</option>
                                                        <option>2005</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2">
                                                    <select class="form-control"  name="month" id="month-modal_add">
                                                        <option value="" disabled selected>Month</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                        <option>11</option>
                                                        <option>12</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="description_add">Abstract</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="5" id="description_add" name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="Submit" class="btn btn-info"/>
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
 
</div>
