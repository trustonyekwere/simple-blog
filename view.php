<?php
// simple-blog/view.php
require __DIR__ . '/src/db.php';

$slug = (string)($_GET['slug'] ?? '');
if ($slug === '') {
    echo "No post specified.";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = ? LIMIT 1");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    echo "Post not found.";
    exit;
}

// Very simple rendering: convert new lines to <br>. No HTML allowed from user.
$contentHtml = nl2br(htmlspecialchars($post['content']));
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <p><a href="index.php">← Home</a></p>
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <small><?= htmlspecialchars($post['created_at']) ?></small>
    <div style="margin-top: 1em;">
        <?= $contentHtml ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
