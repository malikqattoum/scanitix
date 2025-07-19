---
description: Repository Information Overview
alwaysApply: true
---

# Scanitix Information

## Summary
Scanitix is a powerful QR code generator that helps businesses create custom QR codes for menus, websites, files, contact info, and more. It features an intuitive dashboard for managing and tracking scans with real-time analytics. Users can design branded QR codes with logos, colors, and styles to match their identity.

## Structure
- **app/**: Core application files including controllers, models, and helpers
- **install/**: Installation scripts and database setup
- **plugins/**: Modular extensions (affiliate, image-optimizer, offload, push-notifications, pwa, teams)
- **themes/**: Frontend themes (currently only altum theme)
- **update/**: Update scripts and SQL migrations
- **uploads/**: User uploaded content and generated files
- **vendor/**: Third-party dependencies

## Language & Runtime
**Language**: PHP
**Build System**: None (PHP application)
**Package Manager**: None (dependencies included in vendor directory)
**Database**: MySQL/MariaDB

## Dependencies
**Main Dependencies**:
- PHPMailer (Email functionality)
- Stripe (Payment processing)
- Razorpay (Payment processing)
- Mollie (Payment processing)
- Symfony components (Various utilities)
- Picqer (Barcode generation)
- Minishlink/web-push (Push notifications)
- PHPFastCache (Caching)
- Hybridauth (Social authentication)

## Installation
```bash
# 1. Set up a web server (Apache/Nginx) with PHP and MySQL
# 2. Create a MySQL database
# 3. Upload files to web server
# 4. Navigate to the installation URL in browser
# 5. Follow the installation wizard
```

## Configuration
**Main Config File**: config.php
**Required Settings**:
- DATABASE_SERVER
- DATABASE_USERNAME
- DATABASE_PASSWORD
- DATABASE_NAME
- SITE_URL

## Application Structure
**Entry Point**: index.php
**Core Initialization**: app/init.php
**MVC Pattern**:
- Controllers: app/controllers/
- Models: app/models/
- Views: themes/altum/views/

## Features
**QR Code Generation**:
- Custom QR codes with branding options
- Multiple QR code types (URL, vCard, text, etc.)
- Analytics tracking

**Barcode Generation**:
- Multiple barcode formats
- Customization options

**User Management**:
- Registration and authentication
- User roles and permissions
- Team collaboration features

**Payment Processing**:
- Multiple payment gateways
- Subscription management
- Plan-based features

## Plugins
The application supports modular extensions through plugins:
- **affiliate**: Affiliate marketing functionality
- **image-optimizer**: Image optimization tools
- **offload**: Content offloading capabilities
- **push-notifications**: Browser push notifications
- **pwa**: Progressive Web App features
- **teams**: Team collaboration features