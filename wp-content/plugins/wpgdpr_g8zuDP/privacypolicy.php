<?php
$gdprpref='WP-GDPR-Compliance-';
if(isset($_POST['gdprsetpp']))
{
	update_option($gdprpref.'pp-version',$_POST['gdprppversion']);
   update_option($gdprpref.'pp-lusr',$_POST['gdprlusr']);
   update_option($gdprpref.'pp-nlusr',$_POST['gdprnlusr']);
   update_option($gdprpref.'pp-bef',$_POST['befpp']);
   update_option($gdprpref.'pp-aft',$_POST['aftpp']);
    if(isset($_POST['wpgdprppeu']))
   {
	   update_option($gdprpref.'pp-eu','1');
   }
   else
   {
		update_option($gdprpref.'pp-eu','0');  
   }
}


?>
<html><head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<br><br>
	<ul class="nav nav-tabs">
		<li><a href="admin.php?page=wp_gdpr">Conformidad</a></li>
		<li><a href="admin.php?page=wp_gdpr_cookie">Consentimiento de cookies</a></li>
		<li><a href="admin.php?page=wp_gdpr_tandc">Términos y Condiciones</a></li>
		<li  class="active"><a href="admin.php?page=wp_gdpr_pp">Política de privacidad</a></li>
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
 <div class="row">
 <div class="col-sm-12">
<div class="panel-group">
<div class="panel panel-primary">
<div class="panel-heading"><h4 class="m0">Política de privacidad</h4></div> 
 <div class="panel-body">
<div class='form-group'>
 <div class="alert alert-warning clrblack">1. Coloque el código corto <b>[wpgdprPP]</b> en su página de Política de Privacidad existente para agregar un botón de aceptar..<br>
2.  Seleccione la página de Política de privacidad a continuación, para que los usuarios puedan ser redirigidos y den su consentimiento.</div>
</div>
 
 <div class='form-group'>
    <label for="">¿Redirigir a los usuarios registrados a la Política de privacidad?</label>
	<br />
	<label class="radio-inline"><input id="lusr" type="radio" style="margin-top:3px;outline: none;"  name="gdprlusr" value="1" <?php if(get_option($gdprpref.'pp-lusr')=='1'){echo "checked";} ?>>Si</label>
	<label class="radio-inline"><input id="lusr" type="radio" style="margin-top:3px;outline: none;" name="gdprlusr" value="0" selected <?php if(get_option($gdprpref.'pp-lusr')=='0'){echo "checked";} ?>>No</label>
	</div>
	
	<div class='form-group'>
	<label for="">Redirigir a los usuarios no firmados a la Política de privacidad</label>
	<br />
	<label class="radio-inline"><input id="lusr" type="radio" style="margin-top:3px;outline: none;"  name="gdprnlusr" value="1" <?php if(get_option($gdprpref.'pp-nlusr')=='1'){echo "checked";} ?>>Si</label>
	<label class="radio-inline"><input id="lusr" type="radio" style="margin-top:3px;outline: none;"  name="gdprnlusr" value="0" selected <?php if(get_option($gdprpref.'pp-nlusr')=='0'){echo "checked";}  ?>>No</label>
	</div>
	
	<div class="row">
	
	<div class="col-sm-5">
	<label>
	<input type="checkbox" <?php if(get_option($gdprpref.'pp-eu')=='1'){echo "checked";} ?> name="wpgdprppeu" style="margin-right:15px;margin-bottom:8px">
Mostrar solo a los visitantes de la UE </label>
</div>
</div><br>
	
	<div class='form-group row'>
	<div class='col-lg-6'>
	<label for="">¿Cuál es el número de versión de la política de privacidad actual? </label>	
	<input type="text" name="gdprppversion" title="Asegúrese de cambiar el número de versión cada vez que realice un cambio en los documentos de la Política de Privacidad para que los visitantes de su sitio puedan ser redirigidos de nuevo." class="form-control" value="<?php echo get_option($gdprpref.'pp-version'); ?>">
       
	</div>
	</div>
	
	<div class='form-group row'>
	<div class='col-lg-6'>
	<label for="">Seleccionar la página de política de privacidad</label>
	<br>
	<p id="lusr" style="margin: 0 0 0px;"><?php gdpr_all_pages('befpp') ?></p>
     </div>
	 </div>
	 
     <div class='form-group row'>
	<div class='col-lg-6'>
       <label for="">Seleccione dónde redirigir después de aceptado</label>
	
	<p id="lusr" style="margin: 0 0 0px;"><?php gdpr_all_pages('aftpp') ?></p>
       
     </div>
	 </div>
	  
 <p><input type="submit" value="" class="btnsave" name="gdprsetpp"></p>
 
 

 </div></div></div></div></div></div>
 <form>

<style>
.wp-admin select {
    padding: 2px;
    line-height: 28px;
    height: 34px !important;
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
    border-radius: 2px !important;   
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
</style>

</body>
</html>
<?php gdprteknikforce_display_logo(); ?>