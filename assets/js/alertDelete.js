var dels = document.getElementsByClassName("sweeter");
for(var i = 0; i < dels.length ; i++){
  dels[i].addEventListener("click", alertDelete, false);
}

function alertDelete(e){
  e.preventDefault();
  var url = $(this).attr("href");
  swal({
    title: "Segur que el vols eliminar?",
    text: "No el podras recuperar després!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Si, elimina!",
    cancelButtonText: "No, espera!",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm){
    if(isConfirm){
      swal("Eliminat!", "", "success");
      window.setTimeout(function(){
        window.location.href = url;
      }, 1500);
      
    }else{
      swal("Cancelat", "", "error");
    }
  });
}