<?php
require_once 'Controller.php';
require_once 'models/Event.php';

class Pages extends Controller {
    private $eventModel;
    
    public function __construct() {
        $this->eventModel = new Event();
    }
    
    // Home page
    public function index() {
        // Get upcoming events for homepage
        $upcomingEvents = $this->eventModel->getUpcomingEvents(3);
        $pastEvents = $this->eventModel->getPastEvents(3);
        
        $data = [
            'title' => 'Welcome to ' . SITENAME,
            'description' => 'Connect with your community through volunteering opportunities',
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents
        ];
        
        $this->view('pages/index', $data);
    }
    
    // About page
    public function about() {
        $data = [
            'title' => 'About ' . SITENAME,
            'description' => SITENAME . ' is a platform that connects volunteers with organizations to create positive impact in communities.'
        ];
        
        $this->view('pages/about', $data);
    }
}