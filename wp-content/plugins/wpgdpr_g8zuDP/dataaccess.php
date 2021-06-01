<?php
if(isset($_POST['defdatext']))
{
	$pref='WP-GDPR-Compliance-';
	update_option($pref.'da-message',gdprEditorText('dataaccess'));
}
if(isset($_POST['gdprdatakeaction']))
{
	global $wpdb;
	$pref='WP-GDPR-Compliance-';
	$wpcrmailheaders = "MIME-Version: 1.0" . "\r\n";
    $wpcrmailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  require_once("dataaccessmessagebody.php");
  $eml=dataAccessEmailContent();
  $to=$_POST['daemail'];
  $subject=get_option($pref.'da-title');
  $msg=get_option($pref.'da-message').$eml;
  if(wp_mail($to,$subject,$msg,$wpcrmailheaders))
  {
	  $timenow=date('d-M-Y h:iA');
	  $datables=$wpdb->prefix."gdpr_request_records";
	  $wpdb->query($wpdb->prepare("update ".$datables." set action=%s , actiontime='%s' where id=%d ",array('1',$timenow,$_POST['dareqid'])));
	  echo "<script>alert('Datos enviados con éxito a ".$to."');</script>";
  }
  else
  {
	   echo "<script>alert('No se pueden enviar datos');</script>";
  }
  
}
?>
<?php
if(isset($_POST['gdprdaremove']))
{
	global $wpdb;
	$table=$wpdb->prefix."gdpr_request_records";
	$wpdb->query($wpdb->prepare("delete from ".$table." where id=%d ",array($_POST['dareqid'])));
}
?>
<?php
$pref='WP-GDPR-Compliance-';

   if(isset($_POST['dasettingssubmit']))
   {
	   update_option($pref.'da-email',$_POST['daemail']);
       update_option($pref.'da-title',$_POST['damailtitle']);
       update_option($pref.'da-message',stripslashes($_POST['damessage']));
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
  function gdprdaAction(){
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
		<li ><a href="admin.php?page=wp_gdpr_tandc">Términos y Condiciones</a></li>
		<li><a href="admin.php?page=wp_gdpr_pp">Política de privacidad</a></li>
		<li><a href="admin.php?page=wp_gdpr_rtbf">Derecho a ser olvidado</a></li>
		<li class="active"><a href="admin.php?page=wp_gdpr_dac">Acceso a datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_dbr">Incumplimiento De Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_drf">Rectificación de Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_eu">Rechazar Visitas de la UE</a></li>
	</ul>
<br>
	
	
	
	
	<div class="container-fluid">
	<?php
	if(isset($_POST['gdprdaview']))
	{
		echo "<br>";
		echo "
		<h4 class='m0' style='padding:10px;background: linear-gradient(#525863, #444a55);color:white;margin-top:5px;border-radius:2px;padding-left:15px;'>Requested data for selected Email ".$_POST['daemail']."
		<a href=''><input type='button' class='btn goback' value=''></a>
		</h4>";
		global $wpdb;
		// view all comments for selected request
		echo "<br><div class='row'>
		<div class='col-sm-12'>
		<div class='panel panel-primary'><div class='panel-heading'>
		<h4 class='m0'>Comentarios para:<strong> ".$_POST['daemail']."</strong></h4></div>
<div class='panel-body'>
	  <div class='table-responsive'>
		<table class='table table-striped table-hover'>
    <thead>
      <tr>
        <th>Comentario ID</th>
        <th>Fecha</th>
        <th>Publicación ID</th>
		<th>Contenido</th>
		<th>Aprobado</th>
		<th>Tipo</th>
      </tr>
    </thead>
	<tbody>";
	
	$args=array(
	'author_email' =>$_POST['daemail']);
	 $comments=get_comments( $args );
	 foreach($comments as $data)
	 {   echo "<tr>";
		
		  echo "<td>".$data->comment_ID."</td>
        <td>".$data->comment_date."</td>
        <td>".$data->comment_post_ID."</td>
		<td>".$data->comment_content."</td>
		<td>".$data->comment_approved."</td>
		<td>".$data->comment_type."</td>";
		  echo "</tr>";
	 }
	
	
	echo "</tbody>
	</table>
	</div>
	  </div>
	  </div>
	  </div>
	  </div>";
	
	
	
	// view all post meta for selected request 
		echo "<br><div class='row'>
		<div class='col-sm-12'>
		<div class='panel panel-primary'><div class='panel-heading'>
		<h4 class='m0'>All user meta for:<strong> ".$_POST['daemail']."</strong></h4></div>
<div class='panel-body'>
	  <div class='table-responsive'>
		<table class='table table-striped table-hover'>
    <thead>
      <tr>
        <th>Meta ID</th>
        <th>User Id</th>
        <th>Meta Llave</th>
		<th>Meta Valor</th>
      </tr>
    </thead>
	<tbody>";
	
	if(email_exists($_POST['daemail']))
	{
	$metagdprtable=$wpdb->prefix."usermeta";
	
	 $sql="select * from ".$metagdprtable." where user_id=".email_exists($_POST['daemail'])."";
	   $gdprrecords=$wpdb->get_results($sql);
	   
	 foreach($gdprrecords as $data)
	 {   echo "<tr>";
		
		  echo "<td>".$data->umeta_id."</td>
        <td>".$data->user_id."</td>
        <td>".$data->meta_key."</td>
		<td>".$data->meta_value."</td>";
		echo "</tr>";
	 }
	}
	echo "</tbody>
	</table>
	</div>
	  </div>
	  </div>
	  </div>
	  </div>";
	
	//results of all posts for selected user
	  echo "<br><div class='row'>
		<div class='col-sm-12'>
		<div class='panel panel-primary'><div class='panel-heading'>
		<h4 class='m0'>Publicaciones para:<strong> ".$_POST['daemail']."</strong></h4></div>
<div class='panel-body'>
	  <div class='table-responsive'>
		<table class='table table-striped table-hover'>  
    <thead>
      <tr>
        <th>ID</th>
        <th>Fecha</th>
		<th>Título</th>
		<th>Contenido</th>
		<th>Modificado</th>
		<th>Enlazar</th>
		<th>Estado</th>
      </tr>
    </thead>
	<tbody>";
	
	if(email_exists($_POST['daemail']))
	{
	$args = array(
        'author'=>email_exists($_POST['daemail']), 
        'orderby' =>  'post_date',
        'order' =>  'ASC',
		'posts_per_page' => -1
           );

   $posts=get_posts( $args );
	 foreach($posts as $data)
	 {   echo "<tr>";
		
		  echo "<td>".$data->ID."</td>
        <td>".$data->post_date."</td>
        <td>".$data->post_title."</td>
		<td>".$data->post_content."</td>
		<td>".$data->post_modified_gmt."</td>
		<td><a href='".get_permalink( $data->ID )."' target='_BLANK'>".get_permalink( $data->ID )."</a></td>
		<td>".$data->post_status."</td>";
		  echo "</tr>";
	 }
	}
	
	echo "</tbody>
	</table>
	</div>
	  </div>
	  </div>
	  </div>
	  </div>";
	}
	?>
	
	</div>
	
	<?php
	if(! isset($_POST['gdprdaview']))
	{
		?>
	
	
	<div class="container-fluid"><br>
	<form action="" method="post">	
	<div class="row">
	<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Configuración solicitud acceso a datos</h4></div>
<div class="panel-body">
	 
	 <div class="alert alert-warning clrblack">Utilice este código abreviado <b>[GDPR_UserRequestForm]</b> para acceder a los formularios de solicitud de usuario en el futuro.</div>
	 
  <div class="form-group">
    <label for="">Email Administrador:</label>
    <input type="email" class="form-control" name="daemail" value="<?php echo get_option($pref.'da-email'); ?>">
  </div>
  <div class="form-group">
    <label for="">Asunto del Correo:</label>
    <input type="text" class="form-control" name="damailtitle" value="<?php echo get_option($pref.'da-title'); ?>">
  </div>
  <div class="form-group">
  <div class="panel panel-default">
    <div class="panel-body"><label for="">Contenido:</label>
    <?php wp_editor(get_option($pref.'da-message'),"damessage",$settings = array(
    'editor_height' => 200, 
    'textarea_rows' => 20, 
	));?>
	</div>
	<div class="panel-footer"><form action="" method="post"><input type="submit" class="btn btn-default" value="Usar texto predeterminado"  name="defdatext"></form></div>
	</div>
  <input type="submit" value="" class="btnsave" vlaue="" name="dasettingssubmit">
</div>
</div>
</div>
</form>
</div>


<div class="col-sm-12">
	<div class="row m0">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Lista de solicitudes de acceso a datos</h4></div>
<div class="panel-body">
<table class="table table-striped table-hover gdprrqtable">
	<thead>
		<tr>
		<th>#</th>
		<th>Solicitado por</th>
		<th>Estado</th>
		<th>Fecha de solicitud</th>
		<th>Acción tomada</th>
		<th>Opciones</th>
	    </tr>
	</thead>
	<tbody>
	<?php showRequestToDataAccess(); ?>
	</tbody>
	
 </table> 
</div>
   </form>
	</div>
	</div>
	</div>
</div>
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