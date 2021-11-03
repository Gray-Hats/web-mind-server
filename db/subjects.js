const db = require("./connection");
const baseUri = "/api/subject";

module.exports = initSubject = (app) => {

    //GET ALL
    app.get(baseUri + '/all', async (req, res) => {
        try {
            let sql = "SELECT * from subjects ORDER BY title";

            db.query(sql, (err, result) => {
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

    //GET COUNT
    app.get(baseUri + '/count', async (req, res) => {
        try {
            let sql = "SELECT COUNT(uuid) as count from subjects";

            db.query(sql, (err, result) => {
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
    })

    //GET SPECIFIC SUBJECT
    app.post(baseUri + '/get', async (req, res) => {
    
        let uuid = req.body.uuid;

        try {
            let sql = "SELECT * FROM subjects WHERE uuid=?";

            db.query(sql,[uuid], (err, result) => {
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

    //ADD SUBJECT
    app.post(baseUri + '/add', async (req, res) => {
    
        let uuid = req.body.uuid;
        let code = req.body.code;
        let title = req.body.title;
        let description = req.body.description;
        let written = req.body.written;
        let perf = req.body.performance;

        try {
            let sql = "INSERT INTO subjects VALUES(?,?,?,?,?,?)";

            db.query(sql,[uuid, code, title, description, written, perf], (err, result) => {
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

    //UPDATE SUBJECT
    app.post(baseUri + '/update', async (req, res) => {
    
        let uuid = req.body.uuid;
        let code = req.body.code;
        let title = req.body.title;
        let description = req.body.description;
        let written = req.body.written;
        let perf = req.body.performance;
    
        try {
            let sql = "UPDATE subjects SET code=?, title=?, description=?, written=?, performance=? WHERE uuid=?";

            db.query(sql,[code, title, description, written, perf, uuid], (err, result) => {
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

    //DELETE SUBJECT
    app.post(baseUri + '/delete', async (req, res) => {
    
        let uuid = req.body.uuid;
    
        try {
            let sql = "DELETE FROM subjects WHERE uuid=? ";

            db.query(sql,[uuid], (err, result) => {
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