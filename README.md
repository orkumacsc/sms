# Gospel International College, Zaki-Biam School Management System

A comprehensive School Management System built with Laravel for Gospel College. This platform streamlines administrative, academic, and communication processes for schools, providing secure, role-based access for administrators, staff, and students.

---

## Features

- **User Authentication & Role Management**
  - Secure login for admins, staff, and students
  - Role-based dashboards and permissions

- **Student Management**
  - Admissions, profile management, and class assignments
  - Academic records and result checking

- **Staff Management**
  - Staff profiles and attendance
  - Role-based access and management tools

- **Academic Setup**
  - Manage classes, subjects, terms, and sessions
  - Grading and assessment configuration

- **Assessment & Results**
  - Continuous assessment (CASS) and marks entry
  - Automated result computation
  - Printable report cards and broadsheets

- **Notifications & Communication**
  - In-app notifications for staff and students

- **Responsive Interface**
  - Modern, user-friendly dashboards and modals

---

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/orkumacsc/gospelcollege-sms.git
    cd gospelcollege-sms
    ```

2. **Install dependencies:**
    ```sh
    composer install
    npm install
    npm run dev
    ```

3. **Copy and configure your environment:**
    ```sh
    cp .env.example .env
    # Edit .env and set your database and mail settings
    ```

4. **Generate application key:**
    ```sh
    php artisan key:generate
    ```

5. **Run migrations and seeders:**
    ```sh
    php artisan migrate --seed
    ```

6. **(Optional) Link storage:**
    ```sh
    php artisan storage:link
    ```

7. **Start the development server:**
    ```sh
    php artisan serve
    ```

---

## Usage

- Access the application at [http://localhost:8000](http://localhost:8000)
- Login as admin, staff, or student to access respective dashboards and features.

---

## Screenshots

> _Screenshots of dashboards, report cards, and other key features will added here._

---

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

---

## License

This project is licensed under the MIT License.

---

## Contact

For support or inquiries, contact [gospelcollege2019@gmail.com](mailto:gospelcollege2019@gmail.com) or visit [gospelschools.sch.ng](https://gospelschools.sch.ng).
