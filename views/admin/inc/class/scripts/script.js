var hostname = window.location.origin;
if($(location).attr('hostname')==='127.0.0.1'){ hostname = hostname + '/attendance_v1.0';}
hostname = hostname+"/ctrlUp";

$(function(){
  $('.SubmitRegister').on('click', function(){
    var code            = $('#code').val();
    var section         = $('#section').val();
    var name            = $('#name').val();
    if(name!='' && section!=''){
      $.ajax({
        url: hostname,
        type: "POST",
        data: {
          'class-code': '00',
          'class-section': section,
          'class-name': name,
          'webToken': '256',
          'request': 'class-new',
        },
        cache: false,
        success: function(dataResponse){
          var response = JSON.parse(dataResponse);
          if(response.status == 1){
            $('form#simpleForm').trigger("reset");
            $('form#simpleForm select').trigger("change");
            $('.summernote1').summernote('reset');
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
            // alert(response.message);
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
      // alert("Class Name and section are required!");
    }
  });
});

$(function(){
  $('.SubmitEdit').on('click', function(){
    var id                    = $('#_ID').val();
    var code                  = $('#code').val();
    var name                  = $('#name').val();
    var section               = $('#section').val();
    if(amount!='' && motif!='' && date_depense!=''){
      $.ajax({
        url: hostname,
        type: "POST",
        data: {
          'class-id': id,
          'class-code': code,
          'class-name': name,
          'class-section': section,
          'webToken': '256',
          'request': 'class-edit',
        },
        cache: false,
        success: function(dataResponse){
          var response = JSON.parse(dataResponse);
          if(response.status == 1){
            $('form#simpleForm').trigger("reset");
            $('form#simpleForm select').trigger("change");
            $('.summernote1').summernote('reset');
            Swal.fire({
              title:"Notification Success!",
              text: response.message,
              type:"success",
              showCancelButton:!0,
              confirmButtonColor:"#556ee6",
              cancelButtonColor:"#f46a6a"
            });
            // alert('success');
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
            // alert('error');
          }
        }
      });
    }
    else{
      Swal.fire({
        title:"Notification Erreur!",
        text:"Motif, Montant et Date de la Depense sont obligatoires!",
        type:"warning",
        showCancelButton:!0,
        confirmButtonColor:"#556ee6",
        cancelButtonColor:"#f46a6a"
      });
      // alert('erreurkkk');
    }
  });
});

$(function(){
  $('.SubmitDelete').on('click', function(data){
    var id = $(this).attr('data-arg');
    if(id!=''){
      // alert('voulez vous supprimer??');
    Swal.fire({
            title:"Etes-vous sur?",
            text:"Vous voulez supprimmer cette class!",
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
                'class-id': id,
                'webToken': '256',
                'request': 'class-delete',
              },
              cache: false,
              success: function(dataResponse){
                var response = JSON.parse(dataResponse);
                if(response.status == 1){
                  $('tr#'+id+'').css('background-color', '#ccc');
                  $('tr#'+id+'').fadeOut('slow');
                  $('tr#'+id).remove();
                  Swal.fire({
                    title:"Cotisation Approuvee!",
                    text:response.message,
                    type:"success"
                  });
                  // alert('success');
                }
                else{
                  Swal.fire({
                    title:"Notification Error!",
                    text: response.message,
                    type:"error"
                  });
                  // alert('error');
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
