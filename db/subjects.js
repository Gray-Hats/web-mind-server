const db = require("./connection");
const table = "subjects";
const baseUri = "/api/subject";

module.exports = initSubject = (app) => {

    //GET ALL
    app.get(baseUri + '/all', async (req, res) => {
        try {
            let sql = "SELECT * from " + table;

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
            let sql = "SELECT COUNT(*) as count from " + table;

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
            let sql = "SELECT * FROM " + table + " WHERE uuid=?";

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

        try {
            let sql = "INSERT INTO " + table + " VALUES(?,?,?,?)";

            db.query(sql,[uuid, code, title, description], (err, result) => {
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
    
        try {
            let sql = "UPDATE " + table + " SET code=?, title=?, description=? WHERE (uuid=?)";

            db.query(sql,[code, title, description,uuid], (err, result) => {
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
            let sql = "DELETE FROM " + table + " WHERE uuid=? ";

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