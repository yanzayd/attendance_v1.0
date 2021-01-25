<?php
require '../core/init.php';

// $_POST['student-rollnumber']      = "201810763";
// $_POST['student-card_id']         = 93213089;
// $_POST['student-firstname']       = "bedel";
// $_POST['student-lastname']        = 'yan';
// $_POST['student-surname']         = "bin";
// $_POST['student-email']           = 'becdely@gmail.com';
// $_POST['student-gender']          = "Male";
// $_POST['student-address']         = 'Goma';
// $_POST['student-classes']         = 'Year3CS';
// $_POST['student-nationality']     = "Congolaise";
// $_POST['student-birthday']        = '1999-03-02';
// $_POST['student-mothername']      = "rachel";
// $_POST['student-fathername']      = 'faustain';
// $_POST['student-responsable_phone'] = "+250782287842";
// $_POST['student-religion']          = 'Christian';
//
// $_POST['teacher-code']            = "280101032";
// $_POST['teacher-firstname']       = "Yan";
// $_POST['teacher-lastname']        = 'Zayd';
// $_POST['teacher-email']           = 'usooy@gmail.com';
// $_POST['teacher-gender']          = "Male";
// $_POST['teacher-address']         = 'Bkv';
// $_POST['teacher-nationality']     = "Congolaise";
// $_POST['teacher-qualification']   = "phd";
// $_POST['teacher-telephone']       = "+2439997600";
// $_POST['teacher-birthday']        = "1999-08-06";
// $_POST['teacher-religion']        = "muslim";


// $_POST['class-section']  = "m";
// $_POST['class-code']  = "999";
// $_POST['class-id']  = Hash::encryptToken(1);
//
// $_POST['webToken'] = 256;
// $_POST['request']  = 'student-new';

if(Input::checkInput('request', 'post', 1) && Input::checkInput('webToken', 'post', 1)):
  switch (Input::get('request', 'post')):

    case 'class-new':
      $form = \ClassesController::add();
      if($form->ERRORS == false):
        $response['status']  = 1;
        $response['message']  = 'Operation success!';
      else:
        $response['status']  = 0;
        $response['message'] = $form->ERRORS_SCRIPT;
      endif;
    break;

    case 'class-delete':
      $form = \ClassesController::delete();
      if($form->ERRORS == false):
        $response['status']  = 1;
        $response['message']  = 'Operation success!';
      else:
        $response['status']  = 0;
        $response['message'] = $form->ERRORS_SCRIPT;
      endif;
    break;

    case 'class-update':
      $form = \ClassesController::updateInformation();
      if($form->ERRORS == false):
        $response['status']  = 1;
        $response['message']  = 'Operation success!';
      else:
        $response['status']  = 0;
        $response['message'] = $form->ERRORS_SCRIPT;
      endif;
    break;

    case 'student-new':
      $form = \StudentController::add();
      if($form->ERRORS == false):
        $response['status']   = 1;
        $response['message']  = 'Operation success!';
      else:
        $response['status']   = 0;
        $response['message']  = $form->ERRORS_SCRIPT;
      endif;
    break;

    case 'teacher-new':
      $form = \TeacherController::add();
      if($form->ERRORS == false):
        $response['status']   = 1;
        $response['message']  = 'Operation success!';
      else:
        $response['status']   = 0;
        $response['message']  = $form->ERRORS_SCRIPT;
      endif;
    break;


    case 'student-delete':
      $form = \StudentController::delete();
      if($form->ERRORS == false):
        $response['status']  = 1;
        $response['message']  = 'Operation success!';
      else:
        $response['status']  = 0;
        $response['message'] = $form->ERRORS_SCRIPT;
      endif;
    break;

    case 'student-update':
      $form = \StudentController::update();
      if($form->ERRORS == false):
        $response['status']  = 1;
        $response['message']  = 'Operation success!';
      else:
        $response['status']  = 0;
        $response['message'] = $form->ERRORS_SCRIPT;
      endif;
    break;

  endswitch;

  echo json_encode($response);
endif;
  ?>
