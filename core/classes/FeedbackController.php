<?php

class FeedbackController
{
 /**
	* static method
	* add()
	*
	*/
	public static function add(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'feedback-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_ADD[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_ADD, array(
			'patient' => array(
				'name' 				=> 'Patient ID',
				'required'		=> true
			),
			'description' => array(
				'name' 				=> 'Description',
				'required'		=> true
			)
		));
		if($validation->passed()):
			$FeedbackTable    = new \Feedback();
			$UserTable        = new \User();
			$Str 					    = new \Str();
			$_datetime			  = \Config::get('time/date_time');
			$_ADD             = (OBJECT)$_ADD;

			$_patientID   	  = $Str->data_in($_ADD->patient);
			$_description		  = $Str->data_in($_ADD->description);
			$_doctorID	      = Session::get(Config::get('session/session_name'));

			$_fields =array(
				'patient_id'    => $_patientID,
				'doctor_id'			=> $_doctorID,
				'description'   => $_description,
				'from_patient'	=> 0,
				'from_doctor'		=> 1,
				'status' 			  => 0,
				'msg_time'			=> date('h:i'),
				'msg_date'			=> date("Y/m/d")
			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$FeedbackTable = new \Feedback();
					$FeedbackTable->insert($_fields);

					$FeedbackTable = new \Feedback();
					$_feedbackID			=	$Str->data_in($_ADD->id_);
					$FeedbackTable->select("WHERE id=? LIMIT 1", array($_feedbackID));
					if($FeedbackTable->count()):
						$_ID 		 = $_feedbackID;
						$_status = 1;
						$_fields = array(
							'status'	 => $_status
						);
						$FeedbackTable->update($_fields, $_ID);
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

	public static function updateFeedbackStatus(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'feedback-';
		foreach($_POST as $index=>$val){
			$ar = explode($prfx,$index);
			if(count($ar)){
				$_SIGNUP[end($ar)] = $val;
			}
		}

		$validation = $validate->check($_SIGNUP, array(
			'id' => array(
				'name'     => 'Feedback ID'
			)
		));

		if($validation->passed()){
			$FeedbackTable = new \Feedback();
			$Str 			     = new \Str();
			$_SIGNUP       = (object)$_SIGNUP;

			$_ID 		   = $Str->data_in($_SIGNUP->id);

			$_fields = array(
				'status'					=> 1
			);
			if($diagnoArray[0] == 'NO_ERRORS'){
						try{
								$FeedbackTable->update($_fields, $_ID);
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
