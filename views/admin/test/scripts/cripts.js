var hostname = window.location.origin;
if($(location).attr('hostname')==='127.0.0.1'){ hostname = hostname + '/attendance_v1.0';}
hostname = hostname+"/ctrlUp";

$(function(){
  $('.SubmitRegister').on('click', function(){
    var code              = $('#code').val();
    var name              = $('#name').val();
    var date              = $('#date').val();
    if(code!='' && name!=''){
      $.ajax({
        url: hostname,
        type: "POST",
        data: {
          'class-code'   : code,
          'class-name'   : name,
          'class-date'   : date,
          'webToken': '256',
          'request': 'test-new',
        },
        cache: false,
        success: function(dataResponse){
          var response = JSON.parse(dataResponse);
          if(response.status == 1){
            $('form#simpleForm').trigger("reset");
            $('form#simpleForm select').trigger("change");
            $('.summernote1').summernote('reset');
            // Swal.fire({
            //   title:"Notification Success!",
            //   text: response.message,
            //   type:"success",
            //   showCancelButton:!0,
            //   confirmButtonColor:"#556ee6",
            //   cancelButtonColor:"#f46a6a"
            // });
            alert("DATA SUCCESSFULLY INSERTED!")
          }
          else{
            // Swal.fire({
            //   title:"Notification Error!",
            //   text: response.message,
            //   type:"error",
            //   showCancelButton:!0,
            //   confirmButtonColor:"#556ee6",
            //   cancelButtonColor:"#f46a6a"
            // });
            alert("SOME ERRORS OCCURED!")
          }
        }
      });
    }
    else{
      // Swal.fire({
      //   title:"Notification Erreur!",
      //   text:"Nom, Prenom, Genre, E-mail, Adresse et Telephone sont obligatoires!",
      //   type:"warning",
      //   showCancelButton:!0,
      //   confirmButtonColor:"#556ee6",
      //   cancelButtonColor:"#f46a6a"
      // });
      alert("Class Name and Code are required!")
    }
  });
});
