<?php 
$pref='WP-GDPR-Compliance-'; 
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



<br><br>
	<ul class="nav nav-tabs">
		<li class="active"><a href="admin.php?page=wp_gdpr">Conformidad</a></li>
		<li><a href="admin.php?page=wp_gdpr_cookie">Consentimiento de cookies</a></li>
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
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel-heading"><h4 class="m0">Conformidad </h4></div>
    <div class="panel-body">  	
  <div class="alert alert-warning">
   <p style="font-size:20px" class="clrblack"><strong>¿Cumple con GDPR?</strong></p>

<h5 class="clrblack">Aquí sabrás si eres obediente. Para cumplir con GDPR debes configurar las siguientes secciones</h5> 

  </div>
  
  <div>
  <?php
  
	  $class='';
	  $prcnt='';
	  $alert='';
	  $count=0;
  switch(complianceStatus())
  {
	case 0:
	$alert='No cumple ninguno de los 7 requisitos..';
	$prcnt=10;
	break;
	case 1:
	$class='';
	  $prcnt=20;
	$alert='Aún no cumple con GDPR. Tiene 6 requisitos de cumplimiento para configurar antes de cumplir con los requisitos.'; 
	break;
	case 2:
	$class='';
	  $prcnt=30;
	  $alert='Aún no cumple con GDPR. Tiene 5 requisitos de cumplimiento para configurar antes de cumplir con los requisitos.';
	break;
	case 3:
	  $class='';
	  $prcnt=40;
	  $alert='Aún no cumple con GDPR. Tiene 4 requisitos de cumplimiento para configurar antes de cumplir con los requisitos.';
	break;
	case 4:
	  $class='';
	  $prcnt=50;
	  $alert='Aún no cumple con GDPR. Tiene 3 requisitos de cumplimiento para configurar antes de cumplir con los requisitos.';
	break;
	case 5:
	  $class='';
	  $prcnt=60;
	  $alert='Aún no cumple con GDPR. Tiene 2 requisitos de cumplimiento para configurar antes de cumplir con los requisitos.';
	break;
	case 6:
	  $class='';
	  $prcnt=70;
	  $alert='Aún no cumple con GDPR. Tiene 1 requisitos de cumplimiento para configurar antes de cumplir con los requisitos.';
	break;
	case 7:
	  $class='';
	  $prcnt=100;
	  $alert='Ahora cumple con 7 requisitos clave de GDPR';
	break;
  }
   ?>
  
	
  <?php if($prcnt==100){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge statusyesbadge"><span class="glyphicon glyphicon-ok statusyesicons" ></span></span></div><div class="col-lg-11 statusyestextblock"><?php echo $alert; ?></div></div>  
  <?php } else { ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge statusnobadge"><span class="glyphicon glyphicon-remove statusnoicons" ></span></span></div><div class="col-lg-11 statusnotextblock"><?php echo $alert; ?></div></div>  
  <?php } ?>
  <br>
  
  </div>
  
  
  
  <div class="row"><div class="col-xs-1 checkbx"></div><div class="col-lg-11"><h4 class="m0">Acepta el tráfico de la UE</h4></div></div>
  <?php if(get_option($pref.'eu-active')=='0'){  ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge yesbadge"><span class="glyphicon glyphicon-ok yesicons" ></span></span></div><div class="col-lg-11 textblock">Su sitio acepta tráfico de la UE y debe cumplir con GDPR. <strong> <a class="gdprlink" href="admin.php?page=wp_gdpr_eu">¿Cambiar ajustes?</a></strong></div></div>  
  <?php  } ?>
  <?php if(get_option($pref.'eu-active')=='1'){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge nobadge"><span class="glyphicon glyphicon-remove noicons" ></span></span></div><div class="col-lg-11 textblock">Su sitio rechaza actualmente a los visitantes de la UE. El cumplimiento de GDPR no es obligatorio.<strong><a class="gdprlink" href="admin.php?page=wp_gdpr_eu"> ¿Cambiar ajustes?</a>.</strong></div></div>  
  <?php } ?>
  <br>
  
  <div class="row"><div class="col-xs-1 checkbx"></div><div class="col-lg-11"><h4 class="m0">Consentimiento de cookies</h4></div></div>  
  <?php if(strlen(get_option($pref.'notice'))>0){  ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge yesbadge"><span class="glyphicon glyphicon-ok yesicons" ></span></span></div><div class="col-lg-11 textblock">Cumple con el requisito de consentimiento de cookies.</div></div>  
  <?php  } ?>
  <?php if(strlen(get_option($pref.'notice'))<1){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge nobadge"><span class="glyphicon glyphicon-remove noicons" ></span></span></div><div class="col-lg-11 textblock">No cumple con el requisito de consentimiento de cookie.<strong><a class="gdprlink" href="admin.php?page=wp_gdpr_cookie">  Configúralo</a>.</strong></div></div>  
  <?php } ?>
  <br>
  
  <div class="row"><div class="col-xs-1 checkbx"></div><div class="col-lg-11"><h4 class="m0">Términos y condiciones</h4></div></div>
  <?php if(isSetTandC()==1){  ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge yesbadge"><span class="glyphicon glyphicon-ok yesicons" ></span></span></div><div class="col-lg-11 textblock">Cumple con los requisitos de los Términos y Condiciones.</div></div>  
  <?php } ?>
  <?php if(isSetTandC()==0){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge nobadge"><span class="glyphicon glyphicon-remove noicons" ></span></span></div><div class="col-lg-11 textblock">No cumple con los requisitos de Términos y condiciones. <strong><a class="gdprlink" href="admin.php?page=wp_gdpr_tandc">Configúralo</a></strong></div></div>  
  <?php } ?>
  <br>
  
  <div class="row"><div class="col-xs-1 checkbx"></div><div class="col-lg-11"><h4 class="m0">Política de privacidad</h4></div></div>
  <?php if(isSetPP()==1){  ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge yesbadge"><span class="glyphicon glyphicon-ok yesicons" ></span></span></div><div class="col-lg-11 textblock">Cumple con los requisitos de la Política de privacidad.</div></div>    
  <?php } ?>
  <?php if(isSetPP()==0){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge nobadge"><span class="glyphicon glyphicon-remove noicons" ></span></span></div><div class="col-lg-11 textblock">No cumple con los requisitos de la Política de privacidad. <strong><a class="gdprlink" href="admin.php?page=wp_gdpr_pp">Configúralo</a></strong></div></div>  
  <?php } ?>
  
  <br>
  <div class="row"><div class="col-xs-1 checkbx"></div><div class="col-lg-11"><h4 class="m0">Derecho a ser olvidado</h4></div></div>
  <?php if(strlen(get_option($pref.'rtbf-message'))>0){  ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge yesbadge"><span class="glyphicon glyphicon-ok yesicons" ></span></span></div><div class="col-lg-11 textblock">Cumple con los requisitos de la regulación de Right to be forgotten.</div></div> 
  <?php } ?>
  <?php if(strlen(get_option($pref.'rtbf-message'))<1){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge nobadge"><span class="glyphicon glyphicon-remove noicons" ></span></span></div><div class="col-lg-11 textblock">No cumple con los requisitos de la regulación de Derecho a olvidarse.<strong><a class="gdprlink" href="admin.php?page=wp_gdpr_rtbf">Configúralo</a></strong></div></div>  
  <?php } ?>
  <br>
  
  <div class="row"><div class="col-xs-1 checkbx"></div><div class="col-lg-11"><h4 class="m0">Solicitudes de acceso a datos</h4></div></div>
  <?php if(strlen(get_option($pref.'da-message'))>0){  ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge yesbadge"><span class="glyphicon glyphicon-ok yesicons" ></span></span></div><div class="col-lg-11 textblock">Cumple con los requisitos de la regulación de acceso a datos obligatorios.</div></div>  
  <?php } ?>
  <?php if(strlen(get_option($pref.'da-message'))<1){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge nobadge"><span class="glyphicon glyphicon-remove noicons" ></span></span></div><div class="col-lg-11 textblock">No cumple con los requisitos de la regulación de acceso a datos obligatorio.<strong><a class="gdprlink" href="admin.php?page=wp_gdpr_dac">Configúralo</a></strong></div></div>
  <?php } ?>
  <br>
  
  <div class="row"><div class="col-xs-1 checkbx"></div><div class="col-lg-11"><h4 class="m0">Notificación de incumplimiento de datos</h4></div></div>
  <?php if(strlen(get_option($pref.'dbr-message'))>0){  ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge yesbadge"><span class="glyphicon glyphicon-ok yesicons" ></span></span></div><div class="col-lg-11 textblock">Cumple con los requisitos de notificación de violación de datos.</div></div>  
  <?php } ?>
  <?php if(strlen(get_option($pref.'dbr-message'))<1){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge nobadge"><span class="glyphicon glyphicon-remove noicons" ></span></span></div><div class="col-lg-11 textblock">No cumple con los requisitos de notificación de violación de datos. <strong><a class="gdprlink" href="admin.php?page=wp_gdpr_dbr">Configúralo</a></strong></div></div>
  <?php } ?>
  <br>
  
<div class="row"><div class="col-xs-1 checkbx"></div><div class="col-lg-11"><h4 class="m0">Requerimientos de Rectificación de Datos</h4></div></div>
  <?php if(strlen(get_option($pref.'drr-message'))>0){  ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge yesbadge"><span class="glyphicon glyphicon-ok yesicons" ></span></span></div><div class="col-lg-11 textblock">Cumple con los requisitos de rectificación de datos.</div></div>  
  <?php } ?>
  <?php if(strlen(get_option($pref.'drr-message'))<1){ ?>
  <div class="row container-fluid"><div class="col-xs-1 checkbx"><span class="badge nobadge"><span class="glyphicon glyphicon-remove noicons" ></span></span></div><div class="col-lg-11 textblock">No cumple con los requisitos de rectificación de datos. <strong><a class="gdprlink" href="admin.php?page=wp_gdpr_drf"> Configúralo</a></strong></div></div>
  <?php } ?>
  
    </div>
  </div>

			</div>
		</div>
	</div>
</body>
<style>
div.gdpryes
{
	font-size:20px;
	background-color: #00e64d;
	border-radius:50px;
	color:white;
}
.gdprno
{
	font-size:20px;
	background-color: #df706d;
	border-radius:50px;
	color:white;
}
.gdpryesicons
{
	font-size:18px;
	border-radius:100%;
	color:#00cc44;
	background-color:white;
}
.gdprnoicons
{
	font-size:18px;
	border-radius:100%;
	color: #df706d;
	background-color:white;
}
.ybadge
{
	min-height:40px;min-width:40px;border-radius:60%;padding:10px;border:0px;background-color:white;margin:5px;
}
.gdprbadge
{
	
}

.gdprlink{color:#337ab7;}
.gdprlink:link{ text-decoration: none;color:#337ab7;}
.gdprlink:hover{color:#337ab7}


/* Customize the label (the containerr) */
.containerr {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.containerr input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.containerr:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.containerr input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.containerr input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.containerr .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
/* Theme style*/
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
/*Row arrangement for status */
.checkbx{
	    width: 5%;
    padding-left: 0;
}
.yesbadge {    
    padding: 10px;
    border: 0px;
    background-color: #38B677;
    margin: 5px;
    margin-top: 1px;
	border-radius: 2px;
}
.yesicons {
    font-size: 18px;
    border-radius: 100%;
    color: #fff;   
}
.noicons {
    font-size: 18px;
    border-radius: 100%;
    color: #fff;   
}
.nobadge {    
    padding: 10px;
    border: 0px;
    background-color: #FE5253;
    margin: 5px;
    margin-top: 1px;
	border-radius: 2px;
}
.statusnobadge {    
    padding: 10px;
    border: 0px;
    background-color: #e4dddd;
    margin: 5px;
    margin-top: 1px;
	border-radius: 2px;
}
.statusyesbadge {    
    padding: 10px;
    border: 0px;
    background-color: #e4dddd;
    margin: 5px;
    margin-top: 1px;
	border-radius: 2px;
}
.textblock{
	padding: 10px;
    padding-right: 0px;
    background-color: #FBFBFB;
    border: 1px solid #E6E6E6;
}
.statusnoicons {
    font-size: 18px;
    border-radius: 100%;
    color: red;   
}
.statusyesicons {
    font-size: 18px;
    border-radius: 100%;
    color: #38B677;   
}
.statusnotextblock {
    padding: 10px;
    padding-right: 0px;    
    color: red;
    font-weight: 700;
}
.statusyestextblock {
    padding: 10px;
    padding-right: 0px;    
    color: #38B677;
    font-weight: 700;
}

</style>
</html>
<?php gdprteknikforce_display_logo(); ?>