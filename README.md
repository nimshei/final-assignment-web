# [Project by Nimshi Athukorala](https://nimshiathukorala.com/)

![version](https://img.shields.io/badge/version-1.0.0-blue.svg) 
![license](https://img.shields.io/badge/license-MIT-blue.svg)

This project is designed to accelerate web development with a modern and efficient stack.

## Table of Contents
* [Prerequisites](#prerequisites)
* [Installation](#installation)
* [Usage](#usage)
* [Features](#features)
* [File Structure](#file-structure)
* [Browser Support](#browser-support)
* [Reporting Issues](#reporting-issues)
* [Licensing](#licensing)
* [Useful Links](#useful-links)
* [Social Media](#social-media)
* [Credits](#credits)

## Prerequisites

Ensure you have a local development environment with PHP and MySQL. You can set up one using the following guides:

 - [Windows Setup Guide](https://example.com/windows-setup)
 - [Linux & Mac Setup Guide](https://example.com/linux-mac-setup)

Additionally, install:
- [Composer](https://getcomposer.org/doc/00-intro.md)
- [Laravel](https://laravel.com/docs/10.x)

## Installation
1. Unzip the downloaded archive.
2. Place the folder in your projects directory and rename it as needed.
3. Run `composer install` in your terminal.
4. Copy `.env.example` to `.env` and configure it (database, email credentials, and APP_URL).
5. Run `php artisan key:generate`.
6. Execute `php artisan migrate --seed` to set up the database.
7. Run `php artisan storage:link` to create the storage symlink.

## Usage
Log in with the default credentials or register a new user to explore the features. Default credentials:
- **Email**: admin@example.com
- **Password**: secret

## Features
- User authentication (login, register, forgot/reset password)
- User profile management
- Dashboard with essential tools

## File Structure
```
+---app
|   +---Http
|   |   +---Controllers
|   |   +---Livewire
|   +---Models
|   +---Notifications
|   +---Providers
|   \---View
...
```

## Browser Support
Supported browsers include the latest versions of:
- Chrome
- Firefox
- Edge
- Safari
- Opera

## Reporting Issues
To report issues:
1. Ensure you're using the latest version.
2. Provide reproducible steps.
3. Specify the browser if the issue is browser-specific.

## Licensing
- Copyright 2023 [Nimshi Athukorala](https://nimshiathukorala.com)
- Licensed under the [MIT License](https://opensource.org/licenses/MIT)

## Useful Links
- [Documentation](https://nimshiathukorala.com/docs)
- [Blog](https://nimshiathukorala.com/blog)
- [Contact](https://nimshiathukorala.com/contact)

## Social Media
- Twitter: <https://twitter.com/nimshiathukorala>
- LinkedIn: <https://linkedin.com/in/nimshiathukorala>

## Credits
- Developed by [Nimshi Athukorala](https://nimshiathukorala.com)
- Inspired by modern web development practices
- Special thanks to contributors and supporters
