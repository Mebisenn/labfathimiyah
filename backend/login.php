<?php
session_start();
require './../config/db.php';

class Authentication {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function authenticate($email, $password) {
        $user = mysqli_query($this->db, "SELECT * FROM tbl_users WHERE email = '$email'");

        if(mysqli_num_rows($user) > 0) {
            $data = mysqli_fetch_assoc($user);

            if(password_verify($password, $data['password'])) {
                $this->authorizeUser($data);
            } else {
                header('Location:../login.php?error=1');
                die;
            }
        } else {
            header('Location:../login.php?error=invalid_credentials');
            die;
        }
    }

    private function authorizeUser($userData) {
        $_SESSION['nama'] = $userData['nama'];
        $_SESSION['role'] = $userData['role'];
        $_SESSION['jabatan'] = $userData['jabatan'];
        $_SESSION['no_hp'] = $userData['no_hp'];
        $_SESSION['alamat'] = $userData['alamat'];
        $_SESSION['email'] = $userData['email'];

        $redirectPath = ($_SESSION['role'] == 'admin') ? '../pages/content/profile/profile.php' : '../pages/content/profile/profile.php';

        header("Location: $redirectPath");
        exit();
    }
}

// Penggunaan
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $authenticator = new Authentication($db_connect);
    $authenticator->authenticate($email, $password);
}
?>
