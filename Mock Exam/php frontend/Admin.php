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
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Admin Panel</h1>

<h2>Tables</h2>
<ul>
<?php foreach ($tables as $t): ?>
    <li>
        <a href="?table=<?= htmlspecialchars($t) ?>">
            <?= htmlspecialchars($t) ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

<?php if (!empty($rows)): ?>
    <h2>Table: <?= htmlspecialchars($table) ?></h2>

    <table border="1" cellpadding="5">
        <tr>
            <?php foreach ($columns as $col): ?>
                <th><?= htmlspecialchars($col) ?></th>
            <?php endforeach; ?>
            <th>Actions</th>
        </tr>

        <?php foreach ($rows as $row): ?>
        <tr>
            <?php foreach ($columns as $col): ?>
                <td><?= htmlspecialchars($row[$col]) ?></td>
            <?php endforeach; ?>

            <td>
                <form method="post" action="delete_row.php" style="display:inline;">
                    <input type="hidden" name="table" value="<?= $table ?>">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <button type="submit">Edit</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
