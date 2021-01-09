<?php
/**
 * Properties Settings class
 * This Class is used for Properties Settings Related:
 * (Change Preferred Language : Initialy[French, English]
 * i18n of Each String Ouptut in the Software using JSON Properties.json
 * @author Ezechiel Kalengya Ezpk [ ezechielkalengya@gmail.com ]
 */
class Properties
{
	private $readJson;
	private $Prop;
	private $Software_Language;
	function __construct($lang='')
	{
		$this->readJson = DN.'/core/Json/properties.json';
		$this->Prop=$this->parseJson();
		$lang=$lang?$lang:$this->selectedLang();
		$this->Software_Language=$lang;
	}

	private function parseJson(){
		$jsonData=file_get_contents(''.$this->readJson);
		$json=json_decode($jsonData,true);
		//return the decoded to php array from json
		return $json;
	}

	public function selectedLang(){
		$key=$this->string_key("software-lang");
		if($key)  foreach($this->Prop['properties'][$key] as $key=>$value) return $value['lang'];
	  else return 'fr-lang';
	}

	private function string_key($map_word){
		foreach($this->Prop['properties'] as $key => $value):
			if(key($this->Prop['properties'][$key])==$map_word): return $key;
		  else: false;
			endif;
		endforeach;
	}

	/**
	 * Returns the i18n String Output setted in properties.json Depending on the selected Lang
	 * @param string name of the string key setted in properties.json
	 */
	public function string($map_word){
		$key=$this->string_key($map_word);
		if($key)  foreach($this->Prop['properties'][$key] as $key=>$value) return $value[$this->Software_Language];
	  else return 'fr-lang';
	}

	/**
	 * Returns true or false if selected Language has changed
	 * @param string new_value lange ex. fr-lang, eng-lang
	 */
	public function changeLang($new_value){
		$key=$this->string_key("software-lang");
		$data = $this->Prop;
		if($key):
			$data['properties'][$key]['software-lang']['lang']=$new_value;
			$newJsonString = json_encode($data);
			if(file_put_contents($this->readJson, $newJsonString)) return true; else false;
		else: return false;
		endif;
	}

}



?>
