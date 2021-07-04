const db = require("./connection");


module.exports = getAllUsers = () => {
    return new Promise((resolve, reject) => {
        let sql = "SELECT * FROM users";
        db.query(sql, (err, result) => {
            if(err) {
                return reject(err);
            }
            else {
                resolve(result);
            }
        });
    })
}

module.exports =  getUser = (email, password) => {
    return new Promise((resolve, reject) => {
        let sql = "SELECT * FROM users WHERE email=? AND password=?";
        db.query(sql,[email,password], (err, result) => {
            if(err) {
                return reject(err);
            }
            else {
                resolve(result);
            }
        });
    })
}

