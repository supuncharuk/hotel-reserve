$(document).ready(function(){ 
    $("#saveButton").click(function(){
      // Check if any input fields or select items are empty
      var isEmpty = false;
      $("input, select").each(function(){
        if($(this).val() === ''){
          isEmpty = true;
          return false; // Exit the loop if any field is empty
        }
      });
  
      if(isEmpty){
        $('#verticalyCentered').modal('hide');
      }
    });
});