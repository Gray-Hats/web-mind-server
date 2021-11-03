const db = require("./connection");
const baseUri = "/api/post";
const UploadFile = require('../cloud/UploadFile');
const DeleteFile = require("../cloud/DeleteFile");

module.exports = initPost = (app) => {
    //Get All Post
    app.get(baseUri + '/all', async (req, res) => {
        try{
            let sql = "SELECT * from posts ORDER by date_uploaded DESC";

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

    app.post(baseUri + '/add', async (req, res) => {
        try{

            let uuid = req.body.uuid;
            let sender = req.body.sender;
            let content = req.body.content;
            let dateUploaded = req.body.dateUploaded;

            let {url, bucketName} = req.files ? await UploadFile(req.files.file, "post") : {url: "", bucketName: ""};

            if(url === 'error'){
                res.sendStatus(500);
                return;
            }

            let sql = "INSERT INTO posts VALUES(?,?,?,?,?,?)";

            db.query(sql, [uuid, sender, dateUploaded, content, url, bucketName], (err, result) => {
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

    app.post(baseUri + '/delete', async (req, res) => {
        try{

            let uuid = req.body.uuid;
            let bucketName = req.body.bucketName;
           
            let deleteRes = bucketName ? await DeleteFile(bucketName) : true;
            
            if(deleteRes){
                let sql = "DELETE FROM posts WHERE uuid=?";
                db.query(sql, [uuid], (err, result) => {
                    if(err){
                        console.log(err);
                        res.sendStatus(500);
                    }
                    else{
                        res.json(result);
                    }
                });
            }
        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }
    });
}