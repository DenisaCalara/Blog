<?php require('includes/config.php');?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="style/lightbox.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style/slidecss.css">
</head>
<body>

  <div id="wrapper">


    <div id="header">
         <div id="brand">
          <h1><span class="Cristina">Cristina</span> | Blog</h1>
        </div>
        <nav>
          <ul>
            <li ><a href="index.php">Blog</a></li>
            <li class="actual"><a href="project1.php">Projects</a></li>
            <li><a href="sfx.php">SFX</a></li>
            <li><a href="contact.html">Contact</a></li>
          </ul>
        </nav>   
        </div>
    

    <div id='main'>
    
    <h1>Projects</h1>

    <div class="gallery">
      <a href="images/projects/1.jpg" data-lightbox="mygallery"><img src="images/projects/1small.jpg"></a>
      <a href="images/projects/2.jpg" data-lightbox="mygallery"> <img src="images/projects/2small.jpg"></a>
      <a href="images/projects/3.jpg" data-lightbox="mygallery"> <img src="images/projects/3small.jpg"></a>
      <a href="images/projects/4.jpg" data-lightbox="mygallery"> <img src="images/projects/4small.jpg"></a>
      <a href="images/projects/5.jpg" data-lightbox="mygallery"> <img src="images/projects/5small.jpg"></a>
      <a href="images/projects/6.jpg" data-lightbox="mygallery"> <img src="images/projects/6small.jpg"></a>
    
    </div>

      </div>

    <div id='sidebar'>
      <h2>Recent Posts</h2>
<hr/>

<ul>
<?php
$stmt = $db->query('SELECT postTitle, postSlug FROM blog_posts_seo ORDER BY postID DESC LIMIT 5');
while($row = $stmt->fetch()){
  echo '<li><a href="'.$row['postSlug'].'">'.$row['postTitle'].'</a></li>';
}
?>
</ul>

<h2>Catgories</h2>
<hr />

<ul>
<?php
$stmt = $db->query('SELECT catTitle, catSlug FROM blog_cats ORDER BY catID DESC');
while($row = $stmt->fetch()){
  echo '<li><a href="c-'.$row['catSlug'].'">'.$row['catTitle'].'</a></li>';
}
?>
</ul>

<h2>Archives</h2>
<hr />

<ul>
<?php
$stmt = $db->query("SELECT Month(postDate) as Month, Year(postDate) as Year FROM blog_posts_seo GROUP BY Month(postDate), Year(postDate) ORDER BY postDate DESC");
while($row = $stmt->fetch()){
  $monthName = date("F", mktime(0, 0, 0, $row['Month'], 10));
  $slug = 'a-'.$row['Month'].'-'.$row['Year'];
  echo "<li><a href='$slug'>$monthName</a></li>";
}
?>
</ul>

    </div>
  </div>
    <script src="style/lightbox-plus-jquery.min.js"></script>
</body>
</html>