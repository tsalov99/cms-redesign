<?php
echo "<div class=container><ul class='pagination mx-auto'>";
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<li class='page-item'><a class=page-link href=/admin/posts/view/all/$i>$i</li>";
}
echo "</ul></div>";