<?php	include_once 'autoload.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
<div class="user-form w-25 mx-auto my-5">
<a class="btn btn-primary" href="allstaffs.php">All Staffs</a>
		<br>
		<br>	
	<?php
	
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$cell = $_POST['cell'];
		$username = $_POST['username'];
		$Designation = $_POST['Designation'];
		
		$gender = $_POST['gender'] ?? '';
		$email_check = emailCheck($email) ?  '' :  '<span style="color:red;"> * Required  </span>' ;
		if(empty($name) || empty($email) || empty($cell) || empty($username) || empty($Designation) || empty($gender)){
			$msg= validate("All fields are required ! ");
		}
		else if (emailcheck($email) == false){
			$msg = validate("Invalide Email Address !", "warning");
		}
		else{
			$file_name = photoUpload($_FILES['photo'], 'photos/');
			connect() -> query("INSERT INTO staffs (name, email, cell, username, designation, gender, photo)VALUES('$name', '$email', '$cell', '$username', '$Designation', '$gender', '$file_name')");
			
			$msg = validate("Data Success", "success");			
			formclear();
		}

	}
	?>
<div class="card shadow">
	<div class="card-header">
		<h2 class="class-title">Staffs Data Entry</h2>
	</div>
	<div class="card-body">
		<?php echo $msg ?? ''; ?>
          <form action="" method="POST" enctype="multipart/form-data">
			  <div class="form-group">
				  <label for="">Name</label>
				  <input name="name" type="text" value="<?php old('name'); ?>" class="form-control">
			  </div>
			  <div class="form-group">
				<label for="">Email</label>
				<input name="email" type="text" value="<?php old('email'); ?>" class="form-control">
				<?php echo $email_check ?? ''; ?> 
				</div>
			<div class="form-group">
				<label for="">Cell</label>
				<input name="cell" type="text" value="<?php old('cell'); ?>" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Username</label>
				<input name="username" type="text" value="<?php old('username'); ?>" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Designation</label>
				<select class='form-control' name="Designation" id="">
					<option value="">-Select-</option>
					<option <?php echo (old('Designation') == 'admin') ? 'selected' : ''; ?> value="admin">Admin</option>
					<option <?php echo (old('Designation') == 'marketing') ? 'selected' : ''; ?> value="marketing">Marketing</option>
					<option <?php echo (old('Designation') == 'hr') ? 'selected' : ''; ?> value="hr">HR</option>
					<option <?php echo (old('Designation') == 'security') ? 'selected' : ''; ?> value="security">Security</option>
					<option <?php echo (old('Designation') == 'worker') ? 'selected' : ''; ?> value="worker">Worker</option>
				</select>
			</div>
			<div class="form-group">
				<label for="">Gender</label>
				<input <?php echo (old('gender') == 'male') ? 'checked' : ''; ?> type="radio" id="male" name="gender" value='male'><label for="male">Male</label>
				<input <?php echo (old('gender') == 'female') ? 'checked' : ''; ?> type="radio" id="female" name="gender" value='female'><label for="female">Female</label>
			</div>
		    <div class="form-group">
						
						<input name="photo" type="file" > 
			
					</div>
			<div class="form-group">
                 <input name="submit" type="submit" class="btn btn-primary" value="Submit" />
			</div>
		</div>
		  </form>

</div>
 </div>

	




	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>  