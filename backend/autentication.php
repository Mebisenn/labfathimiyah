<?php
session_start();

class Authentication {
    public function logout() {
        // Menghapus semua data sesi
        session_unset();
        // Menghancurkan sesi
        session_destroy();
        
        // Redirect ke halaman login atau halaman lain yang sesuai
        header("Location: ../../index.php");
        exit();
    }
}
?>
