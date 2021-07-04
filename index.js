const express = require('express');
const app = express();
const cors = require('cors');
const user = require('./db/users');
const getAllUser = require('./db/users');
const getUser = require('./db/users');
const config = require('./config');
app.use(cors());
app.use(express.json());

/*
* USER
*/
app.get('/api/users', async (req, res) => {
    try {
        let users = await getAllUsers();
        res.json(users);
    }
    catch(e) {
        console.log(e);
        res.sendStatus(500);
    }
})
app.post('/api/get_user', async (req, res) => {
    let email = req.body.email;
    let password = req.body.password;

    try {
        let user = await getUser(email,password);
        res.json(user);
    }
    catch(e) {
        console.log(e);
        res.sendStatus(500);
    }
})

app.listen(config.port, () => {
    console.log("Server is running...");
})