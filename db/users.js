const db = require("./connection");

module.exports = initUsers = (app) => {
    //GET ALL USERS
    app.get('/api/user/all', async (req, res) => {
        try {
            let sql = "SELECT * from users";
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

    //GET USER
    app.post('/api/user/get', async (req, res) => {
    
        let uuid = req.body.uuid;
        let email = req.body.email;
        let password = req.body.password;
    
        try {
            let sql;

            //GET BY UUID
            if(uuid !== undefined){
                sql = "SELECT * FROM users WHERE uuid=?";
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
            
            //GET BY EMAIL & PASSOWRD
            else{
                sql = "SELECT * FROM users WHERE email=? AND password=?";
                db.query(sql,[email,password], (err, result) => {
                    if(err) {
                        console.log(err);
                        res.sendStatus(500);
                    }
                    else {
                        res.json(result);
                    }
                });
            }
        }
        catch(e) {
            console.log(e);
            res.sendStatus(500);
        }
    })
}