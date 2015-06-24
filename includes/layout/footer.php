	<div id="footer">Copyright <?php echo date("Y")?>,widget Corp </div>
	</body>
</html>
<?php 
	if(isset($connection))
	{
	mysqli_close($connection);
}
?>
