<?php
session_start();

$username = "";
$password = "";
$errors = array();

$title = "";
$content = "";
$date = "";
$imageURL = "";

$db = mysqli_connect('localhost', 'root', '', 'moja baza');

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
        //post.php 
        if (isset($_POST['btn_publish'])) {

            $title = mysqli_real_escape_string($db, $_POST['title']);
            $content = mysqli_real_escape_string($db, $_POST['content']);
            $date = mysqli_real_escape_string($db, $_POST['date']);
            $imageURL = mysqli_real_escape_string($db, $_POST['image']);

            $posts_check_query = "SELECT * FROM posts WHERE title='$title' OR content='$content' OR date='$date' OR image='$imageURL' LIMIT 1";
            $result = mysqli_query($db, $posts_check_query);
            $posts = mysqli_fetch_assoc($result);

            $query = "INSERT INTO posts (title, content, date, image ) 
         VALUES('$title', '$content', '$date', '$imageURL' )";
            mysqli_query($db, $query);
            $_SESSION['title'] = $title;
            $_SESSION['content'] = $content;
            $_SESSION['date'] = $date;
            $_SESSION['image'] = $imageURL;

            $_SESSION['success'] = "Post dodan";
            header('location: index.php');
        }
    }
}
