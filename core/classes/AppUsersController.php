<?php

class AppUsersController
{
 /**
	* static method
	* add()
	*
	*/
	public static function add(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'app-user-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_ADD[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_ADD, array(
			'rollnumber'           => array(
				'name' 			         => 'Rollnumber',
				'required'	         => true
			),
			'card_id'              => array(
				'name' 			         => 'Card Identification',
				'required'	         => true
			)
		));
		if($validation->passed()):
			$StudentTable          = new \Student();
      $UserTable             = new \User();
			$Str 					         = new \Str();
			$_datetime			       = \Config::get('time/date_time');
			$_ADD                  = (OBJECT)$_ADD;

			$_rollnumber           = $StudentTable->generateCode();
			$_card_id              = $Str->data_in($_ADD->card_id);
      $_firstname            = $Str->data_in(Str::sanAsName($_ADD->firstname));
      $_lastname             = $Str->data_in(Str::sanAsName($_ADD->lastname));
      $_surname              = $Str->data_in(Str::sanAsName($_ADD->surname));
      $_email                = $Str->data_in($_ADD->email);
      $_gender               = $Str->data_in(Str::sanAsName($_ADD->gender));
      $_address              = $Str->data_in(Str::sanAsName($_ADD->address));
      $_classes              = $Str->data_in(Str::sanAsName($_ADD->classes));
      $_nationality          = $Str->data_in(Str::sanAsName($_ADD->nationality));
      $_birthday             = $Str->data_in($_ADD->birthday);
      $_mothername           = $Str->data_in(Str::sanAsName($_ADD->mothername));
			$_responsable_phone    = $Str->data_in($_ADD->responsable_phone);
      $_fathername           = $Str->data_in(Str::sanAsName($_ADD->fathername));
      $_religion             = $Str->data_in(Str::sanAsName($_ADD->religion));

			$_userTypeID 					 = 1;
			$_status 			         = 1;
			$_userID			         = Session::get(Config::get('session/session_name'));

			$_fields =array(
				'rollnumber'    		=> $_rollnumber,
				'card_id'		 				=> $_card_id,
        'firstname'    			=> $_firstname,
				'lastname'		 			=> $_lastname,
        'surname'    			  => $_surname,
				'email'		 				  => $_email,
        'gender'    			  => $Str->data_in($Str->sanAsName($_ADD->gender)),
				'address'		 				=> $Str->data_in($Str->sanAsName($_ADD->address)),
        'classes'    			  => $_classes,
				'nationality'		 		=> $_nationality,
        'birthday'    			=> $_birthday,
				'mothername'		 		=> $_mothername,
        'fathername'		 		=> $_fathername,
        'responsable_phone' => $Str->data_in($_ADD->responsable_phone),
				'religion'		 			=> $_religion,
        'profile'		 				=> 'User.png',
				// 'user_type_id'		  => $_userTypeID,
				'status'		  			=> $_status,
				'registered_by'     => $_userID,
				'c_date'						=> $_datetime
			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$StudentTable = new \Student();
					$StudentTable->select("WHERE email =? AND card_id =?", Array($_email, $_card_id));
					if(!$StudentTable->exists()):
						$StudentTable->insert($_fields);
					else:
						return (object)[
							'ERRORS'  			=> true,
							'SUCCESS' 			=> false,
							'ERRORS_SCRIPT' => "Impossible d'enregistrer pour la deuxieme fois cet eleve!"
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
		$prefix					= 'student-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_EDIT[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_EDIT, array(
			'name' => array(
				'name' 			      => 'Name',
				'required'	      => true
			),
			'code'              => array(
				'name' 			      => 'Code of class',
				'required'	      => true
			)
		));
		if($validation->passed()):
			$StudentTable       = new \Student();
			$Str 					      = new \Str();
			$datetime			      = \Config::get('time/date_time');
			$_EDIT 					    = (OBJECT)$_EDIT;

			$_ID 				        = $Str->data_in(Str::sanAsID(Hash::decryptToken($_EDIT->id)));
			$_code              = $Str->data_in($_EDIT->code);
			$_name              = $Str->data_in($_EDIT->name);
			$_dateClasses       = $Str->data_in($_EDIT->date_class);

			$_status 			      = 1;
			$_userID			      = Session::get(Config::get('session/session_name'));

			$_fields = array(
				'name' 		        => $_name,
				'code' 		        => $_code,

			);

			if($diagnoArray[0]   == 'NO_ERRORS'):
				try{
					$DepenseTable->update($_fields, $_ID);
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
		$prefix					       = 'app-user-';
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
			$StudentTable      = new \Student();
			$Str 					     = new \Str();
			$datetime			     = \Config::get('time/date_time');
			$_DELETE 				   = (OBJECT)$_DELETE;
			$_ID 				       = $Str->data_in(Str::sanAsID(Hash::decryptToken($_DELETE->id)));
			$_status 			     = 1;
			$_userID		   	   = Session::get(Config::get('session/session_name'));

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$StudentTable->delete($_ID);
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
