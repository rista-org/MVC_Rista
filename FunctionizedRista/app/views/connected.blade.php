<?php
require_once('header.blade.php');
require_once('conn_header.blade.php');
while($row){
?>
<table>
    <tr>
        <td>
            <?php if (isset($photos[$data['Contact']])) { ?>
                <img src="<?php echo htmlspecialchars($photos[$data['Contact']]); ?>" alt="Profile Photo">
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td>Username:</td>
        <td><?php echo htmlspecialchars($data['Name']); ?></td>
    </tr>
    <tr>
        <td>Contact:</td>
        <td><?php echo htmlspecialchars($data['Contact']); ?></td>
    </tr>
    <tr>
        <td>Address:</td>
        <td><?php echo htmlspecialchars($data['Address']); ?></td>
    </tr>
    <tr>
        <form action="" method="post">
            <input type="hidden" name="recipient_contact" value="<?php echo htmlspecialchars($data['Contact']); ?>">
            <td><button type="submit" name=" view">view</button></td>
        </form>
    </tr>
</table>
<?php }

?>