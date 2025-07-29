# Gym Management System

A comprehensive web-based gym management system built with Laravel and Filament. This application provides a complete solution for gym owners to manage members, memberships, services, equipment, and payments.

## Features

- **Member Management**: Register and manage gym members with detailed profiles
- **Membership Management**: Create and track membership packages with different tiers
- **Payment Processing**: Handle membership payments and track payment history
- **Service Management**: Manage gym services and classes
- **Equipment Tracking**: Monitor gym equipment status and maintenance
- **Goal Setting**: Members can set and track fitness goals
- **Progress Logging**: Track member progress and achievements
- **Announcements**: Post gym announcements and updates
- **Multi-language Support**: English and French language support
- **Mobile Responsive**: Fully responsive design for all devices
- **Admin Panel**: Powerful Filament-based admin interface

## Technology Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Admin Panel**: Filament 2
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **Authorization**: Spatie Laravel Permission

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL 8.0+ or PostgreSQL 13+
- Web server (Apache/Nginx)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/gym-management-system.git
   cd gym-management-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file and set your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=gym_management
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database**
   ```bash
   php artisan db:seed
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

The application will be available at `http://localhost:8000`

## Default Credentials

After seeding the database, you can access the admin panel with:

- **Admin Panel**: `http://localhost:8000/admin`
- **Email**: `admin@gym.com`
- **Password**: `password`

## Usage

### For Gym Owners/Administrators

1. **Access Admin Panel**: Login to the admin panel at `/admin`
2. **Manage Members**: Add, edit, and manage member profiles
3. **Create Packages**: Set up membership packages with different features
4. **Process Payments**: Handle membership payments and track revenue
5. **Manage Services**: Add gym services and classes
6. **Track Equipment**: Monitor equipment status and schedule maintenance
7. **Post Announcements**: Keep members informed with announcements

### For Members

1. **Register**: Create an account on the public website
2. **Choose Package**: Select a membership package
3. **Set Goals**: Define fitness goals and track progress
4. **View Dashboard**: Access membership details and progress
5. **Download Card**: Download membership card for gym access

## Configuration

### Language Settings

The system supports multiple languages. To change the default language:

1. Edit the `config/app.php` file
2. Set `'locale' => 'fr'` for French or `'locale' => 'en'` for English
3. Users can switch languages using the language switcher in the navigation

### Customization

- **Styling**: Modify Tailwind CSS classes in Blade templates
- **Admin Panel**: Customize Filament resources in `app/Filament/Resources/`
- **Models**: Extend models in `app/Models/` for additional functionality
- **Translations**: Add new language files in `resources/lang/`

## Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
composer run-script phpcs
```

### Database Seeding
```bash
php artisan db:seed --class=SampleDataSeeder
```

## Contributing

We welcome contributions to improve the Gym Management System! Please follow these guidelines:

### How to Contribute

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. **Make your changes**
4. **Write tests** for new functionality
5. **Follow coding standards** (PSR-12)
6. **Commit your changes**
   ```bash
   git commit -m "Add: description of your changes"
   ```
7. **Push to your branch**
   ```bash
   git push origin feature/your-feature-name
   ```
8. **Create a Pull Request**

### Code Standards

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Include tests for new features
- Update documentation when necessary
- Ensure mobile responsiveness for UI changes

### Reporting Issues

When reporting issues, please include:
- Laravel version
- PHP version
- Database type and version
- Steps to reproduce the issue
- Expected vs actual behavior

## Security

If you discover any security vulnerabilities, please email us at security@gymmanagement.com. All security issues will be promptly addressed.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support and questions:
- Create an issue on GitHub
- Email: support@gymmanagement.com
- Documentation: [Wiki](https://github.com/yourusername/gym-management-system/wiki)

## Acknowledgments

- [Laravel](https://laravel.com) - The web framework
- [Filament](https://filamentphp.com) - The admin panel
- [Tailwind CSS](https://tailwindcss.com) - The CSS framework
- [Alpine.js](https://alpinejs.dev) - The JavaScript framework

---

**Built with ❤️ for gym owners and fitness enthusiasts**
