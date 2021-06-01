<?php 
$pref='WP-GDPR-Compliance-';
if(isset($_POST['saveeu']))
{
	if(isset($_POST['euactive']))
	{
		if(filter_var($_POST['euurl'],FILTER_VALIDATE_URL))
		{
		update_option($pref.'eu-active','1');
		update_option($pref.'eu-redirect',$_POST['euurl']);
		}
		else
		{
			echo "<script>alert('La URL de redireccionamiento no es válida')</script>";
		}
	}
    else
	{
		update_option($pref.'eu-active','0');
	}
 
}
?>
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
		<li><a href="admin.php?page=wp_gdpr">Conformidad</a></li>
		<li><a href="admin.php?page=wp_gdpr_cookie">Consentimiento de cookies</a></li>
		<li><a href="admin.php?page=wp_gdpr_tandc">Términos y Condiciones</a></li>
		<li><a href="admin.php?page=wp_gdpr_pp">Política de privacidad</a></li>
		<li><a href="admin.php?page=wp_gdpr_rtbf">Derecho a ser olvidado</a></li>
		<li><a href="admin.php?page=wp_gdpr_dac">Acceso a datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_dbr">Incumplimiento De Datos</a></li>
		<li><a href="admin.php?page=wp_gdpr_drf">Rectificación de Datos</a></li>
		<li  class="active"><a href="admin.php?page=wp_gdpr_eu">Rechazar Visitas de la UE</a></li>
	</ul>

<br>
<div class="container-fluid">
<div class="row"><br>
  <div class="col-sm-12">
<div class="panel panel-primary">
      <div class="panel-heading"><h4 class="m0">Rechazar Visitas de la UE</h4></div>
      <div class="panel-body">
	  <?php if((int)get_option($pref.'eu-people')>0){  ?>
	  <div class="alert alert-info">
  <strong><?php echo get_option($pref.'eu-people');  ?></strong> personas rechazadas.
</div>
	  <?php } ?>
	  <form action="" method="post">
  <div class="form-group">
    <div class="">
      <label class="containerr">
      <input type="checkbox" name="euactive" <?php if(get_option($pref.'eu-active')=='1'){echo "checked";} ?>><span class="checkmark"></span>
      <b>No aceptar trafico de los paises de la UE</b></label>
      <div class="form-group">
    <div class="">
      <label>Url de redirección</label><br>
      <input type="URL" class="form-control" value="<?php echo get_option($pref.'eu-redirect'); ?>" name="euurl"></div></div>
      <input type="submit" value="" class="btnsave" name="saveeu">
    <!-- </div>
    </div> -->
  <div class="form-group">
      <div class="con">
          <label class="left" style="margin-top: 7px;">Si rechaza el tráfico de la UE, los visitantes de los siguientes países no podrán ver su sitio web:</label>
       <div class="container-fluid">
  <div class="row" style="margin-top:12px;">
    <div class="col-sm-2">
      <p style="display:list-item;">Belgium</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Bulgaria</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Czech Republic</p>
    </div>
    <div class="col-sm-2">
     <p style="display:list-item;">Finland</p>
    </div>
  </div>
</div><br>
 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
      <p style="display:list-item;">Denmark</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Germany</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Estonia</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Sweden</p>
    </div>
  </div>
</div><br>
 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
      <p style="display:list-item;">Ireland</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Greece</p>
    </div>
    <div class="col-sm-2">
     <p style="display:list-item;">Spain</p>
     </div>
     <div class="col-sm-2">
     <p style="display:list-item;">Latvia</p>
     </div>
  </div>
</div><br>
 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
      <p style="display:list-item;">France</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Croatia</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Italy</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">United Kingdom</p>
    </div>
  </div>
</div><br>
 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
      <p style="display:list-item;">Cyprus</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Lithuania</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Luxembourg</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Romania</p>
    </div>
  </div>
</div><br>
 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
      <p style="display:list-item;">Hungary</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Malta</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Netherlands</p>
    </div>
    <div class="col-sm-2">
      <p style="display:list-item;">Slovenia</p>
    </div>
  </div>
</div><br>
 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-2">
      <p style="display:list-item;">Austria</p>
    </div>
    <div class="col-sm-2">
     <p style="display:list-item;">Poland</p>
    </div>
    <div class="col-sm-2">
     <p style="display:list-item;">Portugal</p>
    </div>
    <div class="col-sm-2">
     <p style="display:list-item;">Slovakia</p>
    </div>
  </div>
</div>
</div>
    </div>
  
	</form>

</div>
</div>
</div>
  </div>
</div>
</body>
</div>
<style>

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

.container-fluid {
  cursor: default;
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
</style>
</body></html>

<?php gdprteknikforce_display_logo(); ?>