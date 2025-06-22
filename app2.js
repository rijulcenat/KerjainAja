const express = require('express');
const mysql = require('mysql2/promise');
const app = express();

app.use(express.json());

const dbConfig = {
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'job_portal'
};

async function getDbConnection() {
    return await mysql.createConnection(dbConfig);
}

// Create job post
app.post('/job_posts', async (req, res) => {
    const data = req.body;
    const statusInt = (data.status === 'active' || data.status == 1) ? 1 : 0;
    try {
        const conn = await getDbConnection();
        const [result] = await conn.execute(
            `INSERT INTO job_posts (judul_pekerjaan, departemen, lokasi, jenis_pekerjaan, batas_waktu, deskripsi, kualifikasi, status)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)`,
            [
                data.judul_pekerjaan,
                data.departemen,
                data.lokasi,
                data.jenis_pekerjaan,
                data.batas_waktu,
                data.deskripsi,
                data.kualifikasi,
                statusInt
            ]
        );
        await conn.end();
        res.status(201).json({ success: true, id: result.insertId });
    } catch (err) {
        res.status(500).json({ success: false, error: err.message });
    }
});

// Get job post by id
app.get('/job_posts/:id', async (req, res) => {
    const id = req.params.id;
    try {
        const conn = await getDbConnection();
        const [rows] = await conn.execute(
            `SELECT * FROM job_posts WHERE id = ?`,
            [id]
        );
        await conn.end();
        if (rows.length === 0) {
            res.status(404).json({ success: false, message: 'Not found' });
        } else {
            res.json(rows[0]);
        }
    } catch (err) {
        res.status(500).json({ success: false, error: err.message });
    }
});

// Update job post
app.put('/job_posts/:id', async (req, res) => {
    const id = req.params.id;
    const data = req.body;
    const statusInt = (data.status === 'active' || data.status == 1) ? 1 : 0;
    try {
        const conn = await getDbConnection();
        const [result] = await conn.execute(
            `UPDATE job_posts SET judul_pekerjaan=?, departemen=?, lokasi=?, jenis_pekerjaan=?, batas_waktu=?, deskripsi=?, kualifikasi=?, status=? WHERE id=?`,
            [
                data.judul_pekerjaan,
                data.departemen,
                data.lokasi,
                data.jenis_pekerjaan,
                data.batas_waktu,
                data.deskripsi,
                data.kualifikasi,
                statusInt,
                id
            ]
        );
        await conn.end();
        res.json({ success: result.affectedRows > 0 });
    } catch (err) {
        res.status(500).json({ success: false, error: err.message });
    }
});

// Update job post status
app.patch('/job_posts/:id/status', async (req, res) => {
    const id = req.params.id;
    const status = req.body.status;
    const statusInt = (status === 'active' || status == 1) ? 1 : 0;
    try {
        const conn = await getDbConnection();
        const [result] = await conn.execute(
            `UPDATE job_posts SET status = ? WHERE id = ?`,
            [statusInt, id]
        );
        await conn.end();
        res.json({ success: result.affectedRows > 0 });
    } catch (err) {
        res.status(500).json({ success: false, error: err.message });
    }
});

const PORT = 8000;
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});


// Get all job posts (Lowongan.getAll)
app.get('/lowongan', async (req, res) => {
    try {
        const conn = await getDbConnection();
        const [rows] = await conn.execute(
            `SELECT * FROM job_posts ORDER BY created_at DESC`
        );
        await conn.end();
        res.json(rows);
    } catch (err) {
        res.status(500).json({ success: false, error: err.message });
    }
});

// Get job post by id (Lowongan.getById)
app.get('/lowongan/:id', async (req, res) => {
    const id = req.params.id;
    try {
        const conn = await getDbConnection();
        const [rows] = await conn.execute(
            `SELECT * FROM job_posts WHERE id = ?`,
            [id]
        );
        await conn.end();
        if (rows.length === 0) {
            res.status(404).json({ success: false, message: 'Not found' });
        } else {
            res.json(rows[0]);
        }
    } catch (err) {
        res.status(500).json({ success: false, error: err.message });
    }
});

// Update job post (Lowongan.update)
app.put('/lowongan/:id', async (req, res) => {
    const id = req.params.id;
    const data = req.body;
    const statusInt = parseInt(data.status, 10) || 0;
    try {
        const conn = await getDbConnection();
        const [result] = await conn.execute(
            `UPDATE job_posts SET judul_pekerjaan=?, departemen=?, lokasi=?, jenis_pekerjaan=?, batas_waktu=?, deskripsi=?, kualifikasi=?, status=? WHERE id=?`,
            [
                data.judul_pekerjaan,
                data.departemen,
                data.lokasi,
                data.jenis_pekerjaan,
                data.batas_waktu,
                data.deskripsi,
                data.kualifikasi,
                statusInt,
                id
            ]
        );
        await conn.end();
        res.json({ success: result.affectedRows > 0 });
    } catch (err) {
        res.status(500).json({ success: false, error: err.message });
    }
});

// Update job post status (Lowongan.updateStatus)
app.patch('/lowongan/:id/status', async (req, res) => {
    const id = req.params.id;
    const status = req.body.status;
    const statusInt = parseInt(status, 10) || 0;
    try {
        const conn = await getDbConnection();
        const [result] = await conn.execute(
            `UPDATE job_posts SET status=? WHERE id=?`,
            [statusInt, id]
        );
        await conn.end();
        res.json({ success: result.affectedRows > 0 });
    } catch (err) {
        res.status(500).json({ success: false, error: err.message });
    }
});