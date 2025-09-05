<?php
// Simple page redirect
function redirect($page){
    header('location: ' . URLROOT . '/' . $page);
    exit;
}

// Get current URL
function getCurrentUrl() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

// Check if URL is active
function isActiveUrl($url) {
    $currentUrl = getCurrentUrl();
    $urlToCheck = URLROOT . '/' . $url;
    
    if ($url == '' && (URLROOT == $currentUrl || URLROOT . '/' == $currentUrl)) {
        return true;
    }
    
    return strpos($currentUrl, $urlToCheck) === 0;
}