<?php
if((isset($_GET['gdpremail']))&&(isset($_GET['gdprtype']))&&(isset($_GET['gdprotp'])))
{
	
	global $wpdb;
	$utable=$wpdb->prefix."gdpr_request_records";
	$uupdate=$wpdb->query($wpdb->prepare("update ".$utable." set login=%s where email=%s and type=%s and login=%s ",array('2',$_GET['gdpremail'],$_GET['gdprtype'],$_GET['gdprotp'])));
	if($uupdate)
	{
		echo "<script>alert('Solicitud confirmada');</script>";
	}
}
?>

<?php
if(isset($_POST['gdprpdasubmit']))
{

     if(filter_var($_POST['gdpremailpda'],FILTER_VALIDATE_EMAIL))
	{gdprRequestDataAccess();	}
	
	
}
if(isset($_POST['gdprfmsubmit']))
{
	if(filter_var($_POST['gdprfmemail'], FILTER_VALIDATE_EMAIL))
	{gdprRequestForgetMe();	}

}
if(isset($_POST['gdprdrsubmit']))
{
	if(filter_var($_POST['gdprdremail'],FILTER_VALIDATE_EMAIL))
	{gdprRequestDataRectification();	}
}
?>
<html>
<head>
<meta charset="utf-8"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$("#gdprfm").hide();$("#gdprdr").hide();
	$("#gdprPDA").click(function(){$("#gdprpda").show();$("#gdprfm").hide();$("#gdprdr").hide();});
	$("#gdprFM").click(function(){$("#gdprfm").show();$("#gdprpda").hide();$("#gdprdr").hide();});
	$("#gdprDR").click(function(){$("#gdprdr").show();$("#gdprpda").hide();$("#gdprfm").hide();});
	
});
</script>
</head>
<body>
<div class="containerr-fluid">
<ul class="nav nav-tabs">
  <li class="active" id="gdprPDA"><a data-toggle="tab" href="#menu1">Solicitud de acceso a datos</a></li>
  <li id="gdprFM"><a data-toggle="tab" href="#menu2">Olvide la solicitud de datos</a></li>
  <li id="gdprDR"><a data-toggle="tab" href="#menu3">Rectificar solicitud de datos</a></li>
</ul>

<div class="tab-content">
    
    <div id="menu1" class="tab-pane fade in active">
      <div class="col-sm-18"><br>
  <div class="panel panel-primary">
    <div class="panel-heading"><h4>Solicitud de acceso a datos</h4></div>
    <div class="panel-body">
       
<div id="gdprpda" class="form-group">
<form action="" method="post">
<p>
<b>Solicite una copia de los datos que tenemos sobre usted. Se le enviará un correo electrónico con los datos una vez que se hayan generado.</b></p>

<label for="gdpremailpda">Email:</label>
<input type="email" id="gdpremailpda" class="form-control" name="gdpremailpda" value="" required="">
<br>
<!-- <label class="containerr">
    I consent to my email being collected in order to receive my requested data. See Privacy Policy page for more information.               
<input type="checkbox" name="gdprchkbox" value="1" required="">
<span class="checkmark"></span>
	</label> -->
<!-- <br> -->
 <button type="submit" name="gdprpdasubmit" class="submitrequestbtn"></button>

</form>
        
</div>
        
    </div>
  </div>
</div>
</div>
<div id="menu2" class="tab-pane fade">
<div class="col-sm-18"><br>
<div class="panel panel-primary">
<div class="panel-heading"><h4>Olvide la solicitud de datos</h4></div>
<div class="panel-body">
<div id="gdprfm" class="Form Control"> 
<form action="" method="post">
<p>
<b>
Seleccione lo que desea ser olvidado. Recibirá una notificación por correo electrónico una vez que se haya completado.
</b></p>
<label class="containerr">
Comentarios de WordPress
<input type="checkbox" name="gdprfmchkboxc" value="c">
<span class="checkmark"></span>
</label>

Sus comentarios en varias publicaciones<br><br>
<label class="containerr">
<b>Publicaciones de WordPress</b>
<input type="checkbox" name="gdprfmchkboxp" value="p">
<span class="checkmark"></span>
</label>
Artículos y publicaciones escritos por usted
<br><br>
<label class="containerr">
<b>Datos de usuario de WordPress</b>
<input type="checkbox" name="gdprfmchkboxu" value="u">
<span class="checkmark"></span>
</label>
Sus datos de usuario registrados en la base de datos de Wordpress.
<br>
 <br><label for="">Email:</label><br>
<input type="email" class="form-control" name="gdprfmemail" value="" required="">
<br>
<!-- <label class="containerr">
I consent to my email being collected in order to process this request. See Privacy Policy page for more information.
<input type="checkbox" name="gdprchkbox" value="1" required="">

<span class="checkmark"></span>
</label> -->
 <button type="submit" name="gdprfmsubmit" class="submitrequestbtn"></button>  
</form>
</div> 
        
    </div>
  </div>
</div>
    </div>
    <div id="menu3" class="tab-pane fade">
    <div id="gdprdr" class="Form Control">
      <div class="col-sm-18"><br>
  <div class="panel panel-primary">
    <div class="panel-heading"><h4>Rectificar solicitud de datos</h4></div>
    <div class="panel-body">
   <div id="gdprdr" class="Form Control"> 
<form action="" method="post">

<label class="containerr">
Comentarios de WordPress
<input type="checkbox" name="gdprdrchkboxc" value="c">
<span class="checkmark"></span>
</label>

Sus comentarios en varias publicaciones<br><br>
<label class="containerr">
<b>Publicaciones de WordPress</b>
<input type="checkbox" name="gdprdrchkboxp" value="p">
<span class="checkmark"></span>
</label>
Artículos y publicaciones escritos por usted
<br><br>
<label class="containerr">
<b>Datos de usuario de WordPress</b>
<input type="checkbox" name="gdprdrchkboxu" value="u">
<span class="checkmark"></span>
</label>
Sus datos de usuario registrados en la base de datos de Wordpress.<br>
<label>
Qué hay que rectificar ?</label><br>
<textarea name="gdprrectification" class="form-control" rows="5" required=""></textarea><br>

<label for="">Email:</label><br>
<input type="email" class="form-control" name="gdprdremail" value="" required="">

<br>
<!-- <label class="containerr">
I consent to my email being collected in order to process this request. See Privacy Policy page for more information.
<input type="checkbox" name="gdprchkbox" required="" value="1">
<span class="checkmark"></span>
</label>-->
<button type="submit" name="gdprdrsubmit" class="submitrequestbtn"></button>

</form>
         </div> 
    </div>
  </div>
</div>
</div>
    </div>
  </div>
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
h4{margin:0px;}
.submitrequestbtn
{
	background-image: url("<?php echo plugins_url( 'img/Submit-Request-Button.png' , __FILE__); ?>");
	height:36px;
	width:280px;
	border:0px;
	margin-left: 0px;	
	border-radius:4px;
}
.submitrequestbtn:hover
{
	background-image: url("<?php echo plugins_url( 'img/Submit-Request-Button.png' , __FILE__); ?>");
	height:36px;
	width:280px;
	border:0px;
	margin-left: 0px;	
	border-radius:4px;
}
</style>
</body>
</html>
