const { Storage } = require('@google-cloud/storage');
const path = require('path');
const uuid = require('uuid');
const uuidV1 = uuid.v1;

const storage = new Storage({
    keyFilename:  path.join(__dirname, './cloud-config.json'),
    projectId: 'sincere-torch-329413',
});

const bucket = storage.bucket('webmind-e-learning-system');

module.exports = UploadFile = (file, folder) => new Promise((resolve, reject) => {

    let subString = file.name.split(".");
    let type = subString[subString.length-1];

    let newFileName = folder + '/' +  uuidV1() +"."+ type;

    let fileUpload = bucket.file(newFileName);

    const blobStream = fileUpload.createWriteStream();

    blobStream.on('error', (error) => {
        console.log('Something is wrong! Unable to upload at the moment.' + error);
        resolve("error");
    });

    blobStream.on('finish', () => {
        //image url from cloud storage
        const url = `https://storage.googleapis.com/${bucket.name}/${fileUpload.name}`;
        resolve({
            url: url,
            bucketName: newFileName,
        });
    });

    blobStream.end(file.data);
})