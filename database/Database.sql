CREATE TABLE Student(
    StudentID varchar(10) NOT NULL PRIMARY KEY,
    Firstname varchar(25) NOT NULL,
    Lastname varchar(25) NOT NULL,
    Contact varchar(11),
    Username varchar(10) NOT NULL,
    Password varchar (25) NOT NULL
);

CREATE TABLE Session(
    SessionID VARCHAR(10) NOT NULL PRIMARY KEY,
    Date DATE NOT NULL,
    DayOfWeek VARCHAR(10) NOT NULL
);

CREATE TABLE StudentAttendance(
    AttendanceID VARCHAR (10) NOT NULL PRIMARY KEY,
    StudentID VARCHAR (10) NOT NULL,
    SessionID VARCHAR (10) NOT NULL,
    FOREIGN KEY (StudentID) REFERENCES Student(StudentID),
    FOREIGN KEY (SessionID) REFERENCES Session(SessionID)
);

CREATE TABLE Tutor(
    TutorID VARCHAR(10) NOT NULL PRIMARY KEY,
    Firstname VARCHAR(25) NOT NULL,
    Lastname VARCHAR(25) NOT NULL,
    Contact VARCHAR(25),
    Username VARCHAR(10),
    Password VARCHAR(25)
);

CREATE TABLE TutorSession(
    TutorSessionID VARCHAR(10) NOT NULL PRIMARY KEY,
    TutorID VARCHAR(10) NOT NULL,
    SessionID VARCHAR(10) NOT NULL,
    FOREIGN KEY (TutorID) REFERENCES Tutor(TutorID),
    FOREIGN KEY (SessionID) REFERENCES Session(SessionID)
);

CREATE TABLE SubjectArea(
    SubjectAreaID VARCHAR(10) NOT NULL PRIMARY KEY,
    Subject VARCHAR(20)
);

CREATE TABLE Specialisation(
    SpecialisationID VARCHAR(10) NOT NULL PRIMARY KEY,
    TutorID VARCHAR(10),
    SubjectAreaID VARCHAR(10),
    FOREIGN KEY (TutorID) REFERENCES Tutor(TutorID),
    FOREIGN KEY (SubjectAreaID) REFERENCES SubjectArea(SubjectAreaID)
);

CREATE TABLE Question(
    QuestionID VARCHAR(10) NOT NULL PRIMARY KEY,
    Quesion VARCHAR(225),
    SubjectAreaID VARCHAR(10),
    SessionID VARCHAR(10),
    StudentID VARCHAR(10),
    FOREIGN KEY (StudentID) REFERENCES Student(StudentID),
    FOREIGN KEY (SessionID) REFERENCES Session(SessionID),
    FOREIGN KEY (SubjectAreaID) REFERENCES SubjectArea(SubjectAreaID)
);

CREATE TABLE Answer(
    AnswerID VARCHAR(10) NOT NULL PRIMARY KEY,
    Answer VARCHAR (255),
    TimeTakenToAnswer INT(10),
    TutorID VARCHAR(10),
    QuestionID VARCHAR(10),
    FOREIGN KEY (TutorID) REFERENCES Tutor(TutorID),
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID)
);

