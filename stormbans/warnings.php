<?php require 'includes/page.php'; ?>
<title>Bans | The Storm</title>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Warnings</h1>
        </div>
    </div>
    <div class="row" style="margin-bottom:60px;">
        <div class="col-lg-12 table-responsive">
            <table class="table table-hover table-bordered table-condensed table-responsi">
                <thead>
                <tr>
                    <th>
                        <div style="text-align: center;">Name</div>
                    </th>
                    <th>
                        <div style="text-align: center;">Warned By</div>
                    </th>
                    <th>
                        <div style="text-align: center;">Reason</div>
                    </th>
                    <th>
                        <div style="text-align: center;">Warned Until</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                global $table_warnings, $conn;
                $result = run_query($table_warnings);
                while ($row = $result->fetch_assoc()) {
                    date_default_timezone_set("UTC");
                    $expiresResult = date('F j, Y, g:i a', $row['until'] / 1000);
                    ?>
                    <tr>
                        <td><?php echo get_avatar($row['name']); ?></td>
                        <td><?php echo get_avatar($row['banned_by_name']); ?></td>
                        <td style="width: 30%;"><?php echo $row['reason']; ?></td>
                        <td>
                            <?php if ($row['until'] <= 0) {
                                $expiresResult = 'Permanent Warning';
                            }
                            if ($row['active'] == 0) {
                                $expiresResult .= ' (Inactive)';
                            }
                            echo $expiresResult;
                            ?>
                        </td>
                    </tr>
                <?php }
                $result->free();
                $conn->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>