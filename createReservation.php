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
h3 {
  color: #20B2AA;
  padding: 0;
  margin: 0;
}
.cont {
  display: flex;
  justify-content: center;
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
echo "<h1>Create Reservation</h1><hr>";
if (isset($_POST['garage'], $_POST['date'])) {
    $Garage = $_POST['garage'];
    $Date = $_POST['date'];
    $sql = "select Date, Price, TotalSpace FROM GARAGE_DATEINFO where Gname='$Garage' and Date='$Date'";
    $result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_array($result)){ // There is specific date_info for garage on date
      // Get avl space at garage on date
      $avlSpaceQuery = "select COUNT(Status) from reservation where Status='successful' and Gname='$Garage' and Date='$Date'";
      $avlSpaceRes = mysqli_query($con, $avlSpaceQuery);
      $takenSpots = mysqli_fetch_array($avlSpaceRes)[0];
      $avlSpace = $row[2] - $takenSpots;
      $revenue = number_format($row[1] * $takenSpots,2);
      if ($avlSpace > 0) { // There is Avl Space
        echo "<div class=\"cont\"><div style=\"padding-right: 16px; border-right: 1px solid grey;\"><p>The price for a spot on $Date at $Garage is $$row[1].</p>";
        echo "<p>There are $avlSpace spots left.</p>";
        echo "<button class=\"reserve-btn\"><a href=\"userHome.php\">Return Home</a></button></div>";
        echo "<div style=\"padding: 2px 0 0 16px\"><form action=\"confirmation.php\" method=\"post\">
                  <label for=\"date\">Your Phone Number:</label>
                  <input type=\"hidden\" id=\"spots\" name=\"spots\" value=\"$avlSpace\">
                  <input type=\"hidden\" id=\"date\" name=\"date\" value=\"$Date\">
                  <input type=\"hidden\" id=\"price\" name=\"price\" value=\"$row[1]\">
                  <input type=\"hidden\" id=\"garage\" name=\"garage\" value=\"$Garage\">
                  <input type=\"hidden\" id=\"revenue\" name=\"revenue\" value=\"$revenue\">
                  <input style=\"margin: 8px 8px 0 8px;\" id=\"phone\" name=\"phone\" type=\"tel\">
                  <input type=\"submit\" class=\"reserve-btn\" value=\"Reserve Spot\">
              </form></div></div<</div>";
      } else {
        echo "<p>No availability was found for $Garage on $Date</p>";
        echo "<button class=\"reserve-btn\"><a href=\"userHome.php\">Return Home</a></button>";
      }
    } else { // No specific date_info for garage on date. Use default values
        $sql = "select Default_Price, Max_Space FROM GARAGE where Gname='$Garage'";
        $result = mysqli_query($con, $sql);
        if($row = mysqli_fetch_array($result)){
          // Get avl space at garage on date
          $avlSpaceQuery = "select COUNT(Status) from reservation where Status='successful' and Gname='$Garage' and Date='$Date'";
          $avlSpaceRes = mysqli_query($con, $avlSpaceQuery);
          $avlSpace = $row[1] - mysqli_fetch_array($avlSpaceRes)[0];
          echo "<div class=\"cont\"><div style=\"padding-right: 16px; border-right: 1px solid grey;\"><p>The price for a spot on $Date at $Garage is $$row[0].</p>";
          echo "<p>There are $avlSpace spots left.</p>";
          echo "<button class=\"reserve-btn\"><a href=\"userHome.php\">Return Home</a></button></div>";
          echo "<div style=\"padding: 2px 0 0 16px\"><form action=\"confirmation.php\" method=\"post\">
                    <label for=\"date\">Your Phone Number:</label>
                    <input type=\"hidden\" id=\"spots\" name=\"spots\" value=\"$avlSpace\">
                    <input type=\"hidden\" id=\"date\" name=\"date\" value=\"$Date\">
                    <input type=\"hidden\" id=\"price\" name=\"price\" value=\"$row[0]\">
                    <input type=\"hidden\" id=\"garage\" name=\"garage\" value=\"$Garage\">
                    <input style=\"margin: 8px 8px 0 8px;\" id=\"phone\" name=\"phone\" type=\"tel\">
                    <input type=\"submit\" class=\"reserve-btn\" value=\"Reserve Spot\">
                </form></div></div<</div>";
        }
    }
} else {
    echo "<p>Missing Info</p>";
}
?>
</body>
</html>
