<?php
/** 
 * Example Usage of Federal_Open_Source_Repos Class.
 */
?>
<html>
	<body>
<?php

//bootstrap the class
require_once dirname( __FILE__ ) . 'class.federal-open-source-repos.php';

//instantiate the class
$gh = new Federal_Open_Source_Repos();

//retrieve all repos and loop
foreach ( $gh->get_repos() as $repo ) { ?>

	<p><?php echo $repo->owner->login; ?>: <a href="<?php echo $repo->url; ?>"><?php echo $repo->name; ?></a><br />
	<?php echo $repo->description; ?></p>

<?php } ?>

	</body>
</html>

