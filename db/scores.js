const db = require("./connection");
const baseUri = "/api/score";

module.exports = initScore = (app) => {

    //GET ALL SCORES
    app.get(baseUri + '/all', async (req, res) => {
        try{
            
            let sql = "SELECT scores.*, tasks.subject, subjects.title as subject_title, tasks.quarter, tasks.task_no, tasks.type, tasks.highest_score FROM scores INNER JOIN tasks ON scores.task=tasks.uuid INNER JOIN subjects ON tasks.subject=subjects.uuid ORDER BY quarter, subject_title, type, task_no";

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
        catch(e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //GET WRITTEN
    app.get(baseUri + '/written', async (req, res) => {
        try{

            let sql = "SELECT scores.*, tasks.subject, subjects.title as subject_title, tasks.quarter, tasks.task_no, tasks.type, tasks.highest_score FROM scores INNER JOIN tasks ON scores.task=tasks.uuid INNER JOIN subjects ON tasks.subject=subjects.uuid WHERE tasks.type='written' ORDER BY quarter, subject_title, type, task_no";

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

    //GET PERFORMANCE
    app.get(baseUri + '/performance', async (req, res) => {
        try{

            let sql = "SELECT scores.*, tasks.subject, subjects.title as subject_title, tasks.quarter, tasks.task_no, tasks.type, tasks.highest_score FROM scores INNER JOIN tasks ON scores.task=tasks.uuid INNER JOIN subjects ON tasks.subject=subjects.uuid WHERE tasks.type='performance' ORDER BY quarter, subject_title, type, task_no";

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

    //GET QUARTER
    app.post(baseUri + '/quarter', async (req, res) => {
        try{

            let quarter = req.body.quarter;

            let sql = "SELECT scores.*, tasks.subject, subjects.title as subject_title, tasks.quarter, tasks.task_no, tasks.type, tasks.highest_score FROM scores INNER JOIN tasks ON scores.task=tasks.uuid INNER JOIN subjects ON tasks.subject=subjects.uuid WHERE tasks.quarter=? ORDER BY subject_title, type, task_no";

            db.query(sql, [quarter], (err, result) => {
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

    //GET SPECIFIC SCORE
    app.post(baseUri + '/get', async (req, res) => {
        let quarter = req.body.quarter;
        let type = req.body.type;

        let sql = "";
    });

    //ADD SCORE
    app.post(baseUri + '/add', async (req, res) => {
        try {
            let student = req.body.student;
            let task = req.body.task;
            let score = req.body.score;

            let sql = "INSERT INTO scores VALUES(?,?,?)";

            db.query(sql, [student, task, score], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        } catch (e) {
            console.log(err);
            res.sendStatus(500);
        }
    });

    //UPDATE SCORE
    app.post(baseUri + '/update', async (req, res) => {
        try {
            let student = req.body.student;
            let task = req.body.task;
            let score = req.body.score;

            let sql = "UPDATE scores SET score=? WHERE task=? AND student=?";

            db.query(sql, [score, task, student], (err, result) => {
                if(err){
                    console.log(err);
                    res.sendStatus(500);
                }
                else{
                    res.json(result);
                }
            });
        } catch (e) {
            console.log(err);
            res.sendStatus(500);
        }
    });

    //

}