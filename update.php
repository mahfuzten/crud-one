<?php include_once 'autoload.php';
$update_id = $_GET['update_id'] ?? false;

if($update_id){
    $data = connect() ->query("SELECT * FROM staffs WHERE id='$update_id'");
    $update_user_data= $data -> fetch_object();
    if($update_user_data->name==''){
        header('location:allstaffs.php');
        }
        }
        else{
            header('location:allstaffs.php');
        }
?>
<!DOCTYPE html>
<html lang=en>
<head>
             <meta charset="UTF-8">
             <title><?php $update_user_data->name; ?></title>
             <link rel="stylesheet" href="assets/css/bootstrap.min.css">
             <link rel="stylesheet" href="assets/css/style.css">
             <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
                    
             <div class= "user-from w-25 mx-auto my-5">
             
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
                $updated_at_data = date('Y-m-d H:i:s');
                if(empty($name) || empty($email) || empty($cell) || empty($username) || empty($Designation) || empty($gender)){
                    $msg= validate("All fields are required ! ");
                }
                else if (emailcheck($email) == false){
                    $msg = validate("Invalide Email Address !", "warning");
                }else
                {
                    $updated_photo='';
                    if(!empty($_FILES['update_photo']['name'])){
                        $updated_photo = photoUpload($_FILES['update_photo'], 'photos/');
                    }else{
                        
                        $updated_photo = $update_user_data -> photo;
                    }
                    connect() -> query("UPDATE staffs SET name='$name', email='$email', cell='$cell', username='$username', Designation='$Designation', gender='$gender', photo='$updated_photo',
                    updated_at='$updated_at_data' WHERE id='$update_id'");
                    $msg = validate('Data updated successfully', 'success');
                    $data = connect() -> query("SELECT * FROM staffs WHERE id='$update_id'");
                    $update_user_data = $data -> fetch_object();
                    echo $update_user_data-> Designation;
                }
            }
            ?>
                    <div class="card shadow">
                        <div class="card-header">
                             <h2 class="card-title">Update <?php echo $update_user_data ->name; ?>Data</h2>
                        </div>
                        <div class="card-body">
                        <?php echo $msg ?? ''; ?>

                             <form action='' method="POST" enctype="multipart/form-data">
                               <div class="form-group">
                                 <label for=""> Name</label>
                                 <input name="name" value="<?php echo $update_user_data-> name; ?>" type='text' value="<?php echo old('name'); ?>" class="form-control">
                               </div>
                               <div class="form-group">
                               <label for="">Email</label>
                               <input name="email" value="<?php echo $update_user_data-> email;?>" type="text" value="<?php echo old('email');?>" class="form-control">
                               <?php echo $email_check ?? ''; ?>
                               </div>
                               <div class="form-group">
                                <label for="">Cell</label>
                                <input name="cell" value="<?php echo $update_user_data->cell;?>" type="text" value="<?php old('cell'); ?>" class="form-control">
                            </div>
                               <div class="form-group">
                               <label for="">Username</label>
                               <input name="username" type="text" value="<?php echo $update_user_data-> username; ?>" value="<?php echo old('username');?>" class="form-control">
                               </div>
                               <div class="form-group">
				<label for="">Designation</label>
				<select class='form-control' name="Designation" id="">
					<option <?php echo $update_user_data -> Designation == ''? 'selected': '';?> value="">-Select-</option>
					<option <?php echo $update_user_data -> Designation == 'admin' ? 'selected' : ''; ?> value="admin">Admin</option>
					<option <?php echo $update_user_data -> Designation == 'marketing' ? 'selected' : ''; ?> value="marketing">Marketing</option>
					<option <?php echo $update_user_data -> Designation == 'hr' ? 'selected' : ''; ?> value="hr">HR</option>
					<option <?php echo $update_user_data -> Designation == 'security' ? 'selected' : ''; ?> value="security">Security</option>
					<option <?php echo $update_user_data -> Designation == 'worker' ? 'selected' : ''; ?> value="worker">Worker</option>
				</select>
			</div>
            <div class="form-group">
            <label for="">Gender</label>
            <input <?php echo ( $update_user_data -> gender == 'male') ? 'checked' : ''; ?> type="radio" id="male" name="gender" value='male'><label for="male">Male</label>
            <input <?php echo ( $update_user_data -> gender == 'female') ? 'checked' : ''; ?> type="radio" id="female" name="gender" value='female'><label for="female">Female</label>
        </div>
                        <div class="form-group">
                        <img style="max-width: 100%;" src="photos/ <?php echo $update_user_data->photo; ?>" alt="">
                                 <input name="update_photo" type="file">
                        </div>
                        <div class="form-group"> 						
						<input name="submit" type="submit" class="btn btn-primary" value="Update Now">
					</div>
                             </form>
                        </div>
                    </div>
             </div>

             <script src="assets/js/jquery-3.4.1.min.js"></script>
             <script src="assets/js/popper.min.js"></script>
             <script src="assets/js/bootstrap.min.js"></script>
             <script src="assets/js/custom.js"></script>

</body>

</html>