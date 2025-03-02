CREATE TABLE divisions (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO divisions (name) VALUES
('Admisi'),
('Rawat Jalan'),
('Rawat Inap'),
('Rawat Darurat'),
('Kecantikan'),
('Farmasi'),
('Hemodialisa'),
('MCU'),
('OK'),
('VK'),
('Laboratorium'),
('Radiologi'),
('Patologi'),
('Kasir'),
('Keuangan'),
('Kepegawaian'),
('Rekam Medis'),
('IT');
