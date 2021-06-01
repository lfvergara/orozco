<?php $gdprpref='WP-GDPR-Compliance-'; ?>
<html lang="en">
  <head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  <script type="text/javascript">
  $(document).ready(function(){        
   $('#myModalgdrp').modal('show');
    });
	
	function gdrpSetCookie()
	{
		 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      
	 
    }
  };
  xhttp.open("POST", "<?php echo plugins_url( 'update.php', __FILE__ ); ?>", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("gdrpset=1");
	}
  </script>
  
  <style>
.modal-dialog{<?php echo get_option($gdprpref.'cookie-position'); ?>;margin:<?php echo get_option($gdprpref.'cookie-distance'); ?>;position:fixed;}
</style>
  </head>
  <body>
  <div id="myModalgdrp" class="modal fade gdrpbox" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content gdprboxcolor">
      <div class="modal-body" style="padding-top:0px;padding-bottom:0px">
        <h4><p class="gdprtxt"><?php echo get_option('WP-GDPR-Compliance-notice') ?></p></h4>
      </div>
      <div class="modal-footer" style="height:60px;">
        <button type="button" class="btn btn-primary" onclick="gdrpSetCookie()" data-dismiss="modal"><?php echo get_option($gdprpref.'cookie-accept-button'); ?></button>
      </div>
    </div>

  </div>
</div>
<style>.gdprboxcolor{background-color:<?php echo get_option($gdprpref.'cookie-bg-color'); ?>;}.gdprtxt{color:<?php echo get_option($gdprpref.'cookie-text-color'); ?>;}</style>
<style><?php echo get_option($gdprpref.'cookie-style'); ?></style>
  </body>
  </html>