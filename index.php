<?php

$p = "";

if(isset($_GET['p']))
{
	$p = $_GET['p'];
}
else
{
	$p = "Demo";
}

?>

<?php include("Source/Components/Header.php") ?>

<body>

	<section id='p'>
		<?php include("Source/View/" . $p . ".php") ?>
	</section>

<?php include("Source/Components/Footer.php"); ?>

</body>
</html>