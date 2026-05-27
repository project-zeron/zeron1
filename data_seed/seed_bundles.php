<?php
// 1. Database Connection (Ensure $conn is defined, usually via an include)
require_once '../config/db.php'; // Adjust the path as necessary
// require_once 'db_connection.php'; 

// 2. Define the 5 bundles array
$bundles = [
    [
        'name' => 'Starter Pack',
        'description' => 'Perfect for individuals getting started. Includes basic features and standard support.',
        'price' => 9.99
    ],
    [
        'name' => 'Growth Bundle',
        'description' => 'Designed for growing teams. Includes advanced analytics, priority support, and extra storage.',
        'price' => 29.99
    ],
    [
        'name' => 'Enterprise Solution',
        'description' => 'Full suite for large organizations. Custom integrations, 24/7 dedicated support, and unlimited access.',
        'price' => 99.99
    ],
    [
        'name' => 'Developer Toolkit',
        'description' => 'Specialized bundle for developers. Includes API access, sandbox environments, and webhooks.',
        'price' => 49.99
    ],
    [
        'name' => 'Seasonal Special',
        'description' => 'Limited time offer including a mix of marketing tools and premium templates.',
        'price' => 19.99
    ]
];

// 3. Prepare the SQL Statement
$sql = "INSERT INTO bundles (bundle_name, bundle_description, bundle_price) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $seeded_count = 0;

    // 4. Loop through each bundle and execute
    foreach ($bundles as $bundle) {
        $name = $bundle['name'];
        $description = $bundle['description'];
        $price = $bundle['price'];

        // 'ssd' stands for: string (name), string (description), double/decimal (price)
        mysqli_stmt_bind_param($stmt, "ssd", $name, $description, $price);
        
        if (mysqli_stmt_execute($stmt)) {
            $seeded_count++;
        }
    }

    // 5. Redirect or output message based on success
    if ($seeded_count === count($bundles)) {
        header("Location: ../Dashboard?message=bundles_seeded_successfully");
        exit();
    } else {
        header("Location: signup.php?message=bundles_seeding_failed");
        exit();
    }

} else {
    // If the statement failed to prepare
    header("Location: signup.php?message=statement_preparation_failed");
    exit();
}