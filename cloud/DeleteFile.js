const { Storage } = require('@google-cloud/storage');
const path = require('path');
const uuid = require('uuid');
const uuidV1 = uuid.v1;

const storage = new Storage({
    keyFilename:  path.join(__dirname, './cloud-config.json'),
    projectId: 'sincere-torch-329413',
});

const bucket = storage.bucket('webmind-e-learning-system');

module.exports = DeleteFile = (fileName) => new Promise((resolve, reject) => {

    try {
        let file = bucket.file(fileName);
        file.delete();
        resolve(true);
    } catch (error) {
        reject(false)
    }
})