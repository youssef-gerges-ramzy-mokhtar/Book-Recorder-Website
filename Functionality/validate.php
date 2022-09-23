<?php
   // Validate contains some function used to validate User Input

   // assign_data() is used to escape the user input and change html special characters to HTML Entities
   function assign_data($conn, $var) {
      return $conn->real_escape_string(htmlspecialchars($_POST[$var]));
   }

   // validText() checks if the user inputted a valid Text
   // It checks if the string the user inputted is empty, or if the length of the string is morethan 255 characters
   // and we check that the Genre and the Author input fields don't contain numbers
   function validText($str, $fieldType) {
      if (empty($str)) {
         echo "<div class='error_msg'>$fieldType is Empty</div>";
         return false;
      }

      if (strlen($str) > 255) {
         echo "<div class='error_msg'>$fieldType too long: Please don't use more than 255 characters</div>";
         return false;
      }

      if (($fieldType != "Title" && $fieldType != "title") && preg_match_all('/\d+/', $str)) {
         echo "<div class='error_msg'>$fieldType cannot contain numbers</div>";
         return false;
      }

      return true;
   }

   // validNum() checks if the user inputted a valid Number
   // It checks if the numPages Input field is empty, and it checks if the number contains any non-numeric digits
   // Also we check if the number is larger than 10,000 or if the number is zero or negative
   function validNum($num) {
      if (empty($num)) {
         echo "<div class='error_msg'>Number of Pages is Empty</div>";
         return false;
      }
      
      if (!ctype_digit($num)) {
         echo "<div class='error_msg'>Please Enter a Valid Number</div>";
         return false;
      }
      
      $number = (int) $num;
      if ($number > 10000) {
         echo "<div class='error_msg'>The Number of Pages is too long.</div>";
         return false;
      }
      
      if ($number <= 0) {
         echo "<div class='error_msg'>The Number of Pages cannot be Zero or Negative.</div>";
         return false;
      }

      return true;
   }

   // validDate() checks if the user inputted a valid Date
   // It checks if the releaseDate Input Field is empty, and it checks if the date is in the correct format
   function validDate($date) {
      if (empty($date)) {
         echo "<div class='error_msg'>Release Date is Empty</div>";
         return false;
      }

      if (!validateDate($date)) {
         echo "<div class='error_msg'>Please Input a Valid Date</div>";
         return false;
      }

      return true;
   }

   // validateDate() checks that the date is in the correct format
   function validateDate($date) {
      // The Date Format in SQL is YYYY-MM-DD

      // We take the input staring and remove all the spaces from it
      $newDate = str_replace(' ', '', $date);

      // We check if the length of the string not equal to 10 then the date is in the wrong format
      if (strlen($newDate) != 10) return false;

      // We split the string into an array of characters
      $dataArr = str_split($newDate);
      $validDate = true;

      // We loop over the first 4 characters to check that they are all numeric characters
      for ($i = 0; $i <= 3; $i++) {
         if (!ctype_digit($dataArr[$i])) {
            $validDate = false;
         }
      }
      
      if ($validDate == false) return false;

      // We check that the 5th character is a dash
      if ($dataArr[4] != "-") return false;
      
      // We add the part of the string representing the year into a separate variable
      $year = substr($newDate, 0, 4);

      // We check that the year is not larger than the current year + 10
      // This means if the user inputted 2034, while he can only input 2022 + 10 = 2023 then it is not a valid date 
      if ($year > (date("Y") + 10)) return false;

      // We loop over the 2 characters after the first dash to check that they are all numeric characters
      for ($i = 5; $i <= 6; $i++) {
         if (!ctype_digit($dataArr[$i])) {
            $validDate = false;
         }
      }
      
      if ($validDate == false) return false;

      // We check that the 8th character is a dash
      if ($dataArr[7] != "-") return false;
      
      // We add the part of the string representing the month into a separate variable
      $month = substr($newDate, 5, 2);

      // We Loop over the over the last 2 characters to check that they are all numeric characters
      for ($i = 8; $i <= 9; $i++) {
         if (!ctype_digit($dataArr[$i])) {
            $validDate = false;
         }
      }

      if ($validDate == false) return false;

      // We add the part of the string representing the day into a separate variable
      $day = substr($newDate, 8, 2);

      // We check that validity of the month day year when they are all combined using the checkdate function
      if (!checkdate($month, $day, $year)) {
         return false;
      }
      
      return true;
   }


?>