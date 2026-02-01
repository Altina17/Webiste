<?php
// admin/add_news.php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../Homepage.php");
    exit;
}

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "my_project";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->dbname
        );

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8mb4");
    }

    public function addNews($title, $description, $category) {
        $stmt = $this->conn->prepare(
            "INSERT INTO news (title, description, category, created_at)
             VALUES (?, ?, ?, NOW())"
        );

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("sss", $title, $description, $category);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}

/* ===========================
   FUNCTIONALITY (MISSING PART)
   =========================== */

$db = new Database();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');

    if ($title === '') {
        $errors[] = "Title is required.";
    }

    if ($description === '') {
        $errors[] = "Description is required.";
    }

    if (empty($errors)) {
        if ($db->addNews($title, $description, $category)) {
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = "Failed to add news.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add News</title>
<link rel="stylesheet" href="../css/dashboard.css">
<link rel="stylesheet" href="../css/add_news.css">
</head>
<body>

<header class="header">
    <div class="logo">Music<span class="accent">Events</span></div>
</header>

<main class="container">
    

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?php echo htmlspecialchars($e); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    

    <form method="post" action="add_news.php" class="addnews">
    <h1>Add News</h1>

        <div>
            <label>Title</label><br>
            <input type="text" name="title"
                   value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" required>
        </div>

        <div>
            <label>Category</label><br>
            <input type="text" name="category"
                   value="<?php echo htmlspecialchars($_POST['category'] ?? ''); ?>">
        </div>

        <div>
            <label>Description</label><br>
            <textarea name="description" rows="6" required><?php
                echo htmlspecialchars($_POST['description'] ?? '');
            ?></textarea>
        </div>

        <div style="margin-top:10px;">
            <button type="submit" class="btn">Create</button>
            <a href="dashboard.php" class="btn">Dashboard</a>
        </div>
    </form>
</main>

</body>
</html>
