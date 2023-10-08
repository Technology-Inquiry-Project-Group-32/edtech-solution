async function getTutorInfo() {
    var id = sessionStorage["userid"];
    if (true) {
        let tutorInfo = await doGet("../../backend/answer");
        console.log(tutorInfo);
        document.getElementById("temp").innerHTML = tutorInfo.map(answer => `<li id="${answer.AnswerID}">${answer.Answer} <a class="btn btn-primary" onclick="answer(${answer.ID})">Answer</a></li>`)
    } else {
        alert('Please login')
        location.replace('login.html');
    }
}
function answer(id){
    alert("answer:" + id );

}
$(document).ready(async function () {
    const tutorInfo = await getTutorInfo();
    getAnswers();
    getSessions();
})