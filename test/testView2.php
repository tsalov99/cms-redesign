<?php

echo 'Test view 2';
echo "<br>";
    // print the name of the current file

    echo $_SERVER['PHP_SELF'];

    echo "<br>";

    // print the name of the server

    echo $_SERVER['SERVER_NAME'];

    echo "<br>";

    // print the name of the host

    echo $_SERVER['HTTP_HOST'];

    echo "<br>";
    // print the user agent string

    echo $_SERVER['HTTP_USER_AGENT'];

    echo "<br>";

    // print the path of the script

    echo $_SERVER['SCRIPT_NAME'];