<?php
require_once 'Model.php';

class User extends Model {
    // Register user
    public function register($data) {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Insert user
        $this->query('INSERT INTO users (name, email, password, role, status) VALUES (:name, :email, :password, :role, :status)', [
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':role' => $data['role'],
            ':status' => $data['status']
        ]);
        
        $userId = $this->lastInsertId();
        
        // If volunteer, add to volunteers table
        if ($data['role'] == 'volunteer') {
            $this->query('INSERT INTO volunteers (user_id) VALUES (:user_id)', [
                ':user_id' => $userId
            ]);
        }
        
        // If organization, add to organizations table
        if ($data['role'] == 'organization') {
            $this->query('INSERT INTO organizations (user_id) VALUES (:user_id)', [
                ':user_id' => $userId
            ]);
        }
        
        return $userId;
    }
    
    // Login user
    public function login($email, $password) {
        $user = $this->getSingle('SELECT * FROM users WHERE email = :email', [
            ':email' => $email
        ]);
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
    
    // Find user by email
    public function findUserByEmail($email) {
        return $this->getSingle('SELECT * FROM users WHERE email = :email', [
            ':email' => $email
        ]);
    }
    
    // Find user by ID
    public function findUserById($id) {
        return $this->getSingle('SELECT * FROM users WHERE id = :id', [
            ':id' => $id
        ]);
    }
    
    // Get all volunteers
    public function getVolunteers() {
        return $this->getMultiple('SELECT users.*, volunteers.* FROM users 
                                 JOIN volunteers ON users.id = volunteers.user_id 
                                 WHERE users.role = "volunteer"');
    }
    
    // Get all organizations
    public function getOrganizations() {
        return $this->getMultiple('SELECT users.*, organizations.* FROM users 
                                 JOIN organizations ON users.id = organizations.user_id 
                                 WHERE users.role = "organization"');
    }
    
    // Update volunteer status
    public function updateVolunteerStatus($id, $status) {
        return $this->query('UPDATE users SET status = :status WHERE id = :id AND role = "volunteer"', [
            ':status' => $status,
            ':id' => $id
        ]);
    }
    
    // Update volunteer profile
    public function updateVolunteerProfile($id, $data) {
        // Update users table
        $this->query('UPDATE users SET name = :name WHERE id = :id', [
            ':name' => $data['name'],
            ':id' => $id
        ]);
        
        // Update volunteers table
        return $this->query('UPDATE volunteers SET 
                           phone = :phone, 
                           address = :address, 
                           skills = :skills, 
                           availability = :availability, 
                           bio = :bio, 
                           profile_image = :profile_image 
                           WHERE user_id = :user_id', [
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':skills' => $data['skills'],
            ':availability' => $data['availability'],
            ':bio' => $data['bio'],
            ':profile_image' => $data['profile_image'],
            ':user_id' => $id
        ]);
    }
    
    // Update organization profile
    public function updateOrganizationProfile($id, $data) {
        // Update users table
        $this->query('UPDATE users SET name = :name WHERE id = :id', [
            ':name' => $data['name'],
            ':id' => $id
        ]);
        
        // Update organizations table
        return $this->query('UPDATE organizations SET 
                           description = :description, 
                           website = :website, 
                           phone = :phone, 
                           address = :address, 
                           logo = :logo 
                           WHERE user_id = :user_id', [
            ':description' => $data['description'],
            ':website' => $data['website'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':logo' => $data['logo'],
            ':user_id' => $id
        ]);
    }
    
    // Get volunteer profile
    public function getVolunteerProfile($id) {
        return $this->getSingle('SELECT users.*, volunteers.* FROM users 
                               JOIN volunteers ON users.id = volunteers.user_id 
                               WHERE users.id = :id', [
            ':id' => $id
        ]);
    }
    
    // Get organization profile
    public function getOrganizationProfile($id) {
        return $this->getSingle('SELECT users.*, organizations.* FROM users 
                               JOIN organizations ON users.id = organizations.user_id 
                               WHERE users.id = :id', [
            ':id' => $id
        ]);
    }
}