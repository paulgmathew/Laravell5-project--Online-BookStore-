    <div class="col-sm-2 sidenav" style="padding-top:0">
      <h2 class="margin-top-0">Search</h2>
      <form action="{{ route('searchBook') }}" method="post" class="form-horizontal" role="form">
        <div class="form-group">
          <div class="col-sm-12">
            <label class="control-label" for="bookid">Book ID:</label>
            <input type="text" class="form-control" name="bookid" id="bookid" placeholder="Book ID">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <label class="control-label" for="bookname">Book Name:</label>
            <input type="text" class="form-control" name="bookname" id="bookname" placeholder="Book Name">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <label class="control-label" for="author">author:</label>
            <input type="text" class="form-control" name="author" id="author" placeholder="auhor name">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <label class="control-label" for="publisher">publisher:</label>
            <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Publisher">
          </div>
        </div>
        <!--<div class="form-group">-->
        <!--  <div class="col-sm-12">-->
        <!--    <label for="item_type">type:</label>-->
        <!--    <select class="form-control" name="item_type" id="item_type">-->
        <!--        <option value="" disabled selected>Select your option</option>-->
        <!--        <option>New</option>-->
        <!--        <option>Used</option>-->
        <!--        <option>Rent</option>-->
        <!--    </select>-->
        <!--  </div>-->
        <!--</div>-->
        <div class="form-group">
          <div class="col-sm-12">
            <label for="item_category">Category:</label>
            <select class="form-control" name="item_category" id="item_category">
                <option value="" disabled selected>Select your option</option>
                <!--<option>1</option>-->
                <!--<option>2</option>-->
                <!--<option>3</option>-->
                <!--<option>4</option>-->
                @foreach($categories as $category)
                     <option id="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <label for="item_sort">Sort by:</label>
            <select class="form-control" name="item_sort" id="item_sort">
                <option value="" disabled selected>Select your option</option>
                <option>Book ID</option>
                <option>BookName</option>
            </select>
          </div>
        </div>
        
        <div class="form-group">        
          <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-default">Search</button>
          </div>
        </div>
        <input type="hidden" value="{{ Session::token() }}" name="_token"/>
      </form>
    </div>