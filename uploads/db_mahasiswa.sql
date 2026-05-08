DROP DATABASE IF EXISTS mahasiswa_crud;

CREATE DATABASE mahasiswa_crud;
USE mahasiswa_crud;

CREATE TABLE mahasiswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama_lengkap VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);