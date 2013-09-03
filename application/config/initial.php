<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| INITIAL DESIGN CONFIG
| -------------------------------------------------------------------------
|
*/

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
*/

$config['base_url']	= "http://localhost/mygreenmd/";

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'session_cookie_name' = the name you want for the cookie
| 'encrypt_sess_cookie' = TRUE/FALSE (boolean).  Whether to encrypt the cookie
| 'session_expiration'  = the number of SECONDS you want the session to last.
|  by default sessions last 7200 seconds (two hours).  Set to zero for no expiration.
| 'time_to_update'		= how many seconds between CI refreshing Session Information
|
*/
$config['sess_cookie_name']		= 'token';
$config['sess_expiration']		= 7200;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'id_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update'] 	= 300;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix' = Set a prefix if you need to avoid collisions
| 'cookie_domain' = Set to .your-domain.com for site-wide cookies
| 'cookie_path'   =  Typically will be a forward slash
|
$config['cookie_prefix']	= "id_";
$config['cookie_domain']	= ".dev.id.com";
$config['cookie_path']		= "/";
*/
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['url_suffix'] = "";
define("cookie_domain",'');
define("extension", "");
/*
|--------------------------------------------------------------------------
| Email Delivery
|--------------------------------------------------------------------------
|
*/
define('SMTP_HOST', 'mail.sertifikasiguru-r10.org');
define('SMTP_USER', 'noreply@sertifikasiguru-r10.org');
define('SMTP_PASS', 'unlockaja');

/*
|--------------------------------------------------------------------------
| Web Content
|--------------------------------------------------------------------------
|
*/
define('PER_PAGE', 10);


