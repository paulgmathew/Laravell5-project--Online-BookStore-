 @extends('layouts.master')
@section('content')
<div>Purchase details</div>
   <div id="checkOut" style="border:2px solid #85ADAD;
  border-radius:8px;
  float:left;
  height:97%;
  margin-left:48px;
  overflow:auto;
  position:relative;
  width:91%;">
  	    <ul>
  	     
  	    	@foreach($order as $order )
  	 	<li><div class="historyBook" style="position:relative;float:left;border:1px solid #dedede;height:250px;width:200px;margin:5px;border-radius:5px">
                <div class="image" style="postion:relative;float:left;border:1px solid #dededf;width:94%;height:50%;margin:3%"><img class="image"  imageId="{{$order->id}}" src="{{ route('book.image',['filename' => $order->titleimage ])}}" width=100% style="height: 123px;" alt="image"></img></div>
				<div style="position:relative;float:left;width:94%;margin:3px"><div class="book" orderid="{{$order->id}}" book_status="{{$order->book_status}}" order_date="{{$order->order_date}}" class="booksChecked" itemid ="{{$order->item_id}}" quantity="{{$order->quantity}}" title="{{$order->bookname}}" type="{{$order->type}}" price="{{$order->price}}"  need="{{$order->need}}">{{$order->bookname}}</div>
				</div>
				<div id="oswarning" style="position:relative;float:left;width:94%;padding-left: 3px;font-size: small;color:red;display:none" >Out of Stock</div>
				<div id="oswarning1" style="position:relative;float:left;width:94%;padding-left: 3px;font-size: small;color:red;display:none" >Product Discontinued</div>
				<div id="price" style="position:relative;float:left;padding-left: 3px;font-size: small;" >Bought on:{{$order->order_date}}</div></div>
		</li>
  	   @endforeach
  	   
  	    </ul>
  </div>
 
  
  <script>
      $(document).ready(function(){
         // alert("hi");
          $(".historyBook").each(function(){
            var status= $(this).find(".book").attr("book_status");
              if(status =="0")
              {
                  $(this).find("#oswarning1").css("display","block");
                  
              }
              var quantity= parseInt($(this).find(".book").attr("quantity"));
              if(quantity <= 0)
              {
                  $(this).find("#oswarning").css("display","block");
                  
              }
              
          });
          
      });
      
  </script>
   @endsection