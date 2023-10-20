
"use strict";


function checkAttendance(){ 
    var checkattendance = document.getElementById("checkattendance");
    let id = sessionStorage["ID"]
    if (sessionStorage["attendanceChecked-"+id] === "true") {
        return;                                                                             // Do nothing if the button is already checked
    }                                                                                       // check attendance of the user  
    checkattendance.innerText= "Already checked";                                                   // Change to already checked
    sessionStorage["attendanceChecked-"+id] = "true";
    checkattendance.disable = true;                                 
}


function init(){
    var checkattendance = document.getElementById("checkattendance");
    checkattendance.onclick = checkAttendance;
    let id = sessionStorage["ID"]
    if (sessionStorage["attendanceChecked-"+id] === "true"){
        checkattendance.disabled = true;
        checkattendance.innerText = "Already checked";
    }    
    
    var selectedSubject = sessionStorage.getItem("selectedSubject");
    document.getElementById("sessionContent").textContent = selectedSubject;
    document.getElementById("sessionid").value = selectedSubject;
    document.getElementById("sessionid1").value = selectedSubject;
    document.getElementById("student-greeting").innerText = "Hello " + sessionStorage["ID"];
    document.getElementById("studentid").value = sessionStorage["ID"];
}


window.addEventListener("load", init);

