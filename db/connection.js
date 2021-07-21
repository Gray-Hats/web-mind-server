const mysqli = require('mysql');
const config = require('../config');

const db = mysqli.createConnection(config.mysqli);

db.connect(err => {
    if(err) console.log(err);
    else console.log("Database Connected");
})

module.exports = db;