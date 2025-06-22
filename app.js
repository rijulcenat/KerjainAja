const express = require("express"); 
const mysql = require("mysql2/promise");
const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");
const app = express();
const PORT = 8000;

const paramdb = {
    host: "localhost", 
    port: "3306",
    user: "root",
    password: "",
    database: "kerjain"
};

const router = express.Router();
app.use(express.json());

const getById = async (req, res) => {
    const id = req.params.id;
    try {
        const db = await mysql.createConnection(paramdb);
        const sql = "SELECT id, foto, nama_lengkap, alamat, email, no_telpon, " +
            "pendidikan_terakhir, keahlian, pengalaman, deskripsi_diri, cv " +
            "FROM pelamar WHERE id = ?"; 
        const [rows] = await db.execute(sql, [id]);
        db.end();
        if (rows.length === 0) {
            return res.status(404).json({ message: "Pelamar tidak ditemukan." });
        }
        res.status(200).json(rows[0]); 
    } catch (error) {
        return res.status(409).json({ error });
    }
};
router.get("/profile/:id", getById);

const update = async (req, res) => {
    const id = req.params.id; 
    const {
        foto_nama,
        nama,
        alamat,
        email,
        password, 
        nomor,
        pendidikan,
        keahlian,
        pengalaman,
        deskripsi,
        cv_nama
    } = req.body; 
    if (!nama || !email || !password || !nomor) {
        return res.status(400).json({ message: "Kolom yang wajib diisi tidak ada (nama, email, kata sandi, nomor)" });
    }
    try {
        const db = await mysql.createConnection(paramdb);
        const hashedPassword = await bcrypt.hash(password, 8);
        const sql = `
            UPDATE pelamar SET
            foto = ?,
            nama_lengkap = ?,
            alamat = ?,
            email = ?,
            password = ?,
            no_telpon = ?,
            pendidikan_terakhir = ?,
            keahlian = ?,
            pengalaman = ?,
            deskripsi_diri = ?,
            cv = ?
            WHERE id = ?
        `;
        const [result] = await db.execute(sql, [
            foto_nama,
            nama,
            alamat,
            email,
            hashedPassword, 
            nomor,
            pendidikan,
            keahlian,
            pengalaman,
            deskripsi,
            cv_nama,
            id
        ]);
        db.end();
        if (result.affectedRows === 0) {
            return res.status(404).json({ message: "Pelamar tidak ditemukan atau tidak ada perubahan yang dilakukan." });
        }
        res.status(200).json({
            message: "Profil berhasil diperbarui!",
            affectedRows: result.affectedRows
        });
    } catch (error) {
        return res.status(409).json({ error });
    }
};
router.put("/profile/:id", update);

app.use("/", router);
app.listen(PORT, () => {
    console.log("App run at port " + PORT);
});