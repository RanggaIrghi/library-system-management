<?php
    if(!session_id()) session_start();
    
    if(!isset($_SESSION['id_petugas'])) {
        header('Location: http://localhost/library-management-system/public/home/login');
        exit;
    }