<?php
/** 
 * Example Usage of Federal_Open_Source_Repos Class.
 */
?>
<html>
	<body>
<?php
 
$gh = new Federal_Open_Source_Repos();

foreach ( $gh->get_repos() as $repo ) { ?>

	<p><?php echo $repo->owner->login; ?>: <a href="<?php echo $repo->url; ?>"><?php echo $repo->name; ?></a><br />
	<?php echo $repo->description; ?></p>

<?php } ?>

	</body>
</html>

