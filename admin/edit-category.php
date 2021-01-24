<?php
require_once('../includes/config.php');


if(!$user->is_logged_in()){ header('Location: login.php'); }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin - Edit Category</title>
  <link rel="stylesheet" href="../style/normalize.css">
  <link rel="stylesheet" href="../style/main.css">
</head>
<body>

<div id="wrapper">

	<?php include('menu.php');?>
	<p><a href="categories.php">Categories Index</a></p>

	<h2>Edit Category</h2>


	<?php


	if(isset($_POST['submit'])){


		extract($_POST);


		if($catID ==''){
			$error[] = 'This post is missing a valid id!.';
		}

		if($catTitle ==''){
			$error[] = 'Please enter the title.';
		}

		if(!isset($error)){

			try {

				$catSlug = slug($catTitle);


				$stmt = $db->prepare('UPDATE blog_cats SET catTitle = :catTitle, catSlug = :catSlug WHERE catID = :catID') ;
				$stmt->execute(array(
					':catTitle' => $catTitle,
					':catSlug' => $catSlug,
					':catID' => $catID
				));


				header('Location: categories.php?action=updated');
				exit;

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}

		}

	}

	?>


	<?php

	if(isset($error)){
		foreach($error as $error){
			echo $error.'<br />';
		}
	}

		try {

			$stmt = $db->prepare('SELECT catID, catTitle FROM blog_cats WHERE catID = :catID') ;
			$stmt->execute(array(':catID' => $_GET['id']));
			$row = $stmt->fetch(); 

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}

	?>

	<form action='' method='post'>
		<input type='hidden' name='catID' value='<?php echo $row['catID'];?>'>

		<p><label>Title</label><br />
		<input type='text' name='catTitle' value='<?php echo $row['catTitle'];?>'></p>

		<p><input type='submit' name='submit' value='Update'></p>

	</form>

</div>

</body>
</html>	
