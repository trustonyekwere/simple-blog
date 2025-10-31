<?php 

    // connect to database
    $connect = mysqli_connect('localhost', 'trust', 'teelocalhost1', 'blog_db');

    // check to ensure connection
    if (!$connect) {
        echo 'connection error: ' . mysqli_connect_error();
    }

    // write query for all posts
    $sql = 'SELECT * email, title, content FROM posts';

    // make query and get result
    $result = mysqli_query($connect, $sql);

    // fetch the resulting rows as an array
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($connect);

    print_r($posts);

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <main class="container my-5">
        <h1 class="mb-4">Welcome to Simple Blog</h1>
        <p class="lead">Your go-to platform for sharing thoughts and ideas.</p>
        <a href="/simple-blog/add.php" class="btn btn-primary mt-3">Create New Post</a>
    </main>

    <?php include('templates/footer.php'); ?>

</html>