<?php 
require_once('header.blade.php');
require_once('conn_header.blade.php');
$user = $user_data;
$photo = $user_photo;


$photos = [];
while ($photo_row = mysqli_fetch_assoc($photo)) {
    $photos[$photo_row['Contact']] = $photo_row['path_to'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
<table>
    <?php while ($data = mysqli_fetch_assoc($user))  {
        $result = $users->requested($contact, $data['Contact']);
        if($result->num_rows === 0){
        
        ?>
        <tr>
            <td>
                <?php if (isset($photos[$data['Contact']])) { ?>
                    <img src="<?php echo htmlspecialchars($photos[$data['Contact']]); ?>" alt="Profile Photo">
                <?php }else{ ?>
                    <img src="./Profile/annomous.jpg" alt="">
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><?php echo htmlspecialchars($data['Name']); ?></td>
        </tr>
        <tr>
            <td>Age:</td>
            <td><?php echo htmlspecialchars($data['Age']); ?></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?php echo htmlspecialchars($data['Address']); ?></td>
        </tr>
        <tr>
            <form method="post">
                <input type="hidden" name="recipient_contact" value="<?php echo htmlspecialchars($data['Contact']); ?>">
                <td><button name="submit">Send request</button></td>
            </form>
        </tr>
    <?php } 
    }?>
</table>
</body>
</html>

