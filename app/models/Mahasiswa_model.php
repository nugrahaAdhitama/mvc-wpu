<?php

class Mahasiswa_model{
    // membuat koneksi PDO
    private $dbh;
    private $stmt;

    // lakukan koneksi ke database dalam method construct
    public function __construct() {
        // data source name
        $dsn = 'mysql:host=localhost;dbname=phpmvc';

        try {
            $this->dbh = new PDO($dsn, 'root', '');
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllMahasiswa() {
        $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}