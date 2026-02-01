<?php
// admin/edit_news.php
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

    /* ===========================
       GET SINGLE NEWS
       =========================== */
    public function getNewsById($id) {
        $stmt = $this->conn->prepare(
            "SELECT id, title, description, category FROM news WHERE id = ?"
        );

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $news = $result->fetch_assoc();
        $stmt->close();

        return $news;
    }

    /* ===========================
       UPDATE NEWS
       =========================== */
    public function updateNews($id, $title, $description, $category) {
        $stmt = $this->conn->prepare(
            "UPDATE news
             SET title = ?, description = ?, category = ?
             WHERE id = ?"
        );

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("sssi", $title, $description, $category, $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}

/* ===========================
   LOGIC
   =========================== */

$db = new Database();
$errors = [];

// GET ID FROM URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: dashboard.php");
    exit;
}

// FETCH CURRENT NEWS
$news = $db->getNewsById($id);

if (!$news) {
    header("Location: dashboard.php");
    exit;
}

// HANDLE FORM SUBMIT
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
        if ($db->updateNews($id, $title, $description, $category)) {
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = "Failed to update news.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit News</title>
<link rel="stylesheet" href="../css/dashboard.css">
<link rel="stylesheet" href="../css/edit_news.css">
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

    <form method="post" class="editnews" action="edit_news.php?id=<?php echo (int)$id; ?>">
         <h1>Edit News</h1>
        <div>
            <label>Title</label><br>
            <input type="text" name="title"
                   value="<?php echo htmlspecialchars($_POST['title'] ?? $news['title']); ?>"
                   required>
        </div>

        <div>
            <label>Category</label><br>
            <input type="text" name="category"
                   value="<?php echo htmlspecialchars($_POST['category'] ?? $news['category']); ?>">
        </div>

        <div>
            <label>Description</label><br>
            <textarea name="description" rows="6" required><?php
                echo htmlspecialchars($_POST['description'] ?? $news['description']);
            ?></textarea>
        </div>

        <div style="margin-top:10px;">
            <button type="submit" class="btn">Save Changes</button>
            <a href="dashboard.php" class="btn">Dashboard</a>
        </div>
    </form>
</main>

</body>
</html>
