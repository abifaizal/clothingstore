<form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="file"> <br>
	<input type="submit" name="submit" value="Ok">
</form>

<?php 
	if(@$_POST['submit']) {
		$file = $_FILES['file']['name'];
		if($file == "") {
			echo "Kosong";
		} else {
			echo $file;
		}
	}
 ?>