<?php
include "connection.php";
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Example: You can adjust to your real user table
  $sql = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

     if(isset($_POST['remember'])) {
            $token = bin2hex(random_bytes(16));
            $stmt = $conn->prepare("UPDATE users SET username = ? WHERE Username = ?");
            $stmt->bind_param("ss", $token, $username);
            $stmt->execute();
            setcookie("remember_me", $token, time() + (30*24*60*60), "/", "", true, true);
        }

    $_SESSION['username'] = $username;
    echo "<script>window.location.href='select.php';</script>";
  } else {
    $error = "Invalid username or password!";
  }
}
if(!isset($_SESSION['username']) && isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $stmt = $conn->prepare("SELECT Username FROM users WHERE username = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['Username'];
        echo "<script>window.location.href='select.php';</script>";
    } else {
        setcookie("remember_me", "", time() - 3600, "/", "", true, true);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | CMS Dashboard</title>
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
    input[type=password]{
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
      <h1>Welcome Back 👋</h1>
      <p>Sign in to access your dashboard</p>

      <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="checkbox" name="remember" value="1"> Remember Me

      <button type="submit" name="login">Login</button>

      <footer>
        Don’t have an account? <a href="register.php">Create one</a>
      </footer>
    </div>
  </form>

</body>
</html>
