$(document).ready(function () {
    for (i=0;i<4;i++){
      esconder("#dato"+i);
    }
    
      $("#cerrar").click(function(){
       for (i=0;i<4;i++){
       esconder("#dato"+i);
       clearTimeout();
    }});
});
        


function esconder(x){
    $(x).hide();
}

 $(function(){
    $("#exitos").click(function(){
        setTimeout(function(){ $("#dato0").show(1000); }, 1000);
        setTimeout(function(){ $("#dato1").show(1000); }, 3000);
        setTimeout(function(){ $("#dato2").show(1000); }, 5000);
        setTimeout(function(){ $("#dato3").show(1000); }, 7000);
    })
   ;}
 );