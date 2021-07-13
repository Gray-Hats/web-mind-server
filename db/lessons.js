const db = require("./connection");
const baseUri = "/api/lesson";

module.exports = initLesson = (app) => {

    //Get Modules
    app.get(baseUri + '/modules', async (req, res) => {
        try{
            let sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid WHERE type='module' ORDER BY date_uploaded";

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
    app.get(baseUri + '/media', async (req, res) => {
        try{
            let sql = "SELECT lessons.*, subjects.title as subject_title FROM lessons INNER JOIN subjects ON lessons.subject=subjects.uuid WHERE type='audio' OR type='video' ORDER BY date_uploaded";

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

    //Add Module
    app.post(baseUri + '/module/add', async (req, res) => {
        try{
            let uuid = req.body.uuid;
            let name = req.body.name;
            let uri = req.body.uri;
            let description = req.body.description;
            let dateUpload = req.body.dateUpload;
            let subject = req.body.subject;
            let type = 'module';

            let sql = "INSERT INTO lessons VALUES(?,?,?,?,?,?,?)";
            db.query(sql, [uuid, name, type, uri, description, dateUpload, subject], (err, result) => {
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

    //Add Audio
    app.post(baseUri + '/audio/add', async (req, res) => {
        try {
            let uuid = req.body.uuid;
            let name = req.body.name;
            let uri = req.body.uri;
            let description = req.body.description;
            let dateUpload = req.body.dateUpload;
            let subject = req.body.subject;
            let type = 'audio';

            let sql = "INSERT INTO lessons VALUES(?,?,?,?,?,?,?)";
            db.query(sql, [uuid, name, type, uri, description, dateUpload, subject], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        } catch (e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Add Video
    app.post(baseUri + '/video/add', async (req, res) => {
        try {
            let uuid = req.body.uuid;
            let name = req.body.name;
            let uri = req.body.uri;
            let description = req.body.description;
            let dateUpload = req.body.dateUpload;
            let subject = req.body.subject;
            let type = 'video';

            let sql = "INSERT INTO lessons VALUES(?,?,?,?,?,?,?)";
            db.query(sql, [uuid, name, type, uri, description, dateUpload, subject], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        } catch (e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Update lesson
    app.post(baseUri + '/update', async (req, res) => {
        try{
            let uuid = req.body.uuid;
            let name = req.body.name;
            let uri = req.body.uri;
            let description = req.body.description;
            let dateUpload = req.body.dateUpload;
            let subject = req.body.subject;
            let type = 'video';

            let sql = "UPDATE lessons SET name=?, type=?, uri=?, description=?, date_uploaded=?, subject=? WHERE uuid=?";
            
            db.query(sql, [name,type,uri,description,dateUpload,subject,uuid], (err, result) => {
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

            let sql = "DELETE FROM lessonsWHERE uuid=?";
            db.query(sql, [uuid], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        } catch (e) {
            console.log(e);
            res.sendStatus(500);
        }
    });
}