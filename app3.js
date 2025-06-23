const express = require("express");
const mysql = require("mysql2/promise");
const dotenv = require("dotenv");
const multer = require("multer");
const path = require("path");
const fs = require("fs");

dotenv.config();

const app = express();
app.use(express.json());

const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    const uploadDir = 'uploads/';
    if (!fs.existsSync(uploadDir)) {
      fs.mkdirSync(uploadDir);
    }
    cb(null, uploadDir);
  },
  filename: (req, file, cb) => {
    cb(null, file.fieldname + "-" + Date.now() + path.extname(file.originalname));
  },
});

const upload = multer({ storage: storage });

const dbConfig = {
  host: process.env.DB_HOST || "localhost",
  port: process.env.DB_PORT || "3306",
  user: process.env.DB_USER || "root",
  password: process.env.DB_PASSWORD || "",
  database: process.env.DB_DATABASE || "kerjainaja_db",
};

const getConnection = async () => {
  try {
    const connection = await mysql.createConnection(dbConfig);
    return connection;
  } catch (error) {
    console.error("Gagal terhubung ke database:", error);
    throw error;
  }
};

app.get("/api/jobs", async (req, res) => {
  const keyword = req.query.search;
  let db;
  try {
    db = await getConnection();
    let sql = "SELECT id, company_name, description, image, full_description, requirements, documents FROM jobs";
    let params = [];

    if (keyword) {
      sql += " WHERE company_name LIKE ? OR description LIKE ? OR full_description LIKE ?";
      const searchTerm = `%${keyword}%`;
      params = [searchTerm, searchTerm, searchTerm];
    }

    sql += " ORDER BY id DESC";

    const [rows] = await db.execute(sql, params);
    await db.end();

    const jobs = rows.map(job => ({
      ...job,
      requirements: job.requirements ? JSON.parse(job.requirements) : [],
      documents: job.documents ? JSON.parse(job.documents) : []
    }));

    res.status(200).json(jobs);
  } catch (error) {
    console.error("Error fetching or searching jobs:", error);
    res.status(500).json({ message: "Terjadi kesalahan server saat mengambil lowongan.", error: error.message });
    if (db) { try { db.end(); } catch (e) { } }
  }
});

app.get("/api/jobs/:id", async (req, res) => {
  const { id } = req.params;
  let db;
  try {
    db = await getConnection();
    const sql = "SELECT * FROM jobs WHERE id = ?";
    const [rows] = await db.execute(sql, [id]);
    await db.end();

    if (rows.length === 0) {
      return res.status(404).json({ message: "Lowongan tidak ditemukan." });
    }

    const job = {
      ...rows[0],
      requirements: rows[0].requirements ? JSON.parse(rows[0].requirements) : [],
      documents: rows[0].documents ? JSON.parse(rows[0].documents) : []
    };

    res.status(200).json(job);
  } catch (error) {
    console.error("Error fetching job by ID:", error);
    res.status(500).json({ message: "Terjadi kesalahan server saat mengambil detail lowongan.", error: error.message });
    if (db) { try { db.end(); } catch (e) { } }
  }
});

app.post(
  "/api/applications",
  upload.fields([
    { name: "cv", maxCount: 1 },
    { name: "portofolio", maxCount: 1 },
    { name: "surat_lamaran_kerja", maxCount: 1 },
    { name: "transkrip_nilai", maxCount: 1 },
    { name: "ijazah", maxCount: 1 },
  ]),
  async (req, res) => {
    // dummy
    const job_id = "1";
    const applicant_name = "Pelamar Otomatis";
    const email = "pelamar.otomatis@example.com";

    const cvPath = req.files && req.files["cv"] && req.files["cv"][0] ? req.files["cv"][0].path : null;
    const portofolioPath = req.files && req.files["portofolio"] && req.files["portofolio"][0] ? req.files["portofolio"][0].path : null;
    const suratLamaranKerjaPath = req.files && req.files["surat_lamaran_kerja"] && req.files["surat_lamaran_kerja"][0] ? req.files["surat_lamaran_kerja"][0].path : null;
    const transkripNilaiPath = req.files && req.files["transkrip_nilai"] && req.files["transkrip_nilai"][0] ? req.files["transkrip_nilai"][0].path : null;
    const ijazahPath = req.files && req.files["ijazah"] && req.files["ijazah"][0] ? req.files["ijazah"][0].path : null;

    if (!cvPath) {
        if (portofolioPath && fs.existsSync(portofolioPath)) fs.unlinkSync(portofolioPath);
        if (suratLamaranKerjaPath && fs.existsSync(suratLamaranKerjaPath)) fs.unlinkSync(suratLamaranKerjaPath);
        if (transkripNilaiPath && fs.existsSync(transkripNilaiPath)) fs.unlinkSync(transkripNilaiPath);
        if (ijazahPath && fs.existsSync(ijazahPath)) fs.unlinkSync(ijazahPath);
        return res.status(400).json({ message: "File CV wajib diunggah." });
    }

    let db;
    try {
      db = await getConnection();
      const sql = `
        INSERT INTO applications
        (job_id, applicant_name, email, submitted_at,
         cv_path, portofolio_path, surat_lamaran_kerja_path,
         transkrip_nilai_path, ijazah_path, additional_data)
        VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?)
      `;

      const otherApplicationData = {};

      const [result] = await db.execute(sql, [
        job_id,
        applicant_name,
        email,
        cvPath,
        portofolioPath,
        suratLamaranKerjaPath,
        transkripNilaiPath,
        ijazahPath,
        JSON.stringify(otherApplicationData)
      ]);
      await db.end();

      res.status(201).json({
        message: `Lamaran berhasil diterima (Job ID: ${job_id})!`,
        application_id: result.insertId,
        uploaded_files: {
          cv: cvPath,
          portofolio: portofolioPath,
          surat_lamaran_kerja: suratLamaranKerjaPath,
          transkrip_nilai: transkripNilaiPath,
          ijazah: ijazahPath,
        }
      });
    } catch (error) {
      console.error("Error applying for job:", error);
      if (cvPath && fs.existsSync(cvPath)) fs.unlinkSync(cvPath);
      if (portofolioPath && fs.existsSync(portofolioPath)) fs.unlinkSync(portofolioPath);
      if (suratLamaranKerjaPath && fs.existsSync(suratLamaranKerjaPath)) fs.unlinkSync(suratLamaranKerjaPath);
      if (transkripNilaiPath && fs.existsSync(transkripNilaiPath)) fs.unlinkSync(transkripNilaiPath);
      if (ijazahPath && fs.existsSync(ijazahPath)) fs.unlinkSync(ijazahPath);
      res.status(500).json({ message: "Terjadi kesalahan server saat melamar pekerjaan.", error: error.message });
      if (db) { try { db.end(); } catch (e) { } }
    }
  }
);

const PORT = process.env.PORT || 8000;
app.listen(PORT, () => {
  console.log(`Server berjalan di port ${PORT}`);
});
