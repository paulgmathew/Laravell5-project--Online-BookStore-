 @extends('layouts.master')
@section('content')
   <div id="checkOut">
  	    <ul>
  	  	@foreach($order as $book )
  	  	
  	   @endforeach
  	    </ul>
  	     <div>
  	Pay $<input id ="total" value=""></input>
  </div>
  	<button id="wholebuy" onclick="send(event)">Buy</button>
  	<button id="deleteCookie">delete</button>
  	<input type="hidden" value="{{Session::token()}}" name="_token"/>
  	
  </div>
  <script>
  $("document").ready(function(){
      total();
      
       $(document).on("click","#db",function(){
       
      var orderid = $(this).parent().attr("orderid");
      alert(orderid);
      	$.ajax({
  			type:"POST",
  			url:"{{route('deleteOrder')}}",
 			data:{orderid:orderid,_token:"{{Session::token()}}"},
  			}).done(function(data) {
    			// log data to the console so we can see
				alert(data);
				console.log(data); 
            });
      $(this).parent().remove();
       total();
      //$("#checkOut > ul").append("<li>"+$(this).attr("bookTitle") +"</li>");
       // $("#checkOut > ul").append(cart);
    });
    
    $(document).on("click","#buy",function(){
       
      var orderid = $(this).parent().attr("orderid");
       var itemid = $(this).parent().attr("itemid");
        var need = $(this).parent().attr("need");
      alert(orderid);
      	$.ajax({
  			type:"POST",
  			url:"{{route('buyOrder')}}",
 			data:{orderid:orderid,itemid:itemid,need:need,_token:"{{Session::token()}}"},
  			}).done(function(data) {
    			// log data to the console so we can see
				alert(data);
				console.log(data); 
            });
      $(this).parent().remove();
       total();
      //$("#checkOut > ul").append("<li>"+$(this).attr("bookTitle") +"</li>");
       // $("#checkOut > ul").append(cart);
    });
    
      $(document).on("click","#wholebuy",function(){
       alert("wholebuy");
       $(".booksChecked").each(function(){
      var orderid = $(this).attr("orderid");
        var itemid = $(this).attr("itemid");
        var need = $(this).attr("need");
      alert(orderid);
      	$.ajax({
  			type:"POST",
  			url:"{{route('buyOrder')}}",
 				data:{orderid:orderid,itemid:itemid,need:need,_token:"{{Session::token()}}"},
  			}).done(function(data) {
    			// log data to the console so we can see
				alert(data);
				console.log(data); 
            });
      $(this).remove();
       total();
      //$("#checkOut > ul").append("<li>"+$(this).attr("bookTitle") +"</li>");
       // $("#checkOut > ul").append(cart);
       });
    });
      
      
      
  });
  </script>
  @endsection