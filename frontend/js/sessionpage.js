/*  
* Author: Cao Tuan Luong
* Target: sessionpage.html
* Purpose: for sessionstorage
*/


    document.addEventListener("DOMContentLoaded", function () {
    // Add a click event listener to the "Enter Session" button
    const enterSessionButton = document.getElementById("enterSessionButton");
    enterSessionButton.addEventListener("click", function () {
      // Get the current date and format it as "ddmmyy"
      const currentDate = new Date();
      const day = String(currentDate.getDate()).padStart(2, '0');
      const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Month is 0-based
      const year = String(currentDate.getFullYear()).slice(-2); // Get the last 2 digits of the year

      // Format the date as "ddmmyy"
      const formattedDate = day + month + year;

      // Store the formatted date in session storage
      sessionStorage.setItem("sessionid", formattedDate);
      sessionStorage.setItem("selectedSubject", formattedDate);
    
    });
  });