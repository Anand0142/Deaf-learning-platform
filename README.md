# Deaf Learning Platform

A web-based learning platform designed to support deaf education, featuring user authentication and feedback systems.

## Features

- User Registration and Authentication
- User Profile Management
- Feedback System
- Modern UI with FontAwesome Integration

## Technologies Used

- PHP
- Supabase (Database and Authentication)
- HTML/CSS
- JavaScript
- FontAwesome for Icons

## Prerequisites

- PHP 7.4 or higher
- Supabase Account
- Web Server (Apache/Nginx)

## Installation

1. Clone the repository
```bash
git clone [your-repository-url]
```

2. Create a `supabase_config.php` file in the root directory with your Supabase credentials:
```php
<?php
$SUPABASE_URL = 'your-supabase-url';
$SUPABASE_KEY = 'your-supabase-anon-key';
```

3. Set up your Supabase database with the required tables:
   - users (id, firstName, lastName, email, password, created_at)
   - feedback (id, name, email, age, feedback, created_at)

4. Configure your web server to serve the application

## Security Note

This is a development version. For production:
- Replace MD5 password hashing with more secure alternatives
- Implement CSRF protection
- Add rate limiting
- Enable HTTPS

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request 
