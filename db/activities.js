const db = require("./connection");
const baseUri = "/api/activity";
const UploadFile = require('../cloud/UploadFile');
const DeleteFile = require("../cloud/DeleteFile");

module.exports = initActivity = (app) => {

    //Get All Activities
    app.get(baseUri + '/all', async (req, res) => {
        try{
            let sql = "SELECT activities.*, subjects.title as subject_title FROM activities INNER JOIN subjects ON activities.subject=subjects.uuid ORDER BY activities.date_uploaded DESC";

            db.query(sql, (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Get Student Works
    app.post(baseUri + '/all_works', async (req, res) => {
        try{

            let activity = req.body.activity;

            let sql = "SELECT student_works.*, activities.title, activities.date_uploaded, activities.close_date, activities.uri as activity_uri, subjects.title as subject_title, students.student_no, students.lname, students.fname, students.mname  FROM student_works INNER JOIN students ON student_works.student=students.uuid INNER JOIN activities ON student_works.activity=activities.uuid INNER JOIN subjects ON activities.subject=subjects.uuid WHERE student_works.activity=? ORDER BY students.lname, students.fname, students.mname";

            db.query(sql, [activity], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Get Student Work
    app.post(baseUri + '/get_work', async (req, res) => {

        try{
            let activity = req.body.activity;
            let student = req.body.student;

            let sql = "SELECT * FROM student_works WHERE activity=? AND student=?";

            db.query(sql, [activity, student], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }

    });

    //Add Activity
    app.post(baseUri + '/add', async (req, res) => {
        try{
            let uuid = req.body.uuid;
            let subject = req.body.subject;
            let title = req.body.title;
            let activityType = req.body.activityType;
            let dateUploaded = req.body.dateUploaded;
            let closeDate = req.body.closeDate;

            let file = req.files.file;

            let {url, bucketName} = await UploadFile(file, "activity/"+subject);

            if(url === 'error'){
                res.sendStatus(500);
                return;
            }

            let sql = "INSERT INTO activities VALUES(?,?,?,?,?,?,?,?)";
            db.query(sql, [uuid, subject, title, activityType, dateUploaded, closeDate, url, bucketName], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Submit Activity
    app.post(baseUri + '/submit', async (req, res) => {
        try{
            let uuid = req.body.uuid;
            let student = req.body.student;
            let activity = req.body.activity;
            let datePassed = req.body.datePassed;

            let file = req.files.file;

            let {url, bucketName} = await UploadFile(file, "student_works/"+activity);

            if(url === 'error'){
                res.sendStatus(500);
                return;
            }

            let sql = "INSERT INTO student_works VALUES(?,?,?,?,?,?)";
            db.query(sql, [uuid, student, activity, datePassed, url, bucketName], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Update activity
    app.post(baseUri + '/update', async (req, res) => {
        try{
            let uuid = req.body.uuid;
            let subject = req.body.subject;
            let title = req.body.title;
            let activityType = req.body.activityType;
            let closeDate = req.body.closeDate;

            let sql = "UPDATE activities SET subject=?, title=?, type=?, close_date=? WHERE uuid=?";
            
            db.query(sql, [subject, title, activityType, closeDate, uuid], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Delete lesson
    app.post(baseUri + '/delete', async (req, res) => {
        try {
            let uuid = req.body.uuid;
            let bucketName = req.body.bucketName;

            let deleteRes = await DeleteFile(bucketName);
            
            if(deleteRes){
                let sql = "DELETE FROM activities WHERE uuid=?";
                db.query(sql, [uuid], (err, result) => {
                    if(err){
                        console.log(err);
                        res.sendStatus(500);
                    }
                    else{
                        res.json(result);
                    }
                });
            }
            
        } catch (e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Delete student work
    app.post(baseUri + '/delete_work', async (req, res) => {
        try {
            let uuid = req.body.uuid;
            let bucketName = req.body.bucketName;

            let deleteRes = await DeleteFile(bucketName);
            
            if(deleteRes){
                let sql = "DELETE FROM student_works WHERE uuid=?";
                db.query(sql, [uuid], (err, result) => {
                    if(err){
                        console.log(err);
                        res.sendStatus(500);
                    }
                    else{
                        res.json(result);
                    }
                });
            }
            
        } catch (e) {
            console.log(e);
            res.sendStatus(500);
        }
    });
}
