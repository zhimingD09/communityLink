# CommunityLink

CommunityLink is a web application that connects volunteers with organizations for community service events. The platform allows organizations to create and manage events, while volunteers can browse and register for these events.

## Features

- **User Authentication**: Secure login and registration system for volunteers, organizations, and administrators
- **Role-Based Access Control**: Different features and permissions for volunteers, organizations, and administrators
- **Event Management**: Create, edit, view, and delete community service events
- **Volunteer Registration**: Volunteers can register for events and view their registration history
- **Admin Dashboard**: Administrators can manage users, approve volunteers, and oversee all events
- **Responsive Design**: Mobile-friendly interface built with Bootstrap

## Technologies Used

- **Backend**: PHP (MVC Architecture)
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 4, Font Awesome
- **Dependencies**: jQuery, Popper.js

## Installation

1. Clone the repository
   ```
   git clone https://github.com/yourusername/communityLink.git
   ```

2. Import the database schema
   ```
   mysql -u username -p database_name < database/setup.sql
   ```

3. Configure the database connection
   - Edit `config/config.php` with your database credentials

4. Set up a web server (Apache/Nginx) to point to the project directory

5. Access the application through your web browser

## Project Structure

```
├── config/             # Configuration files
├── controllers/        # Controller classes
├── database/           # Database schema and migrations
├── helpers/            # Helper functions
├── models/             # Model classes
├── public/             # Publicly accessible files
│   ├── css/            # Stylesheets
│   ├── img/            # Images
│   └── js/             # JavaScript files
└── views/              # View templates
    ├── admin/          # Admin views
    ├── events/         # Event views
    ├── inc/            # Included files (header, footer, etc.)
    ├── pages/          # Static page views
    └── users/          # User-related views
```

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Bootstrap for the responsive UI components
- Font Awesome for the icons