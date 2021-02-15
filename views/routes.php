<?php
$sub_  = 'inc/';

require $main_.$sub_.'header'.PL;

if('admin/'==$main_):
  switch ($url_struc['tree']):
    case '':
      $sub_ = 'home/';
      require($main_.$sub_.'dashboard'.PL);
    break;
    case 'dashboard':
      $sub_ = 'home/';
      require($main_.$sub_.'dashboard'.PL);
    break;
    case 'attendance':
      $sub_ = 'attendance/';
      require($main_.$sub_.'attendance'.PL);
    break;
    case 'new_class':
      $sub_ = 'class/';
      require($main_.$sub_.'new_class'.PL);
    break;
    case 'edit_class':
      $sub_ = 'class/';
      require($main_.$sub_.'edit_class'.PL);
    break;
    case 'list_class':
      $sub_ = 'class/';
      require($main_.$sub_.'list_class'.PL);
    break;
    case 'new_student':
      $sub_ = 'student/';
      require($main_.$sub_.'new_student'.PL);
    break;
    case 'edit_student':
      $sub_ = 'student/';
      require($main_.$sub_.'edit_student'.PL);
    break;
    case 'profile_student':
      $sub_ = 'student/';
      require($main_.$sub_.'profile_student'.PL);
    break;
    case 'list_student':
      $sub_ = 'student/';
      require($main_.$sub_.'list_student'.PL);
    break;
    case 'new_teacher':
      $sub_ = 'teacher/';
      require($main_.$sub_.'new_teacher'.PL);
    break;
    case 'list_teacher':
      $sub_ = 'teacher/';
      require($main_.$sub_.'list_teacher'.PL);
    break;
    default:
      Redirect::to(DN);
      break;
  endswitch;

elseif('user/'==$main_):
  switch ($url_struc['tree']):
    case '':
      $sub_ = 'home/';
      require($main_.$sub_.'dashboard'.PL);
    break;
    case 'dashboard':
      $sub_ = 'home/';
      require($main_.$sub_.'dashboard'.PL);
    break;
    default:
      Redirect::to(DN);
      break;
  endswitch;

endif;
require($main_.'inc/footer'.PL);
  ?>
