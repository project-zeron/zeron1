<?php
// admin_dashboard/api/controllers/PackageController.php

require_once '../../config/db.php';

function getPackages($conn) {
    // Querying your exact columns: bundle_name, bundle_description, bundle_price
    $sql = "SELECT bundle_name, bundle_description, bundle_price FROM bundles";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    return false;
}

?>
