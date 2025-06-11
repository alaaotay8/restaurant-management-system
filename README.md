# Restaurant Management System

A Laravel-based Restaurant Management System that provides robust functionality for both restaurant administrators and customers. The project features a comprehensive AdminSpace (admin dashboard) for managing restaurant operations and a sleek User Interface designed for customer interactions, such as browsing menus, placing orders, and reservations.

---

## ⚙️ Features

### AdminSpace (Admin Dashboard)
- **User & Role Management**: Add, edit, or remove admins, employees, and manage user permissions.
- **Menu Management**: Create, update, and categorize food items, manage availability, prices, and specials.
- **Order Management**: View, edit, or cancel orders; track order status in real-time.
- **Table Reservations**: Manage restaurant table bookings and schedules.
- **Sales Reports & Analytics**: View reports on sales, revenue, and customer trends.
- **Promotions & Discounts**: Create and manage special offers, discounts, and loyalty rewards.

### User Interface (Customer-Facing Site)
- **Menu Browsing**: Browse menu categories, food items, and detailed descriptions.
- **Order Placement**: Place dine-in, take-away, or delivery orders.
- **Reservation System**: Book tables and manage reservations.
- **User Registration & Authentication**: Sign up, log in, and manage personal profiles.
- **Order Tracking**: View current and past orders, track preparation and delivery status.
- **Responsive Design**: Mobile-friendly interface for seamless user experience.

---

## 🖥️ Requirements

- **PHP** ^8.0
- **Composer** ^2.0
- **Laravel** ^10.x
- **MySQL** or **PostgreSQL** (or compatible database)
- **Node.js** ^16.x & **npm** (for compiling assets)
- **Web Server**: Apache/Nginx recommended
- **Optional**: Redis (for caching), Mail server (for notifications)

---

## 🚀 Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/alaaotay8/restaurant-management-system.git
   cd restaurant-management-system
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   - Copy the example environment file and update your settings:
     ```bash
     cp .env.example .env
     ```
   - Set your database, mail, and other credentials in `.env`.

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Compile Assets**
   ```bash
   npm run build   # or npm run dev for development
   ```

8. **Start the Server**
   ```bash
   php artisan serve
   ```
   Or deploy to a configured web server.

---

## 🤔 Usage

- **Admin Dashboard**: Access via `/admin/dashboard` after logging in with admin credentials.
- **Customer Interface**: Main landing page for menu browsing, ordering, and reservations.
- **User Registration**: Customers can sign up and manage their account.
- **Order/Reservation Management**: Customers can view, update, or cancel their orders and reservations.

---

## 💡 Contributing

1. Fork the repository.
2. Create your feature branch (`git checkout -b feature/my-feature`).
3. Commit your changes (`git commit -am 'Add feature'`).
4. Push to the branch (`git push origin feature/my-feature`).
5. Open a Pull Request.

---

## 🙋‍♂️ Support

For questions, feature requests, or bug reports, please open a GitHub issue or contact the project maintainer [@alaaotay8](https://github.com/alaaotay8).

---

**Made with ❤️ using Laravel.**

