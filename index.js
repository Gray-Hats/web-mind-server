const express = require('express');
const fileUpload = require('express-fileupload');

const app = express();
const cors = require('cors');
const config = require('./config');

const initUsers = require('./db/users');

const initSubject = require('./db/subjects');
const initStudent = require('./db/students');
const initLesson = require('./db/lessons');
const initActivity = require('./db/activities');
const initGrades = require('./db/grades');

const initMessages = require('./db/messages');
const initPost = require('./db/post');
const initNotification = require('./db/notifications');

const initStorage = require('./cloud/Storage');

const http = require('http').createServer(app);

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ 
    extended: true
}));
app.use(fileUpload());

/*
* PORT
*/
// app.listen(config.port, () => {
//     console.log("Webmind server is running...");
// })

const io = require("socket.io")(http);

http.listen(config.port,() => {
    console.log("Successfully Connected Node Server");
    
     io.on("connection", function(socket){
        console.log(socket)
    
        socket.on("sendNotification", function(details){
            socket.broadcast.emit("sendNotification", details);
        });
    });
});

initUsers(app);

initSubject(app);
initStudent(app);
initLesson(app);
initActivity(app);
initGrades(app);

initMessages(app);
initPost(app);
initNotification(app);

initStorage(app);