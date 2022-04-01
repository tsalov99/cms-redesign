<?php
require_once(LAYOUT_PATH . 'public/header.php');


echo "<div class=container 'w-80'>";
echo "<h1 class=display-3>$post[title]</h1>";

echo "<p class=lead>$post[content]</p>";
echo "<div class=container-fluid>
<div class='row py-5'>
<div class=row>";

while ($image = mysqli_fetch_assoc($postImages)) {
    $imagePath = '/' . $image['path'];
    echo "<div class='col-4  py-3'>
    <picture>
    <source srcset=$imagePath>
    <img class='img-thumbnail' width=600px src=$imagePath alt=First slide>
    </picture>
  </div>";
}

echo "</div>
</div>
</div>";

require_once(LAYOUT_PATH . 'public/comment_form.php');

echo "<div class>
<p class='h2 pt-5'>Comments:</p><hr class=pd-3>";
while ($comment = mysqli_fetch_assoc($comments)) {
  echo "<h3>$comment[reviewer_name]</h3> <p><em>$comment[content]</em></p><hr>";
}
echo "</div>";
require_once(LAYOUT_PATH . 'public/footer.php');