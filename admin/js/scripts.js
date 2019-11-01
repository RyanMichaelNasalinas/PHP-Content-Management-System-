  //Check all the check boxes for bulk changes
$(document).ready(function(){
    $('#check_all_boxes').click(function(){
       
        if(this.checked){
           $('.checkBoxes').each(function(){
              this.checked = true;
               
           });

           } else{
                $('.checkBoxes').each(function(){
              this.checked = false;
               
           });

           }
        
    });
//    var div_loading = "<div id='load-screen'><div id='loading'></div></div>";
//    
//    $("body").prepend(div_loading);
//    
//    $("#load-screen").delay(700).fadeOut(600, function(){
//        $(this).remove(); 
//    });
    
    $("[data-toggle='tooltip']").tooltip(); 
   
});


    
function sendUserOnline() {
    $.get('functions.php?onlineusers=result', function(data){ 
       $('.useronline').text(data);
    });
}
    
    setInterval(function(){
        sendUserOnline();
    }, 500);
    
    