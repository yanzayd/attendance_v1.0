<?php
require '../core/init.php';

$form  = \UserController::updatePassword();
if(@$form->SUCCESS == true):
  Session::put('success','User information Updated successfully!');
else:
  Session::put('error', @$form->ERRORS_SCRIPT);
endif;

print_r($form);
 ?>
