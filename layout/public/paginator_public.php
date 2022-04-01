<?php
echo "<div class='container pt-3'><ul class=pagination mx-auto>";
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<li class=page-item><a class=page-link href=/posts/view/all/$i>$i</a></li>";
}
echo "</ul></div>";