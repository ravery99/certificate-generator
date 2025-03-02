CREATE TABLE facilities (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

INSERT INTO facilities (name) VALUES
('Ristra Clinic'),
('Klinik Tirta Muara Teweh'),
('Klinik Jati Medika'),
('UPTD LABORATORIUM KESEHATAN PROVINSI NTT'),
('Klinik Kelmed'),
('Klinik Hidayatullah'),
('Klinik Utama Cahaya Husada Nagan Raya'),
('Rumah Sakit Al-Irsyad'),
('Klinik Tirta Banjarmasin'),
('Klinik Andini');
