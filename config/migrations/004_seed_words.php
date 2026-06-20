<?php

return "
INSERT IGNORE INTO words (word, difficulty) VALUES
('TABLE', 'facile'),
('CHIEN', 'facile'),
('ROUGE', 'facile'),
('LIVRE', 'facile'),
('FLEUR', 'facile'),

('MAISON', 'moyen'),
('JARDIN', 'moyen'),
('ORANGE', 'moyen'),
('BATEAU', 'moyen'),
('SOLEIL', 'moyen'),

('PLANETE', 'difficile'),
('MYSTERE', 'difficile'),
('CHATEAU', 'difficile'),
('FANTOME', 'difficile'),
('COURAGE', 'difficile');
";