$(function(){
    $(".nav a").on("click", function(){
	   $(".nav").find(".active").removeClass("active");
	   $(this).parent().addClass("active");
	});
	
    $(".itemid").mousedown(function(){
        //alert("The paragraph was clicked.");
        $("#show-item").show();
        $("#edit-item").hide();
        $("#modal-edit-btn").show();
        $("#modal-submit-btn").hide();
        //$("#modal-content-add").hide();
    });
    
    $("#modal-edit-btn").click(function(){
        $("#show-item").hide();
        $("#edit-item").show();
        $("#modal-edit-btn").hide();
        $("#modal-submit-btn").show();
    });
    
    $( "#itemdeleteform" ).submit(function( event ) {
		if(!confirm('Do you want to delete items?')){
	            event.preventDefault();
	        }
	});
    // $("#addbtn").click(function(){
    //     $("#modal-content-show").hide();
    //     $("#modal-content-edit").hide();
    //     $("#modal-content-add").show();
    // });
    
    $('#itemmodal').on('show.bs.modal', function(e){
        var itemid = $(e.relatedTarget).data('itemid');
        var price = $(e.relatedTarget).data('price');
    	var type = $(e.relatedTarget).data('type');
    	var quantity = $(e.relatedTarget).data('quantity');
    	$('#price-modal').val(price);
    	$('#type-modal').val(type);
    	$('#quantity-modal').val(quantity);
    	$('#price-modal_edit').val(price);
    	$('#type-modal_edit').val(type);
    	$('#quantity-modal_edit').val(quantity);
    	
        $("#edit_item_form").attr("action", "/management/update_item/" + itemid);
        var bookid = $(e.relatedTarget).data('books_id');
    	var bookname = $(e.relatedTarget).data('bookname');
    	var author_name = $(e.relatedTarget).data('author_name');
    	var publisher = $(e.relatedTarget).data('publisher');
    	var pages = $(e.relatedTarget).data('pages');
    	var version = $(e.relatedTarget).data('version');
    	var titleimage = $(e.relatedTarget).data('titleimage');
    	var publish_date = $(e.relatedTarget).data('publish_date');
    	var date_res = publish_date.split("-");
    	var year = date_res[0];
    	var month = date_res[1];
    	var description = $(e.relatedTarget).data('description');
    	var category = $(e.relatedTarget).data('category');
    	$('#bookid-modal').val(bookid);
    	$('#bookName-modal').val(bookname);
    	$('#author-modal').val(author_name);
    	$('#publisher-modal').val(publisher);
    	$('#pages-modal').val(pages);
    	$('#version-modal').val(version);
    	$('#year-modal').val(year);
    	$('#month-modal').val(month);
    	$('#description').val(description);
    	$('#category-modal').val(category);
    	$('#titleimage-modal').attr("src","titleimage/"+titleimage);
    	
    // 	$('#bookName-modal_edit').val(bookname);
    // 	$('#author-modal_edit').val(author_name);
    // 	$('#publisher-modal_edit').val(publisher);
    // 	$('#pages-modal_edit').val(pages);
    // 	$('#version-modal_edit').val(version);
    // 	$('#year-modal_edit').val(year);
    // 	$('#month-modal_edit').val(month);
    // 	$('#description_edit').val(description);
    // 	$('#category-modal_edit').val(category);
    });
    
    // function send(event){
    //       event.preventDefault();
    //       alert("lalala");
    //   }
      
    
    
    //searchBook_item =  function(event){
      //  event.preventDefault();
        //alert('lalala');
        /*$.ajax({
           type: "POST",
           url: "{{route(searchBook_item)}}",
           data: {bookid: $("#bookid-modal").val(), bookName: $("#bookName-modal").val(), _token:"{{ Session::token() }}"}
        })
        .done(function(data) {

				// log data to the console so we can see
				alert(data);
				console.log(data); 

				// here we will handle errors and validation messages
				/*if ( ! data.success) {

				} else {

				}*/
		//	}
       //     );
    //}
  
});