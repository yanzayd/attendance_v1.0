<?php
require_once 'core/init.php';
require_once CTRL;
if(!$session_user->isLoggedIn()):
  if(Input::checkInput('webToken', 'post', 1) && Input::checkInput('request', 'post', 1)):
    $post_request=Input::get('request', 'post');
    switch ($post_request):
      case 'user_signin':
        $form = UserController::login();
        if($form->ERRORS == false):
          Redirect::to(DN._.'dashboard');
        endif;
        break;
    endswitch;
  endif;

  if(Input::checkInput('login_email', 'post', 1)):
    $pageviewClass = new PageView();
    $page_type     = 'Login';
    $page_item_ID  = 1;
    $grab_info     = '';
    $grab_info    .= Input::get('login_email', 'post');
    $pageviewClass->insert(array(
      'page_id'   => $page_item_ID,
      'type'      => $page_type,
      'grabbed_info'=> $grab_info
    ));
  endif;
  require_once _PATH_VIEWS_.'login/login.layout'.PL;

else:
  Redirect::to(DN);
endif;
?>
