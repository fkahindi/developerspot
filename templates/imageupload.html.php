<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Image Upload</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<div id="upload">
		<form action="/spexproject/includes/processFormAuthentication-Test.php" method="post" enctype="multipart/form-data">
		<h4>Select image to upload:</h4>
		<p>Only images sizes of less than 500kb with formats .jpg, .png and .gif are allowed. </p>
		<input type="file" name="fileToUpload" id="fileToUpload" size="50">
		<span class="errorMsg"><?php echo (!empty($errors['fileToUpload'])? $errors['fileToUpload'] :'');?></span>
		<input type="submit" value="Upload Image" name="image-upload" class="button">
		</form>
	</div>
	
</body>
</html>