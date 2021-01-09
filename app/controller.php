<?php

$error_message       = '';
$form_error          = false;
$form                = (object)['ERRORS' => false];

$request             = Input::get('request','get');
$url_struc['tree']   = Input::get('request','get');
$url_struc['trunk']  = Input::get('trunk','get');
$url_struc['branch'] = Input::get('branch','get');
$var_branch          = array();

if(Input::checkInput('branch','get','1')){
    $var_branch = explode('-',Input::get('branch','get'));
    $url_struc['branch'] = $var_branch[0];
}

$url_struc['branch-sub1'] = @$var_branch[1];
$url_struc['branch-sub2'] = @$var_branch[2];


if($url_struc['tree'] =='app'){
    $url_struc['app-idname'] = Input::get('idname','get');
}
if($url_struc['branch-sub2'] =='export'){

    $event_ID = Input::get('id','get');
    Redirect::to(DNADMIN.'/export/'.$event_ID);
}

if($url_struc['branch-sub2'] =='exportsearch'){

    $event_ID = Input::get('id','get');
    Redirect::to(DNADMIN.'/exportsearch/');
}



#************************#
#    POST DETECTS        #
#************************#

if(Input::checkInput('request','post','1') && Input::checkInput('webToken','post','1')):
	$post_request = Input::get('request','post');
  switch($post_request):
		case 'user_login':
  			$form = \UserController::login();
  			if($form->ERRORS == false):
          Redirect::to(DN.'/Dashboard');
  			else:
  				//echo errors
  			endif;
		break;

		case 'user-new':
      $form = \UserController::add();
      if(@$form->SUCCESS == true):
        Session::put('success','Compte Membre cree avec success! Mot de Passe par defaut a ete envoye a son address E-mail.');
      else:
        Session::put('error', @$form->ERRORS_SCRIPT);
      endif;
		break;

		case 'class-new':
      $form = \ClassesController::add();
      if(@$form->SUCCESS == true):
        Session::put('success','Class a ete enregistree correctement!');
      else:
        Session::put('error', @$form->ERRORS_SCRIPT);
      endif;
		break;

		case 'student-new':
      $form = \StudentController::add();
      if(@$form->SUCCESS == true):
        Session::put('success','Student a ete enregistre correctement!');
      endif;
		break;
  endswitch;
endif;

//********************//
//    GET DETECTS    //
//******************//

if(Input::checkInput('request','get','1')){
	$post_request = Input::get('request','get');
	switch($post_request){

       // Logout

		case 'logout':
			$db = DB::getInstance();
            $sessionName = Config::get('session/session_name');
            $cookieName = Config::get('remember/session_name');
            $temp = Config::get('time/seconds');
            if(isset($_SESSION[$sessionName])){
                $user_ID = Session::get($sessionName);


                // $db->delete('vendor',array('user_ID','=',$user_ID));
                // $db->update('val_vendor',$user_ID,array('account_session'=>'0','last_access'=>$temp));
                // Cookie::delete($cookieName);

                session_destroy();
                session_unset();
                session_regenerate_id(true);

                $sessionName = Config::get('session/vendor');
                $cookieName = Config::get('remember/vendor');

                if(isset($_COOKIE["$sessionName"])){
                    unset($_COOKIE["$sessionName"]);
                    setcookie($sessionName, null, -1, '/');
                    Cookie::delete($cookieName);
                }
            }
            Redirect::to(DNSIGNIN);
		break;
    }

}

?>
