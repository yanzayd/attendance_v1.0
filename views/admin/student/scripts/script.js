var hostname = window.location.origin;
if($(location).attr('hostname')==='127.0.0.1'){ hostname = hostname + '/attendance_v1.0';}
hostname = hostname+"/ctrlUp";

$(function(){
  $('.SubmitRegister').on('click', function(){
    // var rollnumber          = $('#rollnumber').val();
    var card_id             = $('#card_id').val();
    var firstname           = $('#firstname').val();
    var lastname            = $('#lastname').val();
    var surname             = $('#surname').val();
    var email               = $('#email').val();
    var gender              = $('#gender').val();
    var address             = $('#address').val();
    var classes             = $('#classes').val();
    var nationality         = $('#nationality').val();
    var birthday            = $('#birthday').val();
    var mothername          = $('#mothername').val();
    var fathername          = $('#fathername').val();
    var responsable_phone   = $('#responsable_phone').val();
    var religion            = $('#religion').val();
    if( firstname!='' && lastname!='' && email!='' && gender!=''  && classes!='' && responsable_phone!=''){
      $.ajax({
        url: hostname,
        type: "POST",
        data: {
          'student-rollnumber': '00',
          'student-card_id': card_id,
          'student-firstname': firstname,
          'student-lastname': lastname,
          'student-surname': surname,
          'student-email': email,
          'student-gender': gender,
          'student-address': address,
          'student-classes': classes,
          'student-nationality': nationality,
          'student-birthday': birthday,
          'student-mothername': mothername,
          'student-fathername': fathername,
          'student-responsable_phone': responsable_phone,
          'student-religion': religion,
          'webToken': '256',
          'request': 'student-new',
        },
        cache: false,
        success: function(dataResponse){
          var response = JSON.parse(dataResponse);
          if(response.status == 1){
            alert("DATA SUCCESSFULLY INSERTED!");
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
            alert(response.message);
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
      alert("firstname, lastname, email, gender, classes, and responsable_phone are required!")
    }
  });
});
