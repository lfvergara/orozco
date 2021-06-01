

<?php
$pref='WP-GDPR-Compliance-';

if(isset($_POST['defctext']))
{
	update_option($pref.'notice',gdprEditorText('cookie'));
}
if(isset($_POST['savegdprcookie']))
{
update_option($pref.'notice',stripslashes($_POST['gdprnotice']));
update_option($pref.'show',$_POST['cookie']);
update_option($pref.'cookie-style',$_POST['gdprcustomstyle']);
update_option($pref.'cookie-text-color',$_POST['gdprtxtcolor']);
update_option($pref.'cookie-bg-color',$_POST['gdprbgcolor']);
update_option($pref.'cookie-position',$_POST['gdprcookieposition']);
update_option($pref.'cookie-distance',$_POST['wpgdrdistance']);
update_option($pref.'cookie-accept-button',$_POST['wpgdracceptbuttontext']);

if(isset($_POST['wpgdprcookieeu']))
{
	update_option($pref.'cookie-eu','1');
}
else
{
	update_option($pref.'cookie-eu','0');
}

}

$chkd="";
if(get_option($pref.'show')=='1')
{
	$chkd="checked";
}
//wp editor style
$settings = array(    
    'textarea_rows' => 8, 
	
);

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
		<li class="active"><a href="admin.php?page=wp_gdpr_cookie">Consentimiento de cookies</a></li>
		<li><a href="admin.php?page=wp_gdpr_tandc">Términos y Condiciones</a></li>
		<li><a href="admin.php?page=wp_gdpr_pp">Política de privacidad</a></li>
		<li><a href="admin.php?page=wp_gdpr_rtbf">Derecho a ser olvidado</a></li>
		<li><a href="admin.php?page=wp_gdpr_dac">Acceso a datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_dbr">Incumplimiento De Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_drf">Rectificación de Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_eu">Rechazar Visitas de la UE</a></li>
	</ul>
<br>	
	<br>
	<form action="" method="post">
	<div class="container-fluid">
	
	<h4 style="padding:10px;background: linear-gradient(#525863, #444a55);color:white;margin-top:5px;border-radius:2px;padding-left:15px;">Consentimiento de cookies</h4>
	<div class="row">
	
	<div class="col-sm-8">
<div class="panel panel-primary h376">
<div class="panel-heading"><h4 class="m0">Edite tu aviso de cookies</h4></div>
<div class="panel-body"><?php wp_editor(get_option($pref.'notice'),'gdprnotice',$settings); ?>
</div>
<div class="panel-footer"><form action="" method="post"><input type="submit" class="btn btn-default" value="Usar Texto Predeterminado"  name="defctext"></form></div>
</div>
</div>
	
	<div class="col-sm-4">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Configuración</h4></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-7">
<h5>Seleccione la página a mostrar</h5>
</div>
<div class="col-sm-5">
<?php gdpr_all_pages('cookie'); ?>
</div>
</div>

<div class="row">
<div class="col-sm-7">
<h5>Color de texto</h5>
</div>
<div class="col-sm-5">
<input type="color" style="width:100%" name="gdprtxtcolor" value="<?php echo get_option($pref.'cookie-text-color'); ?>">
</div>
</div>

<div class="row">
<div class="col-sm-7">
<h5>Color de fondo</h5>
</div>
<div class="col-sm-5">
<input type="color" style="width:100%" name="gdprbgcolor" value="<?php echo get_option($pref.'cookie-bg-color'); ?>">
</div>
</div>

<div class="row">
<div class="col-sm-7">
<h5>Box Position</h5>
</div>
<div class="col-sm-5">
<select style="width:100%" name="gdprcookieposition">
<option <?php if(get_option($pref.'cookie-position')=="top:0px;left:0px"){echo "selected";} ?> value="top:0px;left:0px">Top Left</option>
<option <?php if(get_option($pref.'cookie-position')=="top:0px;right:0px"){echo "selected";} ?> value="top:0px;right:0px">Top Right</option>
<option <?php if(get_option($pref.'cookie-position')=="bottom:0px;left:0px"){echo "selected";} ?> value="bottom:0px;left:0px">Bottom Left</option>
<option <?php if(get_option($pref.'cookie-position')=="bottom:0px;right:0px"){echo "selected";} ?> value="bottom:0px;right:0px">Bottom Right</option>
</select>
</div>
</div>

<div class="row">
<div class="col-sm-7">
<h5>Distance From Border</h5>
</div>
<div class="col-sm-5">
<input type="text" style="width:100%" value="<?php echo get_option($pref.'cookie-distance'); ?>" name="wpgdrdistance">
</div>
</div>

<div class="row">
<div class="col-sm-7">
<h5>Accept Button Text</h5>
</div>
<div class="col-sm-5">
<input type="text" style="width:100%" value="<?php echo get_option($pref.'cookie-accept-button'); ?>" name="wpgdracceptbuttontext">
</div>
</div>


<div class="row">
<div class="col-sm-7">
<h5>Show only to visitors from EU</h5>
</div>
<div class="col-sm-5">
<input type="checkbox" <?php if(get_option($pref.'cookie-eu')=='1'){echo "checked";} ?> name="wpgdprcookieeu">
</div>
</div>


<div class="row">
<div class="col-sm-7">
<h5>Custom CSS</h5>
</div>
<div class="col-sm-5">
<textarea name="gdprcustomstyle" style="width:100%"><?php echo get_option($pref.'cookie-style'); ?></textarea>
</div>
</div>

<input type="submit" name="savegdprcookie" class="btnsave" value="">
</div>
</div>
</div>



    </div> 
   </div>
   
   </form>
   <style>select.selectcontrol{width:100%}
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
.h376{height:419px;}
iframe{
    width: 100%;
    height: 157px !important;
    display: block;
}
   </style>
</body>
</html>

<?php gdprteknikforce_display_logo(); ?>