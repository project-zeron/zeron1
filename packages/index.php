<?php
// bundles-component.php

// Ensure your database connection is active
require_once __DIR__ . '/config/db.php';

try {
    // Fetch all records from the bundles table
    $stmt = $pdo->query("SELECT bundle_id, bundle_name, bundle_description, bundle_price, created_at FROM bundles");
    $bundles = $stmt->fetchAll();
} catch (\PDOException $e) {
    // Elegant fallback if the database query fails
    $bundles = [];
}

// Start buffering the output so it can be handled easily
ob_start();
?>

<div class="scroll-container">
    <?php if (!empty($bundles)): ?>
        <?php foreach ($bundles as $bundle): ?>
            <div class="bundle-card">
                <h3><?= htmlspecialchars($bundle['bundle_name']) ?></h3>
                <p><?= htmlspecialchars($bundle['bundle_description'] ?? 'No description available.') ?></p>
                <div class="price">$<?= htmlspecialchars(number_format($bundle['bundle_price'], 2)) ?></div>
                <div class="date">Created: <?= htmlspecialchars($bundle['created_at']) ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-data">No bundles available at the moment.</p>
    <?php endif; ?>
</div>

<?php
// Echo out the generated div markup
echo ob_get_clean();
?>