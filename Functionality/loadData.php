<?php
   require "connect.php"; // includes the connect.php to create the connection

   // Select All from the table books and display the results
   $query = "SELECT * FROM books";
   $result = $conn->query($query);

   // If the query failed we terminate the execution of this code and print an error message
   if (!$result) {
      die("There was a Problem when Loading the Page, Pleaes Try Again Later");
   }

   // We Loop over the results one row at a time
   // And print the row as an entry in the Table Row Element
   // Also the abbr element is used to provide an abbreviation when hovering over an element
   $i = 1;
   while ($row = $result->fetch_assoc()) {
      echo "<tr data-id = ". $row['bookId'] .">";
         echo "<td>$i</td>";
         echo "<td class='title'><abbr title='Edit Book Title'>" . $row["title"] . "</abbr></td>";
         echo "<td class='author'><abbr title='Edit Author'>" . $row["author"] . "</abbr></td>";
         echo "<td class='numPages'><abbr title='Edit Number of Pages'>" . $row["numPages"] . "</abbr></td>";
         echo "<td class='releaseDate'><abbr title='Edit Book Release Date'>" . $row["releaseDate"] . "</abbr></td>";
         echo "<td class='genre'><abbr title='Edit Book Genre'>" . $row["genre"] . "</abbr></td>";
         echo "<td>
                  <form class='delete' method='POST'>
                     <input type='number' name='bookId' value=".$row['bookId'].">
                     <input type='submit' value='delete'>
                  </form>
               </td>";
      echo "</tr>";
      
      $i++;
   }



?>