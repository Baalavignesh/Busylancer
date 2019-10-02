$(document).ready(function(){
        $("#email").keyup(function(){
        var value = $(this).val();
        if(value == ""){
            $("#emailStatus").html("This field cannot be empty !");
            isEverythingValid[0] = 0;
            console.log(0);
        }
        else{
            
            //ajax
            
            $.ajax({
                
                type:'POST',
                url:"includes/validate.php",
                data:"email="+value,
                
                success:function(msg){
                    if(msg == "Awesome!"){
                        isEverythingValid[0] = 1;
                    }
                    else{
                        isEverythingValid[0] = 0;
                        console.log(0);
                    }
                    $("#emailStatus").html(msg);
                }
                
            });
            
        }
    });

});


