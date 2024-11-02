<?php
include_once 'header.blade.php';

// Ensure that session data exists before trying to use it
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($data['Name']); ?></title>
</head>
<body>
    <div class="details_table">
    <?php if ($photo): ?>
            <img src="<?php echo htmlspecialchars($photo['path_to']); ?>" alt="../../Profile/annomous.jpg"><br>
        <?php else: ?>
            <p>No photo available.</p>
        <?php endif; ?><br>
        <div class="details">
            <strong>Username:</strong> <?php echo htmlspecialchars($data['Name']); ?><br>
            <strong>Contact:</strong> <?php echo htmlspecialchars($data['Contact']); ?><br> 
            <strong>Address:</strong> <?php echo htmlspecialchars($data['Address']); ?><br>
            <strong>Age:</strong> <?php echo htmlspecialchars($data['Age']); ?><br>
            <strong>Qualification:</strong> <?php echo htmlspecialchars($data['Qualification']); ?><br>

            <form method="post">
                <button type="submit" name="back">Back</button>
                <button type="submit" name="edit">Edit</button>
            </form>
        </div>
    </div>   
</body>
</html>

