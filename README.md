# E-Portfolio

A modern, database-driven portfolio website with a comprehensive admin interface for managing your professional information, projects, skills, and more.

## Features

### Public-Facing Portfolio
- 🏠 **Home Page**: Introduction and call-to-action
- 📁 **Projects**: Showcase your work with images, descriptions, and links
- 🎨 **Hobbies**: Timeline visualization of your interests with proficiency tracking
- 💼 **Profile**: Your professional information and bio
- 📧 **Contact**: Form for visitors to reach out

### Admin Dashboard
- 📊 **Dashboard**: Central hub for managing all content
- 📁 **Project Management**: Add projects with image uploads, links, and tags
- 🛠️ **Skills Management**: Track technical and soft skills with proficiency levels
- 🎯 **Achievements**: Document awards and accomplishments
- 🎓 **Education**: Manage educational background
- 📧 **Contact Messages**: View and respond to inquiries

### Technical Features
- ✅ **RESTful API**: Clean, organized backend architecture
- ✅ **Database-Driven**: MySQL database with comprehensive schema
- ✅ **File Uploads**: Support for images with automatic management
- ✅ **Responsive Design**: Works on all devices
- ✅ **AJAX Navigation**: Smooth page transitions
- ✅ **Modern UI**: Glassmorphism design with gradient accents

## Technology Stack

### Frontend
- HTML5, CSS3 (Tailwind CSS)
- JavaScript (Vanilla JS)
- AJAX for dynamic content loading

### Backend
- PHP 7.4+
- MySQL 5.7+
- PDO for database access
- RESTful API architecture

### Design
- Glassmorphism UI
- Gradient color schemes
- Responsive grid layouts

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache or Nginx web server
- Modern web browser

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/NissanAlGaib/E-Portfolio.git
   cd E-Portfolio
   ```

2. **Set up the database**
   ```bash
   mysql -u root -p < backend/database/schema.sql
   ```

3. **Configure database connection**
   
   Edit `backend/api/Database.php`:
   ```php
   private $host = "localhost";
   private $username = "root";
   private $password = "your_password";
   private $database = "eportfolio";
   ```

4. **Insert your profile data**
   ```sql
   USE eportfolio;
   INSERT INTO profile (first_name, middle_initial, last_name, email, job_title, bio)
   VALUES ('Your', 'M', 'Name', 'your.email@example.com', 'Your Job Title', 'Your bio here');
   ```

5. **Set up file permissions**
   ```bash
   chmod -R 777 frontend/src/imgs/
   ```

6. **Access the application**
   - Public Portfolio: `http://localhost/frontend/views/pages/home.php`
   - Admin Dashboard: `http://localhost/frontend/views/admin/dashboard.php`

## Project Structure

```
E-Portfolio/
├── backend/
│   ├── api/                    # API endpoints
│   │   ├── Database.php        # Database connection
│   │   ├── user_api.php        # User profile API
│   │   ├── projects_api.php    # Projects API
│   │   ├── skills_api.php      # Skills API
│   │   ├── hobbies_api.php     # Hobbies API
│   │   ├── achievements_api.php # Achievements API
│   │   ├── education_api.php   # Education API
│   │   ├── certifications_api.php # Certifications API
│   │   ├── experience_api.php  # Experience API
│   │   └── contacts_api.php    # Contact messages API
│   ├── class/                  # PHP classes
│   │   ├── User.class.php
│   │   ├── Projects.class.php
│   │   ├── Skills.class.php
│   │   ├── Hobbies.class.php
│   │   ├── Achievements.class.php
│   │   ├── Education.class.php
│   │   ├── Certifications.class.php
│   │   ├── Experience.class.php
│   │   └── Contacts.class.php
│   └── database/
│       ├── schema.sql          # Database schema
│       └── README.md           # Database documentation
├── frontend/
│   ├── src/
│   │   ├── imgs/               # Image uploads
│   │   │   ├── projects/
│   │   │   ├── skills/
│   │   │   ├── hobbies/
│   │   │   ├── achievements/
│   │   │   ├── education/
│   │   │   ├── certifications/
│   │   │   └── experience/
│   │   ├── js/
│   │   │   ├── core/           # Core JavaScript
│   │   │   │   ├── User.js
│   │   │   │   ├── Projects.js
│   │   │   │   ├── Hobbies.js
│   │   │   │   └── particle.js
│   │   │   └── admin/          # Admin JavaScript
│   │   │       ├── ManageProjects.js
│   │   │       ├── ManageSkills.js
│   │   │       ├── ManageAchievements.js
│   │   │       ├── ManageEducation.js
│   │   │       └── ManageContacts.js
│   │   └── css/
│   └── views/
│       ├── pages/              # Public pages
│       │   ├── home.php
│       │   ├── projects.php
│       │   └── hobbies.php
│       ├── admin/              # Admin pages
│       │   ├── dashboard.php
│       │   ├── manage_projects.php
│       │   ├── manage_skills.php
│       │   ├── manage_achievements.php
│       │   ├── manage_education.php
│       │   └── manage_contacts.php
│       ├── components/         # Reusable components
│       └── layout.php          # Main layout
├── ADMIN_GUIDE.md             # Admin documentation
└── README.md                   # This file
```

## Database Schema

The database includes the following tables:

1. **profile** - User profile information
2. **skills** - Technical and soft skills with proficiency tracking
3. **hobbies** - Personal interests and activities
4. **projects** - Portfolio projects with images and links
5. **contacts** - Contact form submissions
6. **education** - Educational background
7. **certifications** - Professional certifications
8. **achievements** - Awards and accomplishments
9. **experience** - Work experience

See `backend/database/README.md` for detailed schema documentation.

## Usage

### For Administrators

1. **Access the Admin Dashboard**
   - Navigate to `/frontend/views/admin/dashboard.php`

2. **Add Content**
   - Click on any section (Projects, Skills, etc.)
   - Click the "Add" button
   - Fill in the form
   - Upload images if applicable
   - Submit

3. **Manage Content**
   - View all items in each section
   - Delete items as needed
   - Update status for contact messages

See `ADMIN_GUIDE.md` for comprehensive admin documentation.

### For Developers

#### Adding a New API Endpoint

1. Create a class in `backend/class/`
2. Create an API file in `backend/api/`
3. Follow existing patterns for CRUD operations
4. Update database schema if needed

#### Adding a New Admin Page

1. Create the page in `frontend/views/admin/`
2. Create corresponding JavaScript in `frontend/src/js/admin/`
3. Follow existing patterns for forms and data loading
4. Add link to admin dashboard

## API Documentation

All APIs follow RESTful conventions:

### Projects API Example
```javascript
// GET all projects
fetch('backend/api/projects_api.php?user_id=1')

// POST new project
const formData = new FormData();
formData.append('user_id', '1');
formData.append('title', 'My Project');
formData.append('description', 'Description here');
formData.append('image_preview', fileInput.files[0]);
fetch('backend/api/projects_api.php', {
  method: 'POST',
  body: formData
})

// DELETE project
fetch('backend/api/projects_api.php', {
  method: 'DELETE',
  body: 'id=5'
})
```

See `backend/database/README.md` for complete API reference.

## Security Notes

⚠️ **Important**: This application currently has no authentication system. Before deploying to production:

1. Add user authentication
2. Implement session management
3. Add CSRF protection
4. Validate and sanitize all inputs
5. Implement rate limiting
6. Use HTTPS in production
7. Secure file uploads with additional validation
8. Add proper error handling

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open source and available under the MIT License.

## Author

NissanAlGaib

## Acknowledgments

- Tailwind CSS for the utility-first CSS framework
- The open-source community for inspiration and resources

## Changelog

### Version 1.0.0 (Current)
- ✅ Database schema with 9 tables
- ✅ Complete backend API infrastructure
- ✅ Admin dashboard with 5 management pages
- ✅ Public portfolio pages
- ✅ File upload support
- ✅ Responsive design
- ✅ Comprehensive documentation

## Roadmap

Future enhancements:
- [ ] User authentication system
- [ ] Rich text editor for descriptions
- [ ] Image optimization and thumbnails
- [ ] Search functionality
- [ ] Analytics dashboard
- [ ] Email notifications for contact forms
- [ ] Multi-language support
- [ ] Theme customization
- [ ] Export/import functionality
- [ ] API rate limiting

## Support

For issues, questions, or suggestions:
- Open an issue on GitHub
- Check the documentation in `ADMIN_GUIDE.md` and `backend/database/README.md`

---

Made with ❤️ for showcasing your professional journey
