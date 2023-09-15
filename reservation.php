<!DOCTYPE html>
<html>
<head>
  <title>Your Reservation Details</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e6ffe6;
    }
    h1 {
      text-align: center;
      color: #20B2AA;
    }
    table {
      margin: 0 auto;
      border-collapse: collapse;
      border: 1px solid #999;
    }
    th, td {
      padding: 8px;
      border: 1px solid #999;
      background-color: white;
    }
    th {
      background-color: #eee;
      font-weight: bold;
      text-align: left;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
		
    .cancel{
      background-color: #ADD8E6;
      color: #20B2AA;
      font-size: 1rem;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      margin: 20px auto 0;
      text-align: center;
      box-shadow: 3px 3px 3px #000;
      display: block;
      vertical-align: middle;
      text-decoration: none;
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .cancel:hover {
			background-color: #7FFFD4;
		}

a {
  color: #20B2AA;
  text-decoration: none;
}

  </style>
</head>
<body>
  
  <?php
  
  if (isset($_POST['phone'])) {
    echo'<h1>Reservation Details</h1>';
    $Phone = $_POST["phone"];
    $con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'garage');
    if (!$con) {
      die('Could not connect'.mysqli_connect_error());
    }
    $sql = "select *, datediff(date,curdate()) from reservation where PhoneNum = '$Phone'";
    $result = mysqli_query($con, $sql) or die(mysqli_connect_error());
    if(mysqli_num_rows($result) == 0) {
      echo "<p>No reservation found for phone number $Phone.</p>";
    } else {
      echo "<form action='' method='post'>";
      echo "<table>";
      echo "<tr><th>Garage</th><th>Date</th><th>FeeCharged</th><th>Status</th><th>Daysleft</th><th>PhoneNum</th><th>Select</th></tr>";
      while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td><td>".$row[4]."</td>";
        echo "<td><input type='checkbox' name='reservations[]' value=' ".$row[0].",".$row[1].",".$row[4]."'></td></tr>";
      }
      echo "</table>";
      echo "<input class='cancel' type='submit' value='Cancel Selected Reservations'>";
      echo "</form>";
      echo "<button class='cancel' style='margin-top: 70px;'><a href=\"userHome.php\">Return Home</a></button>";
      
    }
    mysqli_close($con);
  }
  
  if (isset($_POST['reservations'])) {
    $reservations = $_POST['reservations'];
    foreach ($reservations as $reservation) {
      $garage = trim(substr($reservation, 0, strpos($reservation, ',')));
      $date = trim(substr($reservation, strpos($reservation, ',') + 1, strrpos($reservation, ',') - strpos($reservation, ',') - 1));
      $phone = trim(substr($reservation, strrpos($reservation, ',') + 1));

    $con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'garage');
    if (!$con) {
      die('Could not connect: ' . mysqli_connect_error());
    }
    $sql = "select datediff(date,curdate()) from reservation where PhoneNum = '$phone' and Gname = '$garage' and date = '$date'";
    $result = mysqli_query($con, $sql) or die(mysqli_connect_error());
    if(mysqli_num_rows($result) == 0 ) {
      echo "<script>alert('No reservation found for your information');</script>";
      
    } else {

      while ($row = mysqli_fetch_array($result)) {
        if($row[0] >= 3){
            $sql = "update reservation set status ='cancelled' where PhoneNum = '$phone' AND Gname = '$garage' AND date = '$date'";
            mysqli_query($con, $sql) or die(mysqli_connect_error());
            echo "<script>alert('Your reservation was successfully cancelled.');</script>";
        }
        else{
          echo "<script>alert('Reservations can only be canceled 3+ days in advance.');</script>";
        }
       
      }
      echo "</table>";
    }
    
    mysqli_close($con);
  }
  echo "<button class='cancel'><a href='userHome.php'>Back to Home</a></button>";
}
  ?>
 
</body>
</html>
