<h1>Recent Posts</h1>
<hr />

<ul style="right: 20px">
<?php
$stmt = $db->query('SELECT postTitle, postSlug,postID FROM blog_posts ORDER BY postID DESC LIMIT 5');
while($row = $stmt->fetch()){
	echo '<li><a href="viewpost.php?id=' . $row['postID'] . '">'.$row['postTitle'].'</a></li>';
}
?>
</ul>

<h1>Categories</h1>
<hr />

<ul>
<?php
$stmt = $db->query('SELECT catTitle, catSlug FROM blog_cats ORDER BY catID DESC');
while($row = $stmt->fetch()){
	echo '<li><a href="c-'.$row['catSlug'].'">'.$row['catTitle'].'</a></li>';
}
?>
</ul>

<h1>Archives</h1>
<hr />

<ul>
<?php
$stmt = $db->query("SELECT Month(postDate) as Month, Year(postDate) as Year FROM blog_posts GROUP BY Month(postDate), Year(postDate) ORDER BY postDate DESC");
while($row = $stmt->fetch()){
	$monthName = date("F", mktime(0, 0, 0, $row['Month'], 10));
	$slug = 'a-'.$row['Month'].'-'.$row['Year'];
	echo "<li><a href='$slug'>$monthName</a></li>";
}
?>
</ul>