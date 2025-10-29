<?php
// simple-blog/create.php
require __DIR__ . '/src/db.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim((string)($_POST['title'] ?? ''));
    $content = trim((string)($_POST['content'] ?? ''));

    if ($title === '' || $content === '') {
        $message = 'Title and content are required.';
    } else {
        // simple slug: lowercase, replace non-alnum with -, trim edges
        $slug = preg_replace('/[^a-z0-9\-]+/i', '-', strtolower($title));
        $slug = trim($slug, '-');

        // ensure unique slug by appending id if exists
        $baseSlug = $slug;
        $i = 1;
        while (true) {
            $check = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE slug = ?");
            $check->execute([$slug]);
            if ($check->fetchColumn() == 0) break;
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $stmt = $pdo->prepare("INSERT INTO posts (title, slug, content) VALUES (?, ?, ?)");
        $stmt->execute([$title, $slug, $content]);
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Create post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <h1>Create a post</h1>
    <p><a href="index.php">← Back</a></p>

    <?php if ($message): ?>
        <p style="color: red;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post" action="create.php">
        <p>
        <label>Title<br>
            <input name="title" style="width: 60%;" required>
        </label>
        </p>
        <p>
        <label>Content (Markdown or plain text)<br>
            <textarea name="content" rows="10" cols="80" required></textarea>
        </label>
        </p>
        <p><button>Save post</button></p>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
