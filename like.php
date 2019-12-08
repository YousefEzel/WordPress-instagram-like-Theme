<?php

$mysqli = new mysqli("localhost", "root", "", "wp_learn");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT customerid, companyname, contactname, address, city, postalcode, country FROM customers WHERE customerid = ?";

$sql = "SELECT sum(a.likes_count) as likes_sum,a.likes_count, a.likes_post_ID, a.likes_author, b.ID FROM wp_likes a INNER JOIN wp_posts b ON a.likes_post_ID = b.?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result( $likes_sum, $likes_count, $likes_post_ID, $likes_author, $ID );
$stmt->fetch();
$stmt->close();