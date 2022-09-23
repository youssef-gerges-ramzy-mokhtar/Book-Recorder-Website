"use strict"

// We check that if the length of genreData is zero that means that there is no data to display the Pie Chart
if(genreData.length != 0) {
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   
   // drawChart is used to draw the Pie Chart using the data from the genreData array
   function drawChart() {
      const data = new google.visualization.DataTable();
   
      data.addColumn('string', 'Book Title');
      data.addColumn('number', 'Number of Pages');
      
      // We Loop over the genreData array and add the genre and number of books per each genre
      for(let i = 0; i < genreData.length; i++) {
         data.addRow([genreData[i][0], genreData[i][1]]);
      }
   
   
      // We define some options for the Piece Chart
      const options = {
         title:"Types of Genres",
         position: "left",
         fontSize: 20,
         titleTextStyle: {
            fontSize: 25,
            bold: true,
         },
         width:990, 
         height:660
      };
   
      // We create a new Pie Chart and it will be displayed in the div with id pieChart
      const chart = new google.visualization.PieChart(document.getElementById('chart_div'));

      // We create the Pie Chart using the data and options
      chart.draw(data, options);
   }
}

///////////////////////// Here we display the Number of Books and the Total Number of Pages /////////////////////////

// We will display the number of books and the total number of pages in the div with id num_pages
const num_pages = document.getElementById('num_pages');

// We check that the totalPages and numBooks variables are set, and if they are set we display them in the div with id num_pages
if (totalPages && numBooks) num_pages.textContent = `You Have ${numBooks} Books and ${totalPages} Pages to Read, Keep it Up! 💪`; 
// If one of the 2 variables is not set we display that there is no Books to read
else num_pages.textContent = `You Don't have any books to read! 🤷‍`;