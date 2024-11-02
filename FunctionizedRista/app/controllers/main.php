<?php
// Include necessary files and start session
include_once __DIR__ . '/../models/db.php';
// Create database connection
$db = new Database();
$connect = $db->connect();

// Get the current URL path
$server = $_SERVER['REQUEST_URI'];
$url = strtok($server, '?');

// Handle login
if ($url === '/login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['Contact'];
        $password = $_POST['Password'];
        $users = new Users($connect);
        $data = $users->login($username, $password);

        if ($data) {
            $_SESSION['Contact'] = $username;
            header('Location: /home'); // Redirect to home page
             // Ensure no further code is executed
        } else {
            echo "Login failed";
        }
    } else {
        echo "Invalid request method.";
    }
}

elseif ($url === '/home'){
    if (isset($_SESSION['Contact'])) {
        $user = new Users($connect);
        $data = $user->fetch_data($_SESSION['Contact']);
        include __DIR__.'/../views/home.blade.php';
        
    } else {
        header("Location: /");
    }

}

elseif ($url === '/details') {
    if (isset($_SESSION['Contact'])) {
        $details = new Users($connect);
        $data = $details->fetch_data($_SESSION['Contact']);
        $photo = $details->fetch_photo($_SESSION['Contact']);
        if ($data ) {
            include __DIR__.'/../views/details.blade.php';
            exit(); 
        } else {
            echo "No data found.";
        }
    } else {
        header("Location: /");
    }
}

elseif($url === '/connection') {
    if(isset($_SESSION['Contact'])){
        $contact = $_SESSION['Contact'];
        $users = new Users($connect);
        $user_data = $users->users_data($contact);
        $user_photo = $users->users_photo($contact);
        if($user_data && $user_photo){
            include __DIR__.'/../views/connection.blade.php';
            //header("Location: connect");
        }else{
            echo "Data not send";
        }
    }
    
    
}

elseif($url === '/requested'){
    if(isset($_SESSION['Contact'])){
        $status = 'pending';
        $user = new Users($connect);
        $result = $user->connected($_SESSION['Contact'], $status);
        if(mysqli_num_rows($result) > 0){
            

        } 
        include __DIR__.'/../views/requested.blade.php';
    }
}

elseif($url === '/connected'){
    if(isset($_SESSION['Contact'])){
        $status = 'Connected';
        $user = new Users($connect);
        $result = $user->connected($_SESSION['Contact'], $status);
        if ($result->num_rows > 0) {
            // Fetch and display each row
            while ($row = $result->fetch_assoc()) {
                $contact = $row['RequestedTo'];
                // Create an instance of Users and fetch user details
                $user = new Users($connect);
                $data= $user->fetch_data($contact);
                $photo = $user->fetch_photo($contact);

                $photos = [];
                while ($photo_row = $photo) {
                    $photos[$photo_row['Contact']] = $photo_row['path_to'];
                }
                

            }
        }
        include __DIR__.'/../views/connected.blade.php';
    }
}

elseif($url === '/logout'){
    session_write_close();
    ob_end_flush();
    session_abort();
    header("location:/");
}
