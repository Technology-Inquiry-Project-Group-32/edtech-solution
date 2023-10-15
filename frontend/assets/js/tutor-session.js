async function answer(tutorID, questionID, timeToAnswer) {
    let answer = "";
    let answerPosted = await doPost("../../backend/answer/index.php", {
        answer: answer,
        timeTakenToAnswer: timeToAnswer,
        tutorId: tutorID,
        questionId: questionID
    });
    if (answerPosted) {
        await getQuestions();
    } else {
        alert("answer unsuccessfully")
        await getQuestions();
    }
}
var answerTime = {};
function getPostedDate(questionId) {
    return (new Date((Math.floor((new Date()).getTime() / 10000000000) * 10000000 + parseInt(questionId.substring(2))) * 1000)).toString().substring(0,24);
}

async function getQuestions() {
    if (sessionStorage["UserType"] === "Tutor") {
        let tutorInfo = await doGet("../../backend/tutor/index.php", {id: sessionStorage["ID"]});
        if (!tutorInfo || tutorInfo.length === 0) {
            alert('Please login')
            location.replace('login.html');
            return;
        }
        let tutor = tutorInfo[0];
        const urlParams = new URLSearchParams(window.location.search);
        let sessionID = urlParams.get("sessionID")
        $('#session-name').text(sessionID)
        let questions = await doGet("../../backend/question/session.php", {id: sessionID});
        questions.sort((q1,q2) => q1.QuestionID > q2.QuestionID ? -1 : 1)
        $("#tutor-name").text(tutor.Firstname);
        if (questions && questions.length > 0) {
            $("#question-list").html(questions.map(value => `<a
                            href="javascript:void(0);"
                            class="list-group-item list-group-item-action flex-column align-items-start"
                          >
                            <div class="d-flex justify-content-between w-100">
                              <h6>${value.Question}</h6>
                              <small>Posted at: ${getPostedDate(value.QuestionID)}</small>
                            </div>
                            <div class="mb-1">
                               <p id="answered-${value.QuestionID}" style="display: none;">Answered</p>
                               <p id="answered-time-${value.QuestionID}" style="display: none;"></p>
                              <button id="start-answer-btn-${value.QuestionID}" class="btn btn-primary btn-sm" onclick="startAnswer('${value.QuestionID}')">Start Answer</button>
                              <button id="stop-answer-btn-${value.QuestionID}" class="btn btn-primary btn-sm" style="display: none;" onclick="stopAnswer('${value.QuestionID}','${tutor.TutorID}')">Finish Answer</button>
                            </div>
                          </a>`).join(""))
        }
        let answers = await doGet("../../backend/answer/tutor.php", {id: tutor.TutorID});
        if (!answers) {
            answers = [];
        }
        for (let i = 0; i < answers.length; i++) {
            let questionID = answers[i].QuestionID;
            if (!!questionID) {
                $(`#answered-${questionID}`).show();
                $(`#answered-time-${questionID}`).show();
                $(`#answered-time-${questionID}`).text("Time to answer: "+ Math.ceil(parseInt(answers[i].TimeTakenToAnswer) / 1000) + "s");
                $(`#start-answer-btn-${questionID}`).hide();
                $(`#stop-answer-btn-${questionID}`).hide();
            }else{
                $(`#answered-${questionID}`).hide();
                $(`#answered-time-${questionID}`).hide();
                $(`#start-answer-btn-${questionID}`).show();
                $(`#stop-answer-btn-${questionID}`).hide();
            }
        }
    } else {
        alert('Please login')
        location.replace('login.html');
    }
}
function startAnswer(questionID){
    answerTime[questionID] = Date.now();
    $(`#start-answer-btn-${questionID}`).hide();
    $(`#stop-answer-btn-${questionID}`).show();
}
function stopAnswer(questionID, tutorID){
    let startAnswerTime = answerTime[questionID];
    let stopAnswerTime = Date.now();
    answer(tutorID,questionID,stopAnswerTime-startAnswerTime)
    $(`#start-answer-btn-${questionID}`).hide();
    $(`#stop-answer-btn-${questionID}`).show();
}
$(document).ready(async function () {
    await getQuestions();
})