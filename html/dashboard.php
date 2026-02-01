<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit;
}

class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "my_project";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }
    }

    
    public function getUsers() {
        $sql = "SELECT id, full_name, username, email, role, created_at FROM users ORDER BY id DESC";
        $result = $this->conn->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
     
    public function getNews() {
        $sql = "SELECT id, title, description, category, created_at FROM news ORDER BY id ASC";
        $result = $this->conn->query($sql);
        $news = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $news[] = $row;
            }
        }
        return $news;
    }
}


$db = new Database();
$users = $db->getUsers();
$newsList = $db->getNews();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

<header class="header">
    <div class="logo">Music<span class="accent">Events</span></div>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
             <li><a href="Homepage.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<section class="dashboard">
    <h1 class="dashboard-title">Admin Dashboard</h1>

    <div class="cards">
        <div class="card">
            <h2>Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                    </tr>
                </thead>
               <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td><?php echo $user['created_at']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center;">No users found</td>
                </tr>
            <?php endif; ?>
        </tbody>
            </table>
        </div>

         <div class="card">
            <div class="news-header">
                <h2>News </h2>
                <a href="add_news.php" > Add News</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>   
                        <th>Description</th>   
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($newsList)): ?>
                    <?php foreach ($newsList as $n): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($n['id']); ?></td>
                            <td><?php echo htmlspecialchars($n['title']); ?></td>
                            <td><?php echo htmlspecialchars($n['category']); ?></td>
                            <td><?php echo htmlspecialchars(implode(' ', array_slice(explode(' ', $n['description']), 0, 10)) . (str_word_count($n['description']) > 10 ? '...' : '')); ?></td>
                            <td><?php echo htmlspecialchars($n['created_at'] ?? ''); ?></td>
                            <td class="update-delete">
                                <button type="button" class="edit-btn">
                                <a href="edit_news.php?id=<?php echo (int)$n['id']; ?>" class="btn">Edit</a></button>
                               <form method="post" action="delete_news.php"
      onsubmit="return confirm('Are you sure you want to delete this news item?');"
      style="display:inline;">
    <input type="hidden" name="id" value="<?php echo (int)$n['id']; ?>">
    <button type="submit" class="delete-btn">Delete</button>
</form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No news found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

</body>
</html>
