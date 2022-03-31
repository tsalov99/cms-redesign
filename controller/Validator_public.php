<?php

class Validator
{
    public static $errors = [];

    public static function check($params) {

        if (!empty($_POST)) {

            $_POST['name'] = htmlspecialchars($_POST['name']);
            $title = $_POST['name'];
            if(strlen($title) === 0) {static::$errors['name'] = 'This field cannot be empty!';}
            else if (strlen($title) > 50) {static::$errors['name'] = 'This field must be under 50 characters!';}
            
            $_POST['content'] = htmlspecialchars($_POST['content']);
            $content = $_POST['content'];
            if(strlen($content) === 0) {static::$errors['content'] = 'The field cannot be empty!';}
            else if(strlen($content) > 1000) {static::$errors['content'] = 'The field must be under 1000 characters!';}
        } else {
            static::$errors['name'] = 'This field cannot be empty!';
            static::$errors['content'] = 'The field cannot be empty!';
        } 

        return static::$errors;

}

    public static function slugDuplicateCheck($slug) {
        require_once(MODEL_PATH . 'Post.php ');
        $postSlugCheck = new Post;
        $postSlugCheck = $postSlugCheck->checkSlug($slug);
        $postSlugCheck = $postSlugCheck->fetch_row();
        return $postSlugCheck;
    }
}   
