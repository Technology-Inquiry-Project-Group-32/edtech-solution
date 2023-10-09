/*  
* Author: Cao Tuan Luong
* Target: sessionpage.html
* Purpose: for sessionstorage
*/

  document.addEventListener("DOMContentLoaded", function () {
    // Get references to the list group items
    const listItems = document.querySelectorAll(".list-group-item");

    // Store the selected subject
    let selectedSubject = "";

    // Add a click event listener to each list item
    listItems.forEach(function (item) {
      item.addEventListener("click", function () {
        selectedSubject = item.textContent.trim() + "777"; // Append "777" to the subject
      });
    });

    // Add a click event listener to the "Enter Session" button
    const enterSessionButton = document.getElementById("enterSessionButton");
    enterSessionButton.addEventListener("click", function () {
      // Store the selected subject in session storage
      sessionStorage.setItem("selectedSubject", selectedSubject);
    });
  });
