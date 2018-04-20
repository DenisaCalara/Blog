<?php require('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - Archives</title>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>

	<div id="wrapper">

        <div id="header">
         <div id="brand">
          <h1><span class="Cristina">Cristina</span> | Blog</h1>
        </div>
        <nav>
          <ul>
            <li class="actual"><a href="index.php">Blog</a></li>
            <li><a href="project1.php">Projects</a></li>
            <li><a href="sfx.php">SFX</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </nav>   
        </div>
		


		<div id='main'>

			<?php
				try {

					//collect month and year data
					$month = $_GET['month'];
					$year = $_GET['year'];

					//set from and to dates
					$from = date('Y-m-01 00:00:00', strtotime("$year-$month"));
					$to = date('Y-m-31 23:59:59', strtotime("$year-$month"));


					$pages = new Paginator('3','p');

					$stmt = $db->prepare('SELECT postID FROM blog_posts_seo WHERE postDate >= :from AND postDate <= :to');
					$stmt->execute(array(
						':from' => $from,
						':to' => $to
				 	));

					//pass number of records to
					$pages->set_total($stmt->rowCount());

					$stmt = $db->prepare('SELECT postID, postTitle, postSlug, postDesc, postDate FROM blog_posts_seo WHERE postDate >= :from AND postDate <= :to ORDER BY postID DESC '.$pages->get_limit());
					$stmt->execute(array(
						':from' => $from,
						':to' => $to
				 	));
					while($row = $stmt->fetch()){

							echo '<h1><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></h1>';
							echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['postDate'])).' in ';

								$stmt2 = $db->prepare('SELECT catTitle, catSlug	FROM blog_cats, blog_post_cats WHERE blog_cats.catID = blog_post_cats.catID AND blog_post_cats.postID = :postID');
								$stmt2->execute(array(':postID' => $row['postID']));

								$catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

								$links = array();
								foreach ($catRow as $cat)
								{
								    $links[] = "<a href='c-".$cat['catSlug']."'>".$cat['catTitle']."</a>";
								}
								echo implode(", ", $links);

							echo '</p>';
							echo '<p>'.$row['postDesc'].'</p>';				
							echo '<p><a href="'.$row['postSlug'].'">Read More</a></p>';
					}

					echo $pages->page_links("a-$month-$year&");

				} catch(PDOException $e) {
				    echo $e->getMessage();
				}
			?>
          		<h4><a href="./">Back</a></h4>
		</div>

		<div id='sidebar'>
			<?php require('sidebar.php'); ?>
		</div>

		<div id='clear'></div>

	</div>


</body>
</html>