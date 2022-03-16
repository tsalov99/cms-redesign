<?php

class Validator
{
    public static $errors = [];

    public static function check() {

        if (!empty($_POST)) {

            $title = htmlspecialchars($_POST['title']);
            if(strlen($title) === 0) {static::$errors['title'] = 'This field cannot be empty!';}
            else if (strlen($title) > 80) {static::$errors['title'] = 'This field must be under 80 characters!';}
    
            $content = htmlspecialchars($_POST['content']);
            if(strlen($content) === 0) {static::$errors['content'] = 'The field cannot be empty!';}
            
            
            $short_description = htmlspecialchars($_POST['short_description']);
            if(strlen($short_description) === 0) {static::$errors['short_description'] = 'The field cannot be empty!';}
            else if (strlen($short_description) > 150) {static::$errors['short_description'] = 'This field must be under 150 characters!';}
            
            
            $slug = htmlspecialchars($_POST['slug']);
            if (strlen($slug) === 0) { $_POST['slug'] = $title; $slug = $title;}

            if(strlen($slug) === 0) { static::$errors['slug'] = 'The field cannot be empty!';}
            else if (strlen($slug) > 80) { static::$errors['slug'] = 'This field must be under 80 characters!';}
            
            
            //if ($result->num_rows > 0) {
            //    $slugError = 'This slug arleady exists';
            //}
            
            
            $_POST['created'] = date('Y-m-d H:m:s', strtotime($_POST['created']));
            
            $_POST['active'] = (int)($_POST['active']);
    
            if(empty(static::$errors)) {
                if ($check = self::slugDuplicateCheck($slug) === true) {
                    static::$errors['slug'] = 'This slug arleady exists!';
                }
            }
        } else {
            static::$errors['title'] = 'This field cannot be empty!';
            static::$errors['content'] = 'The field cannot be empty!';
            static::$errors['short_description'] = 'The field cannot be empty!';
            static::$errors['slug'] = 'The field cannot be empty!';
        } 

        return static::$errors;

}

    public static function slugDuplicateCheck($slug) {
        require_once(MODEL_PATH . 'Post.php ');
        $postSlugCheck = new Post(new mysqli('localhost', 'root', 'S1L0V', 'blog-cms-project'));
        $postSlugCheck = $postSlugCheck->checkSlug($slug);
        return $postSlugCheck->num_rows === 1 ? true : false;

    }
}