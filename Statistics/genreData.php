<!--
   This Code is used to get the genre and the number of times it is present in the DataBase
   and assign the these values to a javascript variable, and the values will be stored as a 2D Array
-->

<script>
   let genreData;
   
   <?php
      require "Functionality/connect.php"; // includes the connect.php to create the connection

      // We Count the all the Books and group them by the genre
      // So we will have the count of books for each genre
      $query = "SELECT genre, COUNT(*) AS genreCount FROM books GROUP BY genre";
      $result = $conn->query($query);
   
      // If the query failed we terminate the execution of the program and output an error message
      if (!$result) {
         die("Couldn't Display the Statistics of the Books");
      }

      // We add an open bracket [ to indicate that genreData variable will be an array
      echo "genreData = [";
      
      // We Loop over the result and keep fetching the result row as an associative array 
      while ($row = $result->fetch_assoc()) {
         // We add to the genreData an array of 2 elements, in the following format
         // ['genreName', genreCount], 
         echo "['" . $row["genre"] . "', " . $row["genreCount"] . "],";
      }

      // We add a closing bracket ] to indate that we have filled the array
      echo "];";
   ?>
</script>