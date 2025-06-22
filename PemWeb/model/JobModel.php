<?php

class JobModel {
    public function getAllJobs() {
        return [
            [
                'id' => 1,
                'company_name' => 'MkLaren Digital',
                'description' => 'MkLaren Digital adalah perusahaan teknologi yang bergerak di bidang pengembangan aplikasi mobile.',
                'image' => 'Foto/perusahaan.jpg',
                'full_description' => 'Perusahaan terkemuka di bidang teknologi yang berfokus pada pengembangan solusi inovatif untuk memenuhi kebutuhan pasar yang terus berkembang. Berlokasi di Jakarta, kami memiliki tim yang dinamis dan bersemangat dalam menciptakan produk dan layanan berkualitas tinggi. Sejak didirikan pada 2011, kami telah berkomitmen untuk memberikan dampak positif melalui teknologi. Budaya kerja kami mendorong kolaborasi, kreativitas, dan pembelajaran berkelanjutan. Kami percaya bahwa setiap individu memiliki potensi untuk tumbuh dan berkontribusi secara signifikan. Visi kami adalah menjadi pionir dalam industri dengan terus berinovasi dan beradaptasi dengan perubahan zaman. Misi kami adalah memberdayakan karyawan kami, memberikan nilai terbaik kepada pelanggan, dan memberikan kontribusi yang berarti bagi masyarakat.',
                'requirements' => [
                    'Usia minimal 18 tahun.',
                    'Pendidikan minimal D3 di bidang IT.',
                    'Mampu bekerja secara individu maupun dalam tim.',
                    'Memiliki kemampuan komunikasi yang baik.',
                    'Memiliki pengalaman kerja minimal 1-2 tahun di posisi serupa (opsional).',
                ],
                'documents' => [
                    'Curriculum Vitae (CV) terbaru.',
                    'Surat Lamaran Kerja.',
                    'Salinan Ijazah terakhir.',
                    'Salinan Transkrip Nilai.',
                    'Portofolio (relevan dengan posisi yang dilamar).',
                ]
            ],
            [
                'id' => 2,
                'company_name' => 'Lentera Jaya Nusantara',
                'description' => 'Bergabunglah dengan Penggerak di Lentera Jaya Nusantara yang berfokus pada pembaruan distribusi pangan.',
                'image' => 'Foto/perusahaan2.jpg',
                'full_description' => 'Lentera Jaya Nusantara adalah perusahaan yang berfokus pada inovasi distribusi pangan. Kami percaya pada efisiensi dan keberlanjutan dalam setiap langkah rantai pasok.',
                'requirements' => ['Minimal S1 Pertanian/Manajemen.', 'Pengalaman di bidang logistik pangan minimal 2 tahun.'],
                'documents' => ['CV', 'Surat Lamaran', 'Ijazah']
            ],
            [
                'id' => 3,
                'company_name' => 'Sehun Studios',
                'description' => 'Sehun Studios adalah agensi yang bergerak di bidang desain grafis & produksi konten multimedia.',
                'image' => 'Foto/perusahaan3.jpg',
                'full_description' => 'Sehun Studios adalah agensi kreatif terkemuka yang menyediakan layanan desain grafis dan produksi konten multimedia. Kami mencari individu berbakat untuk bergabung dengan tim kami.',
                'requirements' => ['Pendidikan minimal D3 Desain Grafis.', 'Mahir Adobe Creative Suite.'],
                'documents' => ['CV', 'Surat Lamaran', 'Portofolio']
            ],
            [
                'id' => 4,
                'company_name' => 'Surya Energi',
                'description' => 'Surya Energi adalah perusahaan yang berfokus pada instalasi panel surya hunian dan komersial',
                'image' => 'Foto/perusahaan4.jpg',
                'full_description' => 'Surya Energi adalah pelopor dalam solusi energi terbarukan, mengkhususkan diri pada instalasi panel surya untuk hunian dan komersial. Bergabunglah dengan kami untuk masa depan yang lebih hijau.',
                'requirements' => ['Minimal SMK Teknik Elektro.', 'Pengalaman instalasi panel surya.'],
                'documents' => ['CV', 'Surat Lamaran', 'Sertifikat keahlian']
            ],
            [
                'id' => 5,
                'company_name' => 'Chanyeol Creative',
                'description' => 'Chanyeol Creative adalah studio kreatif yang bergerak di bidang pengembangan desain interior.',
                'image' => 'Foto/perusahaan4.jpg', 
                'full_description' => 'Chanyeol Creative adalah studio desain interior inovatif yang menciptakan ruang indah dan fungsional. Kami mencari desainer berbakat untuk memperluas tim kami.',
                'requirements' => ['Minimal S1 Desain Interior.', 'Memiliki portofolio desain yang kuat.'],
                'documents' => ['CV', 'Surat Lamaran', 'Portofolio']
            ],
            [
                'id' => 6,
                'company_name' => 'Interaktif Indo',
                'description' => 'Interaktif Indo yaitu perusahaan konsultan teknologi informasi yang spesialis dalam CRM.',
                'image' => 'Foto/perusahaan.jpg', 
                'full_description' => 'Interaktif Indo adalah konsultan teknologi informasi terkemuka yang berspesialisasi dalam implementasi sistem CRM. Kami membantu bisnis mengoptimalkan hubungan pelanggan mereka.',
                'requirements' => ['Minimal S1 Sistem Informasi/Teknik Informatika.', 'Pengalaman dengan sistem CRM (Salesforce, Dynamics).'],
                'documents' => ['CV', 'Surat Lamaran', 'Ijazah']
            ]
        ];
    }

    public function getJobById($id) {
        $jobs = $this->getAllJobs();
        foreach ($jobs as $job) {
            if ($job['id'] == $id) {
                return $job;
            }
        }
        return null; 
    }
}