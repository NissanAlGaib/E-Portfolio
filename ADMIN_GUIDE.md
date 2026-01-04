# E-Portfolio Admin Guide

This guide explains how to use the admin interface to manage your portfolio content.

## Getting Started

### 1. Database Setup

Before using the admin interface, you need to set up the database:

```bash
# Create the database and tables
mysql -u root -p < backend/database/schema.sql
```

This will create:
- The `eportfolio` database
- All necessary tables (profile, skills, projects, hobbies, achievements, education, certifications, experience, contacts)
- Appropriate indexes for performance

### 2. Configure Database Connection

Check `backend/api/Database.php` and update the credentials if needed:
```php
private $host = "localhost";
private $username = "root";
private $password = "";
private $database = "eportfolio";
```

### 3. Insert Your Profile Data

Before adding other content, you need to have a profile record in the database. Run this SQL:

```sql
INSERT INTO profile (first_name, middle_initial, last_name, email, job_title, bio)
VALUES ('Your', 'M', 'Name', 'your.email@example.com', 'Your Job Title', 'Your bio');
```

The `user_id` used throughout the system is `1` by default (the ID of this profile record).

## Accessing the Admin Interface

Navigate to the admin dashboard:
```
/frontend/views/pages/ -> Click on the appropriate navigation or direct link
```

Or access directly at:
```
your-domain.com/frontend/views/admin/dashboard.php
```

## Admin Features

### Managing Projects

**Location:** Admin Dashboard → Projects

**Features:**
- ✅ Add new projects
- ✅ Upload project preview images
- ✅ Add multiple URLs (project, GitHub, demo)
- ✅ Add tags for categorization
- ✅ Set project status (completed, in_progress, on_hold)
- ✅ Mark projects as featured
- ✅ Delete projects

**How to Add a Project:**
1. Click "Add Project" button
2. Fill in the required fields:
   - **Title** (required): Your project name
   - **Description** (required): Detailed description
   - **Project URL** (optional): Link to live project
   - **GitHub URL** (optional): Repository link
   - **Demo URL** (optional): Demo or presentation link
   - **Tags** (optional): Comma-separated (e.g., "React, Node.js, MongoDB")
   - **Start/End Date** (optional): Project timeline
   - **Status**: Current project status
   - **Featured**: Highlight this project
   - **Image Preview**: Upload a screenshot or preview image
3. Click "Add Project"

**Supported Image Formats:** JPG, PNG, GIF, WebP

**Image Storage:** `/frontend/src/imgs/projects/`

---

### Managing Skills

**Location:** Admin Dashboard → Skills

**Features:**
- ✅ Add technical and soft skills
- ✅ Set proficiency levels (0-100)
- ✅ Categorize skills
- ✅ Track years of experience
- ✅ Upload skill icons
- ✅ Delete skills

**How to Add a Skill:**
1. Click "Add Skill" button
2. Fill in the fields:
   - **Skill Name** (required): e.g., "JavaScript", "Leadership"
   - **Skill Type** (required): Technical or Soft Skill
   - **Category** (optional): e.g., "Programming", "Communication"
   - **Proficiency** (required): 0-100 scale
   - **Years of Experience** (optional): e.g., 2.5
   - **Description** (optional): Additional details
   - **Icon Image** (optional): Upload an icon
3. Click "Add Skill"

Skills are automatically grouped by type (Technical/Soft) in the admin interface.

**Image Storage:** `/frontend/src/imgs/skills/`

---

### Managing Hobbies

**Location:** Admin Dashboard → Hobbies (uses existing page)

**Features:**
- ✅ Add hobbies with descriptions
- ✅ Set proficiency levels
- ✅ Group by category (e.g., year started)
- ✅ Upload hobby icons
- ✅ Timeline visualization
- ✅ Delete hobbies

**How to Add a Hobby:**
1. Click the "+" button on the hobbies page
2. Fill in the fields:
   - **Hobby Name** (required)
   - **Description** (optional)
   - **Category** (optional): Used for grouping/timeline
   - **Proficiency** (0-100)
   - **Icon Image** (optional)
3. Click "Add"

**Image Storage:** `/frontend/src/imgs/hobbies/`

---

### Managing Achievements

**Location:** Admin Dashboard → Achievements

**Features:**
- ✅ Add achievements and awards
- ✅ Categorize achievements (Academic, Sports, Competition, etc.)
- ✅ Track issuer and date
- ✅ Upload achievement images/certificates
- ✅ Custom display order
- ✅ Delete achievements

**How to Add an Achievement:**
1. Click "Add Achievement" button
2. Fill in the fields:
   - **Title** (required): Achievement name
   - **Category** (optional): e.g., "Academic", "Sports"
   - **Issuer** (optional): Who awarded this
   - **Date Achieved** (optional)
   - **Display Order** (optional): Lower numbers appear first
   - **Description** (optional)
   - **Image** (optional): Certificate or trophy image
3. Click "Add Achievement"

**Image Storage:** `/frontend/src/imgs/achievements/`

---

### Managing Education

**Location:** Admin Dashboard → Education

**Features:**
- ✅ Add educational background
- ✅ Track degree, field of study, and institution
- ✅ Record GPA
- ✅ Add institution logos
- ✅ Mark current education (leave end date blank)
- ✅ Delete education records

**How to Add Education:**
1. Click "Add Education" button
2. Fill in the fields:
   - **Institution Name** (required)
   - **Degree** (required): e.g., "Bachelor of Science"
   - **Field of Study** (optional): e.g., "Computer Science"
   - **Location** (optional)
   - **GPA** (optional): 0-4 scale
   - **Start Date** (optional)
   - **End Date** (optional): Leave blank if currently studying
   - **Description** (optional)
   - **Logo** (optional): Institution logo
3. Click "Add Education"

**Image Storage:** `/frontend/src/imgs/education/`

---

### Managing Contact Messages

**Location:** Admin Dashboard → Contact Messages

**Features:**
- ✅ View all contact form submissions
- ✅ Filter by status (New, Read, Replied, Archived)
- ✅ Mark messages as read/replied
- ✅ Delete messages
- ✅ See submission date and IP address

**Message Statuses:**
- **New**: Unread message
- **Read**: Message has been viewed
- **Replied**: Response has been sent
- **Archived**: Old/completed messages

**How to Manage Contacts:**
1. Navigate to Contact Messages from the dashboard
2. Use filter buttons to view specific statuses
3. Click "Mark as Read" or "Mark as Replied" to update status
4. Click "Delete" to remove a message

---

## Additional Management (Backend Only)

The following features have backend support but no admin UI pages yet. You can create similar admin pages following the existing patterns:

### Certifications
- API: `/backend/api/certifications_api.php`
- Class: `/backend/class/Certifications.class.php`
- Fields: certification name, issuing organization, dates, credential ID/URL

### Experience
- API: `/backend/api/experience_api.php`
- Class: `/backend/class/Experience.class.php`
- Fields: company, job title, employment type, dates, responsibilities

---

## File Upload Guidelines

### Image Requirements
- **Recommended Size**: 1200x600 px for project images, 512x512 px for icons
- **Formats**: JPG, PNG, GIF, WebP
- **File Naming**: Files are automatically renamed with timestamp prefix

### Upload Limits
The default PHP upload limits apply. To increase:

Edit `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
```

---

## Security Considerations

### Important Notes:
1. **No Authentication**: The current admin interface has no authentication. Add authentication before deploying to production.
2. **Input Validation**: All API endpoints validate required fields
3. **SQL Injection Protection**: All queries use prepared statements with PDO
4. **File Upload Security**: Only image files are accepted, but consider additional validation

### Recommended Security Enhancements:
- Add admin login/authentication
- Implement session management
- Add CSRF token protection
- Validate file types more strictly
- Limit file sizes
- Add rate limiting for API endpoints

---

## Troubleshooting

### Database Connection Issues
**Error:** "Database connection failed"

**Solutions:**
1. Check MySQL is running: `sudo service mysql status`
2. Verify credentials in `backend/api/Database.php`
3. Ensure database exists: `mysql -u root -p -e "SHOW DATABASES;"`
4. Run schema.sql if database is empty

### File Upload Issues
**Error:** Files not uploading

**Solutions:**
1. Check directory permissions: `chmod 777 frontend/src/imgs/*/`
2. Verify PHP upload settings in `php.ini`
3. Check error logs: `tail -f /var/log/apache2/error.log`

### API Errors
**Error:** "Method Not Allowed"

**Solutions:**
1. Verify the HTTP method (GET, POST, PUT, DELETE)
2. Check CORS headers if accessing from different domain
3. Review browser console for errors

### Image Display Issues
**Error:** Images not showing

**Solutions:**
1. Check file path is correct relative to page
2. Verify file was uploaded successfully
3. Check file permissions: `chmod 644 frontend/src/imgs/*/*.jpg`

---

## API Reference

All APIs are located in `/backend/api/` and follow REST conventions:

- **GET**: Retrieve data
- **POST**: Create new records (with file uploads)
- **PUT**: Update existing records
- **DELETE**: Remove records

See `/backend/database/README.md` for complete API documentation.

---

## Maintenance

### Regular Tasks
1. **Backup database regularly**
   ```bash
   mysqldump -u root -p eportfolio > backup_$(date +%Y%m%d).sql
   ```

2. **Clean up old uploaded files** (if items are deleted)
   
3. **Monitor disk space** for image uploads

4. **Update content regularly** to keep portfolio fresh

### Database Management
```bash
# Export database
mysqldump -u root -p eportfolio > eportfolio_backup.sql

# Import database
mysql -u root -p eportfolio < eportfolio_backup.sql

# Reset and recreate
mysql -u root -p -e "DROP DATABASE IF EXISTS eportfolio;"
mysql -u root -p < backend/database/schema.sql
```

---

## Future Enhancements

Consider adding:
- [ ] User authentication system
- [ ] Rich text editor for descriptions
- [ ] Bulk upload for images
- [ ] Image cropping/resizing
- [ ] Drag-and-drop reordering
- [ ] Export portfolio data
- [ ] Analytics for page views
- [ ] Email notifications for contact forms
- [ ] Public API for integrations

---

## Support

For issues or questions:
1. Check this documentation
2. Review `/backend/database/README.md` for API details
3. Check browser console for JavaScript errors
4. Review PHP error logs for backend issues
5. Verify database structure matches schema.sql

## Summary

The E-Portfolio admin system provides a complete content management solution with:
- ✅ Database-driven content
- ✅ File upload support
- ✅ RESTful API architecture
- ✅ Responsive admin interface
- ✅ Easy content management
- ✅ Comprehensive documentation

All changes made through the admin interface are immediately reflected on the public-facing portfolio pages.
