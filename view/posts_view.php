<?php

require(LAYOUT_PATH . 'top.php');

require(LAYOUT_PATH . 'navigation.php');


    $post['active'] === 1 ? $active = 'Yes' : $active = 'No';
    echo "<div class='text-left p-5 h6'>";
    echo "<p class='h3'>Title:</p>";
    echo "<p>$post[title]</p>";

    echo "<p class='h3'>Short description:</p>";
    echo "<p>$post[short_description]</p>";

    echo "<p class='h3'>Content:</p>";
    echo "<p>$post[content]</p>";

    echo "<p class='h3'>Slug:</p>";
    echo "<p>$post[slug]</p>";
    
    echo "<p class='h3'>Created at: $post[created]</p>";
    
    echo "<p class='h3'>Last change: $post[modified]</p>";

    echo "<p class='h3'>Active: $active</p>";

    echo "<a href=" . URL_BASE . "posts/edit/$post[id]><p>Edit post</p></a>";
    echo "<a href=" . URL_BASE . "posts/delete/$post[id]><p>Delete post</p></a>";
    echo "</div>";

    require(LAYOUT_PATH . 'bottom.php');