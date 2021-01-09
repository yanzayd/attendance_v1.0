<?php

class PostController
{
 /**
	* static method
	* add()
	*
	*/
	public static function add(){
		$diagnoArray[0] = 'NO_ERRORS';
		$validate 			= new \Validate();
		$prefix					= 'post-';
		foreach($_POST as $index => $value):
			$_array = explode($prefix, $index);
			if(count($_array)):
				$_ADD[end($_array)] = $value;
			endif;
		endforeach;
		$validation = $validate->check($_ADD, array(
			'text' => array(
				'name' 				=> 'Post Descr'
			)
		));
		if($validation->passed()):
			$PostTable    		= new \Post();
			$Str 					    = new \Str();
			$_datetime			  = \Config::get('time/date_time');
			$_ADD             = (OBJECT)$_ADD;

			$_postText  	    = $Str->data_in($_ADD->text);
			$_image		        = $Str->data_in($_ADD->image);
			$_doctorID	      = Session::get(Config::get('session/session_name'));

			$_fields =array(
				'doctor_id'			=> $_doctorID,
				'image_attached'=> $_image,
				'description'   => $_postText,
				'post_time'			=> date("h:i"),
				'post_date'			=> date("Y/m/d"),
				'likes'		 			=> 0
			);

			if($diagnoArray[0] == 'NO_ERRORS'):
				try{
					$PostTable = new \Post();
					$PostTable->insert($_fields);
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
