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
<h2>Table: <?= htmlspecialchars($table) ?></h2>

<?php if (!empty($rows)): ?>
<table border="1" cellpadding="5">
    <tr>
        <?php foreach ($columns as $col): ?>
            <th><?= htmlspecialchars($col) ?></th>
        <?php endforeach; ?>
        <th>Actions</th>
    </tr>

    <?php foreach ($rows as $row): ?>
        <?php $pkCol = array_keys($row)[0]; ?>
        <tr>
            <?php foreach ($columns as $col): ?>
                <td><?= htmlspecialchars($row[$col]) ?></td>
            <?php endforeach; ?>
            <td>
                <form method="post" action="edit_row.php" style="display:inline;">
                    <input type="hidden" name="table" value="<?= $table ?>">
                    <input type="hidden" name="primary_key" value="<?= $pkCol ?>">
                    <input type="hidden" name="primary_value" value="<?= $row[$pkCol] ?>">
                    <button type="submit">Edit</button>
                </form>
                <form method="post" action="delete_row.php" style="display:inline;">
                    <input type="hidden" name="table" value="<?= $table ?>">
                    <input type="hidden" name="primary_key" value="<?= $pkCol ?>">
                    <input type="hidden" name="primary_value" value="<?= $row[$pkCol] ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>No rows found in this table.</p>
<?php endif; ?>
