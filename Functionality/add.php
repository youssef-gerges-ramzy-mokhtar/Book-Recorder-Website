<?php
   require "connect.php"; // includes the connect.php to create the connection

   if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["releaseDate"]) && isset($_POST["numPages"]) && isset($_POST["genre"]) && !isset($_SESSION['showform'])) {
      
      $title = assign_data($conn, "title");
      $author = assign_data($conn, "author");
      $releaseDate = assign_data($conn, "releaseDate");
      $numPages = assign_data($conn, "numPages");
      $genre = assign_data($conn, "genre");

      // We Run the validText(), validDate(), validNum() to validate the user input
      // I've added each function call to a variable, because in case there was more than one error all the error messages display to the user
      // Because if I have combined all the function calls in one variable then the condition will short circuit after any function return false and the rest of the function calls wouldn't be called
      $validTitle = validText($title, "Title");
      $validAuthor = validText($author, "Author");
      $validReleaseDate = validDate($releaseDate);
      $validNumPages = validNum($numPages);
      $validGenre = validText($genre, "Genre");

      $validInput = $validTitle && $validAuthor && $validReleaseDate && $validNumPages && $validGenre;

      // If all the User Input is valid we add the user input to the DataBase
      if ($validInput) {
         $query = "INSERT INTO books (title, author, genre, numPages, releaseDate) VALUES ('$title', '$author', '$genre', $numPages, '$releaseDate')";
         $result = $conn->query($query);
   
         // We check if the data was added successfully
         // If the data was not added succesfully we terminate the exectuion of this code and print an error message
         // Else we refresh the page
         if (!$result) {
            die("Couldn't Add the Book, Pleaes Try Again.");
         } else {
            // We Refresh the page, to prevent the confirm for resubmission, which will add the same data to the database
            // when the user refreshes the page, If that was not the case then we don't have to refresh the page to display the data
            // because when submitting a form the page refreshes automatically that is the default behaviro 
            echo "<meta http-equiv='refresh' content='0'>";
         }
      }

   }

?>