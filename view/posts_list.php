<?php
require(LAYOUT_PATH . 'top.php');

require(LAYOUT_PATH . 'navigation.php');

echo "<table class='table table-striped table-bordered text-center'><thead class='thead-dark'><tr><th>Title</th><th>Created</th><th>Active</th></tr></thead>";

if ($allPosts->num_rows > 0) {

    
    while ($post = mysqli_fetch_assoc($allPosts)) {
    
        $post['active'] === '1' ? $active = 'Yes' : $active = 'No';
    
        echo "
        <tr class='text-dark h5'>
            <td class='p-0'>
                <a class='text-dark' style='text-decoration:none; display:blocked;'href=".URL_BASE."admin/posts/view/$post[id]>
                    <p class='m-0'>$post[title]</p>
                </a>
            </td>";
        echo "<td>$post[created]</td>";
        echo "<td>$active</td></tr>";
    }
} else {
    echo '<h1>No posts added!</h1>';
}

require(LAYOUT_PATH . 'bottom.php');