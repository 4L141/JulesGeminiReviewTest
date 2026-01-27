<?php
include "load_header.php";
include 'backend_call.php';

$table = $_GET['table'] ?? null;
if (!$table) die("No table selected");

$response = callBackend([
    "Action" => "select_all",
    "table" => $table
]);

$rows = $response['Rows'] ?? [];
$columns = !empty($rows) ? array_keys($rows[0]) : [];

?>
<main>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <a href="Admin.php" class="sidebar-btn">Back to Tables</a>
        </aside>

        <section class="main-content">
            <h1>Table: <?= htmlspecialchars($table) ?></h1>

            <div class="content-block">
                <?php if (!empty($rows)): ?>
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
                            <?php $pkCol = array_keys($row)[0]; ?>
                            <tr>
                                <?php foreach ($columns as $col): ?>
                                    <td><?= htmlspecialchars($row[$col]) ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <form method="post" action="edit_row.php" class="action-form">
                                        <input type="hidden" name="table" value="<?= $table ?>">
                                        <input type="hidden" name="primary_key" value="<?= $pkCol ?>">
                                        <input type="hidden" name="primary_value" value="<?= $row[$pkCol] ?>">
                                        <button type="submit" class="auth-btn table-btn">Edit</button>
                                    </form>
                                    <form method="post" action="delete_row.php" class="action-form">
                                        <input type="hidden" name="table" value="<?= $table ?>">
                                        <input type="hidden" name="primary_key" value="<?= $pkCol ?>">
                                        <input type="hidden" name="primary_value" value="<?= $row[$pkCol] ?>">
                                        <button type="submit" class="auth-btn table-btn" style="background-color: #d32f2f;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p>No rows found in this table.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
