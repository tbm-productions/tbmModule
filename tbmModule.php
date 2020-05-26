<?php
/*
 *  tbmModule - Easy use of complex PHP functions.
 *  Version 0.6
 *  PHP Verison 7.3.6
 *
 *  @docs       https://developer.tbmproduction.com/projects/tbm-module/docs
 *
 *  @author     Ben M CEO / Co-Owner TBM Productions    <contact@tbmproduction.com>
 *  
 *  @copyright  2020 TBM Productions    https://developer.tbmproduction.com/projects/tbm-module/license
 *  @license    https://tbmproduction.com/license
 *
 */


$db = null;

final class tbmModule {

    public const name = "tbmModule";
    public const description = "Easy use of complex PHP functions.";
    public const version = 1.6;
    public const author = "Ben M CEO / Co-Owner TBM Productions <contact@tbmproduction.com>";
    public const docs = "https://developer.tbmproduction.com/projects/tbm-module/docs";
    public const copyright = "Copyright 2020 TBM Productions https://developer.tbmproduction.com/projects/tbmModule/license";
    public const license = "Licensed under the Apache License 2.0";


    public const information = "tbmModule v.0.6 - Easy use of complex PHP functions. - By Ben M CEO / Co-Owner TBM Productions &lt;contact@tbmproduction.com&gt;<br>Docs: https://developer.tbmproduction.com/projects/tbm-module/docs<br>Copyright: Copyright 2020 TBM Productions, Licensed under the Apache License 2.0<br><br>";

    
    /*
     *
     * CONFIG / SETTINGS
     *
     */

    private const ALLOW_COOKIE_ACCESS = true; // Allow access to cookies - Remove / Set / Edit

    private const ALLOW_ENCODING = true; // Allow Encoding & Hashing - Allow TBM Big Encode

    /*
     * Specify which encoding options you want enabled - Format (anything inserted will be enabled) base64, hex, md5, sha1, bigEncode
     */
    private const ENCODING_ALLOWED = array("base64", "hex", "md5", "sha1", "bigEncode");

    
    private const ALLOW_READ_DNS = true; // Allow access to Read DNS Records

    private const DENY_PAGE_ACCESS = false; // Will deny anyone access to the page if set to true
    private const DENIED_PAGE = "https://example.com/403-page"; // Page to redirect to if user is denied from the page

    private const ALLOW_FROM_SESSION_VARIABLE = false; // Will only deny page access if the user does not have a certain $_SESSION variable set in their session. Example: $_SESSION["allow_page_acccess"] = true (Sets the variable)

    private const SESSION_VARIABLE = "allow_page_access"; // $_SESSION Variable name (Will only allow access if if varialbe contents are true) 

    private const ALLOW_DATABASE_ACCESS = true; // Allow access to Databases

    /*
    If you have Database Access set to true, you can set a default connection.
    Will only connect to databse if connect() command is executed with no parameters or empty values.
    */
    private const DEFAULT_DATABASE_DETAILS = array('host', 'username', 'password', 'database');


    /*
     *
     * MAIN CODE
     *
     */
    
    public $dbstatus;public $error;function __construct(){$this->dbstatus="Not connected to a Database";$this->error='No Errors';if($this::DENY_PAGE_ACCESS===true&&$this::ALLOW_FROM_SESSION_VARIABLE===true){if(!isset($_SESSION[$this::SESSION_VARIABLE])&&$_SESSION[$this::SESSION_VARIABLE]!==true){header("location:".$this::DENIED_PAGE);exit(403);}}else if($this::DENY_PAGE_ACCESS===true&&$this::ALLOW_FROM_SESSION_VARIABLE!==true){header("location:".$this::DENIED_PAGE);exit(403);}if($this::ALLOW_COOKIE_ACCESS===true){$security="_tbmis";$possible_chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?/*&^|\#";$name="_tbmid";if(!$_COOKIE[$name]){for($i=0;$i!==20;$i+=1){$uid.=$possible_chars[rand(0,strlen($possible_chars))];}setrawcookie($name,$uid,0,"/","",true,);}$url=(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on'?"https":"http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";$urlname="_tbmd";if(!$_COOKIE[$urlname]){setrawcookie($urlname,$url,0,"/","",false);}else if($_COOKIE[$urlname]!==$url){setrawcookie($urlname,$url,0,"/","",false);}}}public function connect($host=null,$username=null,$password=null,$name=null):bool{if($this::ALLOW_DATABASE_ACCESS===true){if(!empty($host)||!empty($username)||!empty($password)||!empty($name)){$conn=new mysqli($host,$username,$password,$name);if(!$conn->connect_error){$db=$conn;$this->dbstatus="Connected to Database ".$name;return true;}else{$this->error="Could not connect: ".$conn->connect_error;return false;}}else{$conn=new mysqli($this::DEFAULT_DATABASE_DETAILS[0],$this::DEFAULT_DATABASE_DETAILS[1],$this::DEFAULT_DATABASE_DETAILS[2],$this::DEFAULT_DATABASE_DETAILS[3]);if(!$conn->connect_error){$db=$conn;$this->dbstatus="Connected to Database ".$name;return true;}else{$this->error="Could not connect: ".$conn->connect_error;return false;}}}else if($this::ALLOW_DATABASE_ACCESS===false){$this->dbstatus="Error: Database Connect -> Permission Denied";$this->error="Error: Database Connect -> Permission Denied";return false;}}public function globalVar($action,$name,$contents=null):bool{$action=strtolower($action);switch($action){case 'create':if(!$GLOBALS[$name]){$GLOBALS[$name]=$contents;return true;}else{$this->error="Variable '".$name."' already exists.";return false;}break;case 'edit':if(!$GLOBALS[$name]){$this->error="Variable '".$name."' does not exist.";return false;}else{$GLOBALS[$name]=$contents;return true;}break;case 'get':if(!$GLOBALS[$name]){$this->error="Variable '".$name."' does not exist.";return false;}else{return $GLOBALS[$name];}break;case 'delete':if(!$GLOBALS[$name]){$this->error="Variable '".$name."' does not exist.";return false;}else{unset($GLOBALS[$name]);return true;}break;default:$this->error="Unknown action '".$action."'. Use 'create', 'edit', 'get' or 'delete'.";return false;break;}}public function sessionVar($action,$name,$contents=null):bool{$action=strtolower($action);switch($action){case 'create':if(!$_SESSION[$name]){$_SESSION[$name]=$contents;return true;}else{$this->error="Variable '".$name."' already exists.";return false;}break;case 'edit':if(!$_SESSION[$name]){$this->error="Variable '".$name."' does not exist.";return false;}else{$_SESSION[$name]=$contents;return true;}break;case 'get':if(!$_SESSION[$name]){$this->error="Variable '".$name."' does not exist.";return false;}else{return $_SESSION[$name];}break;case 'delete':if(!$_SESSION[$name]){$this->error="Variable '".$name."' does not exist.";return false;}else{unset($_SESSION[$name]);return true;}break;default:$this->error="Unknown action '".$action."'. Use 'create', 'edit', 'get' or 'delete'.";return false;break;}}public function base64_encrypt($string):string{if($this::ALLOW_ENCODING&&in_array("base64",$this::ENCODING_ALLOWED)){if(empty($string)){$tbm->error="Please enter a string!";return "Please enter a string!";}else if(!is_string($string)){$tbm->error="Entered parameter is not a string!";return "Entered parameter is not a string!";}else{return base64_encode($string);}}else{$this->error="Cannot Base64 Encode the string: Permission Denied";return false;}}public function base64_decrypt($string):string{if($this::ALLOW_ENCODING&&in_array("base64",$this::ENCODING_ALLOWED)){if(empty($string)){$tbm->error="Please enter a string!";return "Please enter a string!";}else if(!is_string($string)){$tbm->error="Entered parameter is not a string!";return "Entered parameter is not a string!";}else{return base64_decode($string);}}else{$this->error="Cannot Base64 Decode the string: Permission Denied";return false;}}public function hex_encrypt($string):string{if($this::ALLOW_ENCODING&&in_array("hex",$this::ENCODING_ALLOWED)){if(empty($string)){$tbm->error="Please enter a string!";return "Please enter a string!";}else if(!is_string($string)){$tbm->error="Entered parameter is not a string!";return "Entered parameter is not a string!";}else{return bin2hex($string);}}else{$this->error="Cannot Hex Encode the string: Permission Denied";return false;}}public function hex_decrypt($string):string{if($this::ALLOW_ENCODING&&in_array("hex",$this::ENCODING_ALLOWED)){if(empty($string)){$tbm->error="Please enter a string!";return "Please enter a string!";}else if(!is_string($string)){$tbm->error="Entered parameter is not a string!";return "Entered parameter is not a string!";}else{return hex2bin($string);}}else{$this->error="Cannot Hex Decode the string: Permission Denied";return false;}}public function big_encrypt($string):string{if($this::ALLOW_ENCODING&&in_array("bigEncode",$this::ENCODING_ALLOWED)){if(empty($string)){$tbm->error="Please enter a string!";return "Please enter a string!";}else if(!is_string($string)){$tbm->error="Entered parameter is not a string!";return "Entered parameter is not a string!";}else{return bin2hex(base64_encode(bin2hex(base64_encode(bin2hex($string)))));}}else{$this->error="Cannot Big Encode the string: Permission Denied";return false;}}public function big_decrypt($string):string{if($this::ALLOW_ENCODING&&in_array("bigEncode",$this::ENCODING_ALLOWED)){if(empty($string)){$tbm->error="Please enter a string!";return "Please enter a string!";}else if(!is_string($string)){$tbm->error="Entered parameter is not a string!";return "Entered parameter is not a string!";}else{return hex2bin(base64_decode(hex2bin(base64_decode(hex2bin($string)))));}}else{$this->error="Cannot Big Decode the string: Permission Denied";return false;}}public function md5_hash($string,$type=false):string{if(in_array("md5",$this::ENCODING_ALLOWED)){return md5($string,$type);}else{$this->error="Cannot create an MD5 Hash: Permission Denied";return false;}}public function sha1_hash($string,$type=false):string{if(in_array("sha1",$this::ENCODING_ALLOWED)){return sha1($string,$type);}else{$this->error="Cannot create an SHA1 Hash: Permission Denied";return false;}}public function throw_error($string){throw new Exception($string);}public function checkDnsRecord($domain,$type):string{if($this::ALLOW_READ_DNS){if(checkdnsrr($domain,$type)){return "Passed";}else{return "Failed";}}else{return "Cannot Check Record Type: Permission Denied";}}public function getDnsRecord($domain,$type){if($this::ALLOW_READ_DNS){return dns_get_record($domain,$type);}else{return "Cannot Get Record: Permission Denied";}}public function getIpv6():string{$ipv6=$_SERVER['HTTP_X_FORWARDED_FOR'];if(empty($ipv6)){$this->error="Error getting User's Ip!";return "Error getting User's Ip!";}else{$pos=strpos($ipv6,",");$sub=substr($ipv6,0,$pos);return $sub;}}public function getIpv4():string{$ip=$_SERVER['REMOTE_ADDR'];if(empty($ip)){$this->error="Error getting User's Ip!";return "Error getting User's Ip!";}else{return $ip;}}public function getFullIp():string{if(!empty($_SERVER['HTTP_CLIENT_IP'])){$ip=$_SERVER['HTTP_CLIENT_IP'];}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];}else{$ip=$_SERVER['REMOTE_ADDR'];}if(empty($ip)){$this->error="Error getting User's Ip!";return "Error getting User's Ip!";}else{return $ip;}}public function getFileContents($fpath):string{try{return file_get_contents($fpath);}catch(Exception $e){return $e->getMessage();}}
}
