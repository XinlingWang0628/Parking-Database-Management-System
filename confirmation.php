<html>
<head>
<title>Parking Reserver</title>
<style type="text/css">
body {
    font-family: Arial, sans-serif;
    background-color: #e6ffe6;
}
h3 {
  color: #20B2AA;
  padding: 0;
  margin: 0;
}
.reserve-btn {
  background-color: #ADD8E6;
  color: #20B2AA;
  box-shadow: 3px 3px 3px #000;
  border: none;
  border-radius: 4px;
  margin-top: 8px;
  padding: 4px;
  height: 32px;
  width: 128px;
  text-decoration: none;
}
.reserve-btn:hover {
  background-color: #7FFFD4;
  cursor: pointer;
}
a {
      color: #20B2AA;
      text-decoration: none;
}
</style>
<body>
<?php
$con = mysqli_connect('localhost', 'phpuser', 'phpwd', 'garage');
echo "<h3>Reservation Confirmation</h3>";
if (isset($_POST['phone'], $_POST['date'], $_POST['garage'], $_POST['price'], $_POST['spots'], $_POST['revenue'])) { // garagedate_info entry exists for date
    $Revenue = $_POST['revenue'];
    $Spots = $_POST['spots'];
    $Price = $_POST['price'];
    $Garage = $_POST['garage'];
    $Date = $_POST['date'];
    $Phone = $_POST['phone'];
    // Check for existing entry
    $check = "select Status from reservation where GName='$Garage' and Date='$Date' and PhoneNum='$Phone'";
    $res = mysqli_query($con, $check) or die(mysqli_connect_error());
    if ($row = mysqli_fetch_array($res)) { // entry exists
        $sql = "update reservation set Status='successful' where GName='$Garage' and Date='$Date' and PhoneNum='$Phone'";
    } else {
        $sql = "insert into reservation values('$Garage', '$Date', $Price, 'successful', '$Phone')";
    }
    // Create reservation entry
    mysqli_query($con, $sql) or die(mysqli_connect_error());
    echo "<p>You have successfully reserved a spot at $Garage on $Date for $$Price.</p>";
    echo "<button class=\"reserve-btn\"><a href=\"userHome.php\">Return Home</a></button>";
} else if (isset($_POST['phone'], $_POST['date'], $_POST['garage'], $_POST['price'], $_POST['spots'])) { // garagedate_info entry doesn't exist for date
    $Spots = $_POST['spots'];
    $Price = $_POST['price'];
    $Garage = $_POST['garage'];
    $Date = $_POST['date'];
    $Phone = $_POST['phone'];
    // Check for existing entry
    $check = "select Status from reservation where GName='$Garage' and Date='$Date' and PhoneNum='$Phone'";
    $res = mysqli_query($con, $check) or die(mysqli_connect_error());
    if ($row = mysqli_fetch_array($res)) { // entry exists
        $sql = "update reservation set Status='successful' where GName='$Garage' and Date='$Date' and PhoneNum='$Phone'";
    } else {
        $sql = "insert into reservation values('$Garage', '$Date', $Price, 'successful', '$Phone')";
    }
    // Create reservation entry
    mysqli_query($con, $sql) or die(mysqli_connect_error());
    echo "<p>You have successfully reserved a spot at $Garage on $Date for $$Price.</p>";
    echo "<button class=\"reserve-btn\"><a href=\"userHome.php\">Return Home</a></button>";
} else {
    echo "<p>Missing Info</p>";
}
?>
</body>
</html>
