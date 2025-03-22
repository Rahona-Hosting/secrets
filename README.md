# Rahona Hosting Secrets

![Rahona Hosting Logo](https://repository-images.githubusercontent.com/952967276/7882aee5-290f-4e50-9b5c-6440e46197f2)

## 🔐 Secure Password Sharing Solution

Rahona Secrets is an enterprise-grade secure password and sensitive information sharing platform designed to
safely transmit credentials to clients with full control, tracking, and expiration capabilities.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-blue.svg)](https://php.net)

## 🌟 Features

- **End-to-end Encryption**: Client-side encryption ensures that sensitive data is never stored in plaintext
- **Automatic Expiration**: Set custom expiration times for all shared secrets
- **Access Tracking**: Know exactly when recipients access their credentials
- **Multi-language Support**: Available in English, French, and Hungarian
- **Enterprise SSO Integration**: Connect with your existing identity providers
- **API Support**: Programmatically create and manage secrets
- **Two-Factor Authentication**: Enhanced security for your account
- **Email Notifications**: Get alerts when secrets are accessed or expire
- **Responsive Design**: Works on desktop and mobile devices

## 🚀 Getting Started

### Prerequisites

- Docker
- Or PHP 8.3+ with sqlite or mariadb/mysql

### Clone the repository

```bash
git clone https://github.com/Rahona-Hosting/secrets.git
cd secrets
```

### Installation with Docker (recommended)

1. Copy config files

```bash
cp docker-compose.yml.example docker-compose.yml
cp redis.conf.example redis.conf
cp .env.docker.example .env
```

2. Define a password for redis

In the `redis.conf`, replace <define_password> without the <>

```bash
requirepass my_strong_password
```

3. Update the `.env` file

Main settings that need to be changed :

For the APP_KEY you can generate it with `php artisan key:generate` or you can use this online
project : https://laravel-encryption-key-generator.vercel.app/

```bash
APP_KEY=
APP_URL=https://example.com

# MySQL secrets (be careful on the DB_HOST)
MYSQL_ROOT_PASSWORD=""
MYSQL_DATABASE=""
MYSQL_USER=""
MYSQL_PASSWORD=""

# SMTP Configuration (for notification)
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=""
MAIL_FROM_ADDRESS=""
```

4. Start the docker

```bash
docker compose up -d
```

### Installation without Docker (not recommended)

1. Install PHP and NPM dependencies

```bash
composer install && npm install
```

2. Create environment file

```bash
cp .env.example .env
```

3. Generate application key

```bash
php artisan key:generate
```

4. Run database migrations

```bash
php artisan migrate
```

5. Build frontend assets

```bash
npm run build
```

6. Start the development server

```bash
php artisan serve
```

## 🔧 Configuration

For custom installation please refer to the official Laravel 11 documentation.

### SSO Providers

### Email Notifications

Configure your SMTP settings in the `.env` file to enable email notifications:

```

MAIL_MAILER=smtp

```

## 🛣️ Roadmap

Our current development priorities are:

- Add GDPR job anonymization
-
- Implementing comprehensive unit tests to establish code coverage metrics
- Refactoring certain components to eliminate code duplication
- Enhancing the API capabilities with additional endpoints

## 🤝 Contributing

We welcome contributions from the community! While we can't guarantee that all issues will be addressed, we appreciate
your input and will review all pull requests.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🔒 Security

If you discover any security-related issues, please email security@rahona-hosting.com instead of using the issue
tracker.

## 🙏 Acknowledgements

- [Laravel](https://laravel.com)
- [Livewire](https://laravel-livewire.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Font Awesome](https://fontawesome.com)

---

Developed with ❤️ by [Rahona Hosting](https://rahona-hosting.com)
