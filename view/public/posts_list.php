<?php require(LAYOUT_PATH . 'public/header.php');

if ($allPosts->num_rows > 0) {
  echo "<div class=container mx-auto>";
echo "<div class=row>";
  while ($post = mysqli_fetch_assoc($allPosts)) {
    echo "<div class=col-12>
          <div class=row position-relative>
            <div class=col-12 p-4 position-static>
              <h3 class=mb-0>$post[title]</h3>
              <div class=mb-1 text-muted>$post[created]</div>
              <p class=card-text mb-auto>$post[short_description]</p>
              <a href=/posts/view/$post[slug] class=stretched-link>Continue reading</a>
            </div>
          </div>
        </div>";
  }
 echo "</div></div>";
}

require(LAYOUT_PATH . 'public/footer.php');