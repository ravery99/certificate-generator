CREATE TABLE participants (
    id UUID PRIMARY KEY,  
    email VARCHAR(255) NOT NULL,
    training_date DATE NOT NULL,
    p_name VARCHAR(255) NOT NULL,
    division_id INT NOT NULL,
    facility_id INT NOT NULL,
    phone_number VARCHAR(20) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_division FOREIGN KEY (division_id) REFERENCES divisions(id) ON DELETE CASCADE,
    CONSTRAINT fk_facility FOREIGN KEY (facility_id) REFERENCES facilities(id) ON DELETE CASCADE
);

CREATE INDEX idx_email ON participants(email);
CREATE INDEX idx_training_date ON participants(training_date);
