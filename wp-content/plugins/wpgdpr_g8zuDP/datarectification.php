<?php
$pref='WP-GDPR-Compliance-';
$timenow=date('d-M-Y h:iA');
global $wpdb;
$table=$wpdb->prefix."gdpr_request_records";


if(isset($_POST['defrecttext']))
{
	update_option($pref.'drr-message',gdprEditorText('datarectification'));
}

if(isset($_POST['savedrrsettings']))
{
	if(filter_var($_POST['drremail'],FILTER_VALIDATE_EMAIL))
	{
update_option($pref.'drr-email',$_POST['drremail']);
	}
	else
	{echo "<script>alert('Email inválido');</script>";}
update_option($pref.'drr-title',$_POST['drrtitle']);
update_option($pref.'drr-message',stripslashes($_POST['drrmessage']));
}
if(isset($_POST['gdprdrremove']))
{
	global $wpdb;
	$table=$wpdb->prefix."gdpr_request_records";
	$wpdb->query($wpdb->prepare("delete from ".$table." where id=%d ",array($_POST['drreqid'])));
}
if(isset($_POST['gdprdrtakeaction']))
{
	$wpcrmailheaders = "MIME-Version: 1.0" . "\r\n";
    $wpcrmailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	 if(wp_mail($_POST['dremail'],get_option($pref.'drr-title'),get_option($pref.'drr-message'),$wpcrmailheaders))
  {
	  $datables=$wpdb->prefix."gdpr_request_records";
	  $wpdb->query($wpdb->prepare("update ".$datables." set action=%s , actiontime='%s' where id=%d ",array('1',$timenow,$_POST['drreqid'])));
	  echo "<script>alert('Correo electrónico de confirmación enviado con éxito a ".$to."');</script>";
  }
  else
  {
	   echo "<script>alert('No se puede enviar el correo electronico');</script>";
  }
}
?>

<html lang="en">
  <head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script type="text/javascript">
  function gdprdrAction(){
			var conf=confirm("Estás seguro que quieres eliminar esto");
			if(conf==true)
			{return true;}
			else
			{return false;}
			}
  </script>
  <script>
   $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
  </head>
	<body>
	
	
	<br><br>
		<ul class="nav nav-tabs">
		<li ><a href="admin.php?page=wp_gdpr">Conformidad</a></li>
		<li><a href="admin.php?page=wp_gdpr_cookie">Consentimiento de cookies</a></li>
		<li><a href="admin.php?page=wp_gdpr_tandc">Términos y Condiciones</a></li>
		<li><a href="admin.php?page=wp_gdpr_pp">Política de privacidad</a></li>
		<li><a href="admin.php?page=wp_gdpr_rtbf">Derecho a ser olvidado</a></li>
		<li><a href="admin.php?page=wp_gdpr_dac">Acceso a datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_dbr">Incumplimiento De Datos</a></li>
		<li class="active"><a href="admin.php?page=wp_gdpr_drf">Rectificación de Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_eu">Rechazar Visitas de la UE</a></li>
	</ul>
<br>
	
	
	
	
	
	
	
	<div class="container-fluid">
	<div class="row">
	<?php
	if(isset($_POST['gdprdrview']))
	{
		if($_POST['drrtype']=='u')
{ 
	if(email_exists($_POST['dremail']))
	{
	$resultaction="<p align='right'><a href='user-edit.php?user_id=".email_exists($_POST['dremail'])."'><input type='button' class='btn btn-primary mdu' value=''></a></p>";
	}
	else
	{
		$resultaction="<font color='red'><b>el usuario no existe .</b></font>";
	}
}
if($_POST['drrtype']=='p')
{
	if(email_exists($_POST['dremail']))
	{
	$resultaction=
	"
	<table class='table table-stripped table-hover gdprrqtable'>
	<thead><tr><th>#</th><th>Fecha</th><th>Título de la entrada</th><th>Acción</th></tr><thead>
	<tbody>";
	$args = array(
    'author'        =>email_exists($_POST['dremail']),
    'orderby'       =>  'post_date',
    'order'         =>  'ASC' 
    );
	$drposts=get_posts( $args );
	
	foreach($drposts as $data)
	{
		$resultaction .="<tr><td>".$data->ID."</td><td>".$data->post_date."</td><td>".$data->post_title."</td><td><a href='post.php?post=".$data->ID."&action=edit'><input type='button' class='btn btn-primary mdp' value=''></a></td></tr>";
	}
	$resultaction .="</tbody>
	</table>
	";
	}
}
if($_POST['drrtype']=='c')
{
	$drcomments="<table class='table table-stripped table-hover'><thead><tr><th>#</th><th>Fecha</th><th>Título de la entrada</th><th>Comentario</th><th>Acción</th></tr></thead><tbody>";
	$args=array(
	'author_email' =>$_POST['dremail']);
	 $comments=get_comments( $args );
	 foreach($comments as $data)
	 {
		
		$drcomments .="<tr><td>". $data->comment_ID."</td><td>".$data->comment_date."</td><td>".get_the_title($data->comment_post_ID)."</td><td><p>".$data->comment_content."</p></td><td><a href='comment.php?action=editcomment&c=".$data->comment_ID."'><input type='button' class='btn btn-primary mdc'  value=''></a></td></tr>";
		 
	 }
	 $drcomments .="</tbody></table>";
	 $resultaction=$drcomments;
}

		
		
		
		echo "<br>";
		echo "<div class='panel panel-primary'>
		<div class='panel-heading'>
		<h4 class='m0'>Datos solicitados para el correo electrónico seleccionado ".$_POST['dremail']."
		<a href=''><input type='button' class='btn goback' value=''></a></h4>
		</div>
		<div class='panel-body'>
		";
		$sql="select * from ".$table." where id=".$_POST['drreqid']."";
		$crdata=$wpdb->get_row($sql);
		echo 
		"
		<div class='alert alert-warning clrblack'><h4>Solicitud del usuario <h5>".$crdata->updatedvalue."</h5></div>
		".$resultaction."
		</div>
		</div>
		";
		
	}
	?>
	</div>
	</div>
	
	<?php
	if(! isset($_POST['gdprdrview']))
	{
	?>
	<form action="" method="post">
	<div class="container-fluid">
	<div class="row">
	<br>
	<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Configuración de solicitud de rectificación de datos</h4></div>
<div class="panel-body">
<div class="alert alert-warning clrblack">Utilice este código abreviado <b>[GDPR_UserRequestForm]</b> para acceder a los formularios de solicitud de usuario en el futuro.</div>

	<div class="form-group">
		<label>Email Administrador:</label>
		<input class="form-control" type="email" name="drremail" value="<?php echo get_option($pref.'drr-email');  ?>">
	</div>
	<div class="form-group">
		<label>Asunto del Correo</label>
		<input type="text" class="form-control" name="drrtitle" value="<?php echo get_option($pref.'drr-title');  ?>">
	</div>
	<div class="form-group">
	<div class="panel panel-default">
	<div class="panel-body">
    <label for="">Contenido:</label>
    <?php wp_editor(get_option($pref.'drr-message'),"drrmessage",$settings = array(
    'editor_height' => 200, 
    'textarea_rows' => 20, 
	));?>
	</div>
	<div class="panel-footer"><form action="" method="post"><input type="submit" class="btn btn-default" value="Usar texto predeterminado"  name="defrecttext"></form></div>
	</div>
	<br/>
  	<button type="submit" class="btn btnsave" name="savedrrsettings"></button>
  </div>
</div>
</div>
</div>
</div></div>

<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Lista de solicitudes de rectificación de datos</h4></div>
<div class="panel-body">
<table class="table table-striped table-hover gdprrqtable">
	<thead>
		<tr>
		<th>#</th>
		<th>Solicitado por</th>
		<th>Estado</th>
		<th>Servicio para rectificar</th>
		<th>Fecha de solicitud</th>
		<th>Fecha de acción </th>
		<th>Opciones</th>
	    </tr>
	</thead>
	<tbody>
	<?php showRequestToDataRectification(); ?>
	</tbody>
	
 </table>  
</div>
  
	</div></div>
	<?php } ?>
	<style>
		.gdprrqtable tbody tr td 
{
   padding-right:2px;
    vertical-align:middle;
}
select.selectcontrol{width:100%}
   .nav>li>a {
    position: relative;
    display: block;
    padding: 10px 10px;
}
.panel-primary {
    border-color: #525863;
}
.panel-primary>.panel-heading {
    color: #fff;
     background: linear-gradient(#525863, #444a55);
    border-color: #525863;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #F9A61C;
    cursor: default;
    background-color: #fff;
    border: 1px solid #000;
    border-bottom-color: transparent;
}
a {
    color: #525863;
    text-decoration: none;
}
.nav-tabs {
    border-bottom: 1px solid #000;
}
.btnsave{
	background-image: url("<?php echo plugins_url( 'img/btnsavesettings.png' , __FILE__); ?>");
	height:36px;
	width:150px;
	border:0px;
	margin-bottom: 5px;
}
.m0{
	margin:0px;
}
.panel {    
    border-radius: 2px;   
}
.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
}
.clrblack{
	color:#000;
}
.mdp{
	background-image: url("<?php echo plugins_url( 'img/Modify-Post-button.png' , __FILE__); ?>");
	height:36px;
	width:150px;
	border:0px;
	margin-bottom: 5px;
}
.mdc{
	background-image: url("<?php echo plugins_url( 'img/Modify-comment-Button.png' , __FILE__); ?>");
	height:36px;
	width:200px;
	border:0px;
	margin-bottom: 5px;
}
.mdu
{
background-image: url("<?php echo plugins_url( 'img/Update-User-Informations-button.png' , __FILE__); ?>");
	height:36px;
	width:270px;
	border:0px;
	margin-bottom: 5px;	
}
.goback
{
	background-image: url("<?php echo plugins_url( 'img/Go-back-button.png' , __FILE__); ?>");
	height:36px;
	width:150px;
	border:0px;
	margin-left: 40px;
	border-radius:4px;
}
	</style>
</body>
</html>
<?php gdprteknikforce_display_logo(); ?>