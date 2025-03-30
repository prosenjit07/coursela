# Coursela - Online Course Selling Platform

## Overview
Coursela is a **PHP-based** online course-selling platform that enables seamless interaction between **teachers, students, and admins**. It provides a structured learning environment where teachers can manage content, students can enroll in courses, and admins oversee platform operations. The platform integrates **SSLCommerz** for secure payment transactions.

## Tech Stack
```plaintext
- PHP (85.1%) - Backend logic and server-side processing
- CSS (9.7%) - Frontend styling
- Hack (3.2%) - Performance improvements
- JavaScript (2.0%) - Client-side interactivity
```

## Features
```plaintext
- Course Management: Teachers can create, edit, and manage course content.
- Student Enrollment: Students can browse and enroll in courses.
- Admin Panel: Admins oversee platform operations and manage users.
- Real-time Collaboration: Interactive discussion forums and chat options.
- Payment Integration: Secure transactions via SSLCommerz (Bkash, Nagad, Rocket, and Cards).
- Responsive Design: Optimized for multiple devices.
```

## Installation
### Prerequisites
```plaintext
- PHP 7.4+
- MySQL 5.7+
- Apache/Nginx
- Composer
```

### Steps
```sh
# Clone the repository
git clone https://github.com/your-username/coursela.git
cd coursela

# Install dependencies
composer install

# Configure the .env file
cp .env.example .env
# Update database credentials
# Configure SSLCommerz API keys

# Run database migrations
php artisan migrate

# Start the development server
php -S localhost:8000 -t public
```

Access the application at **http://localhost:8000**

## Contribution
Feel free to contribute by submitting pull requests or reporting issues.

## License
```plaintext
This project is licensed under the MIT License.
```

---
### **Author**
[Coursela Team](https://github.com/your-username)

