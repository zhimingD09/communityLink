-- Drop database if exists and create a new one
DROP DATABASE IF EXISTS communitylink;
CREATE DATABASE communitylink;
USE communitylink;

-- Users table (for all user types)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'volunteer', 'organization') NOT NULL,
    status ENUM('active', 'inactive', 'hired') NOT NULL DEFAULT 'inactive',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Volunteers table (extends users)
CREATE TABLE volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    skills TEXT,
    availability TEXT,
    bio TEXT,
    profile_image VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Organizations table (extends users)
CREATE TABLE organizations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    description TEXT,
    website VARCHAR(255),
    phone VARCHAR(20),
    address TEXT,
    logo VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Events table
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    event_date DATETIME NOT NULL,
    created_by INT NOT NULL,
    image VARCHAR(255),
    status ENUM('upcoming', 'ongoing', 'completed') NOT NULL DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- Event Volunteers (Many-to-Many relationship)
CREATE TABLE event_volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    volunteer_id INT NOT NULL,
    status ENUM('registered', 'confirmed', 'attended', 'cancelled') NOT NULL DEFAULT 'registered',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (volunteer_id) REFERENCES volunteers(id) ON DELETE CASCADE,
    UNIQUE KEY (event_id, volunteer_id)
);

-- Insert admin user
INSERT INTO users (name, email, password, role, status) VALUES 
('Admin', 'admin@communitylink.com', '$2y$10$abcdefghijklmnopqrstuuWzlCv86Y7EuV6gsH6wOgXxOBqOxhC6', 'admin', 'active');
-- Note: The password hash above is for 'password123' - in a real application, generate this properly

-- Sample data for testing
INSERT INTO users (name, email, password, role, status) VALUES 
('John Volunteer', 'john@example.com', '$2y$10$abcdefghijklmnopqrstuuWzlCv86Y7EuV6gsH6wOgXxOBqOxhC6', 'volunteer', 'inactive'),
('Jane Volunteer', 'jane@example.com', '$2y$10$abcdefghijklmnopqrstuuWzlCv86Y7EuV6gsH6wOgXxOBqOxhC6', 'volunteer', 'hired'),
('Charity Org', 'charity@example.org', '$2y$10$abcdefghijklmnopqrstuuWzlCv86Y7EuV6gsH6wOgXxOBqOxhC6', 'organization', 'active');

INSERT INTO volunteers (user_id, phone, address, skills, availability, bio) VALUES 
(2, '123-456-7890', '123 Main St', 'Communication, Leadership', 'Weekends', 'Passionate about helping others'),
(3, '987-654-3210', '456 Oak Ave', 'Event Planning, First Aid', 'Evenings and Weekends', 'Experienced volunteer with 5 years of community service');

INSERT INTO organizations (user_id, description, website, phone, address) VALUES 
(4, 'We help local communities through various programs', 'www.charityorg.org', '555-123-4567', '789 Charity Lane');

INSERT INTO events (title, description, location, event_date, created_by, status) VALUES 
('Community Cleanup', 'Join us for a day of cleaning up the local park', 'Central Park', '2023-12-15 09:00:00', 4, 'upcoming'),
('Food Drive', 'Help collect food for those in need', 'Community Center', '2023-12-20 10:00:00', 4, 'upcoming'),
('Past Event', 'This was a great event', 'Downtown', '2023-01-10 09:00:00', 4, 'completed');

INSERT INTO event_volunteers (event_id, volunteer_id, status) VALUES 
(1, 2, 'registered'),
(2, 1, 'confirmed');