-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestion_etudiants;
USE gestion_etudiants;

-- Table des filières
CREATE TABLE filieres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL UNIQUE
);

-- Table des étudiants
CREATE TABLE etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    filiere_id INT NOT NULL,
    FOREIGN KEY (filiere_id) REFERENCES filieres(id) ON DELETE CASCADE
);

-- Insertion de données de test
INSERT INTO filieres (nom) VALUES 
('Informatique'),
('Mathématiques'),
('Physique'),
('Chimie'),
('Biologie'),
('Économie'),
('Droit');

-- Insertion d'étudiants de test
INSERT INTO etudiants (nom, prenom, filiere_id) VALUES
('Dupont', 'Jean', 1),
('Martin', 'Marie', 1),
('Bernard', 'Pierre', 2),
('Thomas', 'Sophie', 3),
('Petit', 'Luc', 4),
('Robert', 'Julie', 5),
('Richard', 'Paul', 6),
('Durand', 'Claire', 7);