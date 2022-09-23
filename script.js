"use strict"

// We get the title, author, numPages, releaseDate and genre Fileds from the HTML Table
// This gives us an array containing all the data in one field in the HTML Table
const title = document.getElementsByClassName("title")
const author = document.getElementsByClassName("author")
const numPages = document.getElementsByClassName("numPages")
const releaseDate = document.getElementsByClassName("releaseDate")
const genre = document.getElementsByClassName("genre")

// genreateHTMLEditEvent is a function that generates the HTML needed for the user to edit a data value from the HTML Table
// It generates a form with an input field for the user to edit the data value
function generateHtmlEditEvent(inputWidth, inputHeight, value, id, fieldType, typeOfChange) {
   if (typeOfChange != "changeText" && typeOfChange != "changeDate" && typeOfChange != "changeNumber") return ""

   return `
   <form id="editBook" method="post">
      <input name="${typeOfChange}" style="width: ${inputWidth}px; height: ${inputHeight}px" type=${typeOfChange == "changeText" ? "text" : typeOfChange == "changeDate" ? "date" : "number"} value="${value}" />
      <input style="display:none" type='number' name='bookIdChange' value="${id}">
      <input style="display:none" type="text" name="fieldType" value="${fieldType}">
   </form>
   `
}

// handleEdit is a function that handles the user's when they click on any data value on the Table
// and also handle when the user submits the edit that he want
// also it receives the event object and they typeOfEdit as parameters 
function handleEdit(e, typeOfEdit) {
   // We get all the data from the e.target which is the TD Element that the user clicked on
   // We get the width & Height of the TD Element
   // We get the data-id attribute from the TD Element, which holds the id of each record in the HTML Table
   // We get the class attribute from the TD Element, which holds the name of the Field that the user wants to edit
   let width = e.target.clientWidth
   let height = e.target.clientHeight
   let id = e.target.parentElement.getAttribute("data-id")
   let fieldType = e.target.getAttribute("class")
   
   // In case the user clicks on the <abbr> HTML element, we get all the things that are mentioned above but we get the Parent Element of the <abbr> tag which is the TD tag
   if (e.target.tagName == "ABBR") {
      width = e.target.parentElement.clientWidth
      height = e.target.parentElement.clientHeight
      id = e.target.parentElement.parentElement.getAttribute("data-id")
      fieldType = e.target.parentElement.getAttribute("class")
   }
   
   // We create the html that we need to display to the user to edit the data value using the generateHtmlEditEvent function
   const html = generateHtmlEditEvent(
      width,
      height,
      e.target.textContent,
      id,
      fieldType,
      typeOfEdit
   )
   
   
   let parentElement = e.target

   // If the Clicked Element is the TD, we remove all the text in it, and add the value adjust to the class attribute
   // and we insert the html that we created in the TD
   if (e.target.tagName == "TD") {
      e.target.textContent = ""
      e.target.classList.add("adjust")
      e.target.insertAdjacentHTML("afterbegin", html)
   }

   // If the Clicked Element is the <abbr> tag, we repeat all the steps as above but for its parent element which is the TD Tag
   if (e.target.tagName == "ABBR") {
      parentElement = e.target.parentElement
      parentElement.innerHTML = ""
      parentElement.classList.add("adjust")
      parentElement.insertAdjacentHTML("afterbegin", html)
   }

   // If the parentElement doesn't contain children that means that the element is already the input
   // and this means that the user has clicked on the TD Tag, and an input field have appeared and then he clicked 
   // on the input field, which has fired the eventListener
   let input = parentElement
   
   // if the parentElement contains children this means that the parentElement is the TD Tag
   // and the firstChild of the parentElement is the form and the input is the child of the form
   if (parentElement.children[0]) input = parentElement.children[0].children[0]

   // We and focus to the input field
   input.focus()

   // We add an eventListener to the input field on losing focus
   input.addEventListener("blur", function(e) {
      // we get the parent Element of the input field which is the form and then submit it
      const form = e.target.parentElement
      form.submit()
   })
}

// We add the title, author and genre arrays in a single array called cellsText
const cellsText = [title, author, genre]


// We Loop over each cell in the cellsText array and add an eventListener on clicking on the cell
for (let i = 0; i < cellsText.length; i++) {
   for (let j = 0; j < cellsText[0].length; j++) {
      cellsText[i][j].addEventListener("click", function(e) {
         handleEdit(e, "changeText")
      })
   }
}

// We Loop over the releseaDate array and add an eventListener on clicking on the cell
for (let i = 0; i < releaseDate.length; i++) {
   releaseDate[i].addEventListener("click", function(e) {
      handleEdit(e, "changeDate")
   })
}

// We Loop over the numPages array and add an eventListener on clicking on the cell
for (let i = 0; i < numPages.length; i++) {
   numPages[i].addEventListener("click", function(e) {
      handleEdit(e, "changeNumber")
   })

}