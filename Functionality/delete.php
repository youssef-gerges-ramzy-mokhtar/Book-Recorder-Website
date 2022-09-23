<?php
   require "connect.php"; // includes the connect.php to create the connection

   // We Delete a row from the table based on id that is stored in the hidden input field
   // in the form in last TD Element in the TR Element
   if (isset($_POST["bookId"])) {
      $bookId = assign_data($conn, "bookId");
      $query = "DELETE FROM books WHERE bookId = $bookId";
      $result = $conn->query($query);
   
      // If the deletion was not successfull we terminate the execution of this code and print an error message
      // Else we refresh the page
      if (!$result) {
         die("Couldn't Delete the Book, Please Try Again.");
      } else {
         // We Refresh the page, to prevent the confirm for resubmission, which will add the same data to the database
         // when the user refreshes the page, If that was not the case then we don't have to refresh the page to display the data
         // because when submitting a form the page refreshes automatically that is the default behaviro 
         echo "<meta http-equiv='refresh' content='0'>";
      }
   }
?>