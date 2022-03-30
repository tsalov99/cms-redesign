<?php require(LAYOUT_PATH . 'public/header.php');




if ($allPosts->num_rows > 0) {
  while ($post = mysqli_fetch_assoc($allPosts)) {
    echo "<div class=container mx-auto>
    <div class=row mb-2>
        <div class=col-md-12>
          <div class=row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative>
            <div class=col p-4 d-flex flex-column position-static>
              <h3 class=mb-0>$post[title]</h3>
              <div class=mb-1 text-muted>$post[created]</div>
              <p class=card-text mb-auto>$post[short_description]</p>
              <a href=posts/view/public/$post[id] class=stretched-link>Continue reading</a>
            </div>
            <div class=col-auto d-none d-lg-block>
            <img style=width:200px;height:150px src=public/favicon.ico alt=... class=img-fluid>
            </div>
          </div>
        </div>
      </div>
      </div>";
  }
}

require(LAYOUT_PATH . 'public/footer.php');