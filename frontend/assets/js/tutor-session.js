

async function answer(tutorID,questionID) {
    let answer = $(`#answer-${questionID}-text-area`).val();
    let answerPosted = await doPost("../../backend/answer/index.php", {
        answer: answer,
        timeTakenToAnswer: 10000,
        tutorId: tutorID,
        questionId: questionID
    });
    if(answerPosted){
        alert("answer successfully")
        await getQuestions();
    }else{
        alert("answer unsuccessfully")
        await getQuestions();
    }
}
async function getQuestions() {
    if (sessionStorage["UserType"] === "Tutor") {
        let tutorInfo = await doGet("../../backend/tutor/index.php",{id: sessionStorage["ID"]});
        if(!tutorInfo || tutorInfo.length === 0){
            alert('Please login')
            location.replace('login.html');
            return;
        }
        let tutor = tutorInfo[0];
        var urlParams = new URLSearchParams(window.location.search);
        if(!urlParams.has('sessionID')){
            alert("invalid session id");
            location.replace('tutor-profile.html');
            return;
        }
        let sessionID = urlParams.get("sessionID")
        let sessions = await doGet("../../backend/session/index.php",{id: sessionID});
        if(!sessions || sessions.length === 0){
            alert("invalid session id");
            location.replace('tutor-info.html');
            return;
        }
        let session = sessions[0];
        let questions = await doGet("../../backend/question/session.php",{id: sessionID});

        $("#tutor-name").text(tutor.Firstname);
        if(questions && questions.length > 0){
            $("#question-list").html(questions.map(value => `<li class="d-flex mb-4 pb-1">
                                                                <div class="card accordion-item active d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <h2 class="accordion-header" id="question-${value.QuestionID}" style="width: 100%;">
                        <button
                          type="button"
                          class="accordion-button"
                          data-bs-toggle="collapse"
                          data-bs-target="#answer-${value.QuestionID}"
                          aria-expanded="true"
                          aria-controls="answer-${value.QuestionID}"
                        >
                          ${value.Question}
                        </button>
                      </h2>

                      <div
                        id="answer-${value.QuestionID}"
                        class="accordion-collapse collapse"
                        data-bs-parent="#question-${value.QuestionID}"
                        style="width: 100%;"
                      >
                        <div class="accordion-body">
                          <label for="answer-${value.QuestionID}-text-area" class="form-label">Answer</label>
                        <textarea style="resize: none;" class="form-control" id="answer-${value.QuestionID}-text-area" rows="5"></textarea>
                        <button id="answer-${value.QuestionID}-btn" class="btn btn-primary" onclick="answer('${tutor.TutorID}','${value.QuestionID}')">Answer</button>
                        </div>
                      </div>
                    </div>

                                        </li>`).join(""))

        }
        let answers = await doGet("../../backend/answer/tutor.php",{id: tutor.TutorID});
        if(!answers){
            answers = [];
        }
        for(let i = 0 ; i < answers.length; i++){
            let questionID = answers[i].QuestionID;
            if(!!questionID){
                $(`#answer-${questionID}-text-area`).val(answers[i].Answer);
                $(`#answer-${questionID}-text-area`).prop('readonly',true);
                $(`#answer-${questionID}-btn`).hide();
            }
        }
    } else {
        alert('Please login')
        location.replace('login.html');
    }
}

$(document).ready(async function () {
   await getQuestions();
})