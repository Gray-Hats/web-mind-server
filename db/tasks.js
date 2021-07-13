const db = require("./connection");
const baseUri = "/api/task";

module.exports = initTask = (app) => {
    
    //Get All
    app.get(baseUri + '/all', async (req, res) => {
        try{
            let sql = "SELECT tasks.*, subjects.title as subject_title FROM tasks INNER JOIN subjects ON tasks.subject=subjects.uuid ORDER BY subject_title";
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

    //Get Written Works
    app.get(baseUri + '/written_works', async (req, res) => {
        try{
            
            let sql = "SELECT tasks.*, subjects.title as subject_title FROM tasks INNER JOIN subjects ON tasks.subject=subjects.uuid WHERE type='written' ORDER BY task_no";

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

    //Get Performance Tasks
    app.get(baseUri + '/performance_tasks', async (req, res) => {
        try{
            let sql = "SELECT tasks.*, subjects.title as subject_title FROM tasks INNER JOIN subjects ON tasks.subject=subjects.uuid WHERE type='performance' ORDER BY task_no";
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

    
    //Add Tasks
    app.post(baseUri + '/add', async (req, res) => {
        try {
            
            let uuid = req.uuid;
            let subject = req.subject;
            let quarter = req.body.quarter;
            let taskNo = req.taskNo;
            let score = req.body.highestScore;
            let type = req.body.type;

            let sql = "INSERT INTO tasks VALUES (?,?,?,?,?,?)";

            db.query(sql, [uuid,subject,quarter,taskNo,score,type], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            })

        } catch (e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Update Task
    app.post(baseUri + '/update', async (req, res) => {
        try {
            let uuid = req.uuid;
            let subject = req.subject;
            let quarter = req.body.quarter;
            let taskNo = req.taskNo;
            let score = req.body.highestScore;
            let type = req.body.type;


            let sql = "UPDATE tasks SET subject=?, quarter=?, task_no=?, highest_score=?, type=? WHERE uuid=?";

            db.query(sql, [subject,quarter,taskNo,score,type,uuid], (err, result) => {
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

    //Delete Task
    app.post(baseUri + '/delete', async (req, res) => {
        try {
            let uuid = req.uuid;

            let sql = "DELETE FROM tasks WHERE uuid=?";

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