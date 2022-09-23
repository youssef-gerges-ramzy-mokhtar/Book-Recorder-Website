<?php
   require "connect.php"; // includes the connect.php to create the connection

   // We check that the values in the input field, that is releated to text fields, that appeared to the user when editing a data field is set
   if (isset($_POST["bookIdChange"]) && isset($_POST["changeText"]) && isset($_POST["fieldType"])) {
      $bookId = assign_data($conn, "bookIdChange");
      $changeText = assign_data($conn, "changeText");
      $fieldTypeText = assign_data($conn, "fieldType");


      // We check that the fieldTypeText is not the numPages and not the releaseDate fields
      // This is in case the user changed the script file from the developer tools in the browser
      if ($fieldTypeText != "numPages" && $fieldTypeText != "releaseDate") {
         // We check the validity of the user input and use the updateReuslt() function to update the value in the DataBase
         if (validText($changeText, $fieldTypeText)) {
            updateResult($bookId, rtrim(ltrim($changeText)), $fieldTypeText, $conn);
         }
      }
   }

   // We check that the values in the input field, for changing the release Date, that appeared to the user when editing a data field is set
   if (isset($_POST["bookIdChange"]) && isset($_POST["changeDate"]) && isset($_POST["fieldType"])) {
      $bookId = assign_data($conn, "bookIdChange");
      $changeDate = assign_data($conn, "changeDate");
      $fieldTypeDate = assign_data($conn, "fieldType");
      
      // We Check that the fieldTypeDate represent the releaseDate field
      // This is in case the user changed the script file from the developer tools in the browser
      if ($fieldTypeDate == "releaseDate") {
         // We check the validity of the user input and use the updateReuslt() function to update the value in the DataBase
         if (validDate($changeDate)) {
            updateResult($bookId, rtrim(ltrim($changeDate)), $fieldTypeDate, $conn);
         }
      }
   }

   // We check that the values in the input field for changing the numPages that appeared to the user when editing a data field is set
   if (isset($_POST["bookIdChange"]) && isset($_POST["changeNumber"]) && isset($_POST["fieldType"])) {
      $bookId = assign_data($conn, "bookIdChange");
      $changeNumber = assign_data($conn, "changeNumber");
      $fieldTypeNumber = assign_data($conn, "fieldType");

      // We Check that the fieldTypeDate represent the numPages field
      // This is in case the user changed the script file from the developer tools in the browser
      if ($fieldTypeNumber == "numPages") {
         // We check the validity of the user input and use the updateReuslt() function to update the value in the DataBase
         if (validNum($changeNumber)) {
            updateResult($bookId, rtrim(ltrim($changeNumber)), $fieldTypeNumber, $conn);
         }
      }
   }

   // updateResult() is a function that takes the bookId, the new value that needs to be changed, the field that will be changed
   // and the connection object to the database
   function updateResult($id, $newText, $fieldType, $conn) {
      // We update the field to the newText where the bookId is equal to the id
      $query = "UPDATE books SET $fieldType = '$newText' WHERE bookId = $id";
      $result = $conn->query($query);

      
      // We check if the data was changed successfully
      // If the data was not changed succesfully we terminate the exectuion of this code and print an error message
      // Else we refresh the page
      if (!$result) {
         die("Failed to Update the Book! Please Try Again.");
      } else {
         // We Refresh the page, to prevent the confirm for resubmission, which will add the same data to the database
         // when the user refreshes the page, If that was not the case then we don't have to refresh the page to display the data
         // because when submitting a form the page refreshes automatically that is the default behaviro 
         echo "<meta http-equiv='refresh' content='0'>";
      }

   }
?>