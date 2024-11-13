<?php
	
	if(ISSET($_POST['export'])){
		if(!empty($_POST['title']) && !empty($_POST['content'])){	
			$output ="
				<h1>".$_POST['title']."</h1>
				<p>".$_POST['content']."</p>
			";
			
			$date = date("d-m-Y i:s");
			
			header("Content-Type: application/vnd.msword");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("content-disposition: attachment;filename=".$date.".doc");
			
			echo "<html>";
			echo $output;
			echo "</html>";
			
		}else{
			echo "<script>alert('Por favor complete el campo requerido.')</script>";
			echo "<script>window.location='index.php'</script>";
		}
	};
?>