# Simple Task Manager

A clean and professional task management application built with Laravel and Bootstrap, designed to demonstrate Laravel development skills and best practices.

## Features

- **User Authentication**: Registration, login, password reset with email verification
- **Task Management**: Create, read, update, and delete tasks with full CRUD operations
- **Task Filtering**: Search by title/description and filter by status
- **Task Sorting**: Sort by due date, title, or priority
- **Responsive Design**: Modern Bootstrap 5 UI with mobile-friendly interface
- **API Endpoint**: RESTful API for tasks (`/api/tasks`)
- **Database Seeding**: Demo data generation for testing
- **Dashboard Analytics**: Task statistics and recent tasks overview

## Project Setup Instructions

### Prerequisites

- PHP 8.2 or higher
- Composer
- SQLite (or MySQL/PostgreSQL)
- Mailtrap account for email testing

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd simple-task-manager
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies (if using frontend assets)**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # For SQLite (recommended for development)
   touch database/database.sqlite
   
   # Update .env file with SQLite configuration:
   # DB_CONNECTION=sqlite
   # DB_DATABASE=database/database.sqlite
   
   # Run migrations
   php artisan migrate
   
   # Seed database with demo data
   php artisan db:seed
   ```

6. **Email configuration** (for password reset functionality)
   ```bash
   # Update .env with Mailtrap credentials
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="noreply@taskmanager.com"
   MAIL_FROM_NAME="Task Manager"
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   - Open your browser and go to `http://localhost:8000`
   - Register a new account or use demo credentials

## Design Decisions

### **Architecture & Framework**
- **Laravel 12**: Chosen for its robust MVC architecture, built-in security features, and excellent documentation
- **Bootstrap 5**: Selected for responsive design, modern UI components, and cross-browser compatibility
- **SQLite**: Used for development simplicity and easy deployment

### **Database Design**
- **User-Task Relationship**: One-to-many relationship ensuring data isolation between users
- **Soft Deletes**: Implemented for tasks to allow data recovery and maintain referential integrity
- **Enum Fields**: Used for status and priority to ensure data consistency
- **Foreign Key Constraints**: Proper relationships with cascade deletes for data integrity

### **Security Implementation**
- **Authentication Middleware**: All task routes protected with auth middleware
- **Authorization Checks**: Users can only access their own tasks
- **CSRF Protection**: Built-in Laravel CSRF protection on all forms
- **Password Hashing**: Secure password storage using Laravel's built-in hashing
- **Input Validation**: Comprehensive server-side validation for all user inputs

### **User Experience Design**
- **Responsive Design**: Mobile-first approach with Bootstrap 5 grid system
- **Intuitive Navigation**: Clear navigation structure with different menus for guests vs authenticated users
- **Visual Feedback**: Success/error messages, loading states, and hover effects
- **Accessibility**: Proper form labels, semantic HTML, and keyboard navigation support

### **Performance Considerations**
- **Pagination**: Implemented for task lists to handle large datasets efficiently
- **Eager Loading**: Proper Eloquent relationships to avoid N+1 query problems
- **Caching**: Session and configuration caching for better performance
- **Optimized Queries**: Efficient database queries with proper indexing

## Assumptions Made

### **Technical Assumptions**
- **PHP Version**: Assumed PHP 8.2+ for modern Laravel features and performance
- **Database**: Assumed SQLite for development simplicity, but designed to work with MySQL/PostgreSQL
- **Email Service**: Assumed Mailtrap for testing, but configurable for production email services
- **Browser Support**: Assumed modern browsers with ES6+ support

### **User Experience Assumptions**
- **User Behavior**: Assumed users prefer simple, intuitive interfaces over complex feature-rich designs
- **Mobile Usage**: Assumed significant mobile usage, hence responsive design priority
- **Task Management**: Assumed users need basic CRUD operations with search and filter capabilities
- **Data Privacy**: Assumed users expect their tasks to be private and secure

### **Business Logic Assumptions**
- **Task Ownership**: Assumed each task belongs to a single user (no shared tasks)
- **Task States**: Assumed three basic states: Pending, In Progress, Completed
- **Priority Levels**: Assumed three priority levels: Low, Medium, High
- **Data Retention**: Assumed soft deletes are preferred over permanent deletion

## Testing Instructions

### **Manual Testing Checklist**

#### **Authentication Testing**
1. **Registration**
   - Navigate to `/register`
   - Fill in all required fields (name, email, password, confirm password)
   - Verify validation errors for invalid inputs
   - Confirm successful registration redirects to dashboard

2. **Login**
   - Navigate to `/login`
   - Test with valid credentials
   - Test with invalid credentials
   - Verify "Remember me" functionality
   - Test password reset functionality

3. **Logout**
   - Login to the application
   - Click logout button
   - Verify redirect to welcome page
   - Confirm session is cleared

#### **Task Management Testing**
1. **Create Task**
   - Login to the application
   - Navigate to "Create Task"
   - Fill in all required fields
   - Test validation for required fields
   - Verify task is created and appears in the list

2. **View Tasks**
   - Navigate to "My Tasks"
   - Verify all user's tasks are displayed
   - Test pagination if more than 10 tasks exist
   - Verify task details are correctly displayed

3. **Edit Task**
   - Click edit button on any task
   - Modify task details
   - Save changes
   - Verify changes are reflected in the task list

4. **Delete Task**
   - Click delete button on any task
   - Confirm deletion
   - Verify task is removed from the list
   - Verify soft delete (task can be restored from database)

#### **Search and Filter Testing**
1. **Search Functionality**
   - Use search box to search by task title
   - Use search box to search by task description
   - Verify search results are accurate
   - Test search with no results

2. **Filter by Status**
   - Use status filter dropdown
   - Select different statuses (Pending, In Progress, Completed)
   - Verify filtered results are correct
   - Test "All Statuses" option

3. **Sorting**
   - Test sorting by due date (ascending/descending)
   - Test sorting by title (ascending/descending)
   - Test sorting by priority (ascending/descending)
   - Verify sort order is maintained with filters

#### **Responsive Design Testing**
1. **Desktop Testing**
   - Test on desktop browsers (Chrome, Firefox, Safari, Edge)
   - Verify all features work correctly
   - Check layout and styling

2. **Mobile Testing**
   - Test on mobile devices or browser dev tools
   - Verify responsive navigation (hamburger menu)
   - Test touch interactions
   - Verify table scrolling on mobile

3. **Tablet Testing**
   - Test on tablet devices or browser dev tools
   - Verify intermediate layout works correctly

#### **API Testing**
1. **API Authentication**
   - Test API endpoint without authentication (should fail)
   - Test API endpoint with authentication (should succeed)

2. **API Response**
   - Verify API returns only user's tasks
   - Check JSON response format
   - Verify all task fields are included

### **Automated Testing**
```bash
# Run all tests
php artisan test

# Run specific test suites
php artisan test --filter=Auth
php artisan test --filter=Task
```

### **Database Testing**
```bash
# Check database migrations
php artisan migrate:status

# Reset database and seed
php artisan migrate:fresh --seed

# Check seeded data
php artisan tinker
>>> App\Models\User::count()
>>> App\Models\Task::count()
```

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Auth/           # Authentication controllers
│   ├── TaskController.php
│   └── HomeController.php
├── Models/
│   ├── User.php
│   └── Task.php
├── Http/Requests/      # Form request validation
├── Http/Middleware/    # Custom middleware
database/
├── migrations/         # Database migrations
├── seeders/           # Data seeders
└── factories/         # Model factories
resources/
└── views/
    ├── auth/          # Authentication views
    ├── tasks/         # Task management views
    ├── layouts/       # Layout templates
    └── components/    # Reusable components
routes/
├── web.php           # Web routes
├── api.php           # API routes
└── auth.php          # Authentication routes
```

## Technologies Used

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Bootstrap 5, Font Awesome Icons
- **Database**: SQLite (development), MySQL/PostgreSQL (production)
- **Authentication**: Laravel Breeze
- **Email**: Mailtrap (testing), SMTP (production)
- **Version Control**: Git

## API Documentation

### **GET /api/tasks**
Returns all tasks for the authenticated user.

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
```

**Response:**
```json
[
    {
        "id": 1,
        "user_id": 1,
        "title": "Complete Project",
        "description": "Finish the task management application",
        "due_date": "2025-01-15",
        "status": "In Progress",
        "priority": "High",
        "created_at": "2025-01-01T10:00:00.000000Z",
        "updated_at": "2025-01-01T10:00:00.000000Z"
    }
]
```

## Deployment Notes

### **Production Deployment**
1. Set `APP_ENV=production` in `.env`
2. Configure production database (MySQL/PostgreSQL)
3. Set up production email service
4. Run `php artisan config:cache`
5. Run `php artisan route:cache`
6. Set up web server (Apache/Nginx)
7. Configure SSL certificate

### **Environment Variables**
```env
APP_NAME="Task Manager"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Task Manager"
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For any questions or issues, please refer to the Laravel documentation or create an issue in the repository.
