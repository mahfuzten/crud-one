<?php 

	include_once "autoload.php";


	
	$delete_id = $_GET['delete_id'] ?? false ;
	
	if( $delete_id ){
		connect() -> query("DELETE FROM staffs WHERE id='$delete_id'");
		header('location:allstaffs.php');
	}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Staffs Database</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	
	

	<div class="wrap-table">
		<a class="btn btn-primary btn-sm" href="index.php">Add new Staffs</a>
		<br>
		<br>
		<div class="card shadow">
			<div class="card-body">
				<h2>All Data</h2>
                <table class="table table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
                            <th>Username</th>
                            <th>Designation</th>
                            <th>Gender</th>
							<th>Photo</th>
							<th width="200">Action</th>
						</tr>
					</thead>
					<tbody>



					<?php 
					
						
					$data = connect() -> query("SELECT * FROM staffs");
					
					
					
					$sn = 1;
					while( $user = $data -> fetch_object() ) :
					
					?>

						<tr>
							<td><?php echo $sn; $sn++; ?></td>
							<td><?php echo $user -> name; ?></td>
							<td><?php echo $user -> email; ?></td>
							<td><?php echo $user -> cell; ?></td>
                            <td><?php echo $user -> username; ?></td>
                            <td><?php echo $user -> Designation; ?></td>
                            <td><?php echo $user -> gender; ?></td>
							<td><img src="photos/<?php echo $user -> photo; ?>" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info"  href="person.php?user_id=<?php echo $user -> id; ?>">View</a>
								<a class="btn btn-sm btn-warning" href="edit.php?edit_id=<?php echo $user -> id; ?>">Edit</a>
								<a class="btn btn-sm btn-danger delete_btn" href="?delete_id=<?php echo $user -> id; ?>">Delete</a>
							</td>
						</tr>
					
						<?php endwhile; ?>
						

					</tbody>
				</table>
			</div>
		</div>
	</div>










	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>

		$('.delete_btn').click(function(){
			let conf = confirm('Are you sure ? ');

			if(conf){

				return true;
				
			}else{
				

				return false;
			}
			

		});

	</script>
</body>
</html>