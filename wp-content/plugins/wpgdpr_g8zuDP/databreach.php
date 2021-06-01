<?php
$pref='WP-GDPR-Compliance-';

if(isset($_POST['defdbrtext']))
{
	update_option($pref.'dbr-message',gdprEditorText('databreach'));
}

if(isset($_POST['dbrsaveit']))
{
update_option($pref.'dbr-title',$_POST['dbrtitle']);
update_option($pref.'dbr-message',stripslashes($_POST['dbrmessage']));
update_option($pref.'dbr-user',$_POST['dbruser']);	
}
if(isset($_POST['dbrsendmail']))
{
	$wpcrmailheaders = "MIME-Version: 1.0" . "\r\n";
    $wpcrmailheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$count=0;
	
	$args = array('orderby' => 'display_name');
$wp_user_query = new WP_User_Query($args);
$authors = $wp_user_query->get_results();
foreach ($authors as $author) {
		$author_info = get_userdata($author->ID);
	if(wp_mail($author_info->user_email,get_option($pref.'dbr-title'),get_option($pref.'dbr-message'),$wpcrmailheaders))
	{$count++;}
}
if($count !=0)
{
	echo "<script>alert('Correo enviado');</script>";
}
else
	{
	echo "<script>alert('No se puede enviar correo');</script>";
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
		<li class="active"><a href="admin.php?page=wp_gdpr_dbr">Incumplimiento De Datos</a></li>
		<li ><a href="admin.php?page=wp_gdpr_drf">Rectificación de Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_eu">Rechazar Visitas de la UE</a></li>
	</ul>
<br>
	
	
	<div class="container fluid">
	<?php
	
	if(isset($_POST['dbrshowusers']) && get_option($pref.'dbr-user')=='1')
      {
	$args = array('orderby' => 'display_name');
$wp_user_query = new WP_User_Query($args);
$authors = $wp_user_query->get_results();
if (!empty($authors)) {
	echo '<br></br><ul class="list-group">
	      <li class="list-group-item active headerLi"><h4 class="m0">Emails</h4> </li>
	';
	
	foreach ($authors as $author) {
		$author_info = get_userdata($author->ID);
		echo '<li class="list-group-item">' . $author_info->user_email . '</li>';
	}
	 echo '<li class="list-group-item info"><div style="text-align:center"><form action="" method="post"><button type="submit" class="btm btn-primary dbrnotibutton" name="dbrsendmail" style="border:0px;border-radius:5px;padding:6px"></button></form></div></li>';
	echo '</ul>';
} else {
	echo 'No results';
}
	
      }
	
	?>
	
	</div>
	<?php
	if(! isset($_POST['dbrshowusers']) || get_option($pref.'dbr-user')!='1')
	{
	?>
	
	<form action="" method="post">
	<div class="container-fluid">
	<div class="row">
	<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Configuración de notificación de incumplimiento de datos</h4></div>
<div class="panel-body">

	<div class="form-group">
    <label for="">Asunto del Correo:</label>
    <input class="form-control" type="text" name="dbrtitle" value="<?php echo get_option($pref.'dbr-title'); ?>">
  </div>
   <div class="form-group">
   <div class="panel panel-default">
   <div class="panel-body">
    <label for="">Contenido:</label>
    <?php wp_editor(get_option($pref.'dbr-message'),"dbrmessage",$settings = array(
    'editor_height' => 200, 
    'textarea_rows' => 20, 
	));?>
	</div>
	<div class="panel-footer"><form action="" method="post"><input type="submit" class="btn btn-default" value="Usar texto predeterminado"  name="defdbrtext"></form></div>
	</div>
  </div>
  <div class="form-group">
  	<label>Recopilar correos electrónicos de datos?</label><br>
		<label class="radio-inline"><input type="radio" style="margin-top: 2px" value="1" name="dbruser" <?php if(get_option($pref.'dbr-user')=='1'){echo 'checked';} ?> >Si</label>
			<label class="radio-inline"><input type="radio" style="margin-top: 2px" value="0" name="dbruser" <?php if(get_option($pref.'dbr-user')=='0'){echo 'checked';} ?>>No</label><br/><br/>
<input type="submit" class="btnsave" value="" name="dbrsaveit">
<button type="submit" name="dbrshowusers" style="margin-bottom:3px;" class="btn btn-primary dbrnotibutton">

</button>
	</div>
</form>
		</div>
</div>
</div>
</div>
</div>
	<?php } ?>
	<style>
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
.dbrnotibutton{
	background-image: url("<?php echo plugins_url( 'img/Send-data-button.png' , __FILE__); ?>");
	height:36px;
	width:280px;
	border:0px;
	margin-bottom: 20px;
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
.headerLi
{
	background: linear-gradient(#525863, #444a55);
    border-color: #525863;
}
.finaDbrsend
{
	
}
	</style>
</body>
</html>
<?php gdprteknikforce_display_logo(); ?>