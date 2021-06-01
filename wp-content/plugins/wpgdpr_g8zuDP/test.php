<?php
if($_POST['drrtyp']=='u')
{
	if(email_exists($_POST['dremail']))
	{
	$resultaction="<p><a href='user-edit.php?user_id=".email_exists($_POST['dremail'])."'><input type='button' class='btn btn-primary'></a></p>";
	}
	else
	{
		$resultaction="<font color='red'><b>el usuario no existe .</b></font>";
	}
}
if(isset($_POST['p']))
{
	echo 
	"
	<table>
	<thead><th>#</th><th>Date</th><th>Título de la entrada</th><th>Acción</th><thead>
	<tbody>";
	$args = array(
    'author'        =>email_exists($_POST['dremail']),
    'orderby'       =>  'post_date',
    'order'         =>  'ASC' 
    );
	$drposts=get_posts( $args );
	print_r($drposts)
	foreach($drpost as $data)
	{
		//echo "<td>".$data->ID."</td><td>".$data->post_title."</td><td><a href=></a></td>";
	}
	echo "</tbody>
	</table>
	";
}
if($_POST['drrtype']=='c')
{
	$drcomments="<table class='table table-stripped'><thead><tr><td>#</td><td>Date</td><td>Título de la entrada</td><td>Comentario</td><td>Acción</td></tr></thead><tbody>";
	$args=array(
	'author_email' =>$_POST['dremail']);
	 $comments=get_comments( $args );
	 foreach($comments as $data)
	 {
		
		$drcomments .="<tr><td>". $data->comment_ID."</td><td>".$data->comment_date."</td><td>".get_the_title($data->comment_post_ID)."</td><td><p>".$data->ccomment_ontent."</p></td><td><a href='comment.php?action=editcomment&c=".$data->comment_ID."'><input type='button' class='btn btn-primary' value='Modificar comentario'></a></td></tr>";
		 
	 }
	 $drcomments .="</tbody></table>";
	 $resultaction=$drcomments;
}
?>