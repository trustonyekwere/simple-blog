<?php 

    include ('config/db_connect.php');

    $email = $title = $content = ''; // initialize variables to empty strings to ensure form is static upon entry

    $errors = array('email' => '', 'title' => '', 'content' => '');

    if(isset($_POST['submit'])) {
        // Get form data
        // $email = htmlspecialchars($_POST['email']);
        // $title = htmlspecialchars($_POST['title']);
        // $content = htmlspecialchars($_POST['content']);

        // check email
        if (empty ($_POST['email'])) {
            $errors['email'] = "An email is required <br /> "; // checks if input field is empty
        } else {
            $email = $_POST ['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // validating email format
                $errors['email'] = "Email must be a valid email address <br /> "; 
            }
        }

        // check title
        if (empty ($_POST['title'])) {
            $errors['title'] = "A title is required <br /> ";
        } else {
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $errors['title'] = "Title must be letters and spaces only <br /> ";
            }
            // echo htmlspecialchars($_POST['title']); // htmlspecialchars to prevent XSS (injecting coding virus)
        }

        // check content
        if (empty ($_POST['content'])) {
            $errors['content'] = "Content is required <br /> ";
        } else {
            $content = $_POST['content'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $content)) {
                $errors['content'] = "Content must be letters and spaces only <br /> ";
            }
        } 
        //end of POST check

        // Redirect to the homepage after submission if no errors
        if (array_filter($errors)) {
            //redirect nowhere with errors
            // echo 'There are errors in the form';
        } else {
            //redirect to homepage without errors
            // echo 'form is valid';
            
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $title = mysqli_real_escape_string($connect, $_POST['title']);
            $content = mysqli_real_escape_string($connect, $_POST['content']);

            // create sql
            $sql = "INSERT INTO posts(title, email, content) VALUES('$title', '$email', '$content' )";

            // save to db and check
            if(mysqli_query($connect, $sql)) {
                // success
                header('location: index.php');
            } else {
                // error
                'query error:' . mysqli_error($connect);
            }

        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <main class="container my-5">
        <section class="justify-content-center d-flex">
            <div class="card p-3 border-0 align-content-center align-items-center w-75">
                <h2 class="text-center pt-3">Add a Post</h2>
                <form action="" method="POST" class="bg-white mt-3">
                    <div class="row px-4 g-3">
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Email address</label>
                                <input type="email" value="<?php echo htmlspecialchars($email) ?>" class="form-control" name="email" aria-describedby="emailHelp">
                                <div class="text-danger"><?php echo $errors['email']; ?></div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Post Title</label>
                                <input type="text" value="<?php echo htmlspecialchars($title) ?>" class="form-control" name="title">
                                <div class="text-danger"><?php echo $errors['title']; ?></div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Post Content</label>
                                <input type="text" value="<?php echo htmlspecialchars($content) ?>" class="form-control" name="content">
                                <div class="text-danger"><?php echo $errors['content']; ?></div>
                            </div>
                        </div>
                        <div class="text-center pt-5 ">
                            <button name="submit" value="submit" class="btn btn-primary ">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section> 
    </main>

    <?php include('templates/footer.php'); ?>

</html>