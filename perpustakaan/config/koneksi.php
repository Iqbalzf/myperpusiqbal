<?php
/**
 * File      : koneksi.php
 * Fungsi    : Koneksi database menggunakan OOP (MySQLi)
 * Digunakan : Seluruh modul aplikasi
 */

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "db_perpustakaan_lsp";

    public $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );

        // Cek koneksi
        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }
}
