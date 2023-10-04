
<html>
<body>
<?php
echo phpversion();
?>
<script>
    //create
    let data = {
        "answer": "answer",
        "timeTakenToAnswer": 123,
        "tutorId": "TUT1234567",
        "questionId": "QST1234567"
    };
    fetch("answer/", {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    }).then(async res => {
        console.log("Request complete! response:", await res.json());
    });
    //update
    let data = {
        "id" : "ANS6426667",
        "answer": "ANS6426667",
        "timeTakenToAnswer": 123,
        "tutorId": "TUT1234567",
        "questionId": "QST1234567"
    };
    fetch("answer/", {
        method: "PUT",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    }).then(async res => {
        console.log("Request complete! response:", await res.json());
    });
    //get by id;
    fetch("answer/?id=ANS6426715", {
        method: "GET",
        headers: {'Content-Type': 'application/json'},
    }).then(async res => {
        console.log("Request complete! response:", await res.json());
    });
    //get all
    fetch("answer/", {
        method: "GET",
        headers: {'Content-Type': 'application/json'},
    }).then(async res => {
        console.log("Request complete! response:", await res.json());
    });
    //delete by id;
    fetch("answer/?id=ANS6426715", {
        method: "DELETE",
        headers: {'Content-Type': 'application/json'},
    }).then(async res => {
        console.log("Request complete! response:", await res.json());
    });
</script>
</body>
</html>