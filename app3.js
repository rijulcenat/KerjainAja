const express = require("express");
const dotenv = require("dotenv");

const pelamarRoutes = require("./routes/pelamarRoutes"); 
const jobAPIRoutes = require("./routes/jobAPIRoutes"); 

dotenv.config();

const app = express();
const PORT = process.env.PORT || 8000;

app.use(express.json());

app.use("/api", pelamarRoutes); 

app.use("/api", jobAPIRoutes);

app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
    console.log(`Pelamar API: http://localhost:${PORT}/api/profile/:id`);
    console.log(`Job API: http://localhost:${PORT}/api/jobs`);
    console.log(`Job Detail API: http://localhost:${PORT}/api/jobs/:id`);
    console.log(`Apply Job API: http://localhost:${PORT}/api/applications`);
});
