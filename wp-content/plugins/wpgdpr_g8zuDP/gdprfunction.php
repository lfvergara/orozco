<?php
function gdpr_all_pages($gdprtype)
{
	$pref='WP-GDPR-Compliance-';
// Set up the objects needed
$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(array('post_type' =>get_post_types('', 'names')));
// Filter through all pages and find Portfolio's children
$all_children = get_page_children( get_the_ID(), $all_wp_pages );
$all_children=get_pages();
// echo what we get back from WP to the browser
$count=0;
if(!empty($all_children)){
	if($gdprtype !='cookie')
	{
		$class="form-control";
	}
	else
	{
		$class="";
	}
	if($gdprtype =='cookie')
	{
		$class="selectcontrol";
	}
	
	echo '<select  class="'.$class.'" name="'.$gdprtype.'">';
	
		if($gdprtype=='cookie')
		{//for type cookie
	         if(get_option($pref.'show')=='y')
			 {
			 echo '<option Value="y" selected>Todas las páginas</option>';
			 echo '<option Value="n">No mostrar</option>';
			 echo '<option Value="h">Inicio</option>';
			 }
			 else if(get_option($pref.'show')=='n')
			 {
				echo '<option Value="y">Todas las páginas</option>';
			 echo '<option Value="n" selected>No mostrar</option>'; 
			 echo '<option Value="h">Inicio</option>';
			 }
			 else if(get_option($pref.'show')=='h')
			 {
				echo '<option Value="y">Todas las páginas</option>';
			 echo '<option Value="n" selected>No mostrar</option>'; 
			 echo '<option Value="h" selected>Inicio</option>';
			 }
			 else
			 {
				 echo '<option Value="y">Todas las páginas</option>';
			 echo '<option Value="n">No mostrar</option>';
			 echo '<option Value="h">Inicio</option>';
			 }
		}
		if($gdprtype=='afttandc')
		{
			//for terms and conditions after accept page redirect
			if(get_option($pref.'tandc-aft')=='l')
			 {
				 echo '<option Value="h" >Inicio</option>';
			 echo '<option Value="l" selected>Última página visitada</option>';
			echo '<option Value="n">No mostrar</option>';
			 }
			 else if(get_option($pref.'tandc-aft')=='n')
			 {
				  echo '<option Value="h" >Inicio</option>';
				  echo '<option Value="l">Última página visitada</option>';
				  echo '<option Value="n" selected>No mostrar</option>';
			 }
			 else if(get_option($pref.'tandc-aft')=='h')
			 {     echo '<option Value="h" selected>Inicio</option>';
				  echo '<option Value="l">Última página visitada</option>';
				  echo '<option Value="n">No mostrar</option>';
			 }
			 else
			 {
				  echo '<option Value="h" >Inicio</option>';
				 echo '<option Value="l">Última página visitada</option>';
				  echo '<option Value="n">No mostrar</option>';
			 }
		}
		if($gdprtype=='beftandc')
		{
			//for terms and conditions page
			if(get_option($pref.'tandc-bef')=='0')
			 {
			 echo '<option Value="0" selected></option>';
			
			 }
			 else
			 {
				echo '<option Value="0"></option>'; 
			 }
		}
		
		if($gdprtype=='aftpp')
		{
			//for privacy policy after accept page redirect
			if(get_option($pref.'pp-aft')=='l')
			 {
				 echo '<option Value="h">Inicio</option>';
			 echo '<option Value="l" selected>Última página visitada</option>';
			echo '<option Value="n">No mostrar</option>';
			 }
			 else if(get_option($pref.'pp-aft')=='n')
			 {     echo '<option Value="h">Inicio</option>';
				  echo '<option Value="l">Última página visitada</option>';
				  echo '<option Value="n" selected>No mostrar</option>';
			 }
			 else if(get_option($pref.'pp-aft')=='h')
			 {     echo '<option Value="h" selected>Inicio</option>';
				  echo '<option Value="l">Última página visitada</option>';
				  echo '<option Value="n">No mostrar</option>';
			 }
			 else
			 {
				 echo '<option Value="h">Inicio</option>';
				 echo '<option Value="l">Última página visitada</option>';
				  echo '<option Value="n">No mostrar</option>';
			 }
		}
		if($gdprtype=='befpp')
		{
			//for privacy policy  page
			if(get_option($pref.'pp-bef')=='0')
			 {
			 echo '<option Value="0" selected></option>';
			
			 }
			 else
			 {
				echo '<option Value="0"></option>'; 
			 }
		}
		
    foreach($all_children as $child){
		$count++;
		if(strlen($child->post_title)<1)
		{
			$title="No Title";
		}
		else
		{
			$title=$child->post_title;
		}
		$selected="";
		if($gdprtype=='cookie')
			{//option selection for cookie
		if(get_option($pref.'show')==$child->ID)
		{
			$selected="selected";
		}
		
			}
		if($gdprtype=='beftandc')
			{//option selection for page tandc
		if(get_option($pref.'tandc-bef')==$child->ID)
		{
			$selected="selected";
		}
			}
        if($gdprtype=='afttandc')
			{//option selection for page redicet after accepttandc
		if(get_option($pref.'tandc-aft')==$child->ID)
		{
			$selected="selected";
		}
			}

         if($gdprtype=='befpp')
			{//option selection for page privacy policy
		if(get_option($pref.'pp-bef')==$child->ID)
		{
			$selected="selected";
		}
			}
        if($gdprtype=='aftpp')
			{//option selection for page redicet after accept privacy policy
		if(get_option($pref.'pp-aft')==$child->ID)
		{
			$selected="selected";
		}
			}			
		
         echo '<option Value="'.$child->ID.'" '.$selected.'>'.$title.'</option>';
		
    }
    echo '</select>';
}
}

function  rmhttpurlandmatch($url)
{//cookie match url and show alert
if(get_the_ID()==$url)
{
	return 1;
}
else
{
	return 0;
}
/*$hurl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$surl='https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(strpos($hurl,$url)!==false)
{
	return 1;
}
else if(strpos($surl,$url)!==false)
{
	return 1 ;
}
*/
}

//-----For Terms and Conditions

function tandcacceptbutton()
{//terms and condition shortcode accept button and add user meta or cookie for it
$pref='WP-GDPR-Compliance-';
	if(isset($_POST['gdpraccept']))
	{
		if(is_user_logged_in())
		{//if user logged in add or update user meta
          $user =get_current_user_id();
		  
          $havemeta = get_user_meta($user,$pref.'tandc', false);
		  if( $havemeta)
		  {
			 if(get_user_meta($user,$pref.'tandc', true)!=get_option($pref.'tandc-version'))
			 {
				 update_user_meta($user,$pref.'tandc',get_option($pref.'tandc-version'));
			 }		 
		  }
		  else
		  {
			  add_user_meta($user,$pref.'tandc',get_option($pref.'tandc-version'));}
        }
		
									 
		if(get_option($pref.'tandc-aft')=='l')
		{
			
			$link=$_SESSION['tandclvpage'];
			echo "<script>window.location='".$link."';</script>";
		}
		else if(get_option($pref.'tandc-aft')=='h')
		{
			
			$link=$_SESSION['tandclvpage'];
			echo "<script>window.location='".get_home_url()."';</script>";
		}
		else if(get_option($pref.'tandc-aft')=='n')
		{
			
		}
		else
		{ 
			$link=get_permalink(get_option($pref.'tandc-aft'));
			echo "<script>window.location='".$link."';</script>";
		}
	}
	$nlg="";
	if(!is_user_logged_in())
	{
		$nlg="<input type='hidden' value='1' name='gdprnlgtandc'>";
	}
	$form="<p><form action='' method='post'>".$nlg."
	<label class='containerr'>
	Acepto los términos y condiciones establecidos en los Términos y condiciones.
	<input type='checkbox' required=''>
	<span class='checkmark'></span>
	</label>
	<input type='submit' value='Aceptarlo' name='gdpraccept' class='gdpracceptbutton'></form></p>";
	require_once("gdprstyle.php");
	$form .=gdprstyle();
	return $form;
}
function gdprsettandccookie()
{//adding a cookie for terms and conditions
	$pref='WP-GDPR-Compliance-';
	$tandcookie=$pref.'tandc';
	if(isset($_COOKIE[$tandcookie]))
	{
	if($_COOKIE[$tandcookie]!=get_option($pref.'tandc-version'))
	setcookie($tandcookie,get_option($pref.'tandc-version'),time()+(480000*365),COOKIEPATH, COOKIE_DOMAIN);
    }
	else
	{setcookie($tandcookie,get_option($pref.'tandc-version'),time()+(480000*365),COOKIEPATH, COOKIE_DOMAIN);}
	
}
function gdpr_check_tandc_cookie_or_usermeta()
{//check cookie or user meta set or not
$pref='WP-GDPR-Compliance-';

$https = ((!empty($_SERVER['HTTPS'])) && ($_SERVER['HTTPS'] != 'off')) ? true : false;

if(rmhttpurlandmatch(get_option($pref.'tandc-bef'))==1 || rmhttpurlandmatch(get_option($pref.'pp-bef'))==1)
{}
else{
if($https) {
    $_SESSION['tandclvpage']= "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
} else {
   $_SESSION['tandclvpage']= "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}
    }
	$tandcookie=$pref.'tandc';
	$link=get_permalink(get_option($pref.'tandc-bef'));
	
if(is_user_logged_in()&&(get_option($pref.'tandc-bef')!='0'))
{
	$user =get_current_user_id();
	$havemeta = get_user_meta($user,$pref.'tandc', false);
	if(get_option($pref.'tandc-lusr')=='1'){
		    if($havemeta){
				if(get_user_meta($user,$pref.'tandc', true)!=get_option($pref.'tandc-version'))
			echo "<script>window.location='".$link."';</script>";
			             }
             else
			 {
				echo "<script>window.location='".$link."';</script>"; 
			 }				 
			                           }
}
else if(get_option($pref.'tandc-bef')!='0' && get_option($pref.'tandc-nlusr')=='1')
{
	if(get_option($pref.'tandc-nlusr')=='1')
	{
		if(isset($_COOKIE[$tandcookie]))
		{
			if($_COOKIE[$tandcookie]!=get_option($pref.'tandc-version'))
			echo "<script>window.location='".$link."';</script>";
		}
		else
		{
			echo "<script>window.location='".$link."';</script>";
		}
	}
	else
	{
		echo "<script>window.location='".$link."';</script>";
	}
}	
		
}
//----For Privacy Policy------



function ppacceptbutton()
{//privacy policy shortcode accept button and add user meta or cookie for it
$pref='WP-GDPR-Compliance-';
	if(isset($_POST['gdpracceptpp']))
	{
		if(is_user_logged_in())
		{//if user logged in add or update user meta
          $user =get_current_user_id();
		  
          $havemeta = get_user_meta($user,$pref.'pp', false);
		  if( $havemeta)
		  {
			 if(get_user_meta($user,$pref.'pp', true)!=get_option($pref.'pp-version'))
			 {
				 update_user_meta($user,$pref.'pp',get_option($pref.'pp-version'));
			 }		 
		  }
		  else
		  {
			  add_user_meta($user,$pref.'pp',get_option($pref.'pp-version'));}
        }
		
									 
		if(get_option($pref.'pp-aft')=='l')
		{
			
			$link=$_SESSION['pplvpage'];
			echo "<script>window.location='".$link."';</script>";
		}
		else if(get_option($pref.'pp-aft')=='h')
		{
			
			$link=$_SESSION['pplvpage'];
			echo "<script>window.location='".get_home_url()."';</script>";
		}
		else if(get_option($pref.'pp-aft')=='n')
		{
			
		}
		else
		{ 
			$link=get_permalink(get_option($pref.'pp-aft'));
			echo "<script>window.location='".$link."';</script>";
		}
	}
	$nlg="";
	if(!is_user_logged_in())
	{
		$nlg="<input type='hidden' value='1' name='gdprnlgpp'>";
	}
	$form="<p><form action='' method='post'>".$nlg."
	<label class='containerr'>
	Revisé la Política de privacidad y doy mi consentimiento a los términos establecidos.
	<input type='checkbox' required=''>
	<span class='checkmark'></span></label>
	<input type='submit' class='gdpracceptbutton' value='Aceptarlo' name='gdpracceptpp' ></form></p>";
	
	require_once("gdprstyle.php");
	$form .=gdprstyle();
	return $form;
}
function gdprsetppcookie()
{//adding a cookie for privacy policy
	$pref='WP-GDPR-Compliance-';
	$ppcookie=$pref.'pp';
	if(isset($_COOKIE[$ppcookie]))
	{
	if($_COOKIE[$ppcookie]!=get_option($pref.'pp-version'))
	setcookie($ppcookie,get_option($pref.'pp-version'),time()+(480000*365),COOKIEPATH, COOKIE_DOMAIN);
    }
	else
	{setcookie($ppcookie,get_option($pref.'pp-version'),time()+(480000*365),COOKIEPATH, COOKIE_DOMAIN);}
	
}
function gdpr_check_pp_cookie_or_usermeta()
{//check cookie or user meta set or not for privacy policy
$pref='WP-GDPR-Compliance-';

$https = ((!empty($_SERVER['HTTPS'])) && ($_SERVER['HTTPS'] != 'off')) ? true : false;
if(rmhttpurlandmatch(get_option($pref.'tandc-bef'))==1 || rmhttpurlandmatch(get_option($pref.'pp-bef'))==1)
{}
else{
if($https) {
    $_SESSION['pplvpage']= "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
} else {
   $_SESSION['pplvpage']= "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}
    }
	$ppcookie=$pref.'pp';
	$link=get_permalink(get_option($pref.'pp-bef'));
	
if(is_user_logged_in()&&(get_option($pref.'pp-bef')!='0'))
{
	$user =get_current_user_id();
	$havemeta = get_user_meta($user,$pref.'pp', false);
	if(get_option($pref.'pp-lusr')=='1'){
		    if($havemeta){
				if(get_user_meta($user,$pref.'pp', true)!=get_option($pref.'pp-version'))
			echo "<script>window.location='".$link."';</script>";
			             }
             else
			 {
				echo "<script>window.location='".$link."';</script>"; 
			 }				 
			                           }
}
else if(get_option($pref.'pp-bef')!='0'&& get_option($pref.'pp-nlusr')=='1')
{
	if(get_option($pref.'pp-nlusr')=='1')
	{
		if(isset($_COOKIE[$ppcookie]))
		{
			if($_COOKIE[$ppcookie]!=get_option($pref.'pp-version'))
			echo "<script>window.location='".$link."';</script>";
		}
		else
		{
			echo "<script>window.location='".$link."';</script>";
		}
	}
	else
	{
		echo "<script>window.location='".$link."';</script>";
	}
}	
		
}
//---------Right to be forgotten request table----------------------
function showRequestToForget()
{
	echo '<script>
		
			</script>';
	
	global $wpdb;
	$table=$wpdb->prefix.'gdpr_request_records';
	
	 if(isset($_GET['wpcrpagecount']))
	  {
		  $wpcridin=$_GET['wpcrpagecount'];
		  $sql="select * from ".$table." where type='fm' and id <".$wpcridin." order by id desc";
	   
	  }
	  else 
	  {
	  $sql="select * from ".$table." where type='fm' order by id desc";
	  }
	$records=$wpdb->get_results($sql);
	$wpcrcount=0;
	$last=0;
	foreach($records as $data)
	{
		$wpcrcount++;
		
		if($data->login=='1')
		{
			$login="<font color='green'>Conectado </font>";
		}
		else if($data->login=='2')
		{
			$login="<font color='green'>Confirmado con enlace de verificación .</font>";
		}
		else
		{
			$login="<font color='red'>Enlace de confirmación enviado.</font>";
		}
		if($data->action=='0')
		{
			$action='<table><tr><td><button type="submit" class="btn btn-primary" value="Forget" name="gdprfmtakeaction" data-toggle="tooltip" title="Olvídese de los datos solicitados y envíe un correo electrónico de confirmación">
			<span class="glyphicon glyphicon-ok-sign"></span>
            </button></td><td>
			<button type="submit" class="btn btn-info" value="Forget" name="gdprfmview" data-toggle="tooltip" title="Ver datos solicitados">
			<span class="glyphicon glyphicon-eye-open"></span>
            </button></td><td>
			<button type="submit" name="gdprfmremove" class="btn btn-danger" value="remove" onclick="return gdprfmActionDel()" data-toggle="tooltip" title="Eliminar solicitud">
			<span class="glyphicon glyphicon-trash"></span>
            </button></td></tr></table>
			';
		}
		else
		{
			$action='<span style="margin-left:84px;"><button type="submit" name="gdprfmremove" class="btn btn-danger" value="remove" onclick="return gdprfmActionDel()" data-toggle="tooltip" title="Eliminar solicitud">
			<span class="glyphicon glyphicon-trash"></span>
            </button>';
		}
		if($data->value=='c'){$type="Comments";}if($data->value=='p'){$type="Posts";}if($data->value=='u'){$type="User Meta";}
		echo
		'
		<form action="" method="post">
		<input type="hidden" value="'.$data->value.'" name="afmvalue">
		<input type="hidden" value='.$data->id.' name="afmreqid">
		<input type="hidden" value='.$data->user.' name="afmuser">
		<input type="hidden" value='.$data->email.' name="afmemail">
		<tr>
		<td>'.$data->id.'</td><td>'.$data->email.'</td><td>'.$login.'</td><td>'.$type.'</td><td>'.$data->recorded.'</td><td>'.$data->actiontime.'</td><td>'.$action.'</td>
		</tr>
		</form>
		';
		if($wpcrcount==10)
		   {
			      
			   break;
		   }
	}
	$gdprfmnxtpage=$_SERVER['http_host'].$_SERVER['REQUEST_URI'].'&wpcrpagecount='.$data->id;
	echo
	'
	<tfoot>
		<tr>
			<td colspan="8">
			<ul class="pager">';
		if(isset($_GET['wpcrpagecount']))
		{			
             echo '			
			 <script type="text/javascript">
            function goBack() {
              window.history.back();
                  }
                </script>
				<li class="previous" onclick="goBack()"><a style="cursor:pointer">Anterior</a></li>';
		}
        
      if($wpcrcount==10)
	  {		  
	echo '<li class="next"><a href="'.$gdprfmnxtpage.'">Siguiente</a></li>';
	  }
		
			
	echo '</ul>
			</td>
		</tr>
	</tfoot>
	
	';
}
//---------Data access request table----------------------

function showRequestToDataAccess()
{
	echo '<script>
		
			</script>';
	
	global $wpdb;
	$table=$wpdb->prefix.'gdpr_request_records';
	
	 if(isset($_GET['wpcrpagecount']))
	  {
		  $wpcridin=$_GET['wpcrpagecount'];
		  $sql="select * from ".$table." where type='da' and id <".$wpcridin." order by id desc";
	   
	  }
	  else 
	  {
	  $sql="select * from ".$table." where type='da' order by id desc";
	  }
	$records=$wpdb->get_results($sql);
	$wpcrcount=0;
	$last=0;
	foreach($records as $data)
	{
		$wpcrcount++;
		
		if($data->login=='1')
		{
			$login="<font color='green'>Conectado</font>";
		}
		else if($data->login=='2')
		{
			$login="<font color='green'>Confirmado con enlace de verificación .</font>";
		}
		else
		{
			$login="<font color='red'>Enlace de confirmación enviado</font>";
		}
		/*else if($data->login=='2')
		{
			$login="<font color='orange'></p>Email is not registered with this id .</p></font>";
		}
		else if($data->login=='0')
		{
			$login="<font color='red'></p>Did not login.</p></font>";
		}*/
		
		if($data->action=='0')
		{
			$action='<table><tr><td><button type="submit" class="btn btn-primary" value="Forget" name="gdprdatakeaction" data-toggle="tooltip" title="Enviar datos solicitados">
			<span class="glyphicon glyphicon-ok-sign"></span>
            </button></td><td>
			<button type="submit" class="btn btn-info" value="Forget" name="gdprdaview" data-toggle="tooltip" title="Ver datos solicitados">
			<span class="glyphicon glyphicon-eye-open"></span>
            </button></td><td>
			<button type="submit" name="gdprdaremove" class="btn btn-danger" value="remove" onclick="return gdprdaAction()" data-toggle="tooltip" title="Eliminar solicitud">
			<span class="glyphicon glyphicon-trash"></span>
            </button></td></tr></table>
			';
		}
		else
		{
			$action='<span style="margin-left:84px"><button type="submit" name="gdprdaremove" class="btn btn-danger" value="remove" onclick="return gdprdaAction()" data-toggle="tooltip" title="Eliminar solicitud">
			<span class="glyphicon glyphicon-trash"></span>
            </button></span>';
		}
		echo
		'
		<form action="" method="post">
		<input type="hidden" value='.$data->id.' name="dareqid">
		<input type="hidden" value='.$data->user.' name="dauser">
		<input type="hidden" value='.$data->email.' name="daemail">
		<tr>
		<td>'.$data->id.'</td><td>'.$data->email.'</td><td>'.$login.'</td><td>'.$data->recorded.'</td><td>'.$data->actiontime.'</td><td>'.$action.'</td>
		</tr>
		</form>
		';
		if($wpcrcount==10)
		   {
			      
			   break;
		   }
	}
	$gdprfmnxtpage=$_SERVER['http_host'].$_SERVER['REQUEST_URI'].'&wpcrpagecount='.$data->id;
	echo
	'
	<tfoot>
		<tr>
			<td colspan="7">
			<ul class="pager">';
		if(isset($_GET['wpcrpagecount']))
		{			
             echo '			
			 <script type="text/javascript">
            function goBack() {
              window.history.back();
                  }
                </script>
				<li class="previous" onclick="goBack()"><a style="cursor:pointer">Anterior</a></li>';
		}
        
      if($wpcrcount==10)
	  {		  
	echo '<li class="next"><a href="'.$gdprfmnxtpage.'">Siguiente</a></li>';
	  }
		
			
	echo '</ul>
			</td>
		</tr>
	</tfoot>
	
	';
}
//----------data rectification request table-------------


function showRequestToDataRectification()
{
	echo '<script>
		
			</script>';
	
	global $wpdb;
	$table=$wpdb->prefix.'gdpr_request_records';
	
	 if(isset($_GET['wpcrpagecount']))
	  {
		  $wpcridin=$_GET['wpcrpagecount'];
		  $sql="select * from ".$table." where type='dr' and id <".$wpcridin." order by id desc";
	   
	  }
	  else 
	  {
	  $sql="select * from ".$table." where type='dr' order by id desc";
	  }
	$records=$wpdb->get_results($sql);
	$wpcrcount=0;
	$last=0;
	foreach($records as $data)
	{
		$wpcrcount++;
		
		if($data->login=='1')
		{
			$login="<font color='green'>Conectado</font>";
		}
		else if($data->login=='2')
		{
			$login="<font color='green'>Confirmado con enlace de verificación .</font>";
		}
		else
		{
			$login="<font color='red'>Enlace de confirmación enviado.</font>";
		}
		/*else if($data->login=='2')
		{
			$login="<font color='orange'></p>Email is not registered with this id .</p></font>";
		}
		else if($data->login=='0')
		{
			$login="<font color='red'></p>Did not login.</p></font>";
		}*/
		if($data->value=='c'){$type="Comments";}if($data->value=='p'){$type="Posts";}if($data->value=='u'){$type="User Data";}
		if($data->action=='0')
		{
			$action='<table><tr><td><button type="submit" class="btn btn-primary" value="Forget" name="gdprdrtakeaction" data-toggle="tooltip" title="Enviar datos solicitados">
			<span class="glyphicon glyphicon-ok-sign"></span>
            </button></td><td>
			<button type="submit" class="btn btn-info" value="Forget" name="gdprdrview" data-toggle="tooltip" title="Ver datos solicitados">
			<span class="glyphicon glyphicon-eye-open"></span>
            </button></td><td>
			<button type="submit" name="gdprdrremove" class="btn btn-danger" value="remove" onclick="return gdprdrAction()" data-toggle="tooltip" title="Eliminar solicitud">
			<span class="glyphicon glyphicon-trash"></span>
            </button></td></tr></table>
			';
		}
		else
		{
			$action='<span style="margin-left:84px"><button type="submit" name="gdprdrremove" class="btn btn-danger" value="remove" onclick="return gdprdrAction()" data-toggle="tooltip" title="Eliminar solicitud">
			<span class="glyphicon glyphicon-trash"></span>
            </button></span>';
		}
		echo
		'
		<form action="" method="post">
		<input type="hidden" value='.$data->value.' name="drrtype">
		<input type="hidden" value='.$data->id.' name="drreqid">
		<input type="hidden" value='.$data->user.' name="druser">
		<input type="hidden" value='.$data->email.' name="dremail">
		<tr>
		<td>'.$data->id.'</td><td>'.$data->email.'</td><td>'.$login.'</td><td>'.$type.'</td><td>'.$data->recorded.'</td><td>'.$data->actiontime.'</td><td>'.$action.'</td>
		</tr>
		</form>
		';
		if($wpcrcount==10)
		   {
			      
			   break;
		   }
	}
	$gdprfmnxtpage=$_SERVER['http_host'].$_SERVER['REQUEST_URI'].'&wpcrpagecount='.$data->id;
	echo
	'
	<tfoot>
		<tr>
			<td colspan="7">
			<ul class="pager">';
		if(isset($_GET['wpcrpagecount']))
		{			
             echo '			
			 <script type="text/javascript">
            function goBack() {
              window.history.back();
                  }
                </script>
				<li class="previous" onclick="goBack()"><a style="cursor:pointer">Anterior</a></li>';
		}
        
      if($wpcrcount==10)
	  {		  
	echo '<li class="next"><a href="'.$gdprfmnxtpage.'">Siguiente</a></li>';
	  }
		
			
	echo '</ul>
			</td>
		</tr>
	</tfoot>
	
	';
}





//--------gdpr send mail function----
function gdprSendWPMail($to,$subject,$body)
{
	$wpcrmailheaders = "MIME-Version: 1.0" . "\r\n";
                $wpcrmailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				$wpcrmailbody='
				<html><head></head><body>
				<p style="font-size:18px;padding:2px;margin-top:8px;margin-bottom:6px;color:white;background-color:#003366;">'.$subject.'</p><br>
				<p>'.$body.'</p>
				</body></html>
				';
				
				wp_mail($to,$subject,$body,$wpcrmailheaders);
}
//--------gdpr short code frgt me request function----
function gdprRequestForgetMe()
{
	$head="Hola,<br>Una solicitud para olvidar fue creada en tu blog. Está registrado en la sección de administración de instaGDPR. <br>";
	$foot="<br>Por favor revísalo cuando sea conveniente.<br>Gracias";
	
	$pref='WP-GDPR-Compliance-';
	global $wpdb;
	$table=$wpdb->prefix."gdpr_request_records";
	$login='0';
if(is_user_logged_in())
{
	if(email_exists($_POST['gdprfmemail'])==get_current_user_id())
	{$login='1';}
}
if($_POST['gdprfmchkboxc']=='c')
{
	if($login=='0')
   {
	   $vlogin=gdprMailConfirmationLink($_POST['gdprfmemail'],'Solicitud para Olvidar la Confirmación de Comentarios','fm');
	   $clogin=$vlogin;
   }
	else
	{$clogin=$login;}
	$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,user,email,login, type,ip,value,updatedvalue,recorded,action, actiontime)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',get_current_user_id(),$_POST['gdprfmemail'],$clogin,'fm',$_SERVER['REMOTE_ADDR'],'c','',date('d-M-Y h:iA'),'0',' ')));
	
	$body=$head."The requesting email id : ".$_POST['gdprfmemail'].$foot;
	gdprSendWPMail(get_option($pref.'rtbf-email'),'Solicitud de olvidar creado',$body);
	
}
if($_POST['gdprfmchkboxp']=='p')
{
	if($login=='0')
   {
	   $vlogin=gdprMailConfirmationLink($_POST['gdprfmemail'],'Solicitud para olvidar la confirmación de publicaciones','fm');
	   $plogin=$vlogin;
   }
	else {$plogin=$login;}
	$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,user,email,login, type,ip,value,updatedvalue,recorded,action, actiontime)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',get_current_user_id(),$_POST['gdprfmemail'],$plogin,'fm',$_SERVER['REMOTE_ADDR'],'p','',date('d-M-Y h:iA'),'0',' ')));
	
	$body=$head."El correo electrónico que solicita id : ".$_POST['gdprfmemail'].$foot;
	gdprSendWPMail(get_option($pref.'rtbf-email'),'Solicitud de olvidar creado.',$body);
}
if($_POST['gdprfmchkboxu']=='u')
{
	if($login=='0')
   {
	   $vlogin=gdprMailConfirmationLink($_POST['gdprfmemail'],'Solicitud para olvidar la confirmación del usuario Meta','fm');
	   $ulogin=$vlogin;
   }
	else {$ulogin=$login;}
	$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,user,email,login, type,ip,value,updatedvalue,recorded,action, actiontime)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',get_current_user_id(),$_POST['gdprfmemail'],$ulogin,'fm',$_SERVER['REMOTE_ADDR'],'u','',date('d-M-Y h:iA'),'0',' ')));
	
	$body=$head."The requesting email id : ".$_POST['gdprfmemail'].$foot;
	gdprSendWPMail(get_option($pref.'rtbf-email'),'Solicitud de olvidar creado.',$body);
}
if($login=='1')
{echo "<script>alert('Solicitud recibida');</script>";}
else
{echo "<script>alert('Correo de confirmación enviado');</script>";}
}
//-------------gdpr short code data access request submission------------
function gdprRequestDataAccess()
{
	$pref='WP-GDPR-Compliance-';
	global $wpdb;
	$table=$wpdb->prefix."gdpr_request_records";
	$login='0';
if(is_user_logged_in())
{
	if(email_exists($_POST['gdpremailpda'])==get_current_user_id())
	{
		$login='1';
		$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,user,email,login, type,ip,value,updatedvalue,recorded,action, actiontime)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',get_current_user_id(),$_POST['gdpremailpda'],$login,'da',$_SERVER['REMOTE_ADDR'],'','',date('d-M-Y h:iA'),'0',' ')));
		
	}
    
}
if($login=='0')
{
	$login=gdprMailConfirmationLink($_POST['gdpremailpda'],'Confirmación de acceso a datos','da');
	$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,user,email,login, type,ip,value,updatedvalue,recorded,action, actiontime)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',get_current_user_id(),$_POST['gdpremailpda'],$login,'da',$_SERVER['REMOTE_ADDR'],'','',date('d-M-Y h:iA'),'0',' ')));
	echo "<script>alert('Enlace de confirmación enviado')</script>";
}

	
	
	$body="Hello,<br>A data access report was filed by ".$_POST['gdpremailpda']." El informe ha sido registrado en el administrador de instaGDPR.<br>Por favor revise a su conveniencia.<br>Gracias";
	gdprSendWPMail(get_option($pref.'da-email'),'Informe de datos solicitado',$body);
	if($login=='1')
	{echo "<script>alert('Solicitud recibida');</script>";}
}

//---------gdpr shortcode data rectification request submission--------
function gdprRequestDataRectification()
{
	$head="Hola,<br>Una solicitud de rectificación de datos fue registrada por <br>";
	$foot="<br>Está registrado en el administrador de instaGDPR.<br>Por favor revise cuando sea conveniente.<br>Gracias";
	
	$pref='WP-GDPR-Compliance-';
	global $wpdb;
	$table=$wpdb->prefix."gdpr_request_records";
	$login='0';
if(is_user_logged_in())
{
	if(email_exists($_POST['gdprdremail'])==get_current_user_id())
	{$login='1';}
}
if($_POST['gdprdrchkboxc']=='c')
{
	if($login=='0')
   {
	   $vlogin=gdprMailConfirmationLink($_POST['gdprdremail'],'Solicitud de rectificación Confirmación de comentarios','dr');
	   $clogin=$vlogin;
   }
	else
	{$clogin=$login;}
	$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,user,email,login, type,ip,value,updatedvalue,recorded,action, actiontime)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',get_current_user_id(),$_POST['gdprdremail'],$clogin,'dr',$_SERVER['REMOTE_ADDR'],'c',$_POST['gdprrectification'],date('d-M-Y h:iA'),'0',' ')));
	
	$body=$head.$_POST['gdprdremail'].$foot;
	gdprSendWPMail(get_option($pref.'drr-email'),'Solicitud de rectificación de datos registrada',$body);
	
}
if($_POST['gdprdrchkboxp']=='p')
{
	if($login=='0')
   {
	   $vlogin=gdprMailConfirmationLink($_POST['gdprdremail'],'Solicitud para olvidar la confirmación de publicaciones','dr');
	   $plogin=$vlogin;
   }
	else {$plogin=$login;}
	$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,user,email,login, type,ip,value,updatedvalue,recorded,action, actiontime)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',get_current_user_id(),$_POST['gdprdremail'],$plogin,'dr',$_SERVER['REMOTE_ADDR'],'p',$_POST['gdprrectification'],date('d-M-Y h:iA'),'0',' ')));
	
	$body=$head.$_POST['gdprdremail'].$foot;
	
	gdprSendWPMail(get_option($pref.'drr-email'),'Solicitud de rectificación de datos registrada',$body);
}
if($_POST['gdprdrchkboxu']=='u')
{
	if($login=='0')
   {
	   $vlogin=gdprMailConfirmationLink($_POST['gdprdremail'],'Solicitud para rectificar Confirmación de datos de usuario','dr');
	   $ulogin=$vlogin;
   }
	else {$ulogin=$login;}
	$in=$wpdb->query($wpdb->prepare("insert into ".$table."(id,user,email,login, type,ip,value,updatedvalue,recorded,action, actiontime)values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",array('',get_current_user_id(),$_POST['gdprdremail'],$ulogin,'dr',$_SERVER['REMOTE_ADDR'],'u',$_POST['gdprrectification'],date('d-M-Y h:iA'),'0',' ')));
	
	$body=$head.$_POST['gdprdremail'].$foot;
	gdprSendWPMail(get_option($pref.'drr-email'),'Solicitud de rectificación de datos registrada',$body);
}
if($login=='1')
{echo "<script>alert('Solicitud recibida');</script>";}
else
{echo "<script>alert('Correo de confirmación enviado');</script>";}
}

//-------mail confirmation link-------
function gdprMailConfirmationLink($to,$subject,$type)
{
	if($type=='da')
	{
		$subject="Por favor confirme su solicitud de datos";
		$cnfheader="Hola,<br>Hiciste una solicitud para informarnos todos los datos que tenemos sobre ti.<br>Plese confirma que ha hecho esta solicitud haciendo clic en el siguiente enlace.<br>";
        $cnffooter="<br>Sus datos serán enviados a usted en la confirmación.<br>Gracias";	
	}
	if($type=='fm')
	{
		$subject="Solicitud de olvidar";
		$cnfheader="Hola,<br>Has hecho una solicitud para olvidarte de nosotros. Haga clic en el enlace a continuación para confirmar que la solicitud sea válida. Su solicitud será procesada después de hacer clic en la confirmación.<br>";
        $cnffooter="<br>Gracias";
	}
	if($type=='dr')
	{
		$subject="Su solicitud para rectificar datos";
		$cnfheader="Hola,<br>Has hecho una solicitud para rectificar tus datos con nosotros. Haga clic en el enlace a continuación para confirmar la solicitud.<br>";
        $cnffooter="<br>Sus datos serán rectificados por el administrador en la confirmación.<br>Gracias";
	}
	$wpcrmailheaders = "MIME-Version: 1.0" . "\r\n";
    $wpcrmailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$otp=substr(str_shuffle('123456789abscfghijklmnopqrstuvwxyz@ABCDFGHJ'),0,5);
	$msg=get_permalink().'?gdpremail='.$to.'&gdprtype='.$type.'&gdprotp='.$otp;
	$msg=$cnfheader.$msg.$cnffooter;
	wp_mail($to,$subject,$msg,$wpcrmailheaders);
	return $otp;
}
//-----------------Teknik force logo-------------------
function gdprteknikforce_display_logo()
{
	 '<span class="pull-right" style="right:0px;margin-bottom:10px;margin-right:13px;"><a href="https://teknikforce.com" target="_BLANK"><img src="'.plugins_url('tekniklogo.png',__FILE__).'" style=""></a></span>';
	
	echo '<span style="left:0px;margin-bottom:10px;margin-right:13px;"><a href="" target="_BLANK"><img src="'.plugins_url('img/wpgdpprlogo.png',__FILE__).'" style=""></a></span>';
	echo '<p style="margin-top:5px;">Si bien instaGDPR implementa muchos de los requisitos GDPR, puede no ser suficiente para cubrir las necesidades únicas de cumplimiento de su negocio. Le recomendamos que consulte a un consultor de privacidad profesional o GDPR para asegurarse de que sus prácticas comerciales y la estructura del sitio cumplan con GDPR e implemente cualquier medida adicional si es necesario.</p>';

}
//-------terms and conditions set or not--
function isSetTandC()
{$pref='WP-GDPR-Compliance-';
	if(get_option($pref.'tandc-bef')!='0')
		
		{
			return 1;
		}
		else
		{
			return 0;
		}
}
//-------privacy policy set or not--
function isSetPP()
{$pref='WP-GDPR-Compliance-';
	if(get_option($pref.'pp-bef')!='0')
		
		{
			return 1;
		}
		else
		{
			return 0;
		}
}
//--------did the user form published or not----------
function isUserFormPublished()
{
	$count=0;
	$pref='WP-GDPR-Compliance-';
$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(array('post_type' =>get_post_types('', 'names')));
$all_children = get_page_children( get_the_ID(), $all_wp_pages );
foreach($all_children as $child)
{
	if(has_shortcode( $child->post_content, 'GDPR_UserRequestForm'))
	{
		
		$count=1;
		break;
	}
}
return $count;
}
function complianceStatus()
{//compliance status
$pref='WP-GDPR-Compliance-';
	$count=0;
 if(strlen(get_option($pref.'notice'))>0){$count++;}
 if(isSetTandC()==1){$count++;}
 if(isSetPP()==1){$count++;}
 if(strlen(get_option($pref.'rtbf-message'))>0){$count++;}
 if(strlen(get_option($pref.'da-message'))>0){$count++;}
 if(strlen(get_option($pref.'dbr-message'))>0){$count++;}
 if(strlen(get_option($pref.'drr-message'))>0){$count++;}
 //if(get_option($pref.'eu-active')=='0'){$count++;}
 return $count;
}
//-----------EU country or not---------
function euCountryOrNot() 
{
    $ip = $_SERVER['REMOTE_ADDR']; // the IP address to query
  $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
  if($query && $query['status'] == 'success')
  {
	  $my_countrieseuro = array('BE','BG','CZ','DK','DE','EE','IE','EL','ES','FR','HR','IT','CY','LV','LT','LU','HU','MT','NL','AT','PL','PT','RO','SI','SK','FI','SE','UK');
    if (in_array($query['countryCode'], $my_countrieseuro)) {
    	return 1;
    	
    }
    else{
    	return 0;
    }
	  
  }
   
    
}
//----GDPR Visual Editor Text---------
function gdprEditorText($type)
{
	if($type=='cookie')
	{
		$text="Important<br>
Este sitio hace uso de cookies que pueden contener información de seguimiento sobre los visitantes. Al continuar navegando en este sitio, acepta nuestro uso de cookies.
";
	}
	if($type=='rightforget')
	{
		$text="Hola,<br>

Por favor, consulte su solicitud para olvidar sus datos en nuestro blog. <br>

Esto es para informar que se han tomado medidas y que sus datos han sido olvidados según lo solicitado.<br>

Si tiene alguna consulta, háganoslo saber.<br>

Thanks
";
	}
	if($type=='dataaccess')
	{
		$text="Hola,<br>

Consulte su solicitud para informar todos los datos que tenemos sobre usted.<br>

Adjunto encontrará todos los datos que tenemos sobre usted. <br>

Si necesita más información, por favor háganos saber.<br>

Gracias
";
	}
	if($type=='databreach')
	{
		$text="Hola,<br>

Lamentamos informarle que hubo una violación de datos en nuestro sitio y su información o contraseñas pueden verse comprometidas. <br>

Le solicitamos que cambie su contraseña en nuestro sitio lo antes posible, y también en cualquier otro sitio donde haya utilizado la misma contraseña. <br>

También revise su información con nosotros y asegúrese de que esté adecuadamente protegido contra cualquier uso indebido. <br>

Estamos trabajando para cerrar la brecha y recibirá notificaciones de nuevos desarrollos, si los hubiera. <br>

Gracias
";
	}
	if($type=='datarectification')
	{
		
		$text="Hola, <br>

Por favor, consulte su solicitud de rectificación de datos con nosotros. Nos complace informarle que se tomaron medidas con respecto a su solicitud y se corrigieron sus datos. <br>

Háganos saber si necesita otra ayuda. <br>

Gracias
";
	}
	return $text;
}
?>