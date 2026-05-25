<?php
// 1. Database Configuration
$host    = '127.0.0.1';
$db      = 'zeron';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // 2. Initialize PDO Connection
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected to the database successfully... 🌱\n";

    // 3. Define the Admin Data
    $adminEmail = 'admin@example.com';
    $rawPassword = 'SuperSecureAdminPassword123!'; // Change this!
    $role = 'admin';

    // 4. Securely Hash the Password
    // PASSWORD_DEFAULT uses the strongest current industry standard (currently bcrypt or Argon2id)
    $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

    // 5. Check if the Admin already exists to prevent duplicate errors
    $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $checkStmt->execute([$adminEmail]);
    
    if ($checkStmt->fetch()) {
        echo "Seed skipped: An admin user with the email '$adminEmail' already exists.\n";
        exit;
    }

    // 6. Prepare and Execute the Insert Statement
    $sql = "INSERT INTO users (email, password, role) VALUES (:email, :password, :role)";
    $insertStmt = $pdo->prepare($sql);
    
    $insertStmt->execute([
        ':email'    => $adminEmail,
        ':password' => $hashedPassword,
        ':role'     => $role
    ]);

    echo "Database seeded successfully! Admin user created.\n";

} catch (\PDOException $e) {
    // Handle any connection or query errors safely
    echo "Database Seeding Failed: " . $e->getMessage() . "\n";
}