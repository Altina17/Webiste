<?php
require_once 'db.php';

$result = mysqli_query($conn, "
    SELECT * FROM news 
    ORDER BY created_at DESC
");

$news_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $news_items[] = $row;
}
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - News List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> body { padding: 2rem; } </style>
</head>
<body class="container">

<h1>News Admin Panel</h1>

<a href="new.php" class="btn btn-primary mb-3">+ Add New Article</a>

<?php if (empty($news_items)): ?>
    <div class="alert alert-info">No articles yet.</div>
<?php else: ?>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($news_items as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= htmlspecialchars($item['title']) ?></td>
                <td><?= htmlspecialchars($item['category']) ?></td>
                <td><?= date('Y-m-d H:i', strtotime($item['created_at'])) ?></td>
                <td>
                    <a href="edit.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete.php?id=<?= $item['id'] ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="../news.php" target="_blank" class="btn btn-outline-info mt-3">View Public News Page</a>

</body>
</html>

<?php mysqli_close($conn); ?>