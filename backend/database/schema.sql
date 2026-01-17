-- E-Portfolio Database Schema
-- This schema provides a comprehensive structure for a portfolio website
-- including user profile, skills, projects, hobbies, education, achievements, and more.

-- Create database
CREATE DATABASE IF NOT EXISTS eportfolio;
USE eportfolio;

-- Table: profile
-- Stores the main user profile information
CREATE TABLE IF NOT EXISTS profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    middle_initial CHAR(1),
    last_name VARCHAR(100) NOT NULL,
    job_title VARCHAR(150),
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    location VARCHAR(255),
    bio TEXT,
    linkedin_url VARCHAR(255),
    github_url VARCHAR(255),
    portfolio_url VARCHAR(255),
    profile_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: skills
-- Lists technical and soft skills with proficiency levels
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    skill_name VARCHAR(100) NOT NULL,
    skill_type ENUM('technical', 'soft') NOT NULL DEFAULT 'technical',
    category VARCHAR(100), -- e.g., 'Programming', 'Design', 'Communication'
    proficiency INT NOT NULL DEFAULT 50, -- 0-100 scale
    years_experience DECIMAL(3,1), -- e.g., 2.5 years
    description TEXT,
    icon VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES profile(id) ON DELETE CASCADE
);

-- Table: hobbies
-- Contains interests or activities outside academics
CREATE TABLE IF NOT EXISTS hobbies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    hobby_name VARCHAR(100) NOT NULL,
    description TEXT,
    category VARCHAR(100), -- Can be used for grouping or year started
    proficiency INT DEFAULT 75, -- 0-100 scale for skill level
    icon VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES profile(id) ON DELETE CASCADE
);

-- Table: projects
-- Displays academic or personal projects with title, description, and links
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    project_url VARCHAR(255), -- Link to live project or repository
    github_url VARCHAR(255),
    demo_url VARCHAR(255),
    image_preview VARCHAR(255), -- Photo preview of the project
    tags VARCHAR(255), -- Comma-separated tags (e.g., 'React,Node.js,MongoDB')
    start_date DATE,
    end_date DATE,
    status ENUM('in_progress', 'completed', 'on_hold') DEFAULT 'completed',
    featured BOOLEAN DEFAULT FALSE, -- Highlight important projects
    display_order INT DEFAULT 0, -- For custom ordering
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES profile(id) ON DELETE CASCADE
);

-- Table: contacts
-- Records inquiries or messages from users
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
    ip_address VARCHAR(45), -- IPv4 or IPv6
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: education
-- Stores educational background
CREATE TABLE IF NOT EXISTS education (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    institution_name VARCHAR(200) NOT NULL,
    degree VARCHAR(150) NOT NULL, -- e.g., 'Bachelor of Science'
    field_of_study VARCHAR(150), -- e.g., 'Computer Science'
    location VARCHAR(255),
    start_date DATE,
    end_date DATE, -- NULL if currently studying
    gpa DECIMAL(3,2), -- e.g., 3.75
    description TEXT,
    logo VARCHAR(255), -- Institution logo
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES profile(id) ON DELETE CASCADE
);

-- Table: certifications
-- Stores professional certifications
CREATE TABLE IF NOT EXISTS certifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    certification_name VARCHAR(200) NOT NULL,
    issuing_organization VARCHAR(200) NOT NULL,
    issue_date DATE,
    expiry_date DATE, -- NULL if no expiration
    credential_id VARCHAR(150),
    credential_url VARCHAR(255),
    description TEXT,
    logo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES profile(id) ON DELETE CASCADE
);

-- Table: achievements
-- Stores school achievements and other accomplishments
CREATE TABLE IF NOT EXISTS achievements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    category VARCHAR(100), -- e.g., 'Academic', 'Sports', 'Competition', 'Award'
    issuer VARCHAR(200), -- Who awarded/recognized this achievement
    date_achieved DATE,
    image VARCHAR(255),
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES profile(id) ON DELETE CASCADE
);

-- Table: experience
-- Stores work experience
CREATE TABLE IF NOT EXISTS experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    company_name VARCHAR(200) NOT NULL,
    job_title VARCHAR(150) NOT NULL,
    location VARCHAR(255),
    employment_type ENUM('full_time', 'part_time', 'contract', 'internship', 'freelance') DEFAULT 'full_time',
    start_date DATE,
    end_date DATE, -- NULL if currently working
    description TEXT,
    responsibilities TEXT,
    achievements TEXT,
    company_logo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES profile(id) ON DELETE CASCADE
);

-- Create indexes for better query performance
CREATE INDEX idx_skills_user_id ON skills(user_id);
CREATE INDEX idx_skills_type ON skills(skill_type);
CREATE INDEX idx_hobbies_user_id ON hobbies(user_id);
CREATE INDEX idx_projects_user_id ON projects(user_id);
CREATE INDEX idx_projects_featured ON projects(featured);
CREATE INDEX idx_contacts_status ON contacts(status);
CREATE INDEX idx_education_user_id ON education(user_id);
CREATE INDEX idx_certifications_user_id ON certifications(user_id);
CREATE INDEX idx_achievements_user_id ON achievements(user_id);
CREATE INDEX idx_experience_user_id ON experience(user_id);

-- Note: The table 'user_profile' referenced in the existing User.class.php
-- is now replaced by 'profile'. Update the class file accordingly.
