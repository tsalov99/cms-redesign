<?php

class Validator
{
    public static $errors = [];

    public static function check($params) {

        if (!empty($_POST)) {

            $_POST['title'] = htmlspecialchars($_POST['title']);
            $title = $_POST['title'];
            if(strlen($title) === 0) {static::$errors['title'] = 'This field cannot be empty!';}
            else if (strlen($title) > 80) {static::$errors['title'] = 'This field must be under 80 characters!';}
            
            $_POST['content'] = htmlspecialchars($_POST['content']);
            $content = $_POST['content'];
            if(strlen($content) === 0) {static::$errors['content'] = 'The field cannot be empty!';}
            
            $_POST['short_description'] = htmlspecialchars($_POST['short_description']);
            $short_description = $_POST['short_description'];
            if(strlen($short_description) === 0) {static::$errors['short_description'] = 'The field cannot be empty!';}
            else if (strlen($short_description) > 150) {static::$errors['short_description'] = 'This field must be under 150 characters!';}
            
            $_POST['slug'] = htmlspecialchars($_POST['slug']);
            $slug = $_POST['slug'];
            if (strlen($slug) === 0) { $_POST['slug'] = $title; $slug = $title;}

            if(strlen($slug) === 0) { static::$errors['slug'] = 'The field cannot be empty!';}
            else if (strlen($slug) > 80) { static::$errors['slug'] = 'This field must be under 80 characters!';}
            if(empty(static::$errors)) {

                    // if post is edited the ID should be passed;
                    (isset($params[0])) ? $id = $params[0] : $id = null; 

                    // returns array with post info if its matching or null
                    $checkSlugId = self::slugDuplicateCheck($slug);

                if ($checkSlugId !== null) {
                    if ($checkSlugId[0] === $id ) { // if id is passed through the url it will return edit, page
                        static::$errors['slug'] = 'update';  // set a flag for controller to know if its edit request// ad-hoc(should change it)
                    } else if($checkSlugId[0] !== $id) {
                        static::$errors['slug'] = 'This slug arleady exists!';
                    }
                }
                      
            $_POST['created'] = static::convertDateCreated($_POST['created']);
            $_POST['active'] = (int)($_POST['active']);
    
            
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
        $postSlugCheck = new Post;
        $postSlugCheck = $postSlugCheck->checkSlug($slug);
        $postSlugCheck = $postSlugCheck->fetch_row();
        return $postSlugCheck;
    }

    public static function convertDateCreated($createdDate) {

        //In this case the information comes from the user input
        if (strpos($createdDate, 'T')) {
            $createdDate = str_replace('T', ' ', $createdDate);
            $timestamp = strtotime($createdDate);
            $convertedDate = date('Y-m-d H:i', $timestamp);
            return $convertedDate;
        }


        // In this case the information comes from the database
        $timestamp = strtotime($createdDate);
        $convertedDate = date('Y-m-d\TH:i', $timestamp);
        return $convertedDate;
        


    }
}   
