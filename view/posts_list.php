<?php

require(LAYOUT_PATH . 'top.php');

require_once(MODEL_PATH . 'Post.php');

$allPosts = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));
$allPosts = $allPosts->readAll();
while ($post = mysqli_fetch_assoc($allPosts)) {
    $post['active'] === '1' ? $active = 'Yes' : $active = 'No';
    echo "<tr class='text-dark h5'><td class='p-0'><a class='text-dark' style='text-decoration:none; display:blocked;' href='article?$post[slug]'><p class='m-0'>$post[title]</p></a></td>";
        echo "<td>$post[created]</td>";
        echo "<td>$active</td></tr>";
}

//$test = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));
//$result = $test->readAll();
//
//while ($row = mysqli_fetch_assoc($result)) {
//    $row['active'] === '1' ? $active = 'Yes' : $active = 'No';
//    echo "<tr class='text-dark h5'><td class='p-0'><a class='text-dark' style='text-decoration:none; display:blocked;' href='article?$row[slug]'><p class='m-0'>$row[title]</p></a></td>";
//        echo "<td>$row[created]</td>";
//        echo "<td>$active</td></tr>";
//}