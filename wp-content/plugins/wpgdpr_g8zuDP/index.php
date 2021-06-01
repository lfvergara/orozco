<?php
/*
	PLUGIN NAME: instaGDPR
	Plugin URI: http://www.instagdpr.com
	Description:  Convierte tu sitio web al 100% cumplimiento del GDPR.
	AUTHOR:InstaGDPR
	AUTHOR URI:http://www.instagdpr.com
	VERSION:1.6
*/

add_action('admin_menu','wp_gdpr_add_menu');
function wp_gdpr_add_menu()
{
add_menu_page('WP GDPR','instaGDPR','administrator','wp_gdpr','wp_gdpr_intro_function','');
add_submenu_page('wp_gdpr','WP GDPR','Consentimiento de cookies','administrator','wp_gdpr_cookie','wp_gdpr_admin_cookie_function','');

add_submenu_page('wp_gdpr','WP GDPR','Términos y Condiciones','administrator','wp_gdpr_tandc','wp_gdpr_admin_tandc_function','');
add_submenu_page('wp_gdpr','WP GDPR','Política de privacidad','administrator','wp_gdpr_pp','wp_gdpr_admin_pp_function','');
add_submenu_page('wp_gdpr','WP GDPR','Derecho a ser olvidado','administrator','wp_gdpr_rtbf','wp_gdpr_admin_rtbf_function','');
add_submenu_page('wp_gdpr','WP GDPR','Acceso a datos','administrator','wp_gdpr_dac','wp_gdpr_admin_da_function','');
add_submenu_page('wp_gdpr','WP GDPR','Incumplimiento De Datos','administrator','wp_gdpr_dbr','wp_gdpr_admin_dbr_function','');
add_submenu_page('wp_gdpr','WP GDPR','Rectificación de Datos','administrator','wp_gdpr_drf','wp_gdpr_admin_drf_function','');
add_submenu_page('wp_gdpr','WP GDPR','Rechazar Visitas de la UE','administrator','wp_gdpr_eu','wp_gdpr_admin_eu_function','');
}
function wp_gdpr_intro_function()
{
	require_once("gdprfunction.php");
	require_once("introduction.php");
}
function wp_gdpr_admin_cookie_function()
{
	require_once("gdprfunction.php");
	require_once("cookie.php");
}
function wp_gdpr_admin_tandc_function()
{
	require_once("gdprfunction.php");
	require_once("tandc.php");
}
function wp_gdpr_admin_pp_function()
{
	require_once("gdprfunction.php");
	require_once("privacypolicy.php");
}
function wp_gdpr_admin_rtbf_function()
{
	require_once("gdprfunction.php");
	require_once("rightforgot.php");
}
function wp_gdpr_admin_da_function()
{
	require_once("gdprfunction.php");
	require_once("dataaccess.php");
}
function wp_gdpr_admin_dbr_function()
{
	require_once("gdprfunction.php");
	require_once("databreach.php");
}
function wp_gdpr_admin_drf_function()
{
	require_once("gdprfunction.php");
	require_once("datarectification.php");
}
function wp_gdpr_admin_eu_function()
{
	require_once("gdprfunction.php");
	require_once("eu.php");
}
function wp_gdpr_install()
{//install settings
	$pref='WP-GDPR-Compliance-';
	//User request table create
	global $wpdb;
$charset_collate = '';
  if (!empty($wpdb->charset)) 
  {
  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
  }
 if (!empty($wpdb->collate)) 
 {
        $charset_collate .= " COLLATE {$wpdb->collate}";
 }
 $table_name = $wpdb->prefix . gdpr_request_records;


	 $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (" .
            
			"`id` bigint(11) NOT NULL AUTO_INCREMENT,".
             "`user` varchar(255) NOT NULL,".
			 "`email` varchar(255) NOT NULL,".
			 "`login` varchar(255) NOT NULL,".
			 "`type` varchar(255) NOT NULL,".
              "`ip` varchar(255) NOT NULL,".
               "`value` varchar(255) NOT NULL,".
			   "`updatedvalue` varchar(255) NOT NULL,".
			   "`recorded` varchar(255) NOT NULL,".
			   "`action` varchar(255) NOT NULL,".
			   "`actiontime` varchar(255) NOT NULL,".
                  "PRIMARY KEY (`id`)".
                     ") {$charset_collate} ENGINE=InnoDB;";
                   $wpdb->query($sql);
	//cookie settings
add_option($pref.'show','n');
add_option($pref.'notice','');	
add_option($pref.'cookie-style','');
add_option($pref.'cookie-text-color','#000000');
add_option($pref.'cookie-bg-color','#e6ffff');
add_option($pref.'cookie-distance','0px');
add_option($pref.'cookie-position','bottom:0px;right:0px');
add_option($pref.'cookie-block','1');
add_option($pref.'cookie-accept-button','OK');
add_option($pref.'cookie-eu','0');
   //tandc settings
   add_option($pref.'tandc-version','1.0');
   add_option($pref.'tandc-lusr','0');
   add_option($pref.'tandc-nlusr','0');
   add_option($pref.'tandc-bef','0');
   add_option($pref.'tandc-aft','h');
   add_option($pref.'tandc-eu','0');
   //Privacy Policy settings
   add_option($pref.'pp-version','1.0');
   add_option($pref.'pp-lusr','0');
   add_option($pref.'pp-nlusr','0');
   add_option($pref.'pp-bef','0');
   add_option($pref.'pp-aft','h');
   add_option($pref.'pp-eu','0');
   //data to be forgotten
   $current_user = wp_get_current_user();
   $currentemail=$current_user->user_email;
   add_option($pref.'rtbf-email',$currentemail);
   add_option($pref.'rtbf-title','Sus datos han sido olvidados');
   add_option($pref.'rtbf-message','');
   add_option($pref.'rtbf-reassign','0');
   add_option($pref.'rtbf-reassign-user',get_current_user_id());
   //data access request
   $current_user = wp_get_current_user();
   $currentemail=$current_user->user_email;
   add_option($pref.'da-email',$currentemail);
   add_option($pref.'da-title','Sus datos');
   add_option($pref.'da-message','');
   //data breach request
   $current_user = wp_get_current_user();
   $currentemail=$current_user->user_email;
   add_option($pref.'dbr-email',$currentemail);
   add_option($pref.'dbr-title','Información de incumplimiento de datos');
   add_option($pref.'dbr-message','');
   add_option($pref.'dbr-user','1');
    //data rectification request
   $current_user = wp_get_current_user();
   $currentemail=$current_user->user_email;
   add_option($pref.'drr-email',$currentemail);
   add_option($pref.'drr-title','Data rectification notice');
   add_option($pref.'drr-message','');
   //gdpr EU
   add_option($pref.'eu-active','0');
   add_option($pref.'eu-redirect','');
   add_option($pref.'eu-people','0');
   //plugin version
    if(get_option($pref.'plugin_version'))
   {
	   update_option($pref.'plugin_version','1.6'); 
   }
   else
   {
	   add_option($pref.'plugin_version','1.6');
   }
}
function wp_gdpr_uninstall()
{//uninstall settings
	$pref='WP-GDPR-Compliance-';
	//user request table create
	
	//cookie settings
delete_option($pref.'show');
delete_option($pref.'notice');
delete_option($pref.'cookie-style');
delete_option($pref.'cookie-text-color');
delete_option($pref.'cookie-bg-color');
delete_option($pref.'cookie-position');
delete_option($pref.'cookie-distance');
delete_option($pref.'cookie-block');
delete_option($pref.'cookie-accept-button');
delete_option($pref.'cookie-eu');
   //tandc settings
   delete_option($pref.'tandc-version');
   delete_option($pref.'tandc-lusr');
   delete_option($pref.'tandc-nlusr');
   delete_option($pref.'tandc-bef');
   delete_option($pref.'tandc-aft');
   delete_option($pref.'tandc-eu');
   //privacy policy settings
   delete_option($pref.'pp-version');
   delete_option($pref.'pp-lusr');
   delete_option($pref.'pp-nlusr');
   delete_option($pref.'pp-bef');
   delete_option($pref.'pp-aft');
   delete_option($pref.'pp-eu');
   //data to be forgotten
   delete_option($pref.'rtbf-email');
   delete_option($pref.'rtbf-title');
   delete_option($pref.'rtbf-message');
   delete_option($pref.'rtbf-reassign');
   delete_option($pref.'rtbf-reassign-user');
   //data access request
   delete_option($pref.'da-email');
   delete_option($pref.'da-title');
   delete_option($pref.'da-message');
   //data branch request
   delete_option($pref.'dbr-email');
   delete_option($pref.'dbr-title');
   delete_option($pref.'dbr-message');
   //data rectification request
   delete_option($pref.'drr-email');
   delete_option($pref.'drr-title');
   delete_option($pref.'drr-message');
   //gdpr EU
   delete_option($pref.'eu-active');
   delete_option($pref.'eu-redirect');
}

//-------------------------------------------------------------	
function active_gdrp_box()
{//Show box to user if its activated
require_once("gdprfunction.php");
	$pref='WP-GDPR-Compliance-';
	if(get_option($pref.'show')=='n')
	{
		
	}
	else if(get_option($pref.'show')=='y')
	{
		show_gdpr_box();
		
	}
	else if(get_option($pref.'show')=='h')
	{
		if(is_home())
		{
		show_gdpr_box();
		}
			
	}
	else if(rmhttpurlandmatch(get_option($pref.'show'))==1)
	{
		show_gdpr_box();
	}
		
}
function show_gdpr_box()
{//display or not the box according to cookie
	$gdrpname="TEKGDRP";
	$pref='WP-GDPR-Compliance-';
	if(isset($_COOKIE[$gdrpname]))
	{
		
	}
	else
	{
		if(get_option($pref.'cookie-eu')=='1')
		{
			require_once("gdprfunction.php");
			if(euCountryOrNot()==1)
			{
		require_once("box.php");
			}
		}
		else
		{
		require_once("box.php");
		}
	}
	
}
register_activation_hook( __FILE__, 'wp_gdpr_install' );
register_deactivation_hook( __FILE__, 'wp_gdpr_uninstall' );

add_action('wp_footer','active_gdrp_box');
//----Terms and Conditions-----
function show_gdpr_tandc_accept_button()
{//add accept button to terms and condition page
	require_once("gdprfunction.php");
	return tandcacceptbutton();
	
}
add_shortcode('wpgdprTandC','show_gdpr_tandc_accept_button');

function add_gdpr_tandc_accept_cookie()
{//add accept button to terms and condition page
    
	
	require_once("gdprfunction.php");
	gdprsettandccookie();
	
	
}

if(isset($_POST['gdprnlgtandc'])){
add_action('init',add_gdpr_tandc_accept_cookie);}
function tandcusermetaorcookiesetornot()
{//redirection to terms and condition page
require_once("gdprfunction.php");
$pref='WP-GDPR-Compliance-';
if(get_option($pref.'tandc-eu')=='1')
{
	if(euCountryOrNot()==1)
	{
		if(tandc_pp_pagecheck(get_option('WP-GDPR-Compliance-pp-bef'))!=1)
			{
	require_once("gdprfunction.php");
	$pref='WP-GDPR-Compliance-';
	if(rmhttpurlandmatch(get_option($pref.'tandc-bef'))!=1)
	gdpr_check_tandc_cookie_or_usermeta();
			}
	}
}
else
{
if(tandc_pp_pagecheck(get_option('WP-GDPR-Compliance-pp-bef'))!=1)
	{
	require_once("gdprfunction.php");
	$pref='WP-GDPR-Compliance-';
	if(rmhttpurlandmatch(get_option($pref.'tandc-bef'))!=1)
	gdpr_check_tandc_cookie_or_usermeta();
	}
}
	
}

add_action('wp_head','tandcusermetaorcookiesetornot');

//-----Privacy Policy---------
function show_gdpr_pp_accept_button()
{//add accept button to Privacy Policy page
	require_once("gdprfunction.php");
	return ppacceptbutton();
	
}
add_shortcode('wpgdprPP','show_gdpr_pp_accept_button');
function add_gdpr_pp_accept_cookie()
{//add accept button to terms and condition page
    
	
	require_once("gdprfunction.php");
	gdprsetppcookie();
	
	
}

if(isset($_POST['gdprnlgpp'])){
add_action('init',add_gdpr_pp_accept_cookie);}
function ppusermetaorcookiesetornot()
{//redirection to terms and condition page
    require_once("gdprfunction.php");
 $pref='WP-GDPR-Compliance-';
  if(get_option($pref.'pp-eu')=='1')
  {
	  require_once("gdprfunction.php");
	  if(euCountryOrNot()==1)
	  {
		  if(tandc_pp_pagecheck(get_option('WP-GDPR-Compliance-tandc-bef'))!=1)
	{ 
	require_once("gdprfunction.php");
	$pref='WP-GDPR-Compliance-';
	if(rmhttpurlandmatch(get_option($pref.'pp-bef'))!=1)
	gdpr_check_pp_cookie_or_usermeta();
	}
	  }
  }
  else
  {
    if(tandc_pp_pagecheck(get_option('WP-GDPR-Compliance-tandc-bef'))!=1)
	{ 
	require_once("gdprfunction.php");
	$pref='WP-GDPR-Compliance-';
	if(rmhttpurlandmatch(get_option($pref.'pp-bef'))!=1)
	gdpr_check_pp_cookie_or_usermeta();
	}
  }
	
}

add_action('wp_head','ppusermetaorcookiesetornot');

//-----common page matching function for TandC and privacy policy

function  tandc_pp_pagecheck($url)
{//cookie match url and show alert
if(get_the_ID()==$url)
{
	return 1;
}
else
{
	return 0;
}
}
//------------Public request form using shortcode------------
add_shortcode('GDPR_UserRequestForm','gdprUserRequestForm');
function gdprUserRequestForm()
{
	require_once("gdprfunction.php");
	require_once("userform2.php");
}
//----------------Set Session if not set-----------
function gdprstart_my_session()
{//Set session if not isset
  if( !session_id() )
  {
    session_start();
  }
}
add_action('init', 'gdprstart_my_session');
//-----------Redirect EU Peoples-------------------
function gdprEUReedirect()
{
	$pref='WP-GDPR-Compliance-';
	$https = ((!empty($_SERVER['HTTPS'])) && ($_SERVER['HTTPS'] != 'off')) ? true : false;
	if($https) {
    $eupage= "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
      } else {
   $eupage= "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
              }
	require_once("gdprfunction.php");
	if((get_option($pref.'eu-active')=='1')&&(euCountryOrNot()==1))
	{
		$peoplecount=(int)get_option($pref.'eu-people');
		$peoplecount++;
		update_option($pref.'eu-people',$peoplecount);
		if($eupage==get_option($pref.'eu-redirect'))
		{}
		else if((filter_var(get_option($pref.'eu-redirect'),FILTER_VALIDATE_URL)))
		{
			echo "<script>window.location='".get_option($pref.'eu-redirect')."'</script>";
		}
	}
}
add_action('wp_head', 'gdprEUReedirect');

function gdpr_update_notice_function()
{//plugin auto update function
	require_once("autoupdate.php");
	gdpr_update_notice();
}
//add_action('admin_notices', 'gdpr_update_notice_function');
?>