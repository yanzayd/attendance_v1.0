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
			'code'                 => array(
				'name' 			         => 'Code',
				'required'	         => true
			),
			'firstname'            => array(
				'name' 			         => 'First name',
				'required'	         => true
			),
      'lastname'             => array(
        'name' 			         => 'Last name',
        'required'	         => true
      )

		));
		if($validation->passed()):
			$TeacherTable          = new \Teacher();
      $UserTable             = new \User();
			$Str 					         = new \Str();
			$_datetime			       = \Config::get('time/date_time');
			$_ADD                  = (OBJECT)$_ADD;

			$_code                 = $TeacherTable->generateCode();
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



			$_status 			         = 1;
			$_userID			         = Session::get(Config::get('session/session_name'));

			$_fields =array(
				'code'    		      => $_code,
        'firstname'    			=> $_firstname,
				'lastname'		 			=> $_lastname,
				'email'		 				  => $_email,
        'gender'    			  => $Str->data_in($Str->sanAsName($_ADD->gender)),
        'birthday'    			=> $_birthday,
				'address'		 				=> $Str->data_in($Str->sanAsName($_ADD->address)),
        'qualification'     => $_qualification,
        'telephone'         => $Str->data_in($_ADD->telephone),
        'religion'		 			=> $_religion,
        'profile'		 				=> 'User.png',
        'nationality'		 		=> $_nationality,
				'status'            => $_status,
				'registered_by'     => $_userID,
				'c_date'						=> $_datetime
			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$TeacherTable = new \Teacher();
					$TeacherTable->select("WHERE telephone =? AND email =?", Array($_telephone, $_email));
					if(!$TeacherTable->exists()):
						$TeacherTable->insert($_fields);
					else:
						return (object)[
							'ERRORS'  			=> true,
							'SUCCESS' 			=> false,
							'ERRORS_SCRIPT' => "Impossible d'enregistrer pour la deuxieme fois cet Enseignant!"
						];
					endif;
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
		$prefix					       = 'student-';
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
			$TeacherTable      = new \Teacher();
			$Str 					     = new \Str();
			$datetime			     = \Config::get('time/date_time');
			$_DELETE 				   = (OBJECT)$_DELETE;
			$_ID 				       = $Str->data_in(Str::sanAsID(Hash::decryptToken($_DELETE->id)));
			$_status 			     = 1;
			$_userID		   	   = Session::get(Config::get('session/session_name'));

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$DepenseTable->delete($_ID);
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
