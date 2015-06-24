<?php require_once("../includes/layout/session.php");?>
<?php require_once("../includes/layout/db_connection.php");?>
<?php require_once("../includes/layout/functions.php");?>
<?php require_once("../includes/layout/validation_functions.php");?>
<?php
	$admin= find_admin_by_id($_GET["id"]);
	if(!$admin)
	{
		redirect_to("manage_admins.php");
	}
?>
<?php
	if(isset($_POST['submit']))
	{
		$required_fields=array("user_name","hashed_password");
		validate_presences($required_fields);

		$fields_with_max_lengths=array("user_name" =>30);
		validate_with_max_lengths($required_fields);
	}
	if(empty($errors))
	{
		$id=$admin["id"];
		$username =mysql_prep($_POST["username"]); 
		$hashed_password=mysql_prep($_POST["password"]);

		$query ="UPDATE admin SET ";
		$query .="username ='{$username}', ";
		$query .="hashed_password = '{$hashed_password}' ";
		$query .="WHERE id= {$id} ";
		$query .="LIMIT 1";
		$result=mysqli_query($connection, $query);
		if($result && mysqli_affected_rows($connection)==1)
		{
			$_SESSION["message"]="Admin updated.";
			redirect_to("manage_admins.php");
		}
		else
		{
			$_SESSION["message"]="Admin updated faild.";
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
				<h2>Edit Admin:<?php htmlentities($admin["user_name"]);?>
				</h2>
				<form action="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>" method="post">
				<p>Username:
					<input type="text" name="username" value="<?php echo htmlentities($admin["username"]);?>"/>
					</p>
					<p>Password:
						<input type="password" name="password" value=""/>						
					</p>
					<input type="submit" name="submit" value="Edit Admin"/>
				</form>
				<br/>
				<a href="manage_admins.php">Cancel</a>
			</div>
		</div>
<?php include("../includes/layout/footer.php");?>
