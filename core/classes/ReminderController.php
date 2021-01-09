<?php

class ReminderController
{
 /**
	* static method
	* add()
	*
	*/
	public static function add(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'reminder-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_ADD[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_ADD, array(
			'appointment_id' => array(
				'name' 			=> 'Appointment ID',
				'required'	=> true
			),
			'patient_id' => array(
				'name' 			=> 'Patient ID',
				'required'	=> true
			),
			'message' => array(
				'name' 			=> 'Description',
				'required'	=> true
			)
		));
		if($validation->passed()):
			$ReminderTable = new \Reminder();
			$Str 					    = new \Str();
			$_datetime			  = \Config::get('time/date_time');
			$_ADD             = (OBJECT)$_ADD;

			$_patientID   	    = $Str->data_in($_ADD->patient_id);
			$_appointmentID   	= $Str->data_in($_ADD->appointment_id);
			$_message      	    = $Str->data_in($_ADD->message);
			$telephone   				= $Str->data_in($_ADD->telephone);

			$_userID			= Session::get(Config::get('session/session_name'));

			$_fields =array(
				'appointment_id'    => $_appointmentID,
				'patient_id' 	     	=> $_patientID,
				'doctor_id'         => $_userID,
				'message' 				  => $_message,
				'remind_date'	    	=> $_datetime
			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$ReminderTable = new \Reminder();
					$ReminderTable->insert($_fields);

					$message    = $_message;
					$_telephone = array($telephone);
					$SmartSMS   = new \SmartSMS();
					$SmartSMS->send($message, $_telephone);

					$AppointmentTable = new \Appointment();
					$AppointmentTable->select("WHERE id=? LIMIT 1", array($_appointmentID));
					if($AppointmentTable->count()):
						$_ID 		 = $_appointmentID;
						$_status = 1;
						$_fields = array(
							'status'	 => $_status
						);
						$AppointmentTable->update($_fields, $_ID);
					endif;

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


}


 ?>
