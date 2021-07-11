const db = require("./connection");
const table = "students";
const baseUri = "/api/student";

module.exports = initStudent = (app) => {

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

    //GET SPECIFIC STUDENT
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

    //ADD
    app.post(baseUri + '/add', async (req, res) => {
    
        let uuid = req.body.uuid;
        let studNo = req.body.studNo;
        let lname = req.body.lname;
        let fname = req.body.fname;
        let mname = req.body.mname;
    
        try {
            let sql = "INSERT INTO " + table + " VALUES(?,?,?,?,?)";
            
            db.query(sql, [uuid,studNo,lname,fname,mname], (err, result) => {
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

    app.post(baseUri + '/update', async (req, res) => {
    
        let uuid = req.body.uuid;
        let studNo = req.body.studNo;
        let lname = req.body.lname;
        let fname = req.body.fname;
        let mname = req.body.mname;
    
        try {
            let sql = "UPDATE  " + table + " SET student_no=?, lname=?, fname=?, mname=? WHERE uuid=?";
            
            db.query(sql, [studNo,lname,fname,mname,uuid], (err, result) => {
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