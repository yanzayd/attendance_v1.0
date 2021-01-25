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
            $('form#simpleForm').trigger("reset");
            $('form#simpleForm select').trigger("change");
            Swal.fire({
              title:"Notification Success!",
              text: response.message,
              type:"success",
              showCancelButton:!0,
              confirmButtonColor:"#218838",
              cancelButtonColor:"#dc3545"
            });
          }
          else{
            Swal.fire({
              title:"Notification Error!",
              text: response.message,
              type:"error",
              showCancelButton:!0,
              confirmButtonColor:"#2A3F54",
              cancelButtonColor:"#dc3545"
            });
          }
        }
      });
    }
    else{
      Swal.fire({
        title:"Notification Erreur!",
        text:"Nom, Prenom, Genre, E-mail, Adresse et Telephone sont obligatoires!",
        type:"warning",
        showCancelButton:!0,
        confirmButtonColor:"#2A3F54",
        cancelButtonColor:"#dc3545"
      });
    }
  });
});
// delete fuction
$(function(){
  $('.SubmitDelete').on('click', function(data){
    var id = $(this).attr('data-arg');
    if(id!=''){
    Swal.fire({
            title:"Etes-vous sur?",
            text:"Vous voulez supprimmer cette Eleve!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonText:"Oui, Supprimmer!",
            cancelButtonText:"No, Annuler!",
            confirmButtonClass:"btn btn-success mt-2",
            cancelButtonClass:"btn btn-danger ml-2 mt-2",
            buttonsStyling:!1
        })
        .then(function(t){
          if(t.value){
            $.ajax({
              url: hostname,
              type: "POST",
              data: {
                'student-id': id,
                'webToken': '256',
                'request': 'student-delete',
              },
              cache: false,
              success: function(dataResponse){
                var response = JSON.parse(dataResponse);
                if(response.status == 1){
                  $('#card-'+id+'').css('background-color', '#ccc');
                  $('#card-'+id+'').fadeOut('slow');
                  Swal.fire({
                    title:"Student Deleted!",
                    text:response.message,
                    type:"success"
                  });
                }
                else{
                  Swal.fire({
                    title:"Notification Error!",
                    text: response.message,
                    type:"error"
                  });
                }
              }
            });
          }else{
            t.dismiss===Swal.DismissReason.cancel&&Swal.fire({
              title:"Annulee",
              text:"Vous venez d'annuler cette operation.",
              type:"error"
            });
          }
        });
      }
  });
});
