<?php require('../includes/config.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="style/normalize.css">
    <link rel="stylesheet" href="style/main.css">
    <link href="style/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="style/style.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Personal Blog Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design"
    />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href='http://fonts.googleapis.com/css?family=Oswald:100,400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
            });
        });
    </script>
    <style type="text/css">
        ul {
            list-style-type: none;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="user.php"><img src="images/logo.jpg" title="" /></a>
        </div>

        <div class="top-menu">
            <div class="search">

                <form method="post" action="user.php">
                    <input type="text" name="search" placeholder="">
                    <input type="submit" value=""/>
                </form>

            </div>
            <span class="menu"> </span>
            <ul>
                <li class="active"><a href="user.php">HOME</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
                <li class="active"> <?php echo "LOGGED AS " . $_SESSION["username"];  ?></li>
                <div class="clearfix"> </div>
            </ul>
        </div>
        <div class="clearfix"></div>
        <script>
            $("span.menu").click(function(){
                $(".top-menu ul").slideToggle("slow" , function(){
                });
            });
        </script>

    </div>
</div>

		<?php
			try {

                $pages = new Paginator('1','p');

                $stmt = $db->query('SELECT postID FROM blog_posts');

                //pass number of records to
                $pages->set_total($stmt->rowCount());

                if(isset($_POST['search'])){

                    $searchq = $_POST['search'];
                    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

                    echo '<div class="content">';
                    $stmt = $db->query("SELECT postID, postTitle, postDesc, postDate,postPreview FROM blog_posts WHERE postTitle LIKE '%$searchq%' OR postDesc LIKE '%$searchq%'");
                    while ($row = $stmt->fetch()) {
                        echo '<div class="container">';
                        echo '<div class="content-grids">';
                        echo '<div class="col-md-8 content-main">';
                        echo '<div class="content-grid-info">';
                        echo '<img src="' . $row['postPreview'] . '" alt="" style="object-fit: cover; width:669px;height:320px;"/><br/>';
                        echo '<div class="post-info">';
                        echo '<h4><a href="viewpost.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h4>';
                        echo '<h4>Posted on ' . date('jS M Y H:i:s', strtotime($row['postDate'])) . '</h4>';
                        echo '<p>' . $row['postDesc'] . '</p>';
                        echo '<a href="viewpost.php?id=' . $row['postID'] . '"><span></span>Read More</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }else {
                    echo '<div class="content">';



                    $stmt = $db->query('SELECT postID, postTitle, postSlug, postPreview, postDesc, postDate FROM blog_posts ORDER BY postID DESC '.$pages->get_limit());
                    while ($row = $stmt->fetch()) {




                        echo '<div class="container">';

                        echo '<div class="content-grids">';
                        echo '<div class="col-md-8 content-main">';
                        echo '<div class="content-grid-info">';
                        echo '<img src="' . $row['postPreview'] . '" alt="" style="object-fit: cover; width:669px;height:320px;"/><br/>';
                        echo '<div class="post-info">';
                        echo '<h4><a href="viewpost.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h4>';
                        echo '<h4>Posted on ' . date('jS M Y H:i:s', strtotime($row['postDate'])) . '</h4>';
                        echo '<p>' . $row['postDesc'] . '</p>';
                        echo '<a href="viewpost.php?id=' . $row['postID'] . '"><span></span>Read More</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '</div>';


                    }



                }

			} catch(PDOException $e) {
			    echo $e->getMessage();
			}
		?>

<div id='sidebar'>
    <?php require('sidebar.php'); ?>
</div>
<?php echo $pages->page_links(); ?>
</div>
        </div>

	</div>




<div class="footer">
    <div class="container">
        <p>Blog created by Anuarbek Zhakhangir</a></p>
    </div>
</div>
</body>
</html>
