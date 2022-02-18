<?php 

	include_once "autoload.php";

    $user_id = $_GET['user_id'] ?? false;

    if( $user_id ){
        $data = connect() -> query("SELECT * FROM staffs WHERE id='$user_id'");
        $user_data = $data -> fetch_object();

		if( $user_data -> name == '' ){
			header('location:allstaffs.php');
		}

    }else {
		header('location:allstaffs.php');
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css"> 
	<link rel="stylesheet" href="assets/css/responsive.css">

    <style>
        .person-user {
	width: 500px;
	margin: 200px auto 0;
	text-align: center;
}
 
.person-user img {
	width: 200px;
	height: 200px;
	object-fit: cover;
	border-radius: 50%;
}
    </style>
</head>
<body>
	


    <div class="person-user">
        <img src="photos/<?php echo $user_data -> photo; ?>" alt="">
        <h2><?php echo $user_data -> name; ?></h2>
        <h3><?php echo $user_data -> cell; ?></h3>
        <a class="btn btn-primary" href="allstaffs.php">Back</a>
    </div>




	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>

</body>
</html>