
"use strict";


function checkAttendance(){ 
    var checkattendance = document.getElementById("checkattendance");     
    if (sessionStorage.attendanceChecked === "true") {
        return;                                                                             // Do nothing if the button is already checked
    }                                                                                       // check attendance of the user  
    checkattendance.innerText= "Already checked";                                                   // Change to already checked
    sessionStorage.attendanceChecked = "true";               
    checkattendance.disable = true;                                 
}


function init(){
    var checkattendance = document.getElementById("checkattendance");
    checkattendance.onclick = checkAttendance;
    if (sessionStorage.attendanceChecked == "true"){
        checkattendance.disabled = true;
        checkattendance.value = "Already checked";
    }    
    
    var selectedSubject = sessionStorage.getItem("selectedSubject");
    document.getElementById("sessionContent").textContent = selectedSubject;
}


window.addEventListener("load", init);

