<?php
    if(!session_id()) session_start();
    
    if(!isset($_SESSION['id_petugas'])) {
        header('Location: ' .BASE_URL . '/home/login');
        exit;
    }