<?php  

    // connect to database
    $connect = mysqli_connect('localhost', 'trust', 'teelocalhost1', 'blog_db');

    // check to ensure connection
    if (!$connect) {
        echo 'connection error: ' . mysqli_connect_error();
    }

?>