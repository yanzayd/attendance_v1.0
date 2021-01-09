var hostname = window.location.origin;
if($(location).attr('hostname')==='127.0.0.1'){ hostname = hostname + '/attendance_v1.0';}
hostname = hostname+"/ctrlUp";

$(function(){
  $('.SubmitRegister').on('click', function(){
    var code                = $('#code').val();
    var firstname           = $('#firstname').val();
    var lastname            = $('#lastname').val();
    var email               = $('#email').val();
    var gender              = $('#gender').val();
    var birthday            = $('#birthday').val();
    var address             = $('#address').val();
    var qualification       = $('#qualification').val();
    var telephone           = $('#telephone').val();
    var religion            = $('#religion').val();
    var nationality         = $('#nationality').val();
    if(code!='' && email!=''){
      $.ajax({
        url: hostname,
        type: "POST",
        data: {
          'teacher-code':code,
          'teacher-firstname': firstname,
          'teacher-lastname': lastname,
          'teacher-email': email,
          'teacher-gender': gender,
          'teacher-birthday': birthday,
          'teacher-address': address,
          'teacher-qualification':qualification
          'teacher-telephone': telephone,
          'teacher-religion': religion,
          'teacher-nationality': nationality,
          'webToken': '256',
          'request': 'teacher-new',
        },
        cache: false,
        success: function(dataResponse){
          var response = JSON.parse(dataResponse);
          if(response.status == 1){
            $('form#simpleForm').trigger("reset");
            $('form#simpleForm select').trigger("change");
            // $('.summernote1').summernote('reset');
            // Swal.fire({
            //   title:"Notification Success!",
            //   text: response.message,
            //   type:"success",
            //   showCancelButton:!0,
            //   confirmButtonColor:"#556ee6",
            //   cancelButtonColor:"#f46a6a"
            // });
            alert('Success Operation!')
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
            alert('Errors Occured!')
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
      alert('Code, Email are required')
    }
  });
});
