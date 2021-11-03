const db = require("./connection");
const baseUri = "/api/grade";

module.exports = initGrades = (app) => {

    //CREATE WEIGHTS
    app.post(baseUri + '/create_weights', async (req, res) => {
    
        let subject = req.body.subject;
        let quarter = req.body.quarter;
        let written = "0,0,0,0";
        let perf = "0,0,0,0";
    
        try {
            let sql = "INSERT INTO weights VALUES(?,?,?,?)";

            db.query(sql,[subject, quarter, written, perf], (err, result) => {
                if(err) {
                    console.log(err);
                    res.sendStatus(500);
                }
                else {
                    res.json(result);
                }
            });
        }
        catch(e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //UPADTE WEIGHTS
    app.post(baseUri + '/update_weights', async (req, res) => {
    
        let subject = req.body.subject;
        let quarter = req.body.quarter;
        let written = req.body.written;
        let perf = req.body.perf;
    
        try {
            let sql = "UPDATE weights SET written=?, performance=? WHERE subject=? AND quarter=?";

            db.query(sql,[written, perf, subject, quarter], (err, result) => {
                if(err) {
                    console.log(err);
                    res.sendStatus(500);
                }
                else {
                    res.json(result);
                }
            });
        }
        catch(e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //GET WEIGHTS
    app.post(baseUri + '/get_weights', async (req, res) => {
        try {
            let subject = req.body.subject;
            let quarter = req.body.quarter;

            let sql = "SELECT * FROM weights WHERE subject=? AND quarter=?";
            
            db.query(sql,[subject, quarter], (err, result) => {
                if(err) {
                    console.log(err);
                    res.sendStatus(500);
                }
                else {
                    res.json(result);
                }
            });
        }
        catch(e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //GET GRADE
    app.post(baseUri + '/get_grade', async (req, res) => {
        try {
            let student = req.body.student;
            let subject = req.body.subject;
            let quarter = req.body.quarter;

            let sql = "SELECT * FROM scores WHERE student=? AND subject=? AND quarter=?";
            
            db.query(sql,[student, subject, quarter], (err, result) => {
                if(err) {
                    console.log(err);
                    res.sendStatus(500);
                }
                else {
                    res.json(result);
                }
            });
        }
        catch(e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //ADD GRADE
    app.post(baseUri + '/add_grade', async (req, res) => {
        try {
            let student = req.body.student;
            let subject = req.body.subject;
            let quarter = req.body.quarter;
            let written = req.body.written;
            let wTotal = req.body.wTotal;
            let wPercentage = req.body.wPercentage;
            let wWeighted = req.body.wWeighted;
            let perf = req.body.perf;
            let pTotal = req.body.pTotal;
            let pPercentage = req.body.pPercentage;
            let pWeighted = req.body.pWeighted;
            let initialGrade = req.body.initialGrade;
            let quarterlyGrade = req.body.quarterlyGrade;

            let sql = "INSERT INTO scores VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            
            db.query(sql,[
                student, subject, quarter, 
                written, wTotal, wPercentage, wWeighted, 
                perf, pTotal, pPercentage, pWeighted,
                initialGrade, quarterlyGrade
            ], (err, result) => {
                if(err) {
                    console.log(err);
                    res.sendStatus(500);
                }
                else {
                    res.json(result);
                }
            });
        }
        catch(e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

    //UPDATE GRADE
    app.post(baseUri + '/update_grade', async (req, res) => {
        try {
            let student = req.body.student;
            let subject = req.body.subject;
            let quarter = req.body.quarter;
            let written = req.body.written;
            let wTotal = req.body.wTotal;
            let wPercentage = req.body.wPercentage;
            let wWeighted = req.body.wWeighted;
            let perf = req.body.perf;
            let pTotal = req.body.pTotal;
            let pPercentage = req.body.pPercentage;
            let pWeighted = req.body.pWeighted;
            let initialGrade = req.body.initialGrade;
            let quarterlyGrade = req.body.quarterlyGrade;

            let sql = "UPDATE scores SET written=?, written_total=?, written_ps=?, written_ws=?, performance=?, performance_total=?, performance_ps=?, performance_ws=?, initial_grade=?, quarterly_grade=? WHERE student=? AND subject=? AND quarter=?";
            
            db.query(sql,[
                written, wTotal, wPercentage, wWeighted, 
                perf, pTotal, pPercentage, pWeighted,
                initialGrade, quarterlyGrade,
                student, subject, quarter
            ], (err, result) => {
                if(err) {
                    console.log(err);
                    res.sendStatus(500);
                }
                else {
                    res.json(result);
                }
            });
        }
        catch(e) {
            console.log(e);
            res.sendStatus(500);
        }
    });

}