<?php

echo "<div id=carouselExampleControls class=carousel slide data-ride=carousel>
<div class=carousel-inner>";

while ($image = mysqli_fetch_assoc($postImages)) {
    $imagePath = URL_BASE . 'public/' . $image['path'];
    echo "<div class=carousel-item active>
    <img class=d-block w-100 src=$imagePath alt=First slide>
  </div>";
}




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