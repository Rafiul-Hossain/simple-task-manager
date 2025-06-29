-- Simple Task Manager Database Schema
-- Generated for Laravel Task Manager Application
-- Date: 2025-01-01

-- Users Table
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Tasks Table
CREATE TABLE tasks (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    due_date DATE NOT NULL,
    status ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
    priority ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
    deleted_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Password Reset Tokens Table
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
);

-- Personal Access Tokens Table
CREATE TABLE personal_access_tokens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    abilities TEXT NULL,
    last_used_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX personal_access_tokens_tokenable_type_tokenable_id_index (tokenable_type, tokenable_id)
);

-- Failed Jobs Table
CREATE TABLE failed_jobs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload LONGTEXT NOT NULL,
    exception LONGTEXT NOT NULL,
    failed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cache Table
CREATE TABLE cache (
    `key` VARCHAR(255) NOT NULL PRIMARY KEY,
    `value` MEDIUMTEXT NOT NULL,
    expiration INTEGER NOT NULL
);

-- Sessions Table
CREATE TABLE sessions (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
);

-- Sample Data

-- Sample Users
INSERT INTO users (id, name, email, password, created_at, updated_at) VALUES
(1, 'John Doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW()),
(2, 'Jane Smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());

-- Sample Tasks for User 1
INSERT INTO tasks (user_id, title, description, due_date, status, priority, created_at, updated_at) VALUES
(1, 'Complete Project Documentation', 'Write comprehensive documentation for the task manager application', '2025-01-15', 'In Progress', 'High', NOW(), NOW()),
(1, 'Review Code Quality', 'Perform code review and implement improvements', '2025-01-20', 'Pending', 'Medium', NOW(), NOW()),
(1, 'Setup Production Environment', 'Configure production server and deploy application', '2025-01-25', 'Pending', 'High', NOW(), NOW()),
(1, 'Write Unit Tests', 'Create comprehensive test suite for all features', '2025-01-18', 'Completed', 'Medium', NOW(), NOW()),
(1, 'Design User Interface', 'Create mockups and implement responsive design', '2025-01-12', 'Completed', 'Low', NOW(), NOW());

-- Sample Tasks for User 2
INSERT INTO tasks (user_id, title, description, due_date, status, priority, created_at, updated_at) VALUES
(2, 'Database Optimization', 'Optimize database queries and add indexes', '2025-01-22', 'In Progress', 'High', NOW(), NOW()),
(2, 'Security Audit', 'Perform security audit and fix vulnerabilities', '2025-01-28', 'Pending', 'High', NOW(), NOW()),
(2, 'API Documentation', 'Create API documentation with examples', '2025-01-16', 'Completed', 'Medium', NOW(), NOW()),
(2, 'Performance Testing', 'Conduct load testing and optimize performance', '2025-01-30', 'Pending', 'Medium', NOW(), NOW()),
(2, 'User Training', 'Prepare training materials for end users', '2025-02-05', 'Pending', 'Low', NOW(), NOW());

-- Indexes for Performance
CREATE INDEX tasks_user_id_index ON tasks(user_id);
CREATE INDEX tasks_status_index ON tasks(status);
CREATE INDEX tasks_priority_index ON tasks(priority);
CREATE INDEX tasks_due_date_index ON tasks(due_date);
CREATE INDEX tasks_deleted_at_index ON tasks(deleted_at); 