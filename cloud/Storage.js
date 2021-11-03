const baseUri = "/api/cloud-storage";
const uploadFile = require('./UploadFile');
const db = require("../db/connection");

module.exports = initStorage = (app) => {

    console.log("Cloud Storage Initialized");

    //Upload File
    app.post(baseUri + '/upload/file', async (req, res) => {
        try{

            if(req.files === null) {
                return res.status(400).json({msg: "No file uploaded"});
            }

            const fileUrl = await uploadFile(req.files.file, req.body.folder);
            
            res.status(200).json({
                message: "Upload was successful",
                data: fileUrl
            });

        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }
    });

    //Upload student profile
    app.post(baseUri + '/upload/profile', async (req, res) => {
        try{

            if(req.files === null) {
                return res.status(400).json({msg: "No image uploaded"});
            }

            let uuid = req.body.uuid;

            const imageUrl = await uploadFile(req.files.image, "student-profile");

            let sql = "UPDATE students SET profile_url=? WHERE uuid=?";
            
            db.query(sql, [imageUrl, uuid], (err, result) => {
                if(err) {
                    console.log(err);
                    res.sendStatus(500);
                }
                else {
                    res.status(200).json({
                        message: "success",
                        data: imageUrl
                    });
                }
            });
        }
        catch(e){
            console.log(e);
            res.sendStatus(500);
        }
    });
}