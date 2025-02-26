CREATE TABLE tb_participant (
    id UUID PRIMARY KEY,
    email TEXT NOT NULL,
    training_date DATE NOT NULL,
    p_name TEXT NOT NULL,
    division TEXT NOT NULL,
    facility TEXT NOT NULL,
    phone_number TEXT DEFAULT NULL,
    certificate_path TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
