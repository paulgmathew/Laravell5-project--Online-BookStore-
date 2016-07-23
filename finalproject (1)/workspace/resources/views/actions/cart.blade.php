  @extends('layouts.master')
@section('content')
   <div id="checkOut">
  	    <ul>
  	   
  	    		@foreach($order as $order)
			<li><div id="{{$order->id}}" style="position:relative;float:left;border:1px solid #dedede;height:280px;width:200px;margin:5px;border-radius:5px">
                <div class="image" style="postion:relative;float:left;border:1px solid #dededf;width:94%;height:50%;margin:3%"><img class="image"  imageId="{{$order->id}}" src="{{ route('book.image',['filename' => $order->titleimage ])}}" width=100% style="height: 123px;" alt="image"></img></div>
				<div style="position:relative;float:left;width:94%;margin:3px"><div orderid="{{$order->id}}" class="booksChecked" itemid ="{{$order->item_id}}" imgsrc="{{$order->titleimage}}" quantity="{{$order->quantity}}" title="{{$order->bookname}}" type="{{$order->type}}" price="{{$order->price}}"  need="{{$order->need}}">{{$order->bookname}}<button id="buy">Buy</button><button id="db">Delete</button></div>
					</div>
				<div id="oswarning" style="position:relative;float:left;width:94%;padding-left: 3px;font-size: small;color:red;display:none" >Out of Stock</div>
				<div id="os1warning" style="position:relative;float:left;width:94%;padding-left: 3px;font-size: small;color:red;display:none" >Very Few</div>
				<div id="price" style="position:relative;float:left;padding-left: 3px;font-size: small;" >Price:${{$order->price}}</div>
					<div id="quantity" style="position:relative;float:left;padding-left: 3px;font-size: small;width:100%" >Quantity:<input class="needValue" style="font-size:small;height:25px;width:40px;" id="bookNeed" value="{{$order->need}}"></input></div>
			</div>
		</li>
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
    $("ul.pagination > li").css("display","inline");
   var check = 0;
      total();
      warnings();
      
        $(".needValue").focusout(function(e) {
         //alert("hi");
          $(this).parent().parent().find(".booksChecked").attr("need",$(this).val());  
           total();
           warnings();
       });     
       $(document).on("click","#db",function(){
       
      var orderid = $(this).parent().attr("orderid");
     // alert(orderid);
      	$.ajax({
  			type:"POST",
  			url:"{{route('deleteOrder')}}",
 			data:{orderid:orderid,_token:"{{Session::token()}}"},
  			}).done(function(data) {
    			// log data to the console so we can see
				alert(data);
				console.log(data); 
            });
      $('div[id="'+orderid+'"]').remove();
       total();
      //$("#checkOut > ul").append("<li>"+$(this).attr("bookTitle") +"</li>");
       // $("#checkOut > ul").append(cart);
    });
    
    $(document).on("click","#buy",function(){
       
      var orderid = $(this).parent().attr("orderid");
       var itemid = $(this).parent().attr("itemid");
        var need = parseInt($(this).parent().attr("need"));
         var quantity =parseInt($(this).parent().attr("quantity"));
         if(quantity == 0)
         {
          alert("This book is out of stock");
         }
         else if(quantity - need <=0  ){
          alert("Not much book in the stock");
         }
         else{
     // alert(orderid);
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
         }
    });
    
      $(document).on("click","#wholebuy",function(){
       //alert("wholebuy");
       if(check == 1)
       {
        alert("Some books are out of stock");
       }
       else if(check == 2)
       {
        alert("Some books are very few , check the warning ");
        
       }
       else{
       $(".booksChecked").each(function(){
      var orderid = $(this).attr("orderid");
        var itemid = $(this).attr("itemid");
        var need = $(this).attr("need");
      //alert(orderid);
      var succ =0;
      	$.ajax({
  			type:"POST",
  			url:"{{route('buyOrder')}}",
 				data:{orderid:orderid,itemid:itemid,need:need,_token:"{{Session::token()}}"},
  			}).done(function(data) {
    			// log data to the console so we can see
				alert(data);
				if(data =="success")
				{
				 succ = succ + 1;
				}
				console.log(data); 
            });
            if(succ > 0)
            {
             alert("success");
            }
      $(this).remove();
      $('div[id="'+orderid+'"]').remove();
    //  $(this).parent().parent().parent().remove();
       total();
      //$("#checkOut > ul").append("<li>"+$(this).attr("bookTitle") +"</li>");
       // $("#checkOut > ul").append(cart);
       });
       }
    });
      
      
      
  });
  function warnings(){
   $(".booksChecked").each(function(){
    var need = parseInt($(this).attr('need'));
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
   
   if(quantity - need <= 0)
   {
    check = 2;
    $(this).parent().parent().find("#os1warning").fadeIn();
   // $(".booksChecked").parent().parent().find("#oswarning").fadeIn()
   }
   else{
     $(this).parent().parent().find("#oswarning").fadeOut();
   }
  //  alert(need);
  //  alert(quantity);
    
   });
  }
  </script>
  @endsection