const db = require("./connection");
const baseUri = "/api/lesson";
const UploadFile = require('../cloud/UploadFile');
const DeleteFile = require("../cloud/DeleteFile");

module.exports = initLesson = (app) => {

    //Get All Lesson
    app.get(baseUri + '/all', async (req, res) => {
        try{
            let sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid ORDER BY date_uploaded DESC";

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

    //Get Modules
    app.get(baseUri + '/modules', async (req, res) => {
        try{
            let sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid WHERE type='module' ORDER BY date_uploaded DESC";

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

    //Get Audios and Videos
    app.get(baseUri + '/medias', async (req, res) => {
        try{
            let sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid WHERE type='media' ORDER BY date_uploaded DESC" ;

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

    //Add Lesson
    app.post(baseUri + '/add', async (req, res) => {
        try{
            let uuid = req.body.uuid;
            let name = req.body.name;

            let description = req.body.description;
            let dateUploaded = req.body.dateUploaded;
            let subject = req.body.subject;
            let type = req.body.type;

            let file = req.files.file;
''
            let {url, bucketName} = await UploadFile(file, "lesson/"+subject+"/"+type);

            if(url === 'error'){
                res.sendStatus(500);
                return;
            }

            let sql = "INSERT INTO lessons VALUES(?,?,?,?,?,?,?,?)";
            db.query(sql, [uuid, name, type, description, dateUploaded, subject, url, bucketName], (err, result) => {
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

    //Update lesson
    app.post(baseUri + '/update', async (req, res) => {
        try{
            let uuid = req.body.uuid;
            let name = req.body.name;
            let description = req.body.description;
            let subject = req.body.subject;

            let sql = "UPDATE lessons SET name=?, description=?, subject=? WHERE uuid=?";
            
            db.query(sql, [name,description,subject,uuid], (err, result) => {
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
                let sql = "DELETE FROM lessons WHERE uuid=?";
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
