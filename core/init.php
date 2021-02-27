<?php ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//------------------//
// CONFIGURE HTTPS //

if($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != '127.0.0.1'){
    $http = 'http';
    if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    }
}else{
    $http = 'http';
}
// for test //
// $http = 'http';

function def(){
  define("DN",Config::get('url/home'));
  define("_","/");
  define("P",".php");
	define("PL",".php");
	define("CTRL",'./app'._.'controller'.PL);
	define("ROUTES",'./views'._.'routes'.PL);
	define("DNSIGNIN",DN._.'login');
	define("view_session_off_","views/app_session_off/");
	define("view_session_off","views/app_session_off");
	define("_PATH_","/");
	define("_VIEWS_","views/");
	define("_PATH_VIEWS_","./views/");
	define('Controller_NS','app\Http\Controllers\\');  // NS => Namespace
	define('Url_NS','app\Http\Url\\');
	// define("DNADMIN",DN._.Config::get('url/admin'));
}
// Initialize Global Date Class >> Timezone
require 'classes/Dates.php';
// Initialize Global Functions
require_once 'functions/global.php';

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'db' => 'attendance_db'
	),
	'remember' => array(
		'cookie_name' => 'hash',
		'cdv' => 'cdv_hash',
		'vendor' => 'vendor_hash',
		'customer' => 'customer_hash',
		'cookie_expiry' => 604800,
		'browser_token_expiry' => 60*60*12,
	),
	'var' => array(
		'browser_token_name' => 'TimBrowse',
		'browser_token_ID' => 'TimBrowserID',
	),
	'session' => array(
		'session_name' => 'user_Id',
		'vendor' => 'vendor_session',
		'customer' => 'customer_session',
		'subscriber' => 'gino_hash',
		'token_name' => 'token'
	),
	'submit' => array(
		'method' => ''
	),
	'token' => array(
		//'smskey' => "63e6292c250db86b80b8ac64a71e154e46622b79"
	),
	'url' => array(
		'app_dir'=>"",
		'home' => "$http://{$_SERVER['HTTP_HOST']}/attendance_v1.0",
		'admin_dir' => "admin",
	),
	'time' => array(
		'date_time' => Dates::get('Y-m-d h:i:s'),
		'day_date_time' => Dates::get('D, Y-m-d h:i:s a'),
		'date' => Dates::get('Y-m-d'),
		'time' => Dates::get('h:i:s'),
		'timestamp' => $time,
		'seconds' => $time,
		'browser_token_expiry' => 60*60*12,
	),
	'dev' => array(
		'devMode' => true
	)
);


//$_SESSION['timbaktu_ID']=24;

$uri = $_SERVER['REQUEST_URI'];
$uri_array = explode('?',$uri);
if(count($uri_array)>1){
    $uri_get = $uri_array[1];
    $uri_get_array = explode('&',$uri_get);
    for($i=0;$i<count($uri_get_array);$i++){
        $uri_get_el = $uri_get_array[$i];
        $uri_get_el = explode('=',$uri_get_el);
        if($uri_get_el){
            $_GET[$uri_get_el[0]] = @$uri_get_el[1];
        }
    }
}

// Load Classes
function __autoload($class){
	$pathArray = explode('\\',$class);
	if(count($pathArray)>1){
		require_once $class . '.php';
	}else{
		require_once 'classes/'.$class . '.php';
	}
}

//Initialize Define
def();

$db       = DB::getInstance();
$AppClass = new \App();

$init = (object)[
		'db_status'=>$db->connected(),
		'app_token'=>microtime(true)
	];

$appData = new AppData();
$appData->setDBStatus($db->connected());


/* START LOGIN CHECKING*/
$userClass = new \User();
$sessionName = Config::get('session/session_name');
// $cookieName = Config::get('remember/vendor');
if(Session::exists($sessionName)){
    $userID = Session::get($sessionName);
    $userTokenClass = new UserToken();
    $userTokenClass->select(array('id','user_id'), "WHERE `user_id`= ? ", array($userID));
    if($userTokenClass->count()){
        $usertoken_data = $userTokenClass->first();
        if($usertoken_data->user_id == $userID){
            Session::put($sessionName,$userID);
        }else{
            $userClass->logout();
        }
    }else{
        $userClass->logout();
    }
}else{
}
/* END LOGIN CHECKING*/

$session_user  = new User();
$UserTypeTable = new UserType();
if($session_user->isLoggedIn()){
	$session_user_data = $session_user->data();
	$session_user_ID   = $session_user_data->id;
  $main_             = $UserTypeTable->find($session_user_data->user_type_id, 'id')==1?'admin/':'teacher/';
}

?>
