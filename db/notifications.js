const db = require("./connection");
const baseUri = "/api/notification";

module.exports = initNotification = (app) => {

    //GET NOTIFICATIONS
    app.get(baseUri + '/current', async (req, res) => {
        try {
            
            let sql = "SELECT * from notifications WHERE str_to_date(date_created, '%m/%d/%Y') > DATE_ADD(CURDATE(), INTERVAL -3 DAY) ORDER BY date_created DESC";

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

    //GET NOTIFICATION COUNTS
    app.get(baseUri + '/count', async (req, res) => {
        try {
            
            let sql = "SELECT COUNT(uuid) as count from notifications WHERE date_created > dateadd(dd,-3,cast(getdate() as date)) ORDER BY date_created DESC";

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

    //ADD NOTIFICATION
    app.post(baseUri + '/add', async (req, res) => {
    
        let uuid = req.body.uuid;
        let type = req.body.type;
        let content = req.body.content;
        let dateCreated = req.body.dateCreated;
    
        try {
            let sql = "INSERT INTO notifications VALUES(?,?,?,?)";

            db.query(sql,[uuid, type, content, dateCreated], (err, result) => {
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