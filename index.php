<!DOCTYPE html>
<html>
<head>
	<title>Parking Master</title>
	<style>
		body {
			background-image: url('https://media.istockphoto.com/id/1324853440/photo/parking-lot-in-public-areas.jpg?b=1&s=170667a&w=0&k=20&c=Y4f2QhvXJKwI9-hoaiPCvn_EQPZ2F_AQ03oNv4-3SlE=');
			background-size: cover;
			background-position: bottom 70px;
			font-family: Arial, sans-serif;
			color: #fff;
			text-align: center;
			margin: 0;
			padding: 0;
			animation: zoom-in 5s;
			transform-origin: center center;
			background-repeat: no-repeat;
		}
		
		h1 {
			font-size: 9rem;
			margin-top: 80px;
			margin-bottom: 20px;
			text-shadow: 3px 3px 3px #000;
			color:#20B2AA;
			font-family:"Lucida Handwriting", Times, serif;
		}
		
		button {
			background-color: #ADD8E6;
			color: #20B2AA;
			font-size: 2rem;
			border: none;
			padding: 15px 30px;
			border-radius: 5px;
			cursor: pointer;
			margin: 190px 50px;
			box-shadow: 3px 3px 3px #000;
			display: inline-block;
			vertical-align: middle;
			text-decoration: none;
		}
		
		button:hover {
			background-color: #7FFFD4;
		}

    a {
      color: #20B2AA;
      text-decoration: none;
    }
		
	</style>
</head>
<body>
	
	<h1>Parking Master</h1>
	<button><a href="userHome.php">User Mode</a></button>
	<button><a href="adminHome.php">Admin Mode</a></button>
</body>
</html>
