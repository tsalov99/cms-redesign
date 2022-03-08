<?php

require(LAYOUT_PATH . 'top.php');

require_once(MODEL_PATH . 'Post.php');

$test = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));
print_r($test->readAll());
$result = $test->get_result();
print_r($result);