<?php
/*
 * Database connection class
 * - Uses PDO with utf8mb4 charset
 * - For production, consider using environment variables for credentials
 *   instead of hardcoding them in this file. Example with getenv():
 *     private $host = getenv('DB_HOST') ?: 'localhost';
 */
class Database {
    private $host = "localhost";
    private $db_name = "db_perpustakaan_tadikapertiwi";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4", 
                $this->username, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            // In production, avoid echoing raw exception messages (could leak info)
            echo "Koneksi database gagal: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>