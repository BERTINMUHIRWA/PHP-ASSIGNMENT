<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Registration</title>
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: #f4f6fa;
      color: #1e293b;
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background: linear-gradient(180deg, #1e3a8a, #3b82f6);
      color: white;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .sidebar h2 {
      text-align: center;
      font-size: 20px;
      letter-spacing: 1px;
      margin-bottom: 40px;
    }
    .sidebar nav a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 12px 15px;
      margin: 8px 0;
      border-radius: 8px;
      transition: 0.3s;
      font-weight: 500;
    }
    .sidebar nav a:hover {
      background: rgba(255, 255, 255, 0.2);
    }
    .logout {
      text-align: center;
      font-size: 14px;
      opacity: 0.8;
    }

    /* Main content */
    .main {
      flex: 1;
      padding: 40px;
    }

    .card {
      max-width: 600px;
      background: #fff;
      margin: 0 auto;
      padding: 30px 40px;
      border-radius: 14px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }
    h1 {
      text-align: center;
      color: #1e3a8a;
      font-size: 22px;
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #475569;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #cbd5e1;
      border-radius: 8px;
      margin-bottom: 16px;
      outline: none;
      transition: 0.2s;
      font-size: 14px;
    }
    input:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .gender {
      margin-bottom: 16px;
    }

    button {
      width: 100%;
      background: #1e3a8a;
      border: none;
      color: white;
      padding: 10px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #3b82f6;
      transform: scale(1.03);
    }

    @media (max-width: 768px) {
      body {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        flex-direction: row;
        justify-content: space-around;
        padding: 15px 10px;
      }
      .sidebar h2 {
        display: none;
      }
      .main {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <div>
      <h2>CMS DASHBOARD</h2>
      <nav>
        <a href="index.php">🏠 Dashboard</a>
        <a href="select.php">📋 View Items</a>
        <a href="#">🧾 Reports</a>
        <a href="#">⚙️ Settings</a>
      </nav>
    </div>
    <div class="logout">
      <a href="#" style="color:white; text-decoration:none;">🚪 Logout</a>
    </div>
  </div>

  <div class="main">
    <div class="card">
      <h1>Registration Form</h1>
      <form action="" method="post">
        <label>First Name:</label>
        <input type="text" name="fname" placeholder="Enter your first name..." required>

        <label>Last Name:</label>
        <input type="text" name="lname" placeholder="Enter your last name..." required>

        <label>Phone Number:</label>
        <input type="number" name="pnumber" placeholder="+250700000000" required>

        <div class="gender">
          <label>Gender:</label>
          <input type="radio" name="gender" value="Male" required> Male
          <input type="radio" name="gender" value="Female" required style="margin-left: 15px;"> Female
        </div>

        <button type="submit" name="send">Submit</button>
      </form>
    </div>
  </div>

  <?php 
  include "connection.php";
  if(isset($_POST['send'])){
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $pnumber = $_POST['pnumber'];
      $gender = $_POST['gender'];

      $sql = "INSERT INTO form(Firstname,Lastname,Phone,Gender) VALUES('$fname','$lname','$pnumber','$gender')";
      $query = mysqli_query($conn,$sql);
      if($query == true){
          echo "<script>window.location.href='select.php';</script>";
      }else{
          echo "ERROR OCCURED";
      }
  }
  ?>
</body>
</html>
