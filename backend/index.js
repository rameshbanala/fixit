const express = require('express')
const app = express()
const mysql = require('mysql')
const cors = require('cors')
app.use(cors())
app.use(express.json())
const con = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'projectdb'
})

app.listen(8000, () => {
    console.log("running")
})
con.connect((err) => {
    if (err) {
        console.log(err.stack)
    }
    else {
        console.log("connected successfully")
    }
})

app.post('/workerhomeprofile', (request, response) => {
    const { id } = request.body
    const query = `select name,city,userImgUrl from users where id= ?`;
    con.query(query, [id], (err, result) => {
        if (err) {
            return response.status(500).json({ error: 'Database error' });
        }

        if (result.length > 0) {
            return response.status(200).json(result[0]);
        } else {
            return response.status(404).json({ error: 'User not present' });
        }
    });
})

app.get('/getworkerdetails',(request, response) => {
    const { worktype } = request.query
    const query = `SELECT * FROM users WHERE id in (select id from worker_details WHERE selected_options LIKE '%${worktype}%');`
    con.query(query, (err, res) => {
        if (err) {
            console.error('Error executing query:', error);
            response.status(500).send('Error inserting data');
            return;
        }
        else{
            response.status(200).send(res);
        }
    })
})

app.post('/postworker', (request, response) => {
    const { id, selectedOptions } = request.body;
    const selectedOptionsstring = selectedOptions.join(',')
    const query = 'INSERT INTO worker_details (id, selected_options) VALUES (?, ?)';
    const values = [id, selectedOptionsstring]; // Join the array into a comma-separated string
    con.query(query, values, (error, results, fields) => {
        if (error) {
            console.error('Error executing query:', error);
            response.status(500).send('Error inserting data');
            return;
        }
        console.log('Data inserted successfully');
        response.status(200).send('Data inserted successfully');
    });
});

app.post('/worker', (request, response) => {
    const { id } = request.body;

    if (!id) {
        return response.status(400).json({ error: 'ID is required' });
    }

    const query = 'SELECT * FROM worker_details WHERE id = ?';
    con.query(query, [id], (err, result) => {
        if (err) {
            return response.status(500).json({ error: 'Database error' });
        }

        if (result.length > 0) {
            return response.status(200).json(result[0]);
        } else {
            return response.status(404).json({ error: 'User not present' });
        }
    });
});
app.post('/login', (req, res) => {
    const { email, password } = req.body;
    console.log(req.body);

    // Use parameterized queries to prevent SQL injection
    const query = 'SELECT * FROM users WHERE email = ? AND BINARY password = ?';
    con.query(query, [email, password], (err, result) => {
        if (err) {
            return res.status(500).send(err);
        }

        if (result.length === 0) {
            return res.status(401).send('Invalid email or password');
        }

        res.status(200).send(JSON.stringify(result));
    });
});

