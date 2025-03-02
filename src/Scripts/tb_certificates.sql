CREATE TABLE certificates (
    participant_id UUID PRIMARY KEY,  -- Sekaligus jadi FK
    certificate_filename TEXT NOT NULL,
    certificate_link TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (participant_id) REFERENCES tb_participant(id) ON DELETE CASCADE
);
