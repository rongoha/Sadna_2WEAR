

$(document).ready(function(){
  var c = document.getElementById("termsAg");
    $("#confirm").click(function()
    {
      if(c.checked == true)
      {
        $("#confirm").hide();
        $("#editItem").hide();
        $("#termsAg").hide();
        $("#termsTxt").hide();
      }
    })
  });
  
  
 function confirmMes(){

  var c = document.getElementById("termsAg");
        
        if(c.checked == true)
        {
        alert("Thank you very much, your piece has been successfully published :)");
        }
      

        else{
        alert("Fill the required checkbox!")}

}

function avMes(){
  window.alert('Sorry, This page is not Available :(')
}







