async function getTutorInfo() {
    if (sessionStorage["UserType"] === "Tutor") {
        let tutorInfo = await doGet("../../backend/tutor/index.php",{id: sessionStorage["ID"]});
        if(!tutorInfo || tutorInfo.length === 0){
            alert('Please login')
            location.replace('login.html');
            return;
        }
        let sessions = await doGet("../../backend/tutorSession/index.php");
        console.log(tutorInfo);
        let tutor = tutorInfo[0];
        $("#tutor-name").text(tutor.Firstname);
        $("#greeting").text(`Hello ${tutor.Firstname}!`);
        $("#upcoming-sessions-list").html(sessions.map(value => `<li class="d-flex mb-4 pb-1">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <small class="text-muted d-block mb-1">Math</small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <span class="badge bg-success">Now</span>
                                                    <button type="button" onclick="location.href = 'tutor-session.html?sessionID=${value.SessionID}'" class="btn rounded-pill btn-icon btn-outline-primary">
                                                        <span class="tf-icons bx bx-window-open"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>`).join(""))

    } else {
        alert('Please login')
        location.replace('login.html');
    }
}
$(document).ready(async function () {
    const tutorInfo = await getTutorInfo();
    // getAnswers();
    // getSessions();
})