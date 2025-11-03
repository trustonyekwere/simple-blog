<?php 

    include ('config/db_connect.php');

    if (isset($_POST['delete'])) {

        $id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']);
        $sql = "DELETE FROM posts WHERE id = $id_to_delete";

        if (mysqli_query($connect, $sql)) {
            // success
            header('Location: index.php');
        } {
            // failure
            echo 'query error: ' . mysqli_error($connect);
        }
    }

    // check GET request id parameter
    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($connect, $_GET['id']); // ensure no injection of malicious script from the unique id

        // make sql
        $sql = "SELECT * FROM posts WHERE id = $id";

        // get the query result
        $result = mysqli_query($connect, $sql);

        // fetch the result in array format
        $post = mysqli_fetch_assoc($result);

        // free result memory
        mysqli_free_result($result);
        
        // close connection
        mysqli_close($connect);

        // print_r ($post);
    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <main class="container my-5 pb-5">
        <?php if($post): ?>
            <h1 class="mb-4">Post Details</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Author Email: <?php echo htmlspecialchars($post['email']); ?></h6>
                    <p class="card-text"><?php echo htmlspecialchars($post['content']); ?></p>
                    <p>Date created: <?php echo date($post['created_at']); ?></p>
                    <div class="d-flex gap-3">
                        <a href="index.php" class="btn btn-primary">Back to Home</a>
                        
                        <!-- delete form -->
                        <form action="details.php" method="POST">
                            <input type="hidden" name="id_to_delete" value="<?php echo $post['id']; ?>">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger shadow-none">
                        </form>
                    </div>

                </div>
            </div>
        <?php else: ?>

            <h1 class="mb-4">Error 404: Post Not Found</h1>
            <p>The post you are looking for does not exist.</p>
            <a href="index.php" class="btn btn-primary">Back to Home</a>

        <?php endif; ?>
    </main>

    <?php include('templates/footer.php'); ?>

</html>