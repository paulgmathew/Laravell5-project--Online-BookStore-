$(document).ready(function(){
    
$(".book").each(function(){
 
$("ul.pagination > li").css("display","inline");
   // alert("hi");
   //   $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("bookTitle",$(this).attr("bookTitle"));
   //   $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("authorName",$(this).attr("authorName"));
   //   $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("category",$(this).attr("category"));
   //   $('a.item[bookId="'+$(this).attr("bookId")+'"]').html($(this).attr("bookTitle"));
 //      $('a.item[bookId="'+$(this).attr("bookId")+'"]').parent().parent().find("#price").append(" Genre:"+$(this).attr("category"));
   //       $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("publisher",$(this).attr("publisher"));
  //    $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("pages",$(this).attr("pages"));
  //     $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("version",$(this).attr("version"));
   //    $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("titleimage",$(this).attr("titleimage"));
   //    $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("publishdate",$(this).attr("publishdate"));
       
 //         $('img.image[imageId*="'+$(this).attr("bookId")+'"]').attr("src","http://finalproject-paulgmathew.c9users.io/management/titleimage/"+$(this).attr("titleimage"));
       
   //     $('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("description",$(this).attr("description"));
        
         var num = parseInt($('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("quantity"));
      var num = parseInt($('a.item[bookId="'+$(this).attr("bookId")+'"]').attr("quantity"));
     
      if(num <=0)
      {
       $('a.item[bookId="'+$(this).attr("bookId")+'"]').parent().find("#oswarning").attr("display","block");
       
      }
});   
  
$(".options").each(function(){
 
 
 
 $('a.item[category="'+$(this).attr("categoryid")+'"]').attr("categoryname",$(this).attr("categoryname"));
 
});
    
 //   $("#checkOutLink").click(function(){
 //      //alert("Paul");
  //      $(".sidePanel").css("display","none");
   //     $(".mainPanel").css("display","none");
 //       var cart = getCookie("mycart");
       // alert(cart);
  //       $("#checkOut > ul").html(" ");
 //        $("#checkOut > ul").html(cart);
  //      $("#checkOut").css("display","block");
  //       total();
        
  //  });
    
    
    $(".item").click(function(){
     //   $("#bookDetail").css("display","block");
     $("#bookDetail").fadeIn("slow");
     
     $("td#title").html($(this).attr("bookTitle"));
         $("td#pages").html($(this).attr("pages"));
          $("td#version").html($(this).attr("version"));
          $("td#description").html($(this).attr("description"));
           $("td#category").html($(this).attr("categoryname"));
        $("td#title").html($(this).attr("bookTitle"));
        document.getElementById("author").innerHTML = $(this).attr("authorName");
        $("#bookDetail > #addToCart").attr("bookId",$(this).attr("bookId"));
        $("#bookDetail > #addToCart").attr("bookTitle",$(this).attr("bookTitle"));
         $("#bookDetail > #addToCart").attr("quantity",$(this).attr("quantity"));
          $("#bookDetail > #addToCart").attr("price",$(this).attr("price"));
           $("#bookDetail > #addToCart").attr("type",$(this).attr("type"));
             $("#bookDetail > #addToCart").attr("categoryname",$(this).attr("categoryname"));
            $("#bookDetail > #addToCart").attr("itemid",$(this).attr("itemid"));
            
  $("#bookDetail > #addToCart").attr("publisher",$(this).attr("publisher"));
   $("#bookDetail > #addToCart").attr("pages",$(this).attr("pages"));
   $("#bookDetail > #addToCart").attr("version",$(this).attr("version"));
   $("#bookDetail > #addToCart").attr("titleimage",$(this).attr("titleimage"));
   $("#bookDetail > #addToCart").attr("publishdate",$(this).attr("publishdate"));
    $("#bookDetail > #addToCart").attr("description",$(this).attr("description"));
         var quantity =parseInt ($(this).attr("quantity"));
         if(quantity < 100)
         {
       //   alert("low");
             
         }
    });
    
    $("#close").click(function(){
        
        $(this).parent().hide("slow",function(){
            $(this).css("display","none");
            
        });
        
        
        //css("display","none");
    });
   //////////////////////////////////////////////////////// 
  //  $("#addToCart").click(function(){
//        alert("add");
 //       checkChart();
  //     var book="<a>book</a>";
//       var cart = getCookie("mycart");
 //      var bookTitle = $(this).attr("bookTitle");
  //     var id = $(this).attr("bookid");
//       var quantity =parseInt ($(this).attr("quantity"));
 //      var type = $(this).attr("type");
  //     var price = $(this).attr("price");
//       var need = $(this).attr("need");
 //      var item = $(this).attr("itemid");
  //     if(quantity - need < 0)
//       {
 //       alert("not many books , choose fewer books");   
  //     }
//       else
 //      {
  //     cart = cart+'<li><div class="booksChecked" itemid ="'+item+'" quantity="'+quantity+'" id="'+id+'" title="'+bookTitle+'" quantity="'+quantity+'" type="'+type+'" price="'+price+'"  need="'+need+'">'+bookTitle+'<button id="db">Delete</button></div></li>';
//       setCookie("mycart",cart,1);
 //      }
//     
  //  }) ;  
    
/////////////////////////////////////////////    
    
    $("#deleteCookie").click(function(){
        $("div#checkOut > ul").html(" ");
        delete_c();
     //   $("booksChecked").each(function(){
       //     
      //     alert($(this).attr(id)); 
      //  });
      total();
    });
     
//      $(document).on("click","#db",function(){
//        $(this).parent().remove();
//        
 //        total();
 //          delete_c();
//          checkChart();
//           var cart = getCookie("mycart");
//          $(".booksChecked").each(function(){
//              alert(cart);
//               cart = cart+'<li><div class="booksChecked" itemid="'+$(this).attr("itemid")+'" price="'+$(this).attr("price")+'" type="'+$(this).attr("type")+'" quantity="'+$(this).attr("quantity")+'" id="'+$(this).attr("id")+'" title="'+$(this).attr("title")+'" need="'+$(this).attr("need")+'">'+$(this).attr("title")+'<button id="db" onClick="">Delete</button></div></li>'; 
//               setCookie("mycart",cart,1);
//          });
//         
//    });
    
    $("#need").change(function(){
       // alert($(this).val());
        $("#addToCart").attr("need",$(this).val());
        
        
       var quantity=parseInt($("#addToCart").attr("quantity"));
       var need = parseInt($(this).val());
       if(quantity - need < 300)
       {
        $("#oswarning2").style("display","block");
       }
        
    });
    
  
});
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function checkChart() {
    var user=getCookie("mychart");
    if (user != " ") {
       
    } else {
       if (user == "" && user == null) {
           setCookie("mycart", "", 1);
       }
    }
    
}
    
    function delete_c( name="mycart" ) {
  document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function total(){
var total = 0;    
     $(".booksChecked").each(function(){
            
            var price = parseInt($(this).attr("price"));
            var need =  parseInt($(this).attr("need"));
            
            total = total + price*need;
        });
        
    $("#total").val(total);
} 
