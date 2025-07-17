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
<img width="1919" height="922" alt="Screenshot 2025-07-16 135911" src="https://github.com/user-attachments/assets/fa4fd3a7-c161-488e-ad67-009f092d4ad6" />
<img width="1919" height="917" alt="Screenshot 2025-07-16 135938" src="https://github.com/user-attachments/assets/2e3868b4-30e1-4eab-b626-b440dd7a8aca" />
<img width="1919" height="917" alt="Screenshot 2025-07-16 135951" src="https://github.com/user-attachments/assets/bff472a5-1999-447c-94a7-c1ad9cc10624" />
<img width="1919" height="912" alt="Screenshot 2025-07-16 140002" src="https://github.com/user-attachments/assets/bee37b53-051b-4464-92cb-79a465e5e4bc" />
<img width="1919" height="917" alt="Screenshot 2025-07-16 140016" src="https://github.com/user-attachments/assets/ae8a9074-8e65-4fa2-9149-58b22870afde" />
<img width="1919" height="922" alt="Screenshot 2025-07-16 140058" src="https://github.com/user-attachments/assets/16112d46-49e4-4a27-a469-3946c2701247" />
<img width="1919" height="921" alt="Screenshot 2025-07-16 140119" src="https://github.com/user-attachments/assets/cb077b44-ef31-4e20-afbc-1f7e5f7db0e5" />
<img width="1919" height="927" alt="Screenshot 2025-07-16 140130" src="https://github.com/user-attachments/assets/9417f541-314d-4792-9424-b267f9cafb8c" />
<img width="1919" height="918" alt="Screenshot 2025-07-16 140143" src="https://github.com/user-attachments/assets/9eb152ce-5847-486f-b476-dd750a4f3d15" />
<img width="1919" height="919" alt="Screenshot 2025-07-16 140153" src="https://github.com/user-attachments/assets/3873ac72-7c37-4f70-b8ca-24e0e9d70360" />
<img width="1919" height="919" alt="Screenshot 2025-07-16 140320" src="https://github.com/user-attachments/assets/13db1987-e3c3-4515-b5e5-6477c0613cda" />
<img width="1919" height="919" alt="Screenshot 2025-07-16 140333" src="https://github.com/user-attachments/assets/8e67a50b-dadf-4c7e-ba8e-a20ff9c0dbf1" />


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
