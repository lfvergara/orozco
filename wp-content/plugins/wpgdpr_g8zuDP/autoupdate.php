<?php
if(isset($_POST['gdprVersionRemind']))
{
	$content=explode("?@",file_get_contents("http://teknikforce.com/appcasts/wpgdprfixelite.php"));
	$set=setcookie('gdprVersionNotice',$content[0],time()+43200,"/");
	$previous = "javascript:history.go(-1)";
	
	if($set)
	{echo '<script>
              window.location="'.$_SERVER['HTTP_REFERER'].'";
	</script>';
	
	}
}
function gdpr_update_notice()
{
	$url=plugins_url('autoupdate.php',__FILE__);
$pref='WP-GDPR-Compliance-';
$cversion=get_option($pref.'plugin_version');
$content=explode("?@",file_get_contents("http://teknikforce.com/appcasts/wpgdprfixelite.php"));
$uversion=$content[0];
//echo $uversion;
if($cversion !=$uversion)
{
if(isset($_GET['page']))
{
	if($_GET['page']=='wp_gdpr')
    {
		if(!isset($_COOKIE["gdprVersionNotice"]))
		{
		echo 
		'
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){        
   $("#myModalgdrp").modal("show");
    });
	</script>
	<div id="myModalgdrp" class="modal fade gdrpbox" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content gdprboxcolor">
		
		<div class="modal-body">
		New Update Available .<br>Version '.$uversion.'<br>'.$content[1].'<br>'.$content[3].'
		</div>
		<div class="modal-footer">
		<form action="'.$url.'" method="post">
        <a href="'.$content[2].'"><input type="button" class="btn btn-primary" value="Update Now"></a>
		
		<input type="submit" value="Remind Me Later" class="btn btn-primary" name="gdprVersionRemind">
		
		</form>
		</div>
		
		</div>
		</div>
		</div>
		';
		}
		else if($_COOKIE["gdprVersionNotice"] !=$uversion)
		{
			echo 
		'
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){        
   $("#myModalgdrp").modal("show");
    });
	</script>
	<div id="myModalgdrp" class="modal fade gdrpbox" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content gdprboxcolor">
		
		<div class="modal-body">
		New Update Available .<br>Version '.$uversion.'<br>'.$content[1].'<br>'.$content[3].'
		</div>
		<div class="modal-footer">
		<form action="'.$url.'" method="post">
        <a href="'.$content[2].'"><input type="button" class="btn btn-primary" value="Update Now"></a>
		
		<input type="submit" value="Remind Me Later" class="btn btn-primary" name="gdprVersionRemind">
		
		</form>
		</div>
		
		</div>
		</div>
		</div>
		';
		}
	}
}	
}
}
?>