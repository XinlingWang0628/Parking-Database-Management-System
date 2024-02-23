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
  color: red;
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
if (isset($_POST['garage'], $_POST['date'])) {
    $Garage = $_POST['garage'];
    $Date = $_POST['date'];
    echo "<h1>$Garage Stats for $Date</h1><hr>";
    $sql = "select TotalSpace, Price FROM GARAGE_DATEINFO where Gname='$Garage' and Date='$Date'";
    $result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_array($result)){ // garage_dateinfo entry exists for date
        // Get avl space at garage on date
        $avlSpaceQuery = "select COUNT(Status) from reservation where Status='successful' and Gname='$Garage' and Date='$Date'";
        $avlSpaceRes = mysqli_query($con, $avlSpaceQuery);
        $takenSpots = mysqli_fetch_array($avlSpaceRes)[0];
        $avlSpace = $row[0] - $takenSpots;
        $revenue = number_format($row[1] * $takenSpots,2);
        echo "<div class=\"cont\"><div style=\"padding-right: 16px;\">";
        echo "<p>Price: $$row[1]</p>";
        echo "<p>Spots Left: $avlSpace / $row[0]</p>";
        echo "<p>Revenue: $$revenue</p>";
        echo "<button class=\"reserve-btn\"><a href=\"adminHome.php\">Return Home</a></button>";
        echo "</div></div>";
    } else { // garage_dateinfo entry doesn't exist for date
        $sql = "select * FROM GARAGE where Gname='$Garage'";
        $result = mysqli_query($con, $sql);
        if($row = mysqli_fetch_array($result)){
            // Get avl space at garage on date
            $avlSpaceQuery = "select COUNT(Status) from reservation where Status='successful' and Gname='$Garage' and Date='$Date'";
            $avlSpaceRes = mysqli_query($con, $avlSpaceQuery);
            $takenSpots = mysqli_fetch_array($avlSpaceRes)[0];
            $avlSpace = $row[3] - $takenSpots;
            $revenue = number_format($row[2] * $takenSpots,2);
            echo "<div class=\"cont\"><div style=\"padding-right: 16px;\">";
            echo "<p>Price: $$row[2]</p>";
            echo "<p>Spots Left: $avlSpace / $row[3]</p>";
            echo "<p>Revenue: $$revenue</p>";
            echo "<button class=\"reserve-btn\"><a href=\"adminHome.php\">Return Home</a></button>";
            echo "</div></div>";
        } else {
            echo "<p>Unable to get Garage Info</p>";
            echo "<button class=\"reserve-btn\"><a href=\"adminHome.php\">Return Home</a></button>";
        }
    }
} else {
    echo "<p>Missing Info</p>";
    echo "<button class=\"reserve-btn\"><a href=\"adminHome.php\">Return Home</a></button>";
}
?>
</body>
</html>
