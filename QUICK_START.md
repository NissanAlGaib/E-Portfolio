# Quick Start Guide - E-Portfolio

Get your portfolio up and running in 5 minutes!

## Prerequisites Check

Before starting, ensure you have:
- ✅ PHP 7.4+ installed
- ✅ MySQL 5.7+ installed
- ✅ Apache/Nginx web server running
- ✅ Git (for cloning the repository)

## Quick Setup (5 Steps)

### Step 1: Clone and Navigate
```bash
git clone https://github.com/NissanAlGaib/E-Portfolio.git
cd E-Portfolio
```

### Step 2: Create Database
```bash
mysql -u root -p < backend/database/schema.sql
# Enter your MySQL password when prompted
```

### Step 3: Add Your Profile
```sql
mysql -u root -p
# Enter your password, then run:

USE eportfolio;

INSERT INTO profile (first_name, middle_initial, last_name, email, job_title, bio)
VALUES ('Your', 'M', 'Name', 'you@email.com', 'Web Developer', 'Your amazing bio here');

exit;
```

### Step 4: Configure Database Connection (if needed)
```bash
# Edit backend/api/Database.php if your database credentials differ
# Default: host=localhost, user=root, password='', database=eportfolio
```

### Step 5: Set File Permissions
```bash
chmod -R 777 frontend/src/imgs/
```

## You're Ready! 🎉

### Access Your Portfolio

**Public Portfolio:**
```
http://localhost/E-Portfolio/frontend/views/pages/home.php
```

**Admin Dashboard:**
```
http://localhost/E-Portfolio/frontend/views/admin/dashboard.php
```

## First Steps in Admin

1. **Add a Project**
   - Go to Admin Dashboard → Projects
   - Click "Add Project"
   - Fill in title, description, and upload an image
   - Add project URL or GitHub link
   - Submit!

2. **Add Skills**
   - Go to Admin Dashboard → Skills
   - Click "Add Skill"
   - Enter skill name (e.g., "JavaScript")
   - Set proficiency level (0-100)
   - Submit!

3. **Add Achievements**
   - Go to Admin Dashboard → Achievements
   - Click "Add Achievement"
   - Enter achievement title
   - Upload a certificate or image (optional)
   - Submit!

## Verify Everything Works

1. ✅ Can you access the admin dashboard?
2. ✅ Can you add a project with an image?
3. ✅ Does the project appear on the public projects page?
4. ✅ Can you add a skill with proficiency level?
5. ✅ Can you view contact messages?

If all above are ✅, you're all set!

## Troubleshooting

### Database Connection Error
**Problem:** "Database connection failed"

**Solutions:**
```bash
# Check if MySQL is running
sudo service mysql status

# Start MySQL if it's not running
sudo service mysql start

# Verify database exists
mysql -u root -p -e "SHOW DATABASES;"
# Should see 'eportfolio' in the list
```

### File Upload Not Working
**Problem:** Images not uploading

**Solutions:**
```bash
# Set correct permissions
chmod -R 777 frontend/src/imgs/

# Check PHP upload settings
php -i | grep upload_max_filesize
php -i | grep post_max_size

# If too small, edit php.ini:
upload_max_filesize = 10M
post_max_size = 10M
```

### Images Not Displaying
**Problem:** Uploaded images don't show

**Solutions:**
1. Check file was uploaded to correct directory
2. Verify file permissions: `chmod 644 frontend/src/imgs/*/*.jpg`
3. Check browser console for path errors
4. Ensure relative paths are correct

### Page Not Loading
**Problem:** Blank page or errors

**Solutions:**
```bash
# Check PHP error logs
tail -f /var/log/apache2/error.log
# or
tail -f /var/log/nginx/error.log

# Enable PHP error display (for development only)
# Add to top of PHP files:
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

## Next Steps

Now that everything is working:

1. **Customize Your Content**
   - Add all your projects
   - List your skills with accurate proficiency levels
   - Document your achievements
   - Add your education background

2. **Customize Design**
   - Update colors in Tailwind CSS classes
   - Modify layout files
   - Add your profile image

3. **Add Security**
   - Implement authentication (before production!)
   - Add CSRF protection
   - Secure file uploads further

4. **Deploy**
   - Choose a hosting provider
   - Set up HTTPS
   - Configure production database
   - Update API credentials

## Useful Commands

```bash
# Backup database
mysqldump -u root -p eportfolio > backup.sql

# Restore database
mysql -u root -p eportfolio < backup.sql

# Clear all data (reset)
mysql -u root -p -e "DROP DATABASE eportfolio;"
mysql -u root -p < backend/database/schema.sql

# Check PHP version
php -v

# Check MySQL version
mysql --version

# View PHP configuration
php -i

# Restart Apache
sudo service apache2 restart

# Restart Nginx
sudo service nginx restart
```

## File Structure Quick Reference

```
E-Portfolio/
├── backend/
│   ├── api/              → API endpoints (8 files)
│   ├── class/            → PHP classes (8 files)
│   └── database/         → schema.sql + docs
├── frontend/
│   ├── src/
│   │   ├── imgs/         → Image uploads (7 directories)
│   │   └── js/
│   │       ├── core/     → Public JS (4 files)
│   │       └── admin/    → Admin JS (5 files)
│   └── views/
│       ├── pages/        → Public pages
│       └── admin/        → Admin pages (6 files)
├── README.md             → Project overview
├── ADMIN_GUIDE.md        → Detailed admin guide
└── QUICK_START.md        → This file!
```

## Documentation

- **README.md** - Full project documentation
- **ADMIN_GUIDE.md** - Comprehensive admin usage guide
- **backend/database/README.md** - Database schema and API docs
- **IMPLEMENTATION_SUMMARY.md** - Technical implementation details

## Getting Help

1. Check the documentation files above
2. Review error logs
3. Verify database connection
4. Check file permissions
5. Open an issue on GitHub

## Success Checklist

- [ ] Database created with all tables
- [ ] Profile data inserted
- [ ] Can access admin dashboard
- [ ] Can add a project with image
- [ ] Can add a skill with proficiency
- [ ] Can add an achievement
- [ ] Projects display on public page
- [ ] File uploads work
- [ ] No PHP errors in logs

Once all checked, you're ready to build your portfolio! 🚀

---

**Estimated Setup Time:** 5-10 minutes
**Difficulty:** Beginner-friendly
**Support:** See documentation or open GitHub issue
