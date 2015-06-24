<?php require_once("../includes/layout/session.php");?>
<?php require_once("../includes/layout/db_connection.php");?>
<?php require_once("../includes/layout/functions.php");?>
<?php require_once("../includes/layout/validation_functions.php");?>
<?php
if(isset($_POST['submit']))
{
	//Data validation
	$required_fields=array("username","hashed_password");
	validate_presences($required_fields);

	$fields_with_max_lengths=array("username" =>30);
	validate_with_max_lengths($required_fields);
	if(empty($errors))
	{
		$username=mysql_prep($_POST["username"]);
		$hashed_password=mysql_prep($_POST["password"]);

		$query ="INSERT INTO admin (";
		$query .=" username, hashed_password";
		$query .=") VALUES (";
		$query .=" '{$username}', '{$hashed_password}'";
		$query .=")";
		$result= mysqli_query($connection,$query);
		if($result){
			$_SEESION["message"]="Admin Created.";
			redirect_to("manage_admins.php");
		}
		else
		{
			$_SEESION["message"]="Admin creation faild.";
		}
	}
}
	
?>
<?php $layout_context="admin";?>
<?php include("../includes/layout/header.php");?>
	<div id="main">
			<div id="navigation">
				&nbsp;
					
			</div> 
			<div id="page">
				<?php echo message();?>
				<?php echo form_errors($errors);?>
				<h2>Create Admin</h2>
				<form action="new_admin.php" method="post">
					<p>Username:
						<input type="text" name="username" value=""/>
					</p>
					<p>Password:
						<input type="password" name="password" value=""/>						
					</p>
					<input type="submit" name="submit" value="Create Admin"/>
				</form>
				<br/>
				<a href="manage_admins.php">Cancel</a>	
			</div>
		</div>
<?php include("../includes/layout/footer.php");?>
