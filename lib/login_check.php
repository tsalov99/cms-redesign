<?php

require_once ('config.php');
// very basic log in--- to be made real one
if (isset($_COOKIE['logged-in']) && $_COOKIE['logged-in'] === 'true'){
    if($_COOKIE['logged-in'] === 'true') {
        require_once('bootstrap.php');
    }
} else {
    if (isset($_POST['password'])) {
        if ($_POST['password'] === $adminPassword) {

            // set cookie to check for arleady logged in user, expires when browser is closed
            setcookie('logged-in', 'true');
            require_once('bootstrap.php');
        } else {
                        setcookie('logged-in', 'false');
                        require_once('login.php');
                    }
    } else {
                    require_once('login.php');
    }
}
