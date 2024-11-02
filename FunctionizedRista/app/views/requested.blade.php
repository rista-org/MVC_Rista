<?php
require_once('header.blade.php');
require_once('conn_header.blade.php');
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <form action="" method="post">
            <p><?php echo htmlspecialchars($row['Requested']) . "<br>"; ?>
            <input type="hidden" name="RequestedContact" value="<?php echo htmlspecialchars($row['RequestedTo']); ?>">
            <button type="submit" name="decline">Cancel</button>
            </p>
        </form>
        <?php
    }

    ?>