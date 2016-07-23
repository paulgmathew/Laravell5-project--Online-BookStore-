@extends('layouts.master_admin')

@section('styles')
<link rel="stylesheet" href="{{ URL::secure('src/css/sidebar.css')}}" />
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::secure('src/js/category.js') }}"></script>
@endsection
@section('navbarli')
        <li><a href="{{ route('managementaction',['action'=> 'dashboard']) }}">Dashboard</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'bookmanager']) }}">Book Management</a></li>
        <li><a href="{{ route('managementaction',['action'=> 'itemmanager']) }}">Item Management</a></li>
        <li class="active"><a href="{{ route('managementaction',['action'=> 'categorymanager']) }}">Category Management</a></li>
@endsection
@section('content')

<div class="container-fluid contentcontainer">
  <div class="row content">
      
    
    <div class="col-sm-12">

        <form action="{{ route('delete_category') }}" id="categorydeleteform" method="post">

        <div class="row right-content">
            <h2 class = "margin-top-0">Category Management</h2>
            <p>The general category information will be listed in the following table. Click the Category ID if you want to see details or edit the category.</p>                                                                                      
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
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>update Time</th>
                    <th>Modify</th>
                  </tr>
                </thead>
                <tbody id="booktbody">
                  @foreach($categories as $action)
                  <tr>
                    <td class = "check-pos"><input type="checkbox" class="checkbox" name="checked[]" value="{{$action->id}}"></td>
                    <td>{{$action->id}}</td>
                    <td><input type="text" class="form-control" id="category_name-{{$action->id}}"  value="{{$action->category_name}}" readonly="readonly"></td>
                    <td>{{$action->updated_at}}</td>
                    <td><button type="button" id='modify_category-{{$action->id}}' class="btn btn-warning">Modify</button></td>
                    <input type="hidden" value="{{ Session::token() }}" name="_token"/>
                  </tr>
                   @endforeach
                </tbody>
                
              </table>
              <div class="col-sm-12 center">
                {!! $categories->links() !!}
              </div>
              
            </div>
            <div>
                
            </div>

        </div><hr>
        
        <div class="row right-content">
            <div class="col-sm-6">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myAddcategoryModal" id="addbtn">Add new category</button>
            </div>
            <div class="col-sm-offset-4 col-sm-2">
                <button type="submit" id='delete_category' class="btn btn-danger">Delete Categories</button>
            </div>
            <input type="hidden" value="{{ Session::token() }}" name="_token"/>
        </div>
        
        </form>
        
        
        
        
                <div class="modal fade" id="myAddcategoryModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content" id="modal-items-edit">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Add Category</h4>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('add_category') }}" method="post" id="addcategory_form" class="form-horizontal" role="form" >
                      <div class="form-group">
                          <label class="control-label col-sm-4" for="categoryName-modal_add">Category Name</label>
                          <div class="col-sm-8">
                              <input type="text" class="form-control" name="categoryName" id="categoryName-modal_add" placeholder="Enter category name">
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
  
  <script type="text/javascript">
    function updatecategory(event){
          event.preventDefault();
          var categoryid1 = event.target.id;
          var pieces = categoryid1.split('-');
          var id = pieces[pieces.length-1];
          var categoryname1 = event.target.parentElement.previousElementSibling.previousElementSibling.firstChild.value;
          //var categoryname = (event.target).parent().prev().prev().children(0).val();
          //console.log(id + "   "+categoryname1);
        
          $.ajax({
          type: "POST",
          url: "{{ route('update_category') }}",
          data: {categoryid: id, categoryName: categoryname1, _token: "{{ Session::token() }}"}
            })
            .done(function(data) {
              console.log(data);
              $("#category_name-"+id).attr('readonly', true);
            });
        
        
        
        

      }
  </script>

</div>