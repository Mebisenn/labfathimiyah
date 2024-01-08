<?php

    include "../../../config/db.php";

    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>> GET LIST DATA TMU <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	$QueryGetListUser = mysqli_query($db_connect, "SELECT * FROM tbl_users");
    
    if(isset($_POST['save'])){

        $NAME = mysqli_real_escape_string($db_connect, $_POST['nama']);
        $EMAIL = mysqli_real_escape_string($db_connect, $_POST['email']);
        $ROLE = mysqli_real_escape_string($db_connect, $_POST['role']);
        $JABATAN = mysqli_real_escape_string($db_connect, $_POST['jabatan']);
        $NOHP = mysqli_real_escape_string($db_connect, $_POST['no_hp']);
        $ALAMAT = mysqli_real_escape_string($db_connect, $_POST['alamat']);
        $PASSWORD = password_hash(mysqli_real_escape_string($db_connect, $_POST['password']),PASSWORD_DEFAULT);

        $QueryAddUser = "INSERT INTO tbl_users (nama, role, email, password, jabatan, no_hp, alamat) VALUES ('$NAME', '$ROLE', '$EMAIL', '$PASSWORD', '$JABATAN', '$NOHP', '$ALAMAT')";


        $ResultQueryAddUser = mysqli_query($db_connect, $QueryAddUser);
        header("Location: datauser.php?success=true");
        exit();
    }

?>