<?php require_once("../includes/layout/session.php");?>
<?php require_once("../includes/layout/db_connection.php");?>
<?php require_once("../includes/layout/functions.php");?>
<?php $layout_context="public";?>
<?php include("../includes/layout/header.php");?>
<?php
	find_selected_pages(true);
?>
		<div id="main">
			<div id="navigation">
				<?php echo public_Navigation($current_subject,$current_page);?>
			</div>
			<div id="page">
 				<?php
					if ($current_page) {?>
						<h2><?php echo htmlentities($current_page["menu_name"]);?></h2>

							<?php echo nl2br(htmlentities($current_page["content"]));?>
						<br/>
						<br/>
					 
					<?php
					}else{
					?>
					<br/>
					
				<h>Welcome</h>
				<?php }?>					

			</div>
		</div>
<?php include("../includes/layout/footer.php");?>

	
