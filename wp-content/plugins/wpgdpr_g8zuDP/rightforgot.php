<?php

if(isset($_POST['defrtbftext']))
{
	$pref='WP-GDPR-Compliance-';
	update_option($pref.'rtbf-message',gdprEditorText('rightforget'));
}

if(isset($_POST['gdprfmremove']))
{
	global $wpdb;
	$table=$wpdb->prefix."gdpr_request_records";
	$wpdb->query($wpdb->prepare("delete from ".$table." where id=%d ",array($_POST['afmreqid'])));
}
if(isset($_POST['gdprfmtakeaction']))
{
	global $wpdb;
	$table=$wpdb->prefix."gdpr_request_records";
	$timenow=date('d-M-Y h:iA');
	$pref='WP-GDPR-Compliance-';
	$wpcrmailheaders = "MIME-Version: 1.0" . "\r\n";
    $wpcrmailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	get_option($pref.'rtbf-email');
get_option($pref.'rtbf-title');
get_option($pref.'rtbf-message');
get_option($pref.'rtbf-reassign');
get_option($pref.'rtbf-reassign-user');
$user_info = get_userdata(get_option($pref.'rtbf-reassign'));
$user_info->user_email;
	
if($_POST['afmvalue']=='c')
{//delete comments
	$args=array(
	'author_email' =>$_POST['afmemail']);
	 $comments=get_comments( $args );
	 foreach($comments as $data)
	 {
		 $comment_id=$data->comment_ID;
		 
		 wp_delete_comment( $comment_id); 
	 }
	
	$wpdb->query($wpdb->prepare("update ".$table." set action=%s , actiontime='%s' where id=%d ",array('1',$timenow,$_POST['afmreqid'])));
}
if($_POST['afmvalue']=='u')
{//delete user meta
	
	if(email_exists($_POST['afmemail']))
	{
		
	$metagdprtable=$wpdb->prefix."usermeta";
	$wpdb->query($wpdb->prepare("delete from ".$metagdprtable." where user_id=%d ",array(email_exists($_POST['afmemail']))));
	}
	
	$deltable=$wpdb->prefix."gdpr_request_records";
	$wpdb->query($wpdb->prepare("update ".$deltable." set action=%s , actiontime='%s' where id=%d ",array('1',$timenow,$_POST['afmreqid'])));
}
if($_POST['afmvalue']=='p')
{
	//delete posts or update author
	if(email_exists($_POST['afmemail']))
	{
		
		
		$args = array(
        'author'        =>email_exists($_POST['afmemail']), 
        'orderby'       =>  'post_date',
        'order'         =>  'ASC',
        'posts_per_page' => -1
           );
     $posts=get_posts( $args );
   if(get_option($pref.'rtbf-reassign')=='1')
		{//delete post
	
	 foreach($posts as $data)
	 {
		 wp_delete_post( $data->ID);
	 }
	    }
   if(get_option($pref.'rtbf-reassign')=='0')
		{//update author
	
			
			$wpdb->query($wpdb->prepare("update ".$wpdb->prefix."posts set post_author=%d where post_author=%d ",array((int)get_option($pref.'rtbf-reassign-user'),(int)email_exists($_POST['afmemail']))));
			
		}
	}
	
	$deltable=$wpdb->prefix."gdpr_request_records";
	$wpdb->query($wpdb->prepare("update ".$deltable." set action=%s , actiontime='%s' where id=%d ",array('1',$timenow,$_POST['afmreqid'])));
}
wp_mail($_POST['afmemail'],get_option($pref.'rtbf-title'),get_option($pref.'rtbf-message'),$wpcrmailheaders);	
}
?>

<?php
$pref='WP-GDPR-Compliance-';

if(isset($_POST['gdprfmsettingssubmit']))
{
	if(filter_var($_POST['gdprfmnotifemail'], FILTER_VALIDATE_EMAIL))
	{
	update_option($pref.'rtbf-email',$_POST['gdprfmnotifemail']);
	}
	
    update_option($pref.'rtbf-title',$_POST['gdprfmtitle']);
    update_option($pref.'rtbf-message',stripslashes($_POST['gdprfmmsg']));
	if(email_exists($_POST['gdprfmremail1']))
	{
    update_option($pref.'rtbf-reassign-user',email_exists($_POST['gdprfmremail1']));
	}
	else
	{
		echo "<script>alert('Unable to set reassign email , as user does not exist for this email id');</script>";
	}
    update_option($pref.'rtbf-reassign',$_POST['gdprfmdel']);
}

get_option($pref.'rtbf-email');
get_option($pref.'rtbf-title');
get_option($pref.'rtbf-message');
get_option($pref.'rtbf-reassign');
get_option($pref.'rtbf-reassign-user');
$user_info = get_userdata(get_option($pref.'rtbf-reassign'));
$user_info->user_email;







//wp editor style
$editorsettings = array(
     
    'textarea_rows' =>7, 
	
);
?>
<html lang="en">
  <head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <script type="text/javascript">
  function gdprfmAction(){
			var conf=confirm("Estás seguro");
			if(conf==true)
			{return true;}
			else
			{return false;}
			}
 function gdprfmActionDel(){
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
		<li class="active"><a href="admin.php?page=wp_gdpr_rtbf">Derecho a ser olvidado</a></li>
		<li><a href="admin.php?page=wp_gdpr_dac">Acceso a datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_dbr">Incumplimiento De Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_drf">Rectificación de Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_eu">Rechazar Visitas de la UE</a></li>
	</ul>
<br>
	
<?php
if(isset($_POST['gdprfmview']))
{
	echo "<br>";
		echo "<div class='container-fluid'><h4 class='m0' style='padding:10px;background: linear-gradient(#525863, #444a55);color:white;margin-top:5px;border-radius:2px;padding-left:15px;'>Requested data for selected Email ".$_POST['afmemail']."
		<a href=''><input type='button' class='btn btn-info goback' value=''></a>
		</h4></div>";
	
	global $wpdb;
	$table=$wpdb->prefix."gdpr_request_records";
	
	if($_POST['afmvalue']=='c')
	{// view all comments for selected request
		echo "<br><div class='container-fluid'><div class='row'>
		<div class='col-sm-12'>
		<div class='panel panel-primary'><div class='panel-heading'>
		<h4 class='m0'>Comentarios para:<strong> ".$_POST['afmemail']."</strong></h4></div>
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
	'author_email' =>$_POST['afmemail']);
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
	  </div></div>";
	}
	if($_POST['afmvalue']=='u')
	{// view all post meta for selected request 
		echo "<br><div class='container-fluid'><div class='row'>
		<div class='col-sm-12'>
		<div class='panel panel-primary'><div class='panel-heading'>
		<h4 class='m0'>Todos los usuarios meta para:<strong> ".$_POST['afmemail']."</strong></h4></div>
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
	
	if(email_exists($_POST['afmemail']))
	{
	$metagdprtable=$wpdb->prefix."usermeta";
	
	 $sql="select * from ".$metagdprtable." where user_id=".email_exists($_POST['afmemail'])."";
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
	  </div>
	  </div>";
	
	
		
		
	}
   if($_POST['afmvalue']=='p')
   {
	  //results of all posts for selected user
	  echo "<br><div class='container-fluid'><div class='row'>
		<div class='col-sm-12'>
		<div class='panel panel-primary'><div class='panel-heading'>
		<h4 class='m0'>Publicaciones para:<strong> ".$_POST['afmemail']."</strong></h4></div>
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
	
	if(email_exists($_POST['afmemail']))
	{
	$args = array(
        'author'=>email_exists($_POST['afmemail']), 
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
	  </div>
	  </div>";
	
	
   }
}

?>
	<?php
	if(! isset($_POST['gdprfmview']))
	{
		?>
	
	
	<div class="container-fluid"><br/>
	
	<form action="" method="post">

<h4 style="padding:10px;background: linear-gradient(#525863, #444a55);color:white;margin-top:5px;border-radius:2px;padding-left:15px;">Right to be Forgotten</h4>
<div class="alert alert-warning clrblack">Utilice este código abreviado <b>[GDPR_UserRequestForm]</b> para acceder a los formularios de solicitud de usuario en el futuro..</div>
	<div class="row">
	
	<div class="col-sm-6">
<div class="panel panel-primary h388">
<div class="panel-heading"><h4 class="m0">Mensaje de Email</h4></div>
<div class="panel-body"><?php wp_editor(get_option($pref.'rtbf-message'),'gdprfmmsg',$editorsettings ); ?></div>
<div class="panel-footer"><form action="" method="post"><input type="submit" class="btn btn-default" value="Usar texto predeterminado"  name="defrtbftext"></form></div>
</div>
</div>
	
	<div class="col-sm-6">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Configuraciones</h4></div>
<div class="panel-body">
	<div class="form-group">
		<label>Asunto del email:</label>
		<input class="form-control" type="text" name="gdprfmtitle" value="<?php echo get_option($pref.'rtbf-title'); ?>">
	</div>
	<div class="form-group">
		<label>Email del administrador:</label>
		<input class="form-control" type="email" name="gdprfmnotifemail" value="<?php echo get_option($pref.'rtbf-email'); ?>">
	</div>
	<div class="form-group">
		<label>	Reasignar Email de Usuario:</label>
		<div class="input-group">
		<span class="input-group-addon"><input type="radio" style="margin-top: 2px;" value="0" name="gdprfmdel" <?php if(get_option($pref.'rtbf-reassign')=='0'){echo "checked";} ?>></span>
		<input class="form-control" type="email" name="gdprfmremail1" value="<?php $user_info = get_userdata(get_option($pref.'rtbf-reassign-user'));
echo $user_info->user_email; ?>">
       </div>
	</div>
	<div class="control-group">
	 <div class="controls">
	 	<div class="input-group">
		
		<span class="input-group-addon">
		<input type="radio" style="margin-top: 2px;" value="1" name="gdprfmdel" <?php if(get_option($pref.'rtbf-reassign')=='1'){echo "checked";} ?>></span>
		<p class="form-control">Eliminar mensaje</p>
		</div>
	</div><br>
	 <input type="submit" class="btnsave" value="" name="gdprfmsettingssubmit" >
</div>
</div>
</div>



    </div> 
   </div>
   <div class="row">
   <div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Lista de solicitudes para el derecho a ser olvidado</h4></div>
<div class="panel-body">
	  <div class="table-responsive">
<table class="table table-striped table-hover gdprrqtable">
	<thead>
		<tr>
			<th>#</th>
			<th>Solicitado por</th>
			<th>Estado</th>
			<th>Servicios para Olvidar</th>
			<th>Fecha de solicitud</th>
			<th>Fecha de correo</th>
			<th>Opciones</th>
	    </tr>
		</thead>
		<tbody><?php echo showRequestToForget(); ?></tbody>
	
	
 </table>
</div>
</div>
</div> 
</div>
</div>
   </form>
   
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
.h388{
    height: 388px;
}
iframe{
    width: 100%;
    height: 169px !important;
    display: block;
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
	margin-bottom: 5px;	
}
li.next
{
	
}
	</style>
</body>
</html>

<?php gdprteknikforce_display_logo(); ?>