
<div class="sidePanel" style="display:block">
	
	  <div id="types"><ul>
	     <li><div class="typeItem"><a class="options" categoryid="0">All</a></div></li>
	  	@foreach($category as $category )
		<li><div class="typeItem">	<a class="options" categoryid="{{$category->id}}" categoryname="{{$category->category_name}}">{{$category->category_name}} </a></div></li>
				@endforeach
	  </ul></div>
	</div>

	
		<div class="mainPanel" style="display:block">
			<ul>
				@foreach($items as $item)
			<li><div class="divitem" style="position:relative;float:left;border:1px solid #dedede;height:250px;width:200px;margin:5px;border-radius:5px">
  <div class="" style="postion:relative;float:left;border:1px solid #dededf;width:94%;height:50%;margin:3%"><img class="image"  imageId="{{$item->id}}" src="{{ route('book.image',['filename' => $item->titleimage ])}}" width=100% style="height: 123px;" alt="image"></img></div>
  		<div style="position:relative;float:left;width:94%;margin:3px"><a class="item" authorName = "{{$item->author_name}}"category="{{$item->category}}" publisher="{{$item->publisher}}" bookTitle="{{$item->bookname}}" pages="{{$item->pages}}" version="{{$item->version}}" titleimage="{{$item->titleimage}}" publishdate="{{$item->publish_date}}" itemid="{{$item->items_id}}" description="{{$item->description}}" bookId="{{$item->books_id}}" quantity="{{$item->quantity}}" type = "{{$item->type }}" price="{{$item ->price}}">{{$item->bookname}}</a></div>
				<div id="oswarning" style="position:relative;float:left;width:94%;padding-left: 3px;font-size: small;color:red;display:none" >Out of Stock</div>
				<div id="price" style="position:relative;float:left;padding-left: 3px;font-size: small;" >Price:${{$item ->price}}</div>
				
				</div><li>
			 @endforeach
			       
			      
			      	
			       	</ul>
			     <div id="pagination" style="background-color: #dedede;
    border: 1px solid #dedede;
    border-radius: 6px;
    bottom: 10px;
    float: left;
    height: 30px;
    margin-left: auto;
    position: absolute;
    right: 50%;
    width: 78px;">  	{!! $items->links() !!}</div>
				<div id="bookDetail">
				<div id="close"></div>	
				<table>
					<tr><td>Title:</td><td id="title"></td><tr>
					<tr><td>Author:</td><td id="author"></td><tr>
					<tr><td>Category:</td><td id="category"></td><tr>
				    <tr><td>Pages:</td><td id="pages"></td><tr>
					<tr><td>Version:</td><td id="version"></td><tr>
					<tr><td>Description:</td><td id="description"></td><tr>	
				</table>
				<div>Quantity <select id="need" ><option value="1" selected>1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option><option value="1">4</option>
				<option value="5">5</option>  
				</select></div>
					<div id="oswarning2" style="position:relative;float:left;width:94%;padding-left: 3px;font-size: small;color:red;display:none" >Product Discontinued</div>
				<div class="error"></div>
				<div id="addToCart" bookId="" bookTitle="" authorName="" quantity="" bookTitle="" price="" type="" need="1"></div>
				</div>
					
  </div>

  <div id="checkOut" style="display:none">
  	    <ul>
  	    	
  	    	
  	    	
  	    </ul>
  	     <div>
  	Pay $<input id ="total" value=""></input>
  </div>
  	<button type="submit" onclick="send(event)">Buy</button>
  	<button id="deleteCookie">delete</button>
  	<input type="hidden" value="{{Session::token()}}" name="_token"/>
  	
  </div>
 
  <script>
  	function send(event)
  	{
  		event.preventDefault();
  //		alert("ajax");
  		$(".booksChecked").each(function(){
  				$.ajax({
  			type:"POST",
  			url:"{{route('checkOutAction')}}",
 			data:{itemid:$(this).attr('itemid'),type:$(this).attr('type'),quantity:$(this).attr('need'),_token:"{{Session::token()}}"},
  			}).done(function(data) {
    			// log data to the console so we can see
			//	alert(data);
				console.log(data); 
            });
  			
  		});
  			
  		
  		
  	
  		
  	}
  	$(document).ready(function(){
  	 $("ul.pagination > li").css("display","inline");
  	  warnings();
    $("#addToCart").click(function(){
     //   alert("add");
        checkChart();
       var book="<a>book</a>";
       var bookTitle = $(this).attr("bookTitle");
       var id = $(this).attr("bookid");
       var quantity =parseInt ($(this).attr("quantity"));
       var type = $(this).attr("type");
       var price = $(this).attr("price");
       var needd = $(this).attr("need");
       var item = $(this).attr("itemid");
       if(quantity - need < 0)
       {
        //alert("not many books , choose fewer books");   
       }
       else
       {
      	$.ajax({
  			type:"POST",
  			url:"{{route('checkOutAction')}}",
 			data:{itemid:item,need:needd,_token:"{{Session::token()}}"},
  			}).done(function(data) {
    			// log data to the console so we can see
				alert(data);
				console.log(data); 
            });
       }
      //$("#checkOut > ul").append("<li>"+$(this).attr("bookTitle") +"</li>");
       // $("#checkOut > ul").append(cart);
    });
    
      
     $(".typeItem").click(function(){
     var categoryid = parseInt($(this).find(".options").attr("categoryid"));
     
     $(".divitem").find(".item").each(function(){
     var cat = $(this).attr("category");
     //	alert(cat);
     if(categoryid != cat)
     {
     		$(this).parent().parent().fadeOut();
     }
     else
     {
     		$(this).parent().parent().fadeIn();
     }
     if(categoryid == 0)
     {
        $(this).parent().parent().fadeIn(); 
     }
     	
     });
     });
     
      $("#search").click(function(){
     var val = $("#searchInput").val();
     //alert(val);
        $(".divitem").fadeOut();
      if(val == "")
      {
           $(".divitem").fadeIn();
      }
    $(".divitem").find('.item[booktitle*="'+val+'"]').each(function(){
  
     		$(this).parent().parent().fadeIn();
     	
 });
     
     });
  
 
  	});
  	
  	 
  function warnings(){
   $(".item").each(function(){
    //var need = parseInt($(this).attr('need'));
    var quantity = parseInt($(this).attr('quantity'));
    if(quantity == 0)
   {
    check = 1;
    $(this).parent().parent().find("#oswarning").fadeIn();
   }
   else
   {
     $(this).parent().parent().find("#oswarning").fadeOut();
   }
   
    
   });
  }
  
  
  </script>
  
<!--  <div id="name" value="{{$val = Cookie::get('name')}}"><div>-->
