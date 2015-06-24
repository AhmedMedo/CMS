<?php require_once("../includes/layout/session.php");?>
<?php require_once("../includes/layout/db_connection.php");?>
<?php require_once("../includes/layout/functions.php");?>
<?php
	find_selected_pages();
?>
<?php
	$current_subject=find_subject_by_id($_GET["subject"],false);
	if(!$current_subject)
	{
		//No id found
		redirect_to("manage_contnent.php");
	}
	$pages_set=find_pages_for_subject($current_subject["id"]);
	if(mysqli_num_rows($pages_set) >0)
	{
		$_SESSION["message"]="Can't delete subject with pages";
			 
		redirect_to("manage_content.php?subject={$current_subject["id"]}");

	} 
	$id=$current_subject["id"];
	$query="DELETE FROM subjects WHERE id ={$id} LIMIT 1 ";
	$result=mysqli_query($connection,$query);
	if($result && mysqli_affected_rows($connection) == 1)
		{
			//success

			$_SESSION["message"]="subject Deleted";
			 
			redirect_to("manage_content.php");
		}
		else
		{
			$_SESSION["message"]="subject Delated Faild.";
			redirect_to("manage_content.php?subject={$id}");



		}

?>