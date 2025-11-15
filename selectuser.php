<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit();
}

include('connection.php');

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Central Management | View Items</title>
  <style>
    /* Reset */
    *{
      box-sizing: border-box;
    }
    body{
      margin:0;
      font-family: "Poppins", Arial, sans-serif;
      background: #f0f4f8;
      color: #1e293b;
      padding: 20px;
    }
    .container{
      max-width: 1100px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 14px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      overflow: hidden;
    }

    header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      padding: 20px 25px;
      background: linear-gradient(90deg, #1e3a8a, #3b82f6);
      color:white;
    }
    header a{
      text-decoration: none;
      color: #1e3a8a;
    }

    h1{
      margin:0;
      font-size: 22px;
      letter-spacing: .5px;
    }

    .action-buttons button{
      background: white;
      border: none;
      color: #1e3a8a;
      padding: 8px 16px;
      margin-left: 8px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all .3s ease;
    }
    .action-buttons button:hover{
      background: #e0e7ff;
      transform: translateY(-1px);
    }

    table{
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th{
      background: #f1f5f9;
      color: #1e293b;
      text-align: left;
      padding: 12px;
      font-size: 14px;
      border-bottom: 2px solid #e2e8f0;
    }

    td{
      padding: 12px;
      border-bottom: 1px solid #e5e7eb;
      font-size: 14px;
    }

    tr:hover{
      background: #f8fafc;
    }

    .btn-update, .btn-delete{
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      color: white;
      text-decoration: none;
      font-size: 13px;
      transition: background .3s;
    }

    .btn-update{
      background: #16a34a;
    }
    .btn-update:hover{
      background: #15803d;
    }

    .btn-delete{
      background: #dc2626;
    }
    .btn-delete:hover{
      background: #b91c1c;
    }

    footer{
      text-align:center;
      padding:15px;
      font-size:13px;
      color:#475569;
      background:#f8fafc;
    }


  </style>
</head>
<body>
<div class="sidebar">
      
<div class="container">
  <header>
    <nav>
        <a href="select.php">🏠</a>
      </nav>
    <h1>USER PORTAL</h1>
    <form method="POST">
      <div class="action-buttons">
        <!-- <button type="submit" name="view">View Users</button> -->
        <button type="submit" name="new">New User</button>
        <button id="logoutBtn"><a href="logout.php">Logout</a></button>
      </div>
    </form>
  </header>

  <table>
    <tr>
      <th>Identity</th>
      <th>Username</th>
      <th>Password</th>
      <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $id = $row['Identity'];
        $uname = $row['Username'];
        $pass = $row['Password'];
        echo "<tr>
                <td>$id</td>
                <td>$uname</td>
                <td>$pass</td>
                <td>
                  <a class='btn-update' href='updateuser.php?updatenbr=$id'>Update</a>
                  <a class='btn-delete' href='deleteuser.php?deletenbr=$id'>Delete</a>
                </td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='5' style='text-align:center;color:#64748b;'>No records found</td></tr>";
    }
    $conn->close();
    ?>

    <?php 
    if(isset($_POST['new'])){
      echo "<script>window.location.href='register.php';</script>";
    }
    ?>
  </table>

  <footer>
    &copy; <?php echo date('Y'); ?> Central Management System — All Rights Reserved.
  </footer>
</div>

</body>
</html>
