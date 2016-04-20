var dels = document.getElementsByClassName("sweeter");
for(var i = 0; i < dels.length ; i++){
  dels[i].addEventListener("click", alertCancel, false);
}

function alertCancel(e){
  e.preventDefault();
  var url = $(this).attr("href");
  swal({
    title: "Exit without save the changes?",
    text: "You will lost the settings!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, cancel!",
    cancelButtonText: "No, wait!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm){
    if(isConfirm){
      swal("Canceled!", "", "success");
      window.setTimeout(function(){
        window.location.href = url;
      }, 1500);
    }else{
      swal("Good decision!", "", "success");
    }
  });
}