<?php
class UserController
{
	public static function add(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'user-';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_SIGNUP[end($ar)] = $val;
			}
		}

		global $session_user_data;
		global $session_company_data;

		$validation = $validate->check($_SIGNUP, array(
			'firstname' => array(
				'name'     => 'First Name',
				'string'   => true,
				'required' => true
			),
			'lastname' => array(
				'name'     => 'Last Name',
				'string'   => true,
				'required' => true
			),
			'email' => array(
				'name' => 'Email Address',
				'email' => true,
				'required' => true
			),
			'telephone' => array(
				'name' => 'Telephone',
				'required' => true
			)
		));

		if($validation->passed()){
			$UserTable = new \User();
			$Str 			 = new \Str();
			$datetime  = \Config::get('time/date_time');
			$_SIGNUP   = (object)$_SIGNUP;

			$_userTypeID = $Str->data_in($_SIGNUP->user_type);
			$_firstname  = $Str->data_in($Str->sanAsName($_SIGNUP->firstname));
			$_lastname   = $Str->data_in($Str->sanAsName($_SIGNUP->lastname));
			$_gender     = $Str->data_in($Str->sanAsName($_SIGNUP->gender));
		  $_email 		 = $Str->data_in($_SIGNUP->email);
			$_telephone  = $Str->data_in($_SIGNUP->telephone);
			$_address    = $Str->data_in($Str->sanAsLabel($_SIGNUP->address));

		  $salt 		 				 = Hash::salt(32);
		  $generate_password = 'attendance';
		  $password 				 = Hash::make($generate_password,$salt);

			$_userID = $session_user_data->id;

			$picture = 'user.jpg';
			if ($_gender == 'Female') {
				$picture = 'picture.jpg';
			} else {
				$picture = 'user.png';
			}

			$_user_status = 1;

			$_fields = array(
				'first_name'				=> $_firstname,
				'last_name'					=> $_lastname,
				'gender'						=> $_gender,
				'email'							=> $_email,
				'telephone'					=> $_telephone,
				'address'						=> $_address,
				'profile'		  			=> $picture,
				'user_type_id'		  => $_userTypeID,
				'last_access'		    => '0000-00-00',
				'last_login'		    => '0000-00-00',
				'account_session'	  => 0,
				'pin'							  => 0,
				'password'				  => $password,
				'salt'		  				=> $salt,
				'added_by'					=> $_userID,
				'status'		  			=> $_user_status,
				'c_date'		 		  	=> $datetime
			);
		  if($diagnoArray[0] == 'NO_ERRORS'){
					  try{
							$UserTable = new \User();
							$UserTable->select("WHERE email =? ", Array($_email));
							if($UserTable->count()):
								return (object)[
									'ERRORS'=>true,
									'SUCCESS'=>false,
									'ERRORS_SCRIPT' => 'Email Already Used!'
								];
							else:
								$UserTable->insert($_fields);
								Redirect::to(DN._.'list/users');
							endif;
						}catch(Exeption $e){
							$diagnoArray[0] = "ERRORS_FOUND";
							$diagnoArray[] = $e->getMessage();
						}
				}
			}else{
				$diagnoArray[0] = 'ERRORS_FOUND';
				$error_msg = ul_array($validation->errors());
			}
			if($diagnoArray[0] == 'ERRORS_FOUND'){
				return (object)[
					'ERRORS'=>true,
					'SUCCESS'=>false,
					'ERRORS_SCRIPT' => $validate->getErrorLocation()
				];
			}else{
				return (object)[
					'ERRORS'=>false,
					'SUCCESS'=>true,
					'ERRORS_SCRIPT' => $validate->errors()
				];
			}
	}

	public static function updateInformation(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'user-';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_SIGNUP[end($ar)] = $val;
			}
		}

		global $session_user_data;
		global $session_company_data;

		$validation = $validate->check($_SIGNUP, array(
			'firstname' => array(
				'name'     => 'First Name',
				'string'   => true,
				'required' => true
			),
			'lastname' => array(
				'name'     => 'Last Name',
				'string'   => true,
				'required' => true
			),
			'telephone' => array(
				'name' => 'Telephone',
				'required' => true
			)
		));

		if($validation->passed()){
			$UserTable = new \User();
			$Str 			 = new \Str();
			$datetime  = \Config::get('time/date_time');
			$_SIGNUP   = (object)$_SIGNUP;

			$_ID 				 = Session::get(Config::get('session/session_name'));
			$_firstname  = $Str->data_in($Str->sanAsName($_SIGNUP->firstname));
			$_lastname   = $Str->data_in($Str->sanAsName($_SIGNUP->lastname));
			$_telephone  = $Str->data_in($_SIGNUP->telephone);

			$_userID = 1;
			$_status = 0;
			$_fields = array(
				'first_name'					=> $_firstname,
				'last_name'					  => $_lastname,
				'telephone'				  	=> $_telephone,
				'address'						  => $Str->data_in($Str->sanAsLabel($_SIGNUP->address))
			);
		  if($diagnoArray[0] == 'NO_ERRORS'){
					  try{
								$UserTable->update($_fields, $_ID);
						}catch(Exeption $e){
							$diagnoArray[0] = "ERRORS_FOUND";
							$diagnoArray[] = $e->getMessage();
						}
				}
			}else{
				$diagnoArray[0] = 'ERRORS_FOUND';
				$error_msg = ul_array($validation->errors());
			}
			if($diagnoArray[0] == 'ERRORS_FOUND'){
				return (object)[
					'ERRORS'=>true,
					'SUCCESS'=>false,
					'ERRORS_SCRIPT' => $validate->getErrorLocation()
				];
			}else{
				return (object)[
					'ERRORS'=>false,
					'SUCCESS'=>true,
					'ERRORS_SCRIPT' => $validate->errors()
				];
			}
	}

	public static function activateUser(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'user-';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_SIGNUP[end($ar)] = $val;
			}
		}

		$validation = $validate->check($_SIGNUP, array(
			'id' => array(
				'name'     => 'User ID'
			)
		));

		if($validation->passed()){
			$UserTable = new \User();
			$Str 			 = new \Str();
			$datetime  = \Config::get('time/date_time');
			$_SIGNUP   = (object)$_SIGNUP;

			$_ID 		   = $Str->data_in($_SIGNUP->id);
			$_status   = $Str->data_in($_SIGNUP->status);
			$_user_status = 0;
			if ($_status == 0) {
				$_user_status = 1;
			}else {
				$_user_status = 0;
			}
			$_fields = array(
				'status'					=> $_user_status
			);
		  if($diagnoArray[0] == 'NO_ERRORS'){
					  try{
								$UserTable->update($_fields, $_ID);
						}catch(Exeption $e){
							$diagnoArray[0] = "ERRORS_FOUND";
							$diagnoArray[] = $e->getMessage();
						}
				}
			}else{
				$diagnoArray[0] = 'ERRORS_FOUND';
				$error_msg = ul_array($validation->errors());
			}
			if($diagnoArray[0] == 'ERRORS_FOUND'){
				return (object)[
					'ERRORS'=>true,
					'SUCCESS'=>false,
					'ERRORS_SCRIPT' => $validate->getErrorLocation()
				];
			}else{
				return (object)[
					'ERRORS'=>false,
					'SUCCESS'=>true,
					'ERRORS_SCRIPT' => $validate->errors()
				];
			}
	}

	public static function updatePassword($user_ID = null){
        $diagnoArray[0] = 'NO_ERRORS';
        $errors_str = '';
        $validate = new \Validate();
        $prfx = 'user-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }

        # Load Session User Data
				$User      = new \User();
				$user_ID   = \Session::get(Config::get('session/session_name'));
				$User->select("WHERE id =? ORDER BY id DESC LIMIT 1", Array($user_ID));
			  if($User->count()):
					foreach($User->data() As $user_data):
					endforeach;
				endif;

        $validation = $validate->check($_SIGNUP, array(
            'password' => array(
                'name' => 'Password',
                'min' => 6,
                'required' => true
            ),
            'repassword' => array(
                'required' => true,
                'name' => 'Confirm Password',
                'matches' => 'password',
            )
        ));
				$_SIGNUP   = (Object)$_SIGNUP;

        $current_salt         = $user_data->salt;
        $current_passwordText = Input::get($prfx.'current_password','post');
        $current_password     = Hash::make($current_passwordText,$current_salt);

        if($current_password != $user_data->password){
            $diagnoArray[0]  == 'ERRORS_FOUND';
            $errors_str      = "The current password is Incorrect";
						return (object)[
                'ERRORS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => $errors_str
            ];
        }
				elseif($_SIGNUP->password != $_SIGNUP->repassword){
            $diagnoArray[0] == 'ERRORS_FOUND';
            $errors_str     = "The two passwords must match and the length must be greater than Six characters!";
						return (object)[
                'ERRORS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => $errors_str
            ];
        }

        if($validation->passed()){
            $userTable = new \User();
            $str 			 = new \Str();
            $_SIGNUP   = (Object)$_SIGNUP;
            $seconds   = \Config::get('time/seconds');

            $salt = Hash::salt(32);
            $passwordText = Input::get($prfx.'password','post');
            $password = Hash::make($passwordText,$salt);

            if($diagnoArray[0] == 'NO_ERRORS'){
                try{
                    $userTable->update(array(
                        'password' => $password,
                        'salt' => $salt
                    ),$user_ID);
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }
                // Session::put("success","Password updated successfully.");
            }else{
                $diagnoArray[0] = 'ERRORS_FOUND';
                $error_msg = ul_array($validation->errors());
            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
						$validateStr = '';
						if(array_key_exists('password', $validate->getErrorLocation())):
					  	$validateStr = $validate->getErrorLocation()['password'];
						elseif(array_key_exists('repassword', $validate->getErrorLocation())):
							$validateStr = $validate->getErrorLocation()['repassword'];
						endif;
            return (object)[
                'ERRORS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => $validateStr
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => $validate->errors()
            ];
        }
    }

	public static function requestPasswordReset($user_ID){

        $diagnoArray[0] = 'NO_ERRORS';
        $errors_str = '';

        $validate = new \Validate();
        $prfx = 'recover-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }

        $userTable = new \User();

        $str = new \Str();

        $seconds = \Config::get('time/seconds');

        global $user_data;

        $salt = Hash::salt(32);
        $generated_string = Functions::generateStrongPassword(32,false,'ud');

        $secret_key = $user_data->password;
        $recovery_string = strtoupper(hash_hmac('SHA256', $generated_string, pack('H*',$secret_key)));

        if($diagnoArray[0] == 'NO_ERRORS'){
            try{
                $userTable->update(array(
                    'recovery_string' => $recovery_string
                ),$user_ID);
            }catch(Exeption $e){
                $diagnoArray[0] = "ERRORS_FOUND";
                $diagnoArray[] = $e->getMessage();
            }

            $subject = "Click here to reset your password";

            $link = DNADMIN."/login/resetpassword/{$user_ID}/{$generated_string}";



        }

        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_STRING' => $errors_str,
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => ''
            ];
        }
    }

	public static function resetPassword($user_ID){

        $diagnoArray[0] = 'NO_ERRORS';
        $errors_str = '';

        $validate = new \Validate();
        $prfx = 'reset-';
        foreach($_POST as $index=>$val){
            $ar = explode($prfx,$index);
            if(count($ar)){
                $_SIGNUP[end($ar)] = $val;
            }
        }

        $validation = $validate->check($_SIGNUP, array(
            'password' => array(
                'name' => 'Password',
                'strong_password' => true,
                'min' => 6,
                'required' => true
            )
        ));

        if($validation->passed()){
            $userTable = new \User();

            $str = new \Str();

            $seconds = \Config::get('time/seconds');

            global $user_data;

            $salt = Hash::salt(32);
            $generate_password = $_SIGNUP['password'];
            $password = Hash::make($generate_password,$salt);

            if($diagnoArray[0] == 'NO_ERRORS'){
                try{
                    $userTable->update(array(
                        'password' => $password,
                        'salt' => $salt,
                        'recovery_string' => ''
                    ),$user_ID);
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }

                Session::put("success","Password updated successfully.");


            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
            $errors_str = ul_array($validation->errors());
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_STRING' => $errors_str,
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_STRING' => $errors_str,
                'ERRORS_SCRIPT' => ''
            ];
        }
    }

    public static function update($user_ID){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'user-';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_SIGNUP[end($ar)] = $val;
			}
		}

        global $session_user_data;
        global $session_company_data;

        $validation = $validate->check($_SIGNUP, array(
            'firstname' => array(
                'name' => 'First Name',
                'required' => true
            ),
            'lastname' => array(
                'name' => 'Last Names',
                'string' => true
            ),
            'telephone' => array(
                'name' => 'Telephone',
                'required' => true
            )
        ));

        if($validation->passed()){
            $userTable = new \User();

            $str = new \Str();

            $_SIGNUP = (object)$_SIGNUP;

            $firstname = $str->sanAsName($_SIGNUP->firstname);

            $lastname = $str->sanAsName($_SIGNUP->lastname);

            $telephone = $str->sanAsName($_SIGNUP->telephone);

            $groups = $_SIGNUP->groups;

            $company_ID = $session_company_data->ID;

            $seconds = \Config::get('time/seconds');

            if($diagnoArray[0] == 'NO_ERRORS'){
                try{
                    $userTable->update(array(
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'phone' => $telephone,
                        'groups' => $groups
                    ),$user_ID);
                }catch(Exeption $e){
                    $diagnoArray[0] = "ERRORS_FOUND";
                    $diagnoArray[] = $e->getMessage();
                }
            }
        }else{
            $diagnoArray[0] = 'ERRORS_FOUND';
            $error_msg = ul_array($validation->errors());
        }
        if($diagnoArray[0] == 'ERRORS_FOUND'){
            return (object)[
                'ERRORS'=>true,
                'ERRORS_SCRIPT' => $validate->getErrorLocation()
            ];
        }else{
            return (object)[
                'ERRORS'=>false,
                'SUCCESS'=>true,
                'ERRORS_SCRIPT' => $validate->errors()
            ];
        }
	}
	public static function login($origin=null){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'login_';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_LOGIN[end($ar)] = $val;
			}
		}
		$validation = $validate->check($_LOGIN, array(
			'email' => array(
				'name' => 'Email',
				'required' => true
			),
			'password' => array(
				'name' => 'Password',
				'required' => true
			)
		));

		if($validation->passed()){
			$userTable = new \User();
			$db 			 = DB::getInstance();

			$str 					= new \Str();
			$_LOGIN 			= (object)$_LOGIN;
			$username 		= $str->data_in($_LOGIN->email);
			$password_txt = $str->data_in($_LOGIN->password);
			$remember 		= false;
			if(Input::checkInput($prfx.'remember','post',1)){
				$remember = (Input::get($prfx.'remember','post') == 'on')? true : false;
			}
			$login 		  = $userTable->login($username,$password_txt,$remember);
			if($login !== true){
          $diagnoArray[0] = "ERRORS_FOUND";
			}
			if(count($userTable->errors())){
				if($login == 'password'){
					$form_error = true;
					$diagnoArray[0] = "ERRORS_FOUND";
					Session::put('loginerror','Password');
				}else if($login == 'username'){
					$form_error = true;
					$diagnoArray[0] = "ERRORS_FOUND";
					Session::put('loginerror','Username');
				}
			}

			$seconds = \Config::get('time/seconds');
			if($diagnoArray[0] == 'NO_ERRORS'){

			}
		}else{
			$diagnoArray[0] = 'ERRORS_FOUND';
			$error_msg = ul_array($validation->errors());
		}
		if($diagnoArray[0] == 'ERRORS_FOUND'){
			return (object)[
				'ERRORS'=>true,
				'SUCCESS'=>false,
				'ERRORS_SCRIPT' => $validate->getErrorLocation()
			];
		}else{
			return (object)[
				'ERRORS'=>false,
				'SUCCESS'=>true,
				'ERRORS_SCRIPT' => ""
			];
		}
	}


	public static function changeState($state,$user_ID){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();

        $ID = $user_ID;

        $seconds = \Config::get('time/seconds');

        $userTable = new User();
        global $session_user_data;

        try{
            switch($state){
                case 'Activate';
                    $userTable->update(array(
                        'state' => 'Activated'
                    ),$ID);
                break;
                case 'Block';
                    $userTable->update(array(
                        'state' => 'Blocked'
                    ),$ID);
                break;
            }
        }catch(Exeption $e){
            $diagnoArray[0] = "ERRORS_FOUND";
            $diagnoArray[] = $e->getMessage();
        }
		if($diagnoArray[0] == 'ERRORS_FOUND'){
			return (object)[
				'ERRORS'=>true,
				'ERRORS_SCRIPT' => $diagnoArray
			];
		}else{
			return (object)[
				'ERRORS'=>false,
				'SUCCESS'=>true,
				'ERRORS_SCRIPT' => ""
			];
		}
	}
}
