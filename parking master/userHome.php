<html>
<head>
<title>Parking Reserver</title>
<style type="text/css">
body {
    font-family: Arial, sans-serif;
    background-color: #e6ffe6;
}
h1 {
  color: #20B2AA;
  text-align: center;
  padding: 16px 0 0;
}
.garage-cont {
  display: flex;
  flex-wrap: nowrap;
  padding: 16px 0;
  justify-content: center;
  text-align: center;
}
.garage-item {
  flex-basis: 33%;
  text-align: center;
  border-right: 1px solid grey;
}
.garage-item:last-child {
  border: none;
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
</style>
<body>
<?php
$conn = new mysqli('127.0.0.1', 'phpuser', 'phpwd', 'garage');
$sql = "select Gname, Address, Default_Price, Max_Space FROM GARAGE";
$result = mysqli_query($conn, $sql);
echo "<h1>Available Parking Garages</h1><hr>";
echo "<div class=\"garage-cont\">";
      while ($row = mysqli_fetch_array($result)) {
        echo "<div class=\"garage-item\">";
        echo "<p>$row[0] - $row[1]</p>";
        echo "<form action=\"createReservation.php\" method=\"post\">
              <input type=\"hidden\" name=\"garage\" value=\"$row[0]\">
              <label for=\"date\">Enter Desired Date:</label>
              <br>
              <input style=\"margin-top:8px;\" id=\"date\" name=\"date\" type=\"date\" required>
              <br>
              <input type=\"submit\" class=\"reserve-btn\" value=\"Check Availability\">
              </form>";
        echo "</div>";
      }
echo "</div><hr>";
echo "<h1 style=\"padding:0;\">Your Reservations</h1><hr>";
echo "<div class=\"garage-cont\">";
echo "<form action=\"reservation.php\" method=\"post\">
      <label for=\"phone\">Enter Your Phone Number:</label>
      <br>
      <input style=\"margin-top:8px;\" id=\"phone\" name=\"phone\" type=\"text\" required>
      <br>
      <input type=\"submit\" class=\"reserve-btn\" value=\"Check Reservation\">
    </form>";
echo "</div>";
?>
</body>
</html>
