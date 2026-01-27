<?php
include "load_header.php";
include 'backend_call.php';

// 1. Get tables
$tablesResponse = callBackend([
    "Action" => "list_tables"
]);

$tables = $tablesResponse["Tables"] ?? [];

// 2. Get rows if table selected
$rows = [];
$columns = [];

if (isset($_GET["table"])) {
    $table = $_GET["table"];

    $rowsResponse = callBackend([
        "Action" => "select_all",
        "table" => $table
    ]);

    $rows = $rowsResponse["Rows"] ?? [];

    if (!empty($rows)) {
        $columns = array_keys($rows[0]);
    }
}
?>

<main>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h3>Tables</h3>
            <?php foreach ($tables as $t): ?>
                <a href="?table=<?= htmlspecialchars($t) ?>" class="sidebar-btn <?= (isset($table) && $table === $t) ? 'active' : '' ?>">
                    <?= htmlspecialchars($t) ?>
                </a>
            <?php endforeach; ?>
        </aside>

        <section class="main-content">
            <h1>Admin Panel</h1>

            <?php if (!empty($rows)): ?>
                <h2>Table: <?= htmlspecialchars($table) ?></h2>
                <div class="content-block">
                    <table>
                        <thead>
                            <tr>
                                <?php foreach ($columns as $col): ?>
                                    <th><?= htmlspecialchars($col) ?></th>
                                <?php endforeach; ?>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row): ?>
                            <tr>
                                <?php foreach ($columns as $col): ?>
                                    <td><?= htmlspecialchars($row[$col]) ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <form method="post" action="edit_row.php" class="action-form">
                                        <input type="hidden" name="table" value="<?= $table ?>">
                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                        <button type="submit" class="auth-btn table-btn">Edit</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>Select a table from the sidebar to view its content.</p>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
