<?php
require_once 'Controller.php';
require_once 'models/User.php';
require_once 'models/Event.php';

class Admin extends Controller {
    private $userModel;
    private $eventModel;
    
    public function __construct() {
        $this->userModel = new User();
        $this->eventModel = new Event();
    }
    
    // Admin dashboard
    public function index() {
        // Check if user is admin
        $this->requireAdmin();
        
        // Get all volunteers
        $volunteers = $this->userModel->getVolunteers();
        
        // Get all organizations
        $organizations = $this->userModel->getOrganizations();
        
        // Get all events
        $events = $this->eventModel->getEvents();
        
        $data = [
            'volunteers' => $volunteers,
            'organizations' => $organizations,
            'events' => $events
        ];
        
        $this->view('admin/dashboard', $data);
    }
    
    // Update volunteer status
    public function updateVolunteerStatus() {
        // Check if user is admin
        $this->requireAdmin();
        
        if($this->isPost()) {
            // Get POST data
            $id = $_POST['id'];
            $status = $_POST['status'];
            
            // Update status
            if($this->userModel->updateVolunteerStatus($id, $status)) {
                flash('admin_success', 'Volunteer status updated');
            } else {
                flash('admin_error', 'Something went wrong', 'alert alert-danger');
            }
            
            redirect('admin');
        } else {
            redirect('admin');
        }
    }
    
    // View volunteer details
    public function viewVolunteer($id) {
        // Check if user is admin
        $this->requireAdmin();
        
        // Get volunteer profile
        $volunteer = $this->userModel->getVolunteerProfile($id);
        
        if($volunteer) {
            $this->view('admin/view_volunteer', ['volunteer' => $volunteer]);
        } else {
            redirect('admin');
        }
    }
    
    // View organization details
    public function viewOrganization($id) {
        // Check if user is admin
        $this->requireAdmin();
        
        // Get organization profile
        $organization = $this->userModel->getOrganizationProfile($id);
        
        if($organization) {
            $this->view('admin/view_organization', ['organization' => $organization]);
        } else {
            redirect('admin');
        }
    }
    
    // View event details
    public function viewEvent($id) {
        // Check if user is admin
        $this->requireAdmin();
        
        // Get event details
        $event = $this->eventModel->getEventById($id);
        
        // Get volunteers for event
        $volunteers = $this->eventModel->getEventVolunteers($id);
        
        if($event) {
            $data = [
                'event' => $event,
                'volunteers' => $volunteers
            ];
            
            $this->view('admin/view_event', $data);
        } else {
            redirect('admin');
        }
    }
    
    // Delete event
    public function deleteEvent($id) {
        // Check if user is admin
        $this->requireAdmin();
        
        if($this->eventModel->deleteEvent($id)) {
            flash('admin_success', 'Event deleted');
        } else {
            flash('admin_error', 'Something went wrong', 'alert alert-danger');
        }
        
        redirect('admin');
    }
}