async function init() {
    $('#sign-in').on('click',async function (event) {
        event.preventDefault();
        let reqBody = {
            username: $("#username").val(),
            password: $("#password").val(),
        }
        let response = await doPost("../../backend/login/index.php",reqBody)
        if(response && !!response["StudentID"]){
            sessionStorage["UserType"] = 'Student';
            sessionStorage["ID"] = response["StudentID"];
            location.replace("student-profile.html");
            return;
        }
        if(response && !!response["TutorID"]){
            sessionStorage["UserType"] = 'Tutor';
            sessionStorage["ID"] = response["TutorID"];
            location.replace("tutor-profile.html");
            return;
        }
        alert("invalid credential");
    })
}
function answer(id){
    alert("answer:" + id );

}
$(document).ready(async function () {
    init();
})