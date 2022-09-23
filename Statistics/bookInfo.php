<!--
   This Code is used to get the number of books and total number of pages for all books from the data base 
   and assing these values to javascript variables
-->
<script>
   // We declare 2 javascript variables, and they are automatically assigned to undefined
   let numBooks
   let totalPages

   <?php
      require "Functionality/connect.php"; // includes the connect.php to create the connection

      // We have the first query which selects the sum of the numPages field
      $query = "SELECT SUM(numPages) AS totalNumPages FROM books";
      $result = $conn->query($query);

      // If the query failed we terminate the execution of the program and output an error message
      if (!$result) {
         die("Couldn't Display the Statistics of the Books");
      }

      // We Fetch a result row as an associative array
      $row = $result->fetch_assoc();
      
      // We check that the totalNumPages is set, if it is set then we assign the value of totalNumPages to the variable totalPages
      if ($row["totalNumPages"] != NULL) echo "totalPages = " . $row["totalNumPages"] . ";";

      // We have the second query which selects the count of the books in the DataBase
      $query = "SELECT COUNT(*) AS numBooks FROM books";
      $result = $conn->query($query);

      // If the query faield we terminate the execution of the program and output an error message 
      if (!$result) {
         die("Couldn't Display the Statistics of the Books");
      }

      // We Fetch a result row a san associative array
      $row = $result->fetch_assoc();

      // We check that the numBooks is set, if it is set then we assign the value of numBooks to the variable numBooks
      if ($row["numBooks"] != NULL) echo "numBooks = " . $row["numBooks"] . ";";
   ?>
</script>   