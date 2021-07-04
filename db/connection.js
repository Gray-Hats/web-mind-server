const mysqli = require('mysql');

const db = mysqli.createConnection({
    user: 'root',
    host: 'localhost',
    password: 'password',
    database: 'web_mind_master',
});

db.connect(err => {
    if(err) console.log(err);
})

module.exports = db;