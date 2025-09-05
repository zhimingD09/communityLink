<?php
class Controller {
    // Load model
    public function model($model) {
        // Require model file
        require_once '../models/' . $model . '.php';
        // Instantiate model
        return new $model();
    }
    
    // Load view
    public function view($view, $data = []) {
        // Check for view file
        if(file_exists('../views/' . $view . '.php')) {
            require_once '../views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }
    
    // Check if request is POST
    public function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    
    // Get POST data
    public function getPostData() {
        return $_POST;
    }
    
    // Sanitize POST data
    public function sanitizePost() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        return $_POST;
    }
    
    // Redirect
    public function redirect($url) {
        header('location: ' . URLROOT . '/' . $url);
        exit;
    }
    
    // Check if user is logged in
    public function requireLogin() {
        if(!isLoggedIn()) {
            flash('login_required', 'Please log in to access this page', 'alert alert-danger');
            $this->redirect('login');
        }
    }
    
    // Check if user is admin
    public function requireAdmin() {
        if(!isAdmin()) {
            flash('access_denied', 'You do not have permission to access this page', 'alert alert-danger');
            $this->redirect('');
        }
    }
    
    // Check if user is volunteer
    public function requireVolunteer() {
        if(!isVolunteer()) {
            flash('access_denied', 'You do not have permission to access this page', 'alert alert-danger');
            $this->redirect('');
        }
    }
    
    // Check if user is organization
    public function requireOrganization() {
        if(!isOrganization()) {
            flash('access_denied', 'You do not have permission to access this page', 'alert alert-danger');
            $this->redirect('');
        }
    }
    
    // Check if volunteer is hired
    public function requireHired() {
        if(!isHired()) {
            flash('access_denied', 'Your account has not been approved yet', 'alert alert-danger');
            $this->redirect('');
        }
    }
}