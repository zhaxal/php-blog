<?php require('includes/config.php'); 

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();


if($row['postID'] == ''){
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
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
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle'];?></title>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="logo">
            <a href="index.php"><img src="images/logo.jpg" title="" /></a>
        </div>
        <!---start-top-nav---->
        <div class="top-menu">
            <div class="search">
                <form>
                    <input type="text" placeholder="" required="">
                    <input type="submit" value=""/>
                </form>
            </div>
            <span class="menu"> </span>
            <ul>
                <li class="active"><a href="index.php">HOME</a></li>
                <li><a href="admin/login.php">LOGIN</a></li>
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
        <!---//End-top-nav---->
    </div>
</div>

	<div id="wrapper">

        <?php




        if(isset($_POST['submit'])){

            $_POST = array_map( 'stripslashes', $_POST );


            extract($_POST);

            if(!isset($error)){

                try {


                    $stmt = $db->prepare('INSERT INTO blog_posts (commName,commCont,commDate) VALUES (:commName, :commCont, :commDate)') ;
                    $stmt->execute(array(
                        ':commName' => $commName,
                        ':commCont' => $commCont,
                        ':commDate' => date('Y-m-d H:i:s')
                    ));

                    exit;

                } catch(PDOException $e) {
                    echo $e->getMessage();
                }

            }

        }


        if(isset($error)){
            foreach($error as $error){
                echo '<p class="error">'.$error.'</p>';
            }
        }
        ?>


		<?php	
			echo '<div class="single">';
            echo '<div class="container">';
            echo '<div class="col-md-8 single-main">';
            echo '<div class="single-grid">';
				echo '<h1>'.$row['postTitle'].'</h1>';
				echo '<p>Posted on '.date('jS M Y', strtotime($row['postDate'])).'</p>';
				echo '<p>'.$row['postCont'].'</p>';

        ?>
            <div class="content-form">
                <h3>Leave a comment</h3>
                <form action='' method='post'>
                    <input type="text" name='commName' placeholder="Name" required/>
                    <textarea name='commCont' placeholder="Message"></textarea>
                    <input type='submit' name='submit' value='Submit'/>
                </form>
            </div>
			</div>
            </div>
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