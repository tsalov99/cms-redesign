<?php
require_once(LAYOUT_PATH . 'public/header.php');


echo "<div class=container w-80>";
echo "<h1 class=display-3>$post[title]</h1>";

echo "<p class=lead>$post[content]</p>";
echo "<div class=container-fluid>
<div class=row>
<div class=row>";

while ($image = mysqli_fetch_assoc($postImages)) {
    $imagePath = 'http://' . $_SERVER['HTTP_HOST'] . URL_BASE . 'public/' . $image['path'];
    echo "<div class=col-3>
    <picture>
    <source srcset=$imagePath>
    <img class=img-thumbnail width=300px src=$imagePath alt=First slide>
    </picture>
  </div>";
}

echo "</div>
</div>
</div>";

require_once(LAYOUT_PATH . 'public/comment_form.php');
require_once(LAYOUT_PATH . 'public/footer.php');

   /* <div class="carousel-item active">
      <img class="d-block w-100" src="..." alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> */