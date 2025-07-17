# Blood Bank and Donation Management System

A full-featured web application for managing blood donations, donor and hospital records, and user/admin notifications.  
Built with PHP, MySQL, Bootstrap, and jQuery.

---

## Features

- **User Registration & Login:** Secure authentication for donors and admins.
- **Donor Management:** Add, view, and manage donor records.
- **Hospital Management:** Track hospitals, their blood stock, and reservations.
- **Blood Reservation:** Users can request blood, and hospitals can manage reservations.
- **Admin Dashboard:** View statistics (total donors, hospitals, user queries), manage users, and send notifications.
- **Notification System:**
  - Admins can send notifications to all or selected users.
  - Users see notifications in a bell dropdown, with badges for unread items.
  - Per-user notification deletion and "mark as read" support.
- **Modern UI:** Responsive, card-based design with consistent theming.
- **Informational Pages:** About Us, Why Donate Blood, Blood Tips, Blood Groups, and more.

---

## Project Structure

```
Blood-Bank-And-Donation-Management-System-master/
  ├── admin/                # Admin dashboard, management, and logic
  ├── image/                # Static images
  ├── sql/                  # Database schema
  ├── about_us.php
  ├── contact_us.php
  ├── donate_blood.php
  ├── home.php
  ├── need_blood.php
  ├── user_login.php
  ├── why_donate_blood.php
  ├── conn.php              # Database connection
  ├── head.php              # User header
  ├── footer.php
  └── ... (other files)
```

---

## Setup Instructions

### 1. Requirements

- PHP 7.x or 8.x
- MySQL/MariaDB
- Apache/Nginx (XAMPP, WAMP, or similar recommended)
- Composer (optional, for dependency management)

### 2. Installation

1. **Clone or Download the Repository**
   ```bash
   git clone https://github.com/yourusername/Blood-Bank-And-Donation-Management-System.git
   ```

2. **Database Setup**
   - Import the SQL file:
     - Open `phpMyAdmin` or use the MySQL CLI.
     - Create a new database (e.g., `blood_bank`).
     - Import `sql/blood_bank_database.sql` into your database.

3. **Configure Database Connection**
   - Edit `conn.php` and `admin/conn.php`:
     ```php
     $conn = mysqli_connect("localhost", "root", "", "blood_bank");
     ```
   - Update with your MySQL username, password, and database name as needed.

4. **Set Up Web Server**
   - Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Start Apache and MySQL from your control panel.

5. **Access the Application**
   - Open your browser and go to:  
     `http://localhost/Blood-Bank-And-Donation-Management-System-master/home.php`

---

## Usage

- **User Registration:** New users can register and log in to request blood or become donors.
- **Admin Login:** Admins can log in at `/admin/login.php` to manage the system.
- **Notifications:** Admins can send notifications from the dashboard; users see them in the bell icon.
- **Hospital Management:** Admins can add, edit, and delete hospitals and manage reservations.

---


## Customization

- **Styling:** Modify Bootstrap or custom CSS for branding.
- **Email/SMS Integration:** Add notification hooks for real-world alerts.
- **Security:** For production, secure all forms, sanitize inputs, and use HTTPS.

---

## Troubleshooting

- **Database Errors:** Ensure your database credentials are correct and the SQL file is imported.
- **Session Issues:** Make sure `session_start();` is at the top of all PHP files that require login state.
- **Notification Issues:** Check that the notification tables exist and the AJAX endpoints are correct.

---
## Screenshot
<img width="1919" height="919" alt="Screenshot 2025-07-16 140333" src="https://github.com/user-attachments/assets/063ab6a8-c1e8-4f9b-8227-e140f0bc70d5" />

## License

This project is open-source and free to use for educational and non-commercial purposes.

---

## Credits

This project was developed as a part of our college curriculum by:

 - Hemant Regmi
 - Diroj Khanal
 - Janak Pokharel
---

If you need further help or want to contribute, feel free to open an issue or pull request!
