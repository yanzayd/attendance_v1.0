var hostname = window.location.origin;
if($(location).attr('hostname')==='127.0.0.1'){ hostname = hostname + '/attendance_v1.0';}
hostname = hostname+"/ctrlUp";

$(function(){
  $('.SubmitUpdatePassword').on('click', function(){
    var cpassword                = $('#cpassword').val();
    var npassword                = $('#npassword').val();
    var repassword               = $('#repassword').val();
    if(cpassword!='' && npassword!='' && repassword!=''){
      if(npassword === repassword){
        $.ajax({
          url: hostname,
          type: "POST",
          data: {
            'user-current_password': cpassword,
            'user-password': npassword,
            'user-repassword': repassword,
            'webToken': '256',
            'request': 'user-update-password',
          },
          cache: false,
          success: function(dataResponse){
            var response = JSON.parse(dataResponse);
            if(response.status == 1){
              $('form#simpleForm').trigger("reset");
              $('form#simpleForm select').trigger("change");
              // $('.summernote1').summernote('reset');
              Swal.fire({
                title:"Notification Success!",
                text: response.message,
                type:"success",
                showCancelButton:!0,
                confirmButtonColor:"#556ee6",
                cancelButtonColor:"#f46a6a"
              });
            }
            else{
              $('form#simpleForm').trigger("reset");
              $('form#simpleForm select').trigger("change");
              // $('.summernote1').summernote('reset');
              Swal.fire({
                title:"Notification Error!",
                text: response.message,
                type:"error",
                showCancelButton:!0,
                confirmButtonColor:"#556ee6",
                cancelButtonColor:"#f46a6a"
              });
            }
        }
      });
    }
    else{
      Swal.fire({
        title:"Notification Error!",
        text: "Les deux Mots de Passe doivent correspondre!",
        type:"error",
        showCancelButton:!0,
        confirmButtonColor:"#556ee6",
        cancelButtonColor:"#f46a6a"
      });
    }
  }
  else{
    Swal.fire({
      title:"Notification Erreur!",
      text:"Mot de Passe actuel, nouveau, confirmation sont obligatoires!",
      type:"warning",
      showCancelButton:!0,
      confirmButtonColor:"#556ee6",
      cancelButtonColor:"#f46a6a"
    });
  }
  });
});


$(function(){
  $('.SubmitUpdateInformation').on('click', function(){
    var firstname           = $('#firstname').val();
    var lastname            = $('#lastname').val();
    var surname             = $('#surname').val();
    var email               = $('#email').val();
    var telephone           = $('#telephone').val();
    var address             = $('#address').val();
    if(firstname!='' && lastname!='' && email!='' && telephone!=''){
      $.ajax({
        url: hostname,
        type: "POST",
        data: {
          'user-firstname': firstname,
          'user-lastname': lastname,
          'user-surname': surname,
          'user-email': email,
          'user-telephone': telephone,
          'user-address': address,
          'webToken': '256',
          'request': 'user-update-user-information-profile',
        },
        cache: false,
        success: function(dataResponse){
          var response = JSON.parse(dataResponse);
          if(response.status == 1){
            // $('form#simpleForm').trigger("reset");
            // $('form#simpleForm select').trigger("change");
            // $('.summernote1').summernote('reset');
            $('#firstname').val(firstname);
            $('#lastname').val(lastname);
            $('#surname').val(surname);
            $('#email').val(email);
            $('#telephone').val(telephone);
            $('#address').val(address);
            Swal.fire({
              title:"Notification Success!",
              text: response.message,
              type:"success",
              showCancelButton:!0,
              confirmButtonColor:"#556ee6",
              cancelButtonColor:"#f46a6a"
            });
          }
          else{
            Swal.fire({
              title:"Notification Error!",
              text: response.message,
              type:"error",
              showCancelButton:!0,
              confirmButtonColor:"#556ee6",
              cancelButtonColor:"#f46a6a"
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
        confirmButtonColor:"#556ee6",
        cancelButtonColor:"#f46a6a"
      });
    }
  });
});
