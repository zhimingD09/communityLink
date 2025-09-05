<?php
require_once 'Controller.php';
require_once 'models/Event.php';
require_once 'models/User.php';

class Events extends Controller {
    private $eventModel;
    private $userModel;
    
    public function __construct() {
        $this->eventModel = new Event();
        $this->userModel = new User();
    }
    
    // Events listing
    public function index() {
        // Get upcoming events
        $upcomingEvents = $this->eventModel->getUpcomingEvents();
        
        // Get past events
        $pastEvents = $this->eventModel->getPastEvents();
        
        $data = [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents
        ];
        
        $this->view('events/index', $data);
    }
    
    // View event details
    public function show($id) {
        // Get event details
        $event = $this->eventModel->getEventById($id);
        
        if($event) {
            // Get registered volunteers count
            $registeredCount = $this->eventModel->getRegisteredVolunteersCount($id);
            
            // Check if current user is registered
            $isRegistered = false;
            if(isLoggedIn() && isVolunteer()) {
                $volunteer = $this->userModel->getVolunteerProfile($_SESSION['user_id']);
                if($volunteer) {
                    $isRegistered = $this->eventModel->isVolunteerRegistered($id, $volunteer->id);
                }
            }
            
            // Get registered volunteers
            $registeredVolunteers = $this->eventModel->getRegisteredVolunteers($id);
            
            $data = [
                'event' => $event,
                'registered_count' => $registeredCount,
                'is_registered' => $isRegistered,
                'registered_volunteers' => $registeredVolunteers
            ];
            
            $this->view('events/show', $data);
        } else {
            redirect('events');
        }
    }
    
    // Create event
    public function create() {
        // Check if user is logged in and is organization
        $this->requireLogin();
        $this->requireOrganization();
        
        if($this->isPost()) {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Handle file upload for event image
            $eventImage = '';
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadDir = 'uploads/events/';
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . $_FILES['image']['name'];
                $filePath = $uploadDir . $fileName;
                
                if(move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    $eventImage = $filePath;
                }
            }
            
            // Init data
            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'location' => trim($_POST['location']),
                'event_date' => trim($_POST['event_date']),
                'created_by' => $_SESSION['user_id'],
                'image' => $eventImage,
                'status' => 'upcoming',
                'title_err' => '',
                'description_err' => '',
                'location_err' => '',
                'event_date_err' => ''
            ];
            
            // Validate title
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            
            // Validate description
            if(empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }
            
            // Validate location
            if(empty($data['location'])) {
                $data['location_err'] = 'Please enter location';
            }
            
            // Validate event date
            if(empty($data['event_date'])) {
                $data['event_date_err'] = 'Please enter event date';
            }
            
            // Make sure errors are empty
            if(empty($data['title_err']) && empty($data['description_err']) && empty($data['location_err']) && empty($data['event_date_err'])) {
                // Validated
                
                if($this->eventModel->createEvent($data)) {
                    flash('event_success', 'Event created successfully');
                    redirect('events');
                } else {
                    die('Something went wrong');
                }
                
            } else {
                // Load view with errors
                $this->view('events/create', $data);
            }
            
        } else {
            // Init data
            $data = [
                'title' => '',
                'description' => '',
                'location' => '',
                'event_date' => '',
                'image' => '',
                'title_err' => '',
                'description_err' => '',
                'location_err' => '',
                'event_date_err' => ''
            ];
            
            // Load view
            $this->view('events/create', $data);
        }
    }
    
    // Edit event
    public function edit($id) {
        // Check if user is logged in and is organization
        $this->requireLogin();
        $this->requireOrganization();
        
        // Get event
        $event = $this->eventModel->getEventById($id);
        
        // Check if event exists and user is the creator
        if(!$event || $event->created_by != $_SESSION['user_id']) {
            redirect('events');
        }
        
        if($this->isPost()) {
            // Process form
            
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Handle file upload for event image
            $eventImage = $event->image; // Default to current image
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $uploadDir = 'uploads/events/';
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . $_FILES['image']['name'];
                $filePath = $uploadDir . $fileName;
                
                if(move_uploaded_file($_FILES['image']['tmp_name'], $filePath)) {
                    $eventImage = $filePath;
                }
            }
            
            // Init data
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'location' => trim($_POST['location']),
                'event_date' => trim($_POST['event_date']),
                'image' => $eventImage,
                'status' => trim($_POST['status']),
                'title_err' => '',
                'description_err' => '',
                'location_err' => '',
                'event_date_err' => ''
            ];
            
            // Validate title
            if(empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            
            // Validate description
            if(empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }
            
            // Validate location
            if(empty($data['location'])) {
                $data['location_err'] = 'Please enter location';
            }
            
            // Validate event date
            if(empty($data['event_date'])) {
                $data['event_date_err'] = 'Please enter event date';
            }
            
            // Make sure errors are empty
            if(empty($data['title_err']) && empty($data['description_err']) && empty($data['location_err']) && empty($data['event_date_err'])) {
                // Validated
                
                if($this->eventModel->updateEvent($id, $data)) {
                    flash('event_success', 'Event updated successfully');
                    redirect('events');
                } else {
                    die('Something went wrong');
                }
                
            } else {
                // Load view with errors
                $this->view('events/edit', $data);
            }
            
        } else {
            // Init data
            $data = [
                'id' => $id,
                'title' => $event->title,
                'description' => $event->description,
                'location' => $event->location,
                'event_date' => $event->event_date,
                'image' => $event->image,
                'status' => $event->status,
                'title_err' => '',
                'description_err' => '',
                'location_err' => '',
                'event_date_err' => ''
            ];
            
            // Load view
            $this->view('events/edit', $data);
        }
    }
    
    // Delete event
    public function delete($id) {
        // Check if user is logged in and is organization
        $this->requireLogin();
        $this->requireOrganization();
        
        // Get event
        $event = $this->eventModel->getEventById($id);
        
        // Check if event exists and user is the creator
        if(!$event || $event->created_by != $_SESSION['user_id']) {
            redirect('events');
        }
        
        if($this->eventModel->deleteEvent($id)) {
            flash('event_success', 'Event deleted successfully');
        } else {
            flash('event_error', 'Something went wrong', 'alert alert-danger');
        }
        
        redirect('events');
    }
    
    // Register for event
    public function register($id) {
        // Check if user is logged in and is volunteer
        $this->requireLogin();
        $this->requireVolunteer();
        $this->requireHired();
        
        // Get event
        $event = $this->eventModel->getEventById($id);
        
        if(!$event) {
            redirect('events');
        }
        
        // Get volunteer ID
        $volunteer = $this->userModel->getVolunteerProfile($_SESSION['user_id']);
        
        if($this->eventModel->registerVolunteer($id, $volunteer->id)) {
            flash('event_success', 'You have registered for this event');
        } else {
            flash('event_error', 'Something went wrong', 'alert alert-danger');
        }
        
        redirect('events/show/' . $id);
    }
    
    // Unregister from event
    public function unregister($id) {
        // Check if user is logged in and is volunteer
        $this->requireLogin();
        $this->requireVolunteer();
        $this->requireHired();
        
        // Get event
        $event = $this->eventModel->getEventById($id);
        
        if(!$event) {
            redirect('events');
        }
        
        // Get volunteer ID
        $volunteer = $this->userModel->getVolunteerProfile($_SESSION['user_id']);
        
        if($this->eventModel->unregisterVolunteer($id, $volunteer->id)) {
            flash('event_success', 'You have been unregistered from this event');
        } else {
            flash('event_error', 'Something went wrong', 'alert alert-danger');
        }
        
        redirect('events/show/' . $id);
    }
    
    // My events (for volunteers)
    public function myEvents() {
        // Check if user is logged in and is volunteer
        $this->requireLogin();
        $this->requireVolunteer();
        $this->requireHired();
        
        // Get volunteer ID
        $volunteer = $this->userModel->getVolunteerProfile($_SESSION['user_id']);
        
        // Get events for volunteer
        $events = $this->eventModel->getVolunteerEvents($volunteer->id);
        
        $this->view('events/my_events', ['events' => $events]);
    }
    
    // Organization events
    public function organizationEvents() {
        // Check if user is logged in and is organization
        $this->requireLogin();
        $this->requireOrganization();
        
        // Get events created by organization
        $events = $this->eventModel->getOrganizationEvents($_SESSION['user_id']);
        
        $this->view('events/organization_events', ['events' => $events]);
    }
}