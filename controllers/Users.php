<?php
require_once 'Controller.php';
require_once 'models/User.php';

class Users extends Controller {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    // Register volunteer
    public function registerVolunteer() {
        // Check for POST
        if($this->isPost()) {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            
            // Validate name
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }
            
            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }
            
            // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            
            // Validate confirm password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }
            
            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated
                
                // Register User
                $userData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'role' => 'volunteer',
                    'status' => 'inactive'
                ];
                
                if($this->userModel->register($userData)) {
                    flash('register_success', 'You are registered! Your account will be reviewed by an admin.');
                    redirect('login');
                } else {
                    die('Something went wrong');
                }
                
            } else {
                // Load view with errors
                $this->view('users/register_volunteer', $data);
            }
            
        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            
            // Load view
            $this->view('users/register_volunteer', $data);
        }
    }
    
    // Register organization
    public function registerOrganization() {
        // Check for POST
        if($this->isPost()) {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            
            // Validate name
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter organization name';
            }
            
            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }
            
            // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }
            
            // Validate confirm password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }
            
            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Validated
                
                // Register User
                $userData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'role' => 'organization',
                    'status' => 'active'
                ];
                
                if($this->userModel->register($userData)) {
                    flash('register_success', 'You are registered and can now log in');
                    redirect('login');
                } else {
                    die('Something went wrong');
                }
                
            } else {
                // Load view with errors
                $this->view('users/register_organization', $data);
            }
            
        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            
            // Load view
            $this->view('users/register_organization', $data);
        }
    }
    
    // Login user
    public function login() {
        // Check for POST
        if($this->isPost()) {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];
            
            // Validate email
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            
            // Validate password
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            
            // Check for user/email
            if($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                // User not found
                $data['email_err'] = 'No user found';
            }
            
            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                
                if($loggedInUser) {
                    // Check if volunteer is hired
                    if($loggedInUser->role == 'volunteer' && $loggedInUser->status != 'hired') {
                        flash('login_error', 'Your account has not been approved yet', 'alert alert-danger');
                        $this->view('users/login', $data);
                        return;
                    }
                    
                    // Create session
                    $_SESSION['user_id'] = $loggedInUser->id;
                    $_SESSION['user_email'] = $loggedInUser->email;
                    $_SESSION['user_name'] = $loggedInUser->name;
                    $_SESSION['user_role'] = $loggedInUser->role;
                    $_SESSION['user_status'] = $loggedInUser->status;
                    
                    // Redirect based on role
                    if($loggedInUser->role == 'admin') {
                        redirect('admin');
                    } else {
                        redirect('profile');
                    }
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
                
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
            
        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            
            // Load view
            $this->view('users/login', $data);
        }
    }
    
    // Logout user
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_status']);
        session_destroy();
        redirect('login');
    }
    
    // User profile
    public function profile() {
        // Check if user is logged in
        $this->requireLogin();
        
        // Get user data based on role
        if(isVolunteer()) {
            $profile = $this->userModel->getVolunteerProfile($_SESSION['user_id']);
            $this->view('users/volunteer_profile', ['profile' => $profile]);
        } elseif(isOrganization()) {
            $profile = $this->userModel->getOrganizationProfile($_SESSION['user_id']);
            $this->view('users/organization_profile', ['profile' => $profile]);
        } else {
            redirect('');
        }
    }
    
    // Update volunteer profile
    public function updateVolunteerProfile() {
        // Check if user is logged in and is volunteer
        $this->requireLogin();
        $this->requireVolunteer();
        $this->requireHired();
        
        if($this->isPost()) {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Handle file upload for profile image
            $profileImage = '';
            if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
                $uploadDir = 'uploads/profiles/';
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . $_FILES['profile_image']['name'];
                $filePath = $uploadDir . $fileName;
                
                if(move_uploaded_file($_FILES['profile_image']['tmp_name'], $filePath)) {
                    $profileImage = $filePath;
                }
            } else {
                // Keep existing image
                $profile = $this->userModel->getVolunteerProfile($_SESSION['user_id']);
                $profileImage = $profile->profile_image;
            }
            
            // Update data
            $data = [
                'name' => trim($_POST['name']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'skills' => trim($_POST['skills']),
                'availability' => trim($_POST['availability']),
                'bio' => trim($_POST['bio']),
                'profile_image' => $profileImage
            ];
            
            if($this->userModel->updateVolunteerProfile($_SESSION['user_id'], $data)) {
                flash('profile_success', 'Profile updated successfully');
                redirect('profile');
            } else {
                die('Something went wrong');
            }
            
        } else {
            // Get current profile
            $profile = $this->userModel->getVolunteerProfile($_SESSION['user_id']);
            $this->view('users/edit_volunteer_profile', ['profile' => $profile]);
        }
    }
    
    // Update organization profile
    public function updateOrganizationProfile() {
        // Check if user is logged in and is organization
        $this->requireLogin();
        $this->requireOrganization();
        
        if($this->isPost()) {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Handle file upload for logo
            $logo = '';
            if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $uploadDir = 'uploads/logos/';
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . $_FILES['logo']['name'];
                $filePath = $uploadDir . $fileName;
                
                if(move_uploaded_file($_FILES['logo']['tmp_name'], $filePath)) {
                    $logo = $filePath;
                }
            } else {
                // Keep existing logo
                $profile = $this->userModel->getOrganizationProfile($_SESSION['user_id']);
                $logo = $profile->logo;
            }
            
            // Update data
            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'website' => trim($_POST['website']),
                'phone' => trim($_POST['phone']),
                'address' => trim($_POST['address']),
                'logo' => $logo
            ];
            
            if($this->userModel->updateOrganizationProfile($_SESSION['user_id'], $data)) {
                flash('profile_success', 'Profile updated successfully');
                redirect('profile');
            } else {
                die('Something went wrong');
            }
            
        } else {
            // Get current profile
            $profile = $this->userModel->getOrganizationProfile($_SESSION['user_id']);
            $this->view('users/edit_organization_profile', ['profile' => $profile]);
        }
    }
}