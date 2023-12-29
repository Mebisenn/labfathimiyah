<?php
session_start();

class Logout {
    public function performLogout() {
        // Hapus semua data sesi
        session_unset();
        
        // Hancurkan sesi
        session_destroy();

        // Redirect ke halaman login atau halaman lain yang sesuai
        header("Location: ../../login.php");
        exit();
    }
}

// Penggunaan
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $logoutHandler = new Logout();
    $logoutHandler->performLogout();
}
?>
