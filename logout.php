<?php

if (isset($_GET['logout'])) {
    if (isset($_SESSION['admin_logged_in'])) {
        unset($_SESSION['admin_logged_in']);
        session_destroy();
        
        exit;
    }
}
?> 