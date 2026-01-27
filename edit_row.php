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
        if (isset($rowResp['Rows'])) {
            foreach ($rowResp['Rows'] as $r) {
                if ($r[$pkCol] == $pkVal) {
                    $rowData = $r;
                    break;
                }
            }
        }
        if (!$rowData) die("Row not found");
    }
} else {
    die("Invalid request");
}
?>

<main>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <a href="view_table.php?table=<?= urlencode($table) ?>" class="sidebar-btn">Back to Table</a>
        </aside>

        <section class="main-content">
            <h1>Edit Row: <?= htmlspecialchars($table) ?></h1>

            <div class="auth-container" style="max-width: 100%; box-shadow: none; border: 2px solid #000; margin-top: 2rem;">
                <form method="post">
                    <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
                    <input type="hidden" name="primary_key" value="<?= htmlspecialchars($pkCol) ?>">
                    <input type="hidden" name="primary_value" value="<?= htmlspecialchars($pkVal) ?>">

                    <?php foreach ($rowData as $col => $val): ?>
                        <div class="form-group">
                            <label><?= htmlspecialchars($col) ?>:</label>
                            <input type="text" name="<?= htmlspecialchars($col) ?>" value="<?= htmlspecialchars($val) ?>">
                        </div>
                    <?php endforeach; ?>

                    <button type="submit" name="save" class="auth-btn update-btn">Save Changes</button>
                </form>
            </div>
        </section>
    </div>
</main>

<?php include 'footer.php'; ?>
