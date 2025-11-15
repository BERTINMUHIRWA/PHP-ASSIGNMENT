<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php"); 
    exit();
}

include('connection.php');

$sql = "SELECT * FROM form";
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

<div class="container">
  <header>
    <h1>WELCOME TO CENTRAL MANAGEMENT</h1>
    <form method="POST">
      <div class="action-buttons">
        <button type="submit" name="view">View Users</button>
        <button type="submit" name="new">New Item</button>
        <button id="logoutBtn"><a href="logout.php">Logout</a></button>
      </div>
    </form>
  </header>

  <table>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Phone</th>
      <th>Gender</th>
      <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $fname = $row['Firstname'];
        $lname = $row['Lastname'];
        $phone = $row['Phone'];
        $gender = $row['Gender'];
        echo "<tr>
                <td>$fname</td>
                <td>$lname</td>
                <td>$phone</td>
                <td>$gender</td>
                <td>
                  <a class='btn-update' href='update.php?updatenbr=$phone'>Update</a>
                  <a class='btn-delete' href='delete.php?deletenbr=$phone'>Delete</a>
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
      echo "<script>window.location.href='index.php';</script>";
    }
    ?>
  </table>

  <footer>
    &copy; <?php echo date('Y'); ?> Central Management System — All Rights Reserved.
  </footer>
</div>

</body>
</html>
