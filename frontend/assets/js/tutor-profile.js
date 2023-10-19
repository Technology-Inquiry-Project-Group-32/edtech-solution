function getSessionToday() {
    const currentDate = new Date();
    const day = String(currentDate.getDate()).padStart(2, '0');
    const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Month is 0-based
    const year = String(currentDate.getFullYear()).slice(-2); // Get the last 2 digits of the year

    // Format the date as "ddmmyy"
    const formattedDate = day + month + year;
    return {
        SessionID: formattedDate,
        Date: `${currentDate.getFullYear()}-${month}-${day}`,
        now: true,
    }
}

async function getTutorInfo() {
    if (sessionStorage["UserType"] === "Tutor") {
        let tutorInfo = await doGet("../../backend/tutor/index.php",{id: sessionStorage["ID"]});
        if(!tutorInfo || tutorInfo.length === 0){
            alert('Please login')
            location.replace('login.html');
            return;
        }
        let sessions = await doGet("../../backend/session/index.php");
        sessions.push(getSessionToday())
        sessions.sort((a,b) => a.Date > b.Date ? 1 : -1);
        sessions = sessions.map(s => {
            return {
                ...s,
            }
        })
        console.log(tutorInfo);
        let tutor = tutorInfo[0];
        $("#tutor-name").text(tutor.Firstname);
        $("#greeting").text(`Hello ${tutor.Firstname}!`);
        $("#upcoming-sessions-list").html(sessions.map(value => `<li class="d-flex mb-4 pb-1">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <p class="text-muted d-block mb-1">${value.Date}</p>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    ${value.now ? `<span class="badge bg-success">Now</span>
                                                    <button type="button" onclick="location.href = 'tutor-session.html?sessionID=${value.SessionID}'" class="btn rounded-pill btn-icon btn-outline-primary">
                                                        <span class="tf-icons bx bx-window-open"></span>
                                                    </button>` : ''}
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