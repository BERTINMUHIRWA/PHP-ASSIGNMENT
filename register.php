<?php
include "connection.php";
session_start();

if(isset($_POST['register'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);


        $check = mysqli_query($conn, "SELECT * FROM users WHERE Username='$username'");
        if(mysqli_num_rows($check) > 0) {
            $error = "Username already exists!";
        } else {

            $insert = mysqli_query($conn, "INSERT INTO users VALUES ('$id', '$username', '$password')");
            if($insert) {
               echo "<script>window.location.href='login.php';</script>";
            } else {
                $error = "Something went wrong!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Dashboard</title>
  <style>
    *{
      box-sizing: border-box;
    }
    body{
      margin:0;
      font-family: "Poppins", sans-serif;
      background: linear-gradient(120deg, #1e3a8a, #3b82f6);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-card{
      background: #ffffff;
      border-radius: 14px;
      box-shadow: 0 6px 25px rgba(0,0,0,0.15);
      width: 400px;
      padding: 40px 30px;
      text-align: center;
      animation: fadeIn .6s ease;
    }

    @keyframes fadeIn{
      from{opacity:0; transform:translateY(10px);}
      to{opacity:1; transform:translateY(0);}
    }

    h1{
      color: #1e3a8a;
      margin-bottom: 10px;
    }
    p{
      color: #64748b;
      margin-bottom: 30px;
    }

    input[type=text],
    input[type=password],
    input[type=number]{
      width: 100%;
      padding: 10px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      margin-bottom: 16px;
      outline: none;
      transition: 0.3s;
      font-size: 14px;
    }
    input:focus{
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59,130,246,0.25);
    }

    button{
      width: 100%;
      background: #1e3a8a;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      font-size: 15px;
      transition: 0.3s;
    }
    button:hover{
      background: #3b82f6;
      transform: scale(1.03);
    }

    .error{
      color: #dc2626;
      background: #fee2e2;
      padding: 8px;
      border-radius: 6px;
      font-size: 13px;
      margin-bottom: 15px;
    }

    footer{
      margin-top: 25px;
      font-size: 13px;
      color: #64748b;
    }
    a{
      color: #3b82f6;
      text-decoration: none;
      font-weight: 600;
    }
    a:hover{
      text-decoration: underline;
    }

    @media(max-width:500px){
      .login-card{
        width:90%;
        padding:30px 20px;
      }
    }
  </style>
</head>
<body>

  <form method="POST">
    <div class="login-card">
      <h1>REGISTER HERE !</h1>
      <p>Sign up to access your dashboard</p>

      <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

      <input type="number" name="id" placeholder="Enter your Identity" required>
      <input type="text" name="username" placeholder="Enter your Username" required>
      <input type="password" name="password" placeholder="Enter your Password" required>

      <button type="submit" name="register">Register</button>

      <footer>
        You have an account? <a href="login.php">Sign in</a>
      </footer>
    </div>
  </form>

</body>
</html>
