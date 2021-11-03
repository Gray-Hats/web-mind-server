const db = require("./connection");
const baseUri = "/api/student";

module.exports = initStudent = (app) => {

    //GET ALL
    app.get(baseUri + '/all', async (req, res) => {
        try {
            
            let sql = "SELECT * from students ORDER BY lname, fname, mname";

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
            let sql = "SELECT COUNT(uuid) as count from students";

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
        try {
            let uuid = req.body.uuid;

            let sql = "SELECT * FROM students WHERE uuid=?";
            
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

    //GET SPECIFIC STUDENT BY NO & PASS
    app.post(baseUri + '/check', async (req, res) => {
        try {
            let studNo = req.body.studNo;
            let password = req.body.password;

            let sql = "SELECT * FROM students WHERE student_no=? AND password=?";
            
            db.query(sql,[studNo, password], (err, result) => {
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
    
        try {
                
            let uuid = req.body.uuid;
            let studNo = req.body.studNo;
            let lname = req.body.lname;
            let fname = req.body.fname;
            let mname = req.body.mname;
            
            let sql = "INSERT INTO students VALUES(?,?,?,?,?,'')";
            
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
            let sql = "UPDATE  students SET student_no=?, lname=?, fname=?, mname=? WHERE uuid=?";
            
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
            let sql = "DELETE FROM students WHERE uuid=? ";

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