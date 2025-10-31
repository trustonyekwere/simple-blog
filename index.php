<?php 

    include ('config/db_connect.php');

    // write query for all posts
    $sql = 'SELECT title, content, id FROM posts';

    // make query and get result
    $result = mysqli_query($connect, $sql);

    // fetch the resulting rows as an array
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($connect);

    // print_r($posts);

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <main class="container my-5">
        <h1 class="mb-4">Welcome to Simple Blog</h1>
        <p class="lead">Your go-to platform for sharing thoughts and ideas.</p>
        <a href="/simple-blog/add.php" class="btn btn-secondary mt-3">Create New Post</a><br><br>
        <div class="container">
            <div class="row">

                <?php foreach ($posts as $post) : ?> <!-- replace } with : and then the closing one with endforeach; -->  
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-none">
                            <div class="card-body text-center">
                                <h6><?php echo htmlspecialchars($post['title']); ?></h6>
                                <div><?php echo htmlspecialchars($post['content']); ?></div><hr>
                                <a href="details.php?id=<?php echo $post['id'] ?>" class="btn btn-primary">more info</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </main>

    <?php include('templates/footer.php'); ?>

</html>