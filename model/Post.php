<?php

require_once('Model.php');

class Post extends Model
{
    public $tableName = 'posts';

    public function getSlug($slug) {
        echo "12";
    }
}