<?php
class App
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
	 * @method insert
	 * @param Array Fields
	 * @return Exception Message if errors
	 */
	public function insert($fields = array()){
		if(!$this->_db->insert('pharmacy_class', $fields)){
			throw new Exception("There was a problem a trunk.");
		}
	}

	/**
	 * @method update
	 * @param Array Fields
	 * @param Int ID
	 * @return Exception Message if errors
	 */
	public function update($fields = array(),$id = null){
		if(!$this->_db->update('cdv_pharmacy_medicine_units',$id,$fields)){
			throw new Exception('There was a problem updating');
		}
	}

	/**
	 * @method delete
	 * @param Int ID
	 * @return Exception Message if errors
	 */
	 public function delete($id = null){
 		if(!$this->_db->delete('cdv_pharmacy_medicine_units',array('id', '=', $id))){
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
				$data = $this->_db->getAll('cdv_pharmacy_medicine_units', array($field, '=', $id),$limit);
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
	 * @method findFamilyStatus
	 * @param Int ID
	 * @param String OutputField : Ex. name of field in table
	 * @param Int Limit
	 * @return Exception Message if errors
	 */
	public function findFamilyStatus($id = null, $outputField=null, $limit = null){
		if($id){
			$hit = false;
			if(is_numeric($id)){
				$field = 'id';
				$data = $this->_db->getAll('app_family_status', array($field, '=', $id),$limit);
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
	 * @method findMemberTitle
	 * @param Int ID
	 * @param String OutputField : Ex. name of field in table
	 * @param Int Limit
	 * @return Exception Message if errors
	 */
	public function findMemberTitle($id = null, $outputField=null, $limit = null){
		if($id){
			$hit = false;
			if(is_numeric($id)){
				$field = 'id';
				$data = $this->_db->getAll('app_members_title', array($field, '=', $id),$limit);
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
 		$data = $this->_db->query("SELECT* FROM `cdv_pharmacy_medicine_units` {$sql}", $params);
 		if($data->count()){
 			$this->_count = $data->count();
 			$this->_data = $data->results();
 		}
 	}

	/**
	 * @method selectFamilyStatus
	 * @param String sql
	 * @param Array params
	 */
	 public function selectFamilyStatus($sql = null, $params=array()){
 		$data = $this->_db->query("SELECT* FROM `app_family_status` {$sql}", $params);
 		if($data->count()){
 			$this->_count = $data->count();
 			$this->_data = $data->results();
 		}
 	}

	/**
	 * @method selectMemberTitle
	 * @param String sql
	 * @param Array params
	 */
	 public function selectMemberTitle($sql = null, $params=array()){
 		$data = $this->_db->query("SELECT* FROM `app_members_title` {$sql}", $params);
 		if($data->count()){
 			$this->_count = $data->count();
 			$this->_data = $data->results();
 		}
 	}

	/**
	 * @method selectHealthState
	 * @param String sql
	 * @param Array params
	 */
	 public function selectHealthState($sql = null, $params=array()){
 		$data = $this->_db->query("SELECT* FROM `app_health_state` {$sql}", $params);
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
