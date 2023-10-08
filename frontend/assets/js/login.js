async function init() {
    $('#sign-in').onsubmit(async function (event) {
        let reqBody = {
            username: $("#username").val(),
            password: $("#password").val(),
        }
        let response = await doPost("../../backend/login",reqBody)
        if(!!response["StudentID"]){
            sessionStorage["UserType"] = 'Student';
            sessionStorage["ID"] = response["StudentID"];
            location.replace("student-profile.html");
        }
        if(!!response["TutorID"]){
            sessionStorage["UserType"] = 'Tutor';
            sessionStorage["ID"] = response["TutorID"];
            location.replace("tutor-profile.html");
        }
    })
}
function answer(id){
    alert("answer:" + id );

}
$(document).ready(async function () {
    init();
})