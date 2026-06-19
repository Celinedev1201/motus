<?php

return "
CREATE TABLE IF NOT EXISTS words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(50) NOT NULL UNIQUE,
    difficulty ENUM('facile', 'moyen', 'difficile') DEFAULT 'facile'
);
";