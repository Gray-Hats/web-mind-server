const db = require("./connection");
const baseUri = "/api/message";

module.exports = initMessages = (app) => {

    //GET ALL MESSAGES
    app.get(baseUri + '/all', async (req, res) => {
        try {
            
            let sql = "SELECT * from messages ORDER BY date_sent";

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

    //SEND MESSAGE
    app.post(baseUri + '/send', async (req, res) => {
    
        let uuid = req.body.uuid;
        let sender = req.body.sender;
        let message = req.body.message;
        let dateSent = req.body.dateSent;
        let student = req.body.student;
    
        try {
            let sql = "INSERT INTO messages VALUES(?,?,?,?,?)";

            db.query(sql,[uuid, sender, message, dateSent, student], (err, result) => {
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

    //DELETE MESSAGE
    app.post(baseUri + '/delete', async (req, res) => {
    
        let uuid = req.body.uuid;
    
        try {
            let sql = "DELETE FROM messages WHERE uuid=? ";

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