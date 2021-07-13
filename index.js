const express = require('express');
const app = express();
const cors = require('cors');
const config = require('./config');

const initUsers = require('./db/users');
const initSubject = require('./db/subjects');
const initStudent = require('./db/students');
const initLesson = require('./db/lessons');
const initTask = require('./db/tasks');
const initScore = require('./db/scores');

app.use(cors());
app.use(express.json());

/*
* PORT
*/
app.listen(config.port, () => {
    console.log("Server is running...");
})

initUsers(app);
initSubject(app);
initStudent(app);
initLesson(app);
initTask(app);
initScore(app);