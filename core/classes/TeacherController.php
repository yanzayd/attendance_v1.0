<?php

class TeacherController
{
 /**
	* static method
	* add()
	*
	*/
	public static function add(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'teacher-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_ADD[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_ADD, array(
			'telephone'                 => array(
				'name' 			         => 'Telephone',
				'required'	         => true
			),
			'email'            => array(
				'name' 			         => 'Email',
				'required'	         => true
			)

		));
		if($validation->passed()):
			$AppUsersTable         = new \AppUsers();
			$Str 					         = new \Str();
			$_datetime			       = \Config::get('time/date_time');
			$_ADD                  = (OBJECT)$_ADD;

			$_code                 = $AppUsersTable->generateCode();
      $_firstname            = $Str->data_in(Str::sanAsName($_ADD->firstname));
      $_lastname             = $Str->data_in(Str::sanAsName($_ADD->lastname));
      $_email                = $Str->data_in(Str::sanAsName($_ADD->email));
      $_gender               = $Str->data_in(Str::sanAsName($_ADD->gender));
      $_birthday             = $Str->data_in(Str::sanAsName($_ADD->birthday));
      $_address              = $Str->data_in(Str::sanAsName($_ADD->address));
      $_qualification        = $Str->data_in(Str::sanAsName($_ADD->qualification));
      $_telephone            = $Str->data_in($_ADD->telephone);
      $_religion             = $Str->data_in(Str::sanAsName($_ADD->religion));
			$_nationality          = $Str->data_in(Str::sanAsName($_ADD->nationality));

			# Check if email exists
			$AppUsersTable->select("WHERE telephone =? AND email =?", Array($_telephone, $_email));
			if($AppUsersTable->count()):
				return (OBJECT)[
					'STATUS' 				=> 0,
					'ERRORS' 				=> TRUE,
					'SUCCESS' 			=> FALSE,
					'ERRORS_SCRIPT' => 'This Email exists already!'
				];
			endif;

			$salt 		 				 = Hash::salt(32);
      $generate_password = 'teacher';
      $password 				 = Hash::make($generate_password,$salt);

			$_status 			         = 1;
			$_userID			         = 0;

			$_fields =array(
        'user_type_id'    			   => 2,
				'code'		 			           => $_code,
				'qualification'		 			   => $_qualification,
				'religion'		 			       => $_religion,
				'nationality'		 			     => $_nationality,
				'birthday'		 				     => $_birthday,
        'firstname'    			       => $_firstname,
				'lastname'		 			       => $_lastname,
				'surname'		 			         => '',
				'gender'		 			         => $_gender,
				'email'		 				    		 => $_email,
				'email_state'		 				   => 0,
        'telephone'    			       => $_telephone,
				'address'		 			         => $_address,
				'profile'		 				       => 'User.png',
        'last_access'    			     => '0000-00-00',
				'last_login'		 			   	 => '0000-00-00',
        'account_session'    		   => 0,
        'pin'       						 	 => 0,
        'password'             	   => $password,
        'salt'		  							 => $salt,
				'status'		  			 			 => $_status,
				'admin_id'            		 => $_userID,
				'registered_by'		 			   => $_userID,
				'c_date'						 			 => $_datetime
			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
						$AppUsersTable->insert($_fields);
				}catch(Exception $e){
					$diagnoArray[0] = 'ERRORS_FOUND';
					$diagnoArray[]	= $e->getMessage();
				}
			else:
				$diagnoArray[0]   = 'ERRORS_FOUND';
				$error_msg 				= ul_array($validation->errors());
			endif;

			if($diagnoArray[0] == 'ERRORS_FOUND'):
				return (OBJECT)[
					'STATUS' 				=> 0,
					'ERRORS' 				=> TRUE,
					'SUCCESS' 			=> FALSE,
					'ERRORS_SCRIPT' => $diagnoArray
				];
			else:
				return (OBJECT)[
					'STATUS' 				=> 1,
					'ERRORS' 				=> FALSE,
					'SUCCESS' 			=> TRUE,
					'ERRORS_SCRIPT' => ''
				];
			endif;

		endif;
	}

	/**
 	* static method
 	* feedback()
 	*
 	*/
	public static function edit(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'teacher-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_EDIT[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_EDIT, array(
			'code' => array(
				'name' 			      => 'Code',
				'required'	      => true
			),
			'email'              => array(
				'name' 			      => 'email of Teacher',
				'required'	      => true
			)
		));
		if($validation->passed()):
			$TeacherTable       = new \Teacher();
			$Str 					      = new \Str();
			$datetime			      = \Config::get('time/date_time');
			$_EDIT 					    = (OBJECT)$_EDIT;

			$_ID 				        = $Str->data_in(Str::sanAsID(Hash::decryptToken($_EDIT->id)));
			$_code              = $Str->data_in($_EDIT->code);
			$_email              = $Str->data_in($_EDIT->email);
			// $_dateCl       = $Str->data_in($_EDIT->date_class);

			$_status 			      = 1;
			$_userID			      = Session::get(Config::get('session/session_name'));

			$_fields = array(
				'code' 		          => $_code,
				'email' 		        => $_email,

			);

			if($diagnoArray[0]   == 'NO_ERRORS'):
				try{
					$TeacherTable->update($_fields, $_ID);
				}catch(Exception $e){
					$diagnoArray[0]  = 'ERRORS_FOUND';
					$diagnoArray[]	 = $e->getMessage();
				}
			else:
				$diagnoArray[0]    = 'ERRORS_FOUND';
				$error_msg 				 = ul_array($validation->errors());
			endif;

			if($diagnoArray[0]   == 'ERRORS_FOUND'):
				return (OBJECT)[
					'ERRORS' 				 => TRUE,
					'SUCCESS' 			 => FALSE,
					'ERRORS_SCRIPT'  => $diagnoArray
				];
			else:
				return (OBJECT)[
					'ERRORS' 				 => FALSE,
					'SUCCESS' 			 => TRUE,
					'ERRORS_SCRIPT'  => ''
				];
			endif;
		endif;
	}

	/**
 	* static method
 	* delete()
 	*
 	*/
	public static function delete(){
		$diagnoArray[0]        = 'NO_ERRORS';
		$validate 			       = new \Validate();
		$prefix					       = 'teacher-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_DELETE[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_DELETE, array(
			'id'                => array(
				'name' 			      => 'Name ID',
				'required'	      => true
			)
		));

		if($validation->passed()):
			$AppUsersTable      = new \AppUsers();
			$Str 					     = new \Str();
			$datetime			     = \Config::get('time/date_time');
			$_DELETE 				   = (OBJECT)$_DELETE;
			$_ID 				       = $Str->data_in(Str::sanAsID(Hash::decryptToken($_DELETE->id)));
			$_status 			     = 1;
			$_userID		   	   = Session::get(Config::get('session/session_name'));

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$AppUsersTable->delete($_ID);
				}catch(Exception $e){
					$diagnoArray[0] = 'ERRORS_FOUND';
					$diagnoArray[]	= $e->getMessage();
				}
			else:
				$diagnoArray[0]   = 'ERRORS_FOUND';
				$error_msg 				= ul_array($validation->errors());
			endif;

			if($diagnoArray[0] == 'ERRORS_FOUND'):
				return (OBJECT)[
					'ERRORS' 				=> TRUE,
					'SUCCESS' 			=> FALSE,
					'ERRORS_SCRIPT' => $diagnoArray
				];
			else:
				return (OBJECT)[
					'ERRORS' 				=> FALSE,
					'SUCCESS' 			=> TRUE,
					'ERRORS_SCRIPT' => ''
				];
			endif;
		endif;
	}

}

 ?>
