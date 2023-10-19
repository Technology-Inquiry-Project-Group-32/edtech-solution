async function init() {
    let questionStats = await doGet("../../backend/question/list.php");
    let tableHTML = `<table class="table table-striped table-bordered">
<thead>
            <tr>
                <th scope="col">Question ID</th>
                <th scope="col">Question</th>
                <th scope="col">Tutor ID</th>
                <th scope="col">Tutor First Name</th>
                <th scope="col">Time Taken To Answer (s)</th>
            </tr></thead>`;
    tableHTML += ('<tbody>' + (questionStats.map(x => `<tr><td scope="row">${x.QuestionID}</td><td>${x.Question}</td><td>${x.TutorID}</td><td>${x.FirstName}</td><td>${Math.ceil(x.TimeTakenToAnswer/1000)}</td></tr>`).join("\n")) + '</tbody>');
    $("#questionTable").html(tableHTML);
    let questionPerSessionStats = await doGet("../../backend/question/persession.php");
    let perSessionTableHTML = `<table class="table table-striped table-bordered">
<thead>
            <tr>
                <th scope="col">Session ID</th>
                <th scope="col">Subject</th>
                <th scope="col">Number of Questions</th>
            </tr></thead>`;
    perSessionTableHTML += ('<tbody>' + (questionPerSessionStats.map(x => `<tr><td scope="row">${x.SessionID}</td><td>${x.Subject}</td><td>${x.num_questions}</td></tr>`).join("\n")) + '</tbody>');
    $("#questionPerSessionTable").html(perSessionTableHTML);
}
$(document).ready(async function () {
    init();
})