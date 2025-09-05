<?php
session_start();

// Flash message helper
function flash($name = '', $message = '', $class = 'alert alert-success'){
    if(!empty($name)){
        // No message, create it
        if(!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name])){  
                unset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name.'_class'])){  
                unset($_SESSION[$name.'_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        }
        // Message exists, display it
        elseif(!empty($_SESSION[$name]) && empty($message)){
            $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
}

// Check if user is logged in
function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    } else {
        return false;
    }
}

// Check if user is admin
function isAdmin(){
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
        return true;
    } else {
        return false;
    }
}

// Check if user is volunteer
function isVolunteer(){
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'volunteer'){
        return true;
    } else {
        return false;
    }
}

// Check if user is organization
function isOrganization(){
    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'organization'){
        return true;
    } else {
        return false;
    }
}

// Check if volunteer is hired
function isHired(){
    if(isset($_SESSION['user_status']) && $_SESSION['user_status'] == 'hired'){
        return true;
    } else {
        return false;
    }
}