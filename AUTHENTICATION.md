# Authentication System Documentation

## Overview

The E-Portfolio admin pages are now protected by a login system. Only authenticated users can access the admin dashboard and management pages.

## Features

### 🔐 Login System
- **Login Page**: `/frontend/views/admin/login.php`
- **Session-based authentication**
- **Password hashing** using PHP's `password_hash()` and `password_verify()`
- **Secure logout** that destroys the session

### ⏱️ Session Management
- **Auto-timeout**: Sessions expire after 30 minutes of inactivity
- **Last activity tracking**: Updates on every page load
- **Session hijacking protection**: Session data validated on each request

### 🛡️ Protected Routes
All admin pages now check for authentication:
- `dashboard.php`
- `manage_projects.php`
- `manage_skills.php`
- `manage_achievements.php`
- `manage_education.php`
- `manage_contacts.php`

## Default Credentials

**Username**: `admin`  
**Password**: `admin123`

⚠️ **IMPORTANT**: Change the default password before deploying to production!

## Changing the Password

To change the admin password, edit `/backend/auth/auth.php`:

```php
// Line 6 in backend/auth/auth.php
define('ADMIN_PASSWORD_HASH', password_hash('YOUR_NEW_PASSWORD', PASSWORD_DEFAULT));
```

Or generate a new hash using this PHP command:
```bash
php -r "echo password_hash('your_new_password', PASSWORD_DEFAULT);"
```

Then replace the hash in the auth.php file.

## Usage

### For Admins

1. **Access the Login Page**
   - Navigate to `/frontend/views/admin/login.php`
   - Or try to access any admin page - you'll be redirected to login

2. **Login**
   - Enter username: `admin`
   - Enter password: `admin123` (or your custom password)
   - Click "Login"

3. **Access Admin Dashboard**
   - After successful login, you'll be redirected to the dashboard
   - Navigate between admin pages freely
   - Your session remains active for 30 minutes of inactivity

4. **Logout**
   - Click the "Logout" button in the header
   - Or your session will auto-expire after 30 minutes

### For Visitors

- All public pages remain accessible without login:
  - Home, Projects, Skills, Achievements, Education, Hobbies
- Only admin pages require authentication

## Architecture

### File Structure

```
backend/
  └── auth/
      └── auth.php              # Authentication logic and session management

frontend/
  └── views/
      └── admin/
          ├── login.php          # Login page
          ├── logout.php         # Logout handler
          ├── _header.php        # Admin header with auth check
          ├── _footer.php        # Admin footer
          ├── dashboard.php      # Protected dashboard
          ├── manage_*.php       # Protected management pages
          └── admin_layout.php   # Alternative layout (not currently used)
```

### Authentication Flow

```
┌─────────────────┐
│  User visits    │
│  admin page     │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ requireLogin()  │
│ checks session  │
└────────┬────────┘
         │
    ┌────┴────┐
    │         │
    ▼         ▼
┌────────┐ ┌──────────────┐
│Logged  │ │ Not Logged   │
│  In    │ │    In        │
└───┬────┘ └──────┬───────┘
    │             │
    │             ▼
    │      ┌──────────────┐
    │      │  Redirect to │
    │      │  login.php   │
    │      └──────┬───────┘
    │             │
    │             ▼
    │      ┌──────────────┐
    │      │ Enter creds  │
    │      │ & submit     │
    │      └──────┬───────┘
    │             │
    │             ▼
    │      ┌──────────────┐
    │      │  login()     │
    │      │  validates   │
    │      └──────┬───────┘
    │             │
    └──────┬──────┘
           │
           ▼
    ┌──────────────┐
    │ Show admin   │
    │    page      │
    └──────────────┘
```

### Session Data

When a user logs in successfully, the following session variables are set:

```php
$_SESSION['admin_logged_in'] = true;
$_SESSION['admin_username'] = 'admin';
$_SESSION['last_activity'] = time();
```

## Security Features

### ✅ Implemented

1. **Password Hashing**
   - Uses `password_hash()` with bcrypt
   - Passwords never stored in plain text

2. **Session Management**
   - PHP session for authentication state
   - Auto-timeout after 30 minutes

3. **Protected Routes**
   - All admin pages check authentication
   - Automatic redirect to login if not authenticated

4. **Secure Logout**
   - Properly destroys session data
   - Redirects to login page

### 🔄 Recommended Enhancements for Production

1. **HTTPS Only**
   - Force HTTPS connections
   - Add `session.cookie_secure = true` in php.ini

2. **CSRF Protection**
   - Add CSRF tokens to forms
   - Validate tokens on submission

3. **Rate Limiting**
   - Limit login attempts per IP
   - Implement exponential backoff

4. **Database-based Users**
   - Move from hardcoded credentials to database
   - Support multiple admin accounts
   - Add password reset functionality

5. **Two-Factor Authentication**
   - Add 2FA for extra security layer
   - Use TOTP or SMS verification

6. **Audit Logging**
   - Log all login attempts
   - Track admin actions
   - Monitor for suspicious activity

7. **Session Security**
   - Regenerate session ID after login
   - Add session fingerprinting
   - Implement remember-me functionality

## API Protection

Currently, the API endpoints (`backend/api/*.php`) are **NOT** protected by authentication. This is intentional for public data display (projects, skills, etc.).

If you want to protect API endpoints that modify data (POST, PUT, DELETE), you can add:

```php
// At the top of each API file
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(401);
        echo json_encode(['message' => 'Unauthorized']);
        exit();
    }
}
```

This allows GET requests (for public viewing) but blocks POST/PUT/DELETE requests without authentication.

## Troubleshooting

### Can't Login

**Problem**: Invalid username or password error

**Solutions**:
1. Verify credentials: username `admin`, password `admin123`
2. Check `/backend/auth/auth.php` for correct credentials
3. Make sure sessions are enabled in PHP (check `session.save_path`)

### Session Expires Too Quickly

**Problem**: Getting logged out constantly

**Solutions**:
1. Increase timeout in `/backend/auth/auth.php` (line 33):
   ```php
   if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
   // Changed from 1800 (30 min) to 3600 (60 min)
   ```

### Redirect Loop

**Problem**: Keeps redirecting between login and dashboard

**Solutions**:
1. Clear browser cookies
2. Check PHP session configuration
3. Verify `session_start()` is called in auth.php

### "Headers already sent" Error

**Problem**: PHP warning about headers

**Solutions**:
1. Make sure there's no output before `header()` calls
2. Check for whitespace before `<?php` tags
3. Use output buffering: `ob_start()` at the beginning

## Testing

### Manual Testing Steps

1. **Test Login**
   - Visit `/frontend/views/admin/login.php`
   - Try wrong credentials - should show error
   - Try correct credentials - should redirect to dashboard

2. **Test Protected Pages**
   - Logout
   - Try to access `/frontend/views/admin/dashboard.php` directly
   - Should redirect to login page

3. **Test Session Timeout**
   - Login successfully
   - Wait 30+ minutes (or temporarily reduce timeout for testing)
   - Try to access any admin page
   - Should redirect to login

4. **Test Logout**
   - Login successfully
   - Click "Logout" button
   - Try to go back to dashboard
   - Should redirect to login

## Summary

The authentication system provides a secure foundation for protecting the admin panel. All admin pages now require login, with session management and automatic timeouts. The default credentials should be changed before production deployment.

For enhanced security in production, consider implementing the recommended enhancements listed above.
