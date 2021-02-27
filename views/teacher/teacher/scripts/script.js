var hostname = window.location.origin;
if($(location).attr('hostname')==='127.0.0.1'){ hostname = hostname + '/attendance_v1.0';}
hostname = hostname+"/ctrlUp";

$(function(){
  $('.SubmitRegister').on('click', function(){
    // var code                = $('#code').val();
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

    if(firstname!='' && lastname!='' && qualification!='' && gender!=''  && email!=''){
      $.ajax({
        url: hostname,
        type: "POST",
        data: {
          'teacher-code': '00',
          'teacher-firstname': firstname,
          'teacher-lastname': lastname,
          'teacher-email': email,
          'teacher-gender': gender,
          'teacher-birthday': birthday,
          'teacher-address': address,
          'teacher-qualification': qualification,
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
        text:"Firstname, Lastname, Surname, E-mail, Qualification, Address et Telephone sont obligatoires!",
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
            text:"Vous voulez supprimmer cette Enseignant!",
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
                'teacher-id': id,
                'webToken': '256',
                'request': 'teacher-delete',
              },
              cache: false,
              success: function(dataResponse){
                var response = JSON.parse(dataResponse);
                if(response.status == 1){
                  $('#card-'+id+'').css('background-color', '#ccc');
                  $('#card-'+id+'').fadeOut('slow');
                  Swal.fire({
                    title:"Teacher Deleted!",
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
