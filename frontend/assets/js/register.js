async function init() {
    $('#sign-up').on('click',(async function (event) {
        event.preventDefault();
        let reqBody = {
            username: $("#username").val(),
            password: $("#password").val(),
            lastname: $("#lastname").val(),
            firstname: $("#firstname").val(),
            usertype: $("#usertype").val(),
            contact: $("#contact").val(),
        }
        let response = await doPost("../../backend/register/index.php",reqBody)
        if(!!response["StudentID"]){
            sessionStorage["UserType"] = 'Student';
            sessionStorage["ID"] = response["StudentID"];
            location.replace("login.html");
        }
        if(!!response["TutorID"]){
            sessionStorage["UserType"] = 'Tutor';
            sessionStorage["ID"] = response["TutorID"];
            location.replace("login.html");
        }
        alert(response.errorMessage);
    }))
}
function answer(id){
    alert("answer:" + id );

}
$(document).ready(async function () {
    init();
})