<?php
include 'db.php';

session_start();

$username = "";
$password = "";
$errors = array();
$update = false;

$title = "";
$content = "";
$date = "";
$imageURL = "";


if (isset($_POST['reg_user'])) {

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }


    $user_check_query = "SELECT * FROM users WHERE username='$username' OR password='$password' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['password'] === $password) {
            array_push($errors, "password already exists");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);

        $query = "INSERT INTO users (username, password) 
  			  VALUES('$username', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: post.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $image = $_FILES['imagefile']['tmp_name'];
    $type = $_FILES['imagefile']['type'];
    header('Content-Type: application/json');
    $image = 'data:' . $type . ';base64,' . base64_encode(file_get_contents($image));
   
   
   mysqli_query($db, "INSERT INTO posts(title, content, date, imageURL, type) 
    VALUES('$title', '$content', '$date', '$image','$type')");
    $_SESSION['message'] = "Post is saved.";
    header('location: post.php');
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM posts WHERE id=$id");
    $_SESSION['message'] = "Post is deleted.";
    header('location: post.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM posts WHERE id=$id");

    $n = mysqli_fetch_array($record);

    header('location: add_post.php');
    $_SESSION['message'] = $title;
    $title = $n['title'];
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $imageURL = $_POST['imageURL'];

    mysqli_query($db, "UPDATE posts SET title='$title', content='$content', date='$date', imageURL='$imageURL' WHERE id=$id");
    $_SESSION['message'] = "Post is updated!";
    header('location: post.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: admin.php");
}
