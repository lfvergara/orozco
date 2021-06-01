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

     if((filter_var($_POST['gdpremailpda'],FILTER_VALIDATE_EMAIL))&&($_POST['gdprchkbox']=='1'))
	{gdprRequestDataAccess();	}
	
	
}
if(isset($_POST['gdprfmsubmit']))
{
	if((filter_var($_POST['gdprfmemail'], FILTER_VALIDATE_EMAIL))&&($_POST['gdprchkbox']=='1'))
	{gdprRequestForgetMe();	}
}
if(isset($_POST['gdprdrsubmit']))
{
	if((filter_var($_POST['gdprdremail'],FILTER_VALIDATE_EMAIL))&&($_POST['gdprchkbox']=='1'))
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
<div class="container-fluid">
<ul class="nav nav-tabs">
  <li class="active" id="gdprPDA"><a href="#">Acceso a datos personales</a></li>
  <li id="gdprFM"><a href="#">Olvidame</a></li>
  <li id="gdprDR"><a href="#">Rectificación de datos</a></li>
</ul>


<div id="gdprpda" class="form-group">
            <form action="" method="post">
            <br><p>
				<b>Solicite sus datos recopilados por este sitio web. Una vez hecho esto, recibirá una notificación por correo electrónico..</b></p>

            
                <label for="gdpremailpda">Email:</label>
                <input type="email" id="gdpremailpda" class="form-control" name="gdpremailpda" value="" required="">
                <br><br>
                <input type="checkbox" name="gdprchkbox" value="1" required="">
                <label for="">
					Doy mi consentimiento para que se recopile mi correo electrónico para recibir los datos solicitados. Vea la página de Política de Privacidad para más información.                </label>
                <br><br>
                <input type="submit" class="btn btn-info" name="gdprpdasubmit" value="Submit">
            </form>
        
</div>
<div id="gdprfm" class="Form Control">
<br>
<p>
				<b>Compruebe los servicios que desea que sean olvidados. Esto enviará una solicitud al administrador del sitio web. Se lo notificará por correo electrónico una vez que lo haya hecho.</b></p>

            <form action="" method="post">

                

					                        <div class="">
                            <div class="">
                                <input type="checkbox" name="gdprfmchkboxc" value="c">
                            </div>
                            <div class="">
                                <div class=""><b>Comentarios de WordPress</b></div>
                                <div class="">Comentarios de WordPress, ingresados ​​por los usuarios en los comentarios</div>
                            </div>
                        </div>


					                        
                            <div class="">
                                <input type="checkbox" name="gdprfmchkboxp" value="p">
                            </div>
                            
                                <div class=""><b>Publicaciones de WordPress</b></div>
                                <div class="">WordPress publica datos de autor</div>
                           
                        


					                        <div class="">
                            <div class="">
                                <input type="checkbox" name="gdprfmchkboxu" value="u">
                            </div>
                            <div class="">
                                <div class=""><b>Datos de usuario de WordPress</b></div>
                                <div class="">Datos de usuario de WordPress almacenados como metadatos de usuario en la base de datos</div>
                            </div>
                        </div>


					

                    <div class="">

                        <label for="">Email:</label>
                        <input type="email" name="gdprfmemail" value="" required="">

                    </div>

                    <input type="checkbox" name="gdprchkbox" value="1" required="">
                    <label for="">
						Doy mi consentimiento para que se recopile mi correo electrónico a fin de procesar esta solicitud. Vea la página de Política de Privacidad para más información.                   </label>

                    <input type="submit"  name="gdprfmsubmit" value="Submit">

</form>
</div>
<div id="gdprdr" class="Form Control">
<br>
            <P>
				<b>Envíe una solicitud al administrador del sitio web para rectificar sus datos. Ingrese lo que le gustaría que se rectifique. Se te notificará una vez que esto esté hecho. </b></p>

            <form action="" method="post">

                    <label for="" class="">
						Datos actuales                    </label>
                    <textarea name="gdprcurrent" rows="5" required=""></textarea>

                    <label for="" class="">
						Datos rectificados                 </label>
                    <textarea name="gdprrectification" rows="5" required=""></textarea>

                    <label for="">Email:</label>
                    <input type="email" name="gdprdremail" value="" required="">

                <br>

                <input type="checkbox" name="gdprchkbox" required="" value="1">
                <label for="">
					Doy mi consentimiento para que se recopile mi correo electrónico a fin de procesar esta solicitud. Vea la página de Política de Privacidad para más información.               </label>

                <input type="submit"  name="gdprdrsubmit" value="Submit">


            </form>
        </div>
</div>

</body>
</html>
