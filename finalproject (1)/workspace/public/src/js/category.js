$(function(){
    $('button[id^="modify_category-"]').click(function() {
      //alert( this.id +"Handler for .click() called." );
      if($(this).html()=='Modify'){
          var inputtxt = $(this).parent().prev().prev().children(0);
          //alert(inputtxt.val());
          inputtxt.removeAttr("readonly");
          
          $(this).attr('class','btn btn-success');
          $(this).html('Update');
          
          
          
          
          
      }
      else{
        
        $(this).on("click", updatecategory(event));

          $(this).attr('class','btn btn-warning');
          $(this).html('Modify');
      }
      
      
      
    });
    
    $( "#categorydeleteform" ).submit(function( event ) {
		if(!confirm('Do you want to delete categories?')){
	            event.preventDefault();
	        }
	});
   
});