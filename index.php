<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Book Traker</title>
   <link rel="stylesheet" href="style.css"></link>
</head>
<body>
   <header>
      <h1>Book Traker</h1>
   </header>

   <!-- Here is the Form That the user uses to add Books to the Table and the DataBase -->
   <form id="addBook" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <input type="text" name="title" placeholder="Book Title" />
      <input type="text" name="author" placeholder="Author" />
      <input type="date" name="releaseDate" placeholder="Release Date" />
      <input type="number" name="numPages" placeholder="Number of Pages" />
      <input type="text" name="genre" placeholder="Genre" />
      <br />
      <input type="submit" value="Add Book" />
   </form>
   
   <!-- Here we require the validate.php, because in case there was erros in the user input it get printed to the user -->
   <?php 
      require "Functionality/validate.php"
   ?>

   <table border="1">
      <caption>Your Books</caption>
      <tr>
         <th>Book Number</th>
         <th>Title</th>
         <th>Author</th>
         <th>Number of Pages</th>
         <th>Release Date</th>
         <th>Genre</th>
         <th>Delete</th>
      </tr>
      
      <!-- Here we require the add, delete and update php files, which are used to provide the Functionality of the Program -->
      <!-- Also we require the loadData file to load the Data from the DataBase and Display it in the Table on the Browser -->
      <?php
         require "Functionality/add.php";
      ?>

      <?php
         require "Functionality/delete.php";
      ?>
      
      <?php
         require "Functionality/edit.php";
      ?>
      
      <?php
         require "Functionality/loadData.php"
      ?>

   </table>
   
   <!-- The Footer is used to provide the Statistics about the Books -->
   <footer>
      <h2>Book Statistics</h2>

      <!-- the div with chart_div id holds the Pie Chart -->
      <div id="chart_div"></div>
   
      <!-- the div with num_pages id holds the total number of pages and the number of books in the table -->
      <div id="num_pages"></div>
   </footer>
   
   
   <!---------------------- Here Goes all the JavaScript Files ----------------------->
   <!-- The script.js file is used to handle user trying to edit data in the table --> 
   <script src="script.js"></script>
   <!-- The Google Charts API is used to create the Pie Chart -->
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

   <!-- The genreData.php file is used to store the Number of Books per Genre in a variable to be used by the statistics.js file -->
   <?php
      require "Statistics/genreData.php";
   ?>

   <!-- The bookInfor.php file is used to store the Number of Books and the Total Number of Pages of all Books in 2 variables to be used by the statistics.js file -->
   <?php
      require "Statistics/bookInfo.php";
   ?> 

   <!-- The statistics.js file is used to create the Pie Chart, and display the Number of Books and the Total Number of Pages -->
   <script src="Statistics/statistics.js"></script>
   
</body>
</html>
   
