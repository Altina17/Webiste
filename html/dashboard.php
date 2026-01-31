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

    // Fetch all users excluding password
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
}

// Create database object and fetch users
$db = new Database();
$users = $db->getUsers();
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
            <h2>News</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>New Music Event This Weekend</td>
                        <td>2026-02-01</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Concert Tickets Released</td>
                        <td>2026-02-01</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

</body>
</html>
