<?php

class AppointmentController
{
 /**
	* static method
	* add()
	*
	*/
	public static function add(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'appointment-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_ADD[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_ADD, array(
			'appointment_date' => array(
				'name' 			=> 'Appointment Date',
				'required'	=> true
			),
			'appointment_time' => array(
				'name' 			=> 'Appointment Time',
				'required'	=> true
			),
			'description' => array(
				'name' 			=> 'Description',
				'required'	=> true
			),
			'patient' => array(
				'name' 			=> 'Patient ID',
				'required'	=> true
			)
		));
		if($validation->passed()):
			$AppointmentTable = new \Appointment();
			$PatientTable     = new \Patient();
			$Str 					    = new \Str();
			$_datetime			  = \Config::get('time/date_time');
			$_ADD             = (OBJECT)$_ADD;

			$_patientID   	    = $Str->data_in($Str->sanAsID(Hash::decryptToken($_ADD->patient)));
			$_description				= $Str->data_in($_ADD->description);
			$_dateAppointment   = $Str->data_in($_ADD->appointment_date);
			$_timeAppointment   = $Str->data_in($_ADD->appointment_time);

			$_status 			= 0;
			$_userID			= Session::get(Config::get('session/session_name'));

			$_fields =array(
				'appointment_date'    => $_dateAppointment,
				'appointment_time' 		=> $_timeAppointment,
				'description'    	    => $_description,
				'patient_id'        	=> $_patientID,
				'doctor_id'           => $_userID,
				'status' 						  => $_status,
				'c_date'						  => $_datetime
			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$AppointmentTable = new \Appointment();
					$AppointmentTable->insert($_fields);

				}catch(Exeption $e){
					$diagnoArray[0] = "ERRORS_FOUND";
					$diagnoArray[] = $e->getMessage();
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
		public static function delete(){
			$diagnoArray[0] = 'NO_ERRORS';
			$validate 			= new \Validate();
			$prefix					= 'appointment-';
			foreach($_POST as $index => $value):
				$_array = explode($prefix, $index);
				if(count($_array)):
					$_EDIT[end($_array)] = $value;
				endif;
			endforeach;
			$validation = $validate->check($_EDIT, array(
				'id' => array(
					'name' 			=> 'ID',
					'required'	=> true
				)
			));
			if($validation->passed()):
				$AppointmentTable = new \Appointment();
				$Str 					   = new \Str();
				$datetime			   = \Config::get('time/date_time');
				$_EDIT 					 = (OBJECT)$_EDIT;

				$_ID 				  = $Str->data_in($_EDIT->id);
				$_userID			= Session::get(Config::get('session/session_name'));

				if($diagnoArray[0] == 'NO_ERRORS'):
					try{
						$AppointmentTable->delete($_ID);
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

		public static function updateInformation(){
			$diagnoArray[0] = 'NO_ERRORS';
			$validate = new \Validate();
			$prfx = 'appointment-';
			foreach($_POST as $index=>$val){
				$ar = explode($prfx,$index);
				if(count($ar)){
					$_SIGNUP[end($ar)] = $val;
				}
			}


			$validation = $validate->check($_SIGNUP, array(
				'appointment_date' => array(
					'name'     => 'Appointment Date',
					'required' => true
				),
				'appointment_time' => array(
					'name'     => 'Appointment Time',
					'required' => true
				)
			));

			if($validation->passed()){
				$AppointmentTable = new \Appointment();
				$Str 		        	= new \Str();
				$_SIGNUP          = (object)$_SIGNUP;

				$_appointmentID    = $Str->data_in($_SIGNUP->appointment_id);
				$_dateAppointment  = $Str->data_in($Str->sanAsName($_SIGNUP->appointment_date));
				$_timeAppointment  = $Str->data_in($Str->sanAsName($_SIGNUP->appointment_time));
				$_description      = $Str->data_in($_SIGNUP->description);

				$_fields = array(
					'appointment_date'	  => $_dateAppointment,
					'appointment_time'	  => $_timeAppointment,
					'description'					=> $_description
				);
				if($diagnoArray[0] == 'NO_ERRORS'){
							try{
									$AppointmentTable->update($_fields, $_appointmentID);
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

}


 ?>
