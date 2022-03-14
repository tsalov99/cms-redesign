<?php

require(LAYOUT_PATH . 'top.php');

require(MODEL_PATH . 'Post.php');

$post = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));  // To change this connection, its only for testing
$post = $post->readRowById($params[0]);

while($row = $post->fetch_assoc()) {
    print_r($row);
}


    echo "<div class='text-left p-5 h6'>";
    echo "<p class='h3'>Title:</p>";
    echo "<p>$params[title]</p>";

    echo "<p class='h3'>Short description:</p>";
    echo "<p>$params[short_description]</p>";

    echo "<p class='h3'>Content:</p>";
    echo "<p>$params[content]</p>";

    echo "<p class='h3'>Slug:</p>";
    echo "<p>$params[slug]</p>";
    
    echo "<p class='h3'>Created at: $singlePost[created]</p>";
    
    echo "<p class='h3'>Last change: $singlePost[modified]</p>";

    echo "<p class='h3'>Active: $active</p>";

    echo "<a href=edit?$slug><p>Edit post</p></a>";
    echo "<a href=delete-article?$slug><p>Delete post</p></a>";
    echo "</div>";