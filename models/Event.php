<?php
require_once 'Model.php';

class Event extends Model {
    // Get all events
    public function getEvents() {
        return $this->getMultiple('SELECT events.*, users.name as organizer_name FROM events 
                                 JOIN users ON events.created_by = users.id 
                                 ORDER BY event_date DESC');
    }
    
    // Get upcoming events
    public function getUpcomingEvents($limit = 0) {
        $sql = 'SELECT events.*, users.name as organizer_name FROM events 
                JOIN users ON events.created_by = users.id 
                WHERE events.event_date >= NOW() 
                ORDER BY event_date ASC';
                
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $limit;
        }
        
        return $this->getMultiple($sql);
    }
    
    // Get past events
    public function getPastEvents($limit = 0) {
        $sql = 'SELECT events.*, users.name as organizer_name FROM events 
                JOIN users ON events.created_by = users.id 
                WHERE events.event_date < NOW() 
                ORDER BY event_date DESC';
                
        if ($limit > 0) {
            $sql .= ' LIMIT ' . $limit;
        }
        
        return $this->getMultiple($sql);
    }
    
    // Get event by ID
    public function getEventById($id) {
        return $this->getSingle('SELECT events.*, users.name as organizer_name FROM events 
                               JOIN users ON events.created_by = users.id 
                               WHERE events.id = :id', [
            ':id' => $id
        ]);
    }
    
    // Create event
    public function createEvent($data) {
        return $this->query('INSERT INTO events (title, description, location, event_date, created_by, image, status) 
                           VALUES (:title, :description, :location, :event_date, :created_by, :image, :status)', [
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':location' => $data['location'],
            ':event_date' => $data['event_date'],
            ':created_by' => $data['created_by'],
            ':image' => $data['image'],
            ':status' => $data['status']
        ]);
    }
    
    // Update event
    public function updateEvent($id, $data) {
        return $this->query('UPDATE events SET 
                           title = :title, 
                           description = :description, 
                           location = :location, 
                           event_date = :event_date, 
                           image = :image, 
                           status = :status 
                           WHERE id = :id', [
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':location' => $data['location'],
            ':event_date' => $data['event_date'],
            ':image' => $data['image'],
            ':status' => $data['status'],
            ':id' => $id
        ]);
    }
    
    // Delete event
    public function deleteEvent($id) {
        return $this->query('DELETE FROM events WHERE id = :id', [
            ':id' => $id
        ]);
    }
    
    // Register volunteer for event
    public function registerVolunteer($eventId, $volunteerId) {
        return $this->query('INSERT INTO event_volunteers (event_id, volunteer_id) 
                           VALUES (:event_id, :volunteer_id)', [
            ':event_id' => $eventId,
            ':volunteer_id' => $volunteerId
        ]);
    }
    
    // Update volunteer event status
    public function updateVolunteerStatus($eventId, $volunteerId, $status) {
        return $this->query('UPDATE event_volunteers SET status = :status 
                           WHERE event_id = :event_id AND volunteer_id = :volunteer_id', [
            ':status' => $status,
            ':event_id' => $eventId,
            ':volunteer_id' => $volunteerId
        ]);
    }
    
    // Get volunteers for event
    public function getEventVolunteers($eventId) {
        return $this->getMultiple('SELECT users.name, volunteers.*, event_volunteers.status 
                                 FROM event_volunteers 
                                 JOIN volunteers ON event_volunteers.volunteer_id = volunteers.id 
                                 JOIN users ON volunteers.user_id = users.id 
                                 WHERE event_volunteers.event_id = :event_id', [
            ':event_id' => $eventId
        ]);
    }
    
    // Get registered volunteers count
    public function getRegisteredVolunteersCount($eventId) {
        $result = $this->getSingle('SELECT COUNT(*) as count FROM event_volunteers 
                                  WHERE event_id = :event_id', [
            ':event_id' => $eventId
        ]);
        return $result ? $result->count : 0;
    }
    
    // Check if volunteer is registered for event
    public function isVolunteerRegistered($eventId, $volunteerId) {
        $result = $this->getSingle('SELECT * FROM event_volunteers 
                                  WHERE event_id = :event_id AND volunteer_id = :volunteer_id', [
            ':event_id' => $eventId,
            ':volunteer_id' => $volunteerId
        ]);
        return $result ? true : false;
    }
    
    // Get registered volunteers
    public function getRegisteredVolunteers($eventId) {
        return $this->getMultiple('SELECT users.name, users.email, volunteers.user_id 
                                 FROM event_volunteers 
                                 JOIN volunteers ON event_volunteers.volunteer_id = volunteers.id 
                                 JOIN users ON volunteers.user_id = users.id 
                                 WHERE event_volunteers.event_id = :event_id', [
            ':event_id' => $eventId
        ]);
    }
    
    // Unregister volunteer from event
    public function unregisterVolunteer($eventId, $volunteerId) {
        return $this->query('DELETE FROM event_volunteers 
                           WHERE event_id = :event_id AND volunteer_id = :volunteer_id', [
            ':event_id' => $eventId,
            ':volunteer_id' => $volunteerId
        ]);
    }
    
    // Get events for volunteer
    public function getVolunteerEvents($volunteerId) {
        return $this->getMultiple('SELECT events.*, event_volunteers.status 
                                 FROM event_volunteers 
                                 JOIN events ON event_volunteers.event_id = events.id 
                                 WHERE event_volunteers.volunteer_id = :volunteer_id 
                                 ORDER BY events.event_date DESC', [
            ':volunteer_id' => $volunteerId
        ]);
    }
    
    // Get events created by organization
    public function getOrganizationEvents($userId) {
        return $this->getMultiple('SELECT * FROM events 
                                 WHERE created_by = :created_by 
                                 ORDER BY event_date DESC', [
            ':created_by' => $userId
        ]);
    }
}