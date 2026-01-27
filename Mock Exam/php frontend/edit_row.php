<?php
include "load_header.php";
include 'backend_call.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'];
    $pkCol = $_POST['primary_key'];
    $pkVal = $_POST['primary_value'];

    if (isset($_POST['save'])) {
        $data = $_POST;
        unset($data['table'], $data['primary_key'], $data['primary_value'], $data['save']);
        $response = callBackend([
            "Action" => "update_row",
            "table" => $table,
            "primary_key" => $pkCol,
            "primary_value" => $pkVal,
            "data" => $data
        ]);
        header("Location: view_table.php?table=" . urlencode($table));
        exit;
    } else {
        // Show form
        $rowResp = callBackend([
            "Action" => "select_all",
            "table" => $table
        ]);

        $rowData = null;
        foreach ($rowResp['Rows'] as $r) {
            if ($r[$pkCol] == $pkVal) {
                $rowData = $r;
                break;
            }
        }
        if (!$rowData) die("Row not found");
    }
} else {
    die("Invalid request");
}
?>

<h2>Edit Row: <?= htmlspecialchars($table) ?></h2>
<form method="post">
    <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
    <input type="hidden" name="primary_key" value="<?= htmlspecialchars($pkCol) ?>">
    <input type="hidden" name="primary_value" value="<?= htmlspecialchars($pkVal) ?>">

    <?php foreach ($rowData as $col => $val): ?>
        <label><?= htmlspecialchars($col) ?>:</label>
        <input type="text" name="<?= htmlspecialchars($col) ?>" value="<?= htmlspecialchars($val) ?>"><br>
    <?php endforeach; ?>

    <button type="submit" name="save">Save</button>
</form>
