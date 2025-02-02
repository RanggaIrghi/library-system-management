<?php
    if(!session_id()) session_start();
    
    if(!isset($_SESSION['id_petugas'])) {
        header("Cache-Control: no-cache, must-revalidate, no-store, max-age=0");
        header('Pragma: no-cache');

        header('Location: http://localhost/library-management-system/public/home/login');
        exit;
    }