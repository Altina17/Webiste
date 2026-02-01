<?php
// admin/delete_news.php
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
       DELETE NEWS METHOD
       =========================== */
    public function deleteNews($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM news WHERE id = ?"
        );

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}

/* ===========================
   FUNCTIONALITY
   =========================== */

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if ($id > 0) {
        $db->deleteNews($id);
    }
}

header("Location: dashboard.php");
exit;
