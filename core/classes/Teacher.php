<?php

class Teacher
{
	private $_db,
			$_data,
			$_count = 0,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn,
			$_errors = array();

	public function __construct($user = null){
		$this->_db = DB::getInstance();

		if($user){
			//$this->find($user);
		}
	}
  /**
   * @method generateCode
   * @return String generatedCode
   */
    public function generateCode(){
      $data   = $this->_db->query("SELECT id FROM attendance_teacher ORDER BY id DESC LIMIT 1");
      $lastID = 0;
      if($data->count()):
        $lastID = $data->first()->id;
      endif;
      $newID		= $lastID+1;
      // $Str = 'MSG-';
      $Str = '2021';
      $Str.= ($newID>=0 && $newID<10)?'000':($newID<100?'00':($newID<1000?'0':''));
      $Str.= $newID;
      return $Str;
    }

	/**
	 * @method insert
	 * @param Array Fields
	 * @return Exception Message if errors
	 */
	public function insert($fields = array()){
		if(!$this->_db->insert('attendance_teacher', $fields)){
			throw new Exception("There was a problem inserting.");
		}
	}

	/**
	 * @method update
	 * @param Array Fields
	 * @param Int ID
	 * @return Exception Message if errors
	 */
	public function update($fields = array(),$id = null){
		if(!$this->_db->update('attendance_teacher',$id,$fields)){
			throw new Exception('There was a problem updating');
		}
	}

	/**
	 * @method delete
	 * @param Int ID
	 * @return Exception Message if errors
	 */
	 public function delete($id = null){
 		if(!$this->_db->delete('attendance_teacher',array('id', '=', $id))){
 			throw new Exception('There was a problem updating');
 		}
 	}

	/**
	 * @method find
	 * @param Int ID
	 * @param String OutputField : Ex. name of field in table
	 * @param Int Limit
	 * @return Exception Message if errors
	 */
	public function find($id = null, $outputField=null, $limit = null){
		if($id){
			$hit = false;
			if(is_numeric($id)){
				$field = 'id';
				$data = $this->_db->getAll('attendance_teacher', array($field, '=', $id),$limit);
				if($data->count()){
					$this->_data = $data->first();
					$hit = true;
				}
			}

			if($hit == false){
					return true;
			}else{
				return $outputField==null?true:$data->first()->$outputField;
			}
		}
		return false;
	}

	/**
	 * @method findCotisation
	 * @param Int ID
	 * @param String OutputField : Ex. name of field in table
	 * @param Int Limit
	 * @return Exception Message if errors
	 */
	public function findStudent($id = null, $outputField=null, $limit = null){
		if($id){
			$hit = false;
			if(is_numeric($id)){
				$field = 'id';
				$data = $this->_db->getAll('attendance_teacher', array($field, '=', $id),$limit);
				if($data->count()){
					$this->_data = $data->first();
					$hit = true;
				}
			}

			if($hit == false){
					return true;
			}else{
				return $outputField==null?true:$data->first()->$outputField;
			}
		}
		return false;
	}

	/**
	 * @method select
	 * @param String sql
	 * @param Array params
	 */
	 public function select($sql = null, $params=array()){
 		$data = $this->_db->query("SELECT* FROM attendance_teacher {$sql}", $params);
 		if($data->count()){
 			$this->_count = $data->count();
 			$this->_data = $data->results();
 		}
 	}

	/**
	 * @method selectQuery
	 * @param String sql
	 * @param Array params
	 */
	public function selectQuery($sql,$params=array()){
		$data = $this->_db->query($sql,$params);
		if($data->count()){
			$this->_count = $data->count();
			$this->_data = $data->results();
		}
	}

	/**
	 * @method exists
	 * @return [true or false]
	 */
	public function exists(){
		return (!empty($this->_data))? true : false;
	}

	/**
	 * @method data
	 * @return Array rows
	 */
	public function data(){
		return $this->_data;
	}

	/**
	 * @method first
	 * @return Array first row
	 */
	public function first(){
		$data = $this->data();
		if(isset($data[0])){
			return $data[0];
		}
		return '';
	}

	/**
	 * @method count
	 * @return count
	 */
	public function count(){
		return $this->_count;
	}

	/**
	 * @method addError
	 * @param String error
	 */
	private function addError($error){
		$this->_errors[] = $error;
	}

	/**
	 * @method errors
	 * @return Array erros
	 */
	public function errors(){
		return $this->_errors;
	}
}
?>
