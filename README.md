
This is a reservation system for parking garages. Users can search for their reservations by phone number and cancel them if they are at least three days in advance. The system retrieves reservation details from a MySQL database, and updates the status of canceled reservations. Administrator can query the available spots and revenue from a garage on given date. The system uses PHP for the server-side scripting and HTML/CSS for the user interface.






To install / run the application, download the provided .php files (Group_3_PHP_Files) and place them in your already existing php directory, being sure to delete your index.php if one exists. Simply cd to the directory and run “php -S localhost:8080”. Alternatively, you can download the provided php directory (Group_3_PHP_DIR) as a whole and cd to the directory and run “php -S localhost:8080”. 

index.php:
This file is the homepage for our application. There are two modes, one is for user, the other one is for administrator. 

confirmation.php: 
It is a PHP script that processes form submissions from a parking reservation system. It connects to a MySQL database, checks if a reservation exists but cancelled for a given garage, date, and phone number, and either updates the status of the existing reservation to "successful" or creates a new reservation entry.

If the reservation information is valid and has been successfully created or updated in the database, the script displays a message indicating the success and provides a button that links back to the user's homepage.

createReservation.php: 
This file appears to be a webpage with a form for reserving a parking spot in a garage. It includes HTML and CSS code for styling, and PHP code for processing the form data and querying a MySQL database to check availability and calculate the price of the reservation.

When a user submits the form with their chosen garage and date, the PHP code connects to the database and checks if there is specific date information for the selected garage and date. If there is, it retrieves the total number of spots available for reservation, calculates the revenue for the garage based on the number of spots already taken, and displays this information along with a form for the user to enter their phone number and reserve a spot.

If there is no specific date information for the selected garage and date, the PHP code retrieves default price and maximum space values for the garage from the database and follows the same process for displaying the reservation form. If there are no spots available, a message is displayed indicating that no availability was found.

adminHome.php:
This page displays information about garages, and allow admin to choose a date and check available spots and revenue. It sends data of chosen date to garagestatus.php for processing.

garageStats.php:
This file displays information about a parking garage based on user input for the garage name and date. The PHP code connects to a database and retrieves information about the garage and displays it on the page, including the price, number of available spots, and revenue. If there is missing or incorrect information, an error message is displayed along with a button to return to the home page.


reservation.php:
This page allows users to view and cancel their reservations. When a user enters their phone number and submits the form, the PHP code connects to a MySQL database and retrieves any reservations associated with that phone number. It then displays a table of those reservations, along with a checkbox next to each one to allow the user to select which reservations to cancel.

When the user clicks the "Cancel Selected Reservations" button, the PHP code checks which reservations were selected and cancels them in the database if they are at least three days in advance. The user is then notified of the status of their cancellations.
![image](https://github.com/XinlingWang0628/Parking-Database-Management-System/assets/105673895/d3962d01-8f47-49bf-970a-9fae6775c5bf)
