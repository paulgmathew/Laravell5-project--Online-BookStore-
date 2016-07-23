$(function(){
	$(".nav a").on("click", function(){
	   $(".nav").find(".active").removeClass("active");
	   $(this).parent().addClass("active");
	});

    $(".bookid").click(function(){
        //alert("The paragraph was clicked.");
        $("#modal-content-show").show();
        $("#modal-content-edit").hide();
        $("#modal-content-add").hide();
        
        //$("#modal-items-edit").html($("#modal-content-show").html());
        //console.log("lalalala");
    });

    
    $("#modal-edit-btn").click(function(){
        $("#modal-content-show").hide();
        $("#modal-content-edit").show();
        $("#modal-content-add").hide();
        //alert("The paragraph was clicked.");
        //$("#modal-items-edit").html($("#modal-content-edit").html());
    });
    
    $("#addbtn").click(function(){
        $("#modal-content-show").hide();
        $("#modal-content-edit").hide();
        $("#modal-content-add").show();
        //alert("The paragraph was clicked.");
        //$("#modal-items-edit").html($("#modal-content-edit").html());
    });
    
        
    	//$("#7").click();

    
    $('#myModal').on('show.bs.modal', function(e){
    	var bookid = $(e.relatedTarget).data('book_id');
    	//.log(bookid);
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
    	$('#bookName-modal').val(bookname);
    	$('#author-modal').val(author_name);
    	$('#publisher-modal').val(publisher);
    	$('#pages-modal').val(pages);
    	$('#version-modal').val(version);
    	// if(titleimage!=null || titleimage!="")
    	// 	$('#titleimage-modal').attr("src", "{{ URL::to('book.image',['filename' =>'"+titleimage+"'])}}");
    	$('#year-modal').val(year);
    	$('#month-modal').val(month);
    	$('#description').val(description);
    	$('#category-modal').val(category);
    	$('#titleimage-modal').attr("src","titleimage/"+titleimage);
    	
    	$("#edit_book_form").attr("action", "/management/update_book/" + bookid);
    	$('#bookName-modal_edit').val(bookname);
    	$('#author-modal_edit').val(author_name);
    	$('#publisher-modal_edit').val(publisher);
    	$('#pages-modal_edit').val(pages);
    	$('#version-modal_edit').val(version);
    	// if(titleimage!=null || titleimage!="")
    	// 	$('#titleimage-modal_edit').attr("src", "{{ route('book.image',['filename' =>"+titleimage+"])}}");
    	$('#year-modal_edit').val(year);
    	$('#month-modal_edit').val(month);
    	$('#description_edit').val(description);
    	$('#category-modal_edit').val(category);
    	$('#titleimage-modal_edit').attr("src","titleimage/"+titleimage);
    });

	$( "#bookdeleteform" ).submit(function( event ) {
		if(!confirm('Do you want to delete books?')){
	            event.preventDefault();
	        }
	});


 //   $("#bookform").submit(function(e) {
 //   	e.preventDefault();
 //   	if(!confirm('Do you want to delete this book?')){
 //             e.preventDefault();
 //       }
	// });
    /*$("#deletBook").click(function() {
	  //alert( "Handler for .click() called." );
	  var bookids = new Array();
	  $("#booktbody").find(".checkbox").each(function(){
	    if ($(this).prop('checked')==true){ 
	        //alert("ID:"+$(this).parent().next().children('a').first().attr('id'));
	        bookids.push($(this).parent().next().children('a').first().attr('id'));
	    }
	  });
	  
	  if(bookids.length == 0){
	  	alert("You must select a book to delete");
	  }
	  else{
	  	var data = JSON.stringify(bookids);
	  	alert("OK:"+data);
	  	$.ajax({
	  		type: "POST",
	  		url: "{{route('delete_books')}}",
	  		data:data
	  	});
	  }
	});*/
    /**function delete(event){
    	event.preventDefault();
    	alert("lalala");
    	$("#booktbody").find("checkbox").each(function(){
		    if ($(this).prop('checked')==true){ 
		        alert("true");
		    }
		});*/
		
    // process the form
	/*$('form#year').submit(function(event) {
        
		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var formData = {
			'year' 				: $( "#myselect option:selected" ).text(),
            'lallaa'            : 'asdasd'
		};
		//alert(formData['lallaa']);
        //console.log(formData);
		// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'babyname.php', // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true
		})
			.done(function(data) {
            console.log(data);
				if ( ! data.success) {
					alert('oops! something happened');
				} else {
					alert("success!");
				}
			})
			.fail(function(data) {
				alert('oops! something happened');
			});

		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});*/
  
});