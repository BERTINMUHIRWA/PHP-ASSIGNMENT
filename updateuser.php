<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<?php 
include "connection.php";

if(isset($_GET['updatenbr'])){
    $id = $_GET['updatenbr'];
    $sql = "SELECT * FROM users WHERE Identity='$id'";
    $result = $conn->query($sql);

    if($result && $result->num_rows > 0){
        $rows = $result->fetch_assoc();
        $fname = $rows['Identity'];
        $lname = $rows['Username'];
        $phone = $rows['Password'];
    } else {
        echo "Record not found!";
        exit;
    }
}

if(isset($_POST['send'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pnumber = $_POST['pnumber'];

    $sql = "UPDATE form 
            SET Firstname='$fname', Lastname='$lname', Phone='$pnumber', Gender='$gender'
            WHERE Phone='$id'";
    $query = mysqli_query($conn, $sql);

    if($query){
        echo "<script>window.location.href='selectuser.php';</script>";
    } else {
        echo "ERROR OCCURED";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Update Record</title>
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
      <h1>Update User</h1>
      <form method="post">
        <label>Identity:</label>
        <input type="text" name="fname" value="<?php echo $fname; ?>" required>

        <label>Username:</label>
        <input type="text" name="lname" value="<?php echo $lname; ?>" required>

        <label>Password</label>
        <input type="number" name="pnumber" value="<?php echo $phone; ?>" required>

        <button type="submit" name="send">Save Changes</button>
      </form>
    </div>
  </div>

</body>
</html>
