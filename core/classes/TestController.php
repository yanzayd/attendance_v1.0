<?php

class TestController
{
 /**
	* static method
	* add()
	*
	*/
	public static function add(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'test-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_ADD[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_ADD, array(
			'name' => array(
				'name' 			=> 'Name',
				'required'	=> true
			),
			'code' => array(
				'name' 			=> 'Code of class',
				'required'	=> true
			),
      'date' => array(
				'name' 			=> 'date of test',
				'required'	=> true
			)
		));
    
		if($validation->passed()):
			$TestTable       = new \Test();
			$Str 					   = new \Str();
			$_datetime			 = \Config::get('time/date_time');
			$_ADD            = (OBJECT)$_ADD;

			$_name            = $Str->data_in(Str::sanAsName($_ADD->name));
			$_code            = $Str->data_in($_ADD->code);
      $_date            = $Str->data_in($_ADD->date);

			$_status 			= 1;
			$_userID			= Session::get(Config::get('session/session_name'));

			$_fields =array(
				'name'    			    => $_name,
				'code'		 				  => $_code,
        'date'		 				  => $_date,
				'registered_by'      =>$_userID,
				'c_date'						=> $_datetime
			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$TestTable = new \Test();
					$TestTable->select("WHERE name =? AND code =?", Array($_name, $_code));
					if(!$TestTable->exists()):
						$TestTable->insert($_fields);
					else:
						return (object)[
							'ERRORS'  			=> true,
							'SUCCESS' 			=> false,
							'ERRORS_SCRIPT' => "Impossible d'enregistrer pour la deuxieme fois cette classe!"
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
		$prefix					= 'test-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_EDIT[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_EDIT, array(
			'name' => array(
				'name' 			=> 'Name',
				'required'	=> true
			),
			'code' => array(
				'name' 			=> 'Code of class',
				'required'	=> true
			),
      'date' => array(
				'name' 			=> 'date of test',
				'required'	=> true
			)

		));
		if($validation->passed()):
			$TestTable   = new \Test();
			$Str 					   = new \Str();
			$datetime			   = \Config::get('time/date_time');
			$_EDIT 					 = (OBJECT)$_EDIT;

			$_ID 				  = $Str->data_in(Str::sanAsID(Hash::decryptToken($_EDIT->id)));
			$_code      = $Str->data_in($_EDIT->code);
			$_name       = $Str->data_in($_EDIT->name);
			$_date = $Str->data_in($_EDIT->date);

			$_status 			= 1;
			$_userID			= Session::get(Config::get('session/session_name'));

			$_fields = array(
				'name' 		   => $_name,
				'code' 		   => $_code,
        'date' 		   => $_date,

			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$DepenseTable->update($_fields, $_ID);
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

	/**
 	* static method
 	* delete()
 	*
 	*/
	public static function delete(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'class-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_DELETE[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_DELETE, array(
			'id' => array(
				'name' 			=> 'Name ID',
				'required'	=> true
			)
		));
		if($validation->passed()):
			$TestTable   = new \Test();
			$Str 					   = new \Str();
			$datetime			   = \Config::get('time/date_time');
			$_DELETE 				 = (OBJECT)$_DELETE;

			$_ID 				  = $Str->data_in(Str::sanAsID(Hash::decryptToken($_DELETE->id)));

			$_status 			= 1;
			$_userID			= Session::get(Config::get('session/session_name'));

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
