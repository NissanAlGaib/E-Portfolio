# E-Portfolio Database Schema

This document describes the database structure for the E-Portfolio application.

## Database Setup

### Prerequisites
- MySQL Server (version 5.7 or higher)
- PHP 7.4 or higher
- Web server (Apache/Nginx)

### Installation Steps

1. **Create the database and tables:**
   ```bash
   mysql -u root -p < backend/database/schema.sql
   ```

2. **Configure database connection:**
   Update the database credentials in `backend/api/Database.php` if needed:
   - Host: `localhost`
   - Username: `root`
   - Password: (empty by default)
   - Database: `eportfolio`

3. **Set up image upload directories:**
   The following directories will be created automatically when needed:
   - `frontend/src/imgs/hobbies/`
   - `frontend/src/imgs/skills/`
   - `frontend/src/imgs/projects/`
   - `frontend/src/imgs/achievements/`
   - `frontend/src/imgs/education/`
   - `frontend/src/imgs/certifications/`
   - `frontend/src/imgs/experience/`

## Database Tables

### 1. profile
Stores the main user profile information.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `first_name` (VARCHAR(100), NOT NULL)
- `middle_initial` (CHAR(1))
- `last_name` (VARCHAR(100), NOT NULL)
- `job_title` (VARCHAR(150))
- `email` (VARCHAR(255), UNIQUE, NOT NULL)
- `phone` (VARCHAR(20))
- `location` (VARCHAR(255))
- `bio` (TEXT)
- `linkedin_url` (VARCHAR(255))
- `github_url` (VARCHAR(255))
- `portfolio_url` (VARCHAR(255))
- `profile_image` (VARCHAR(255))
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### 2. skills
Lists technical and soft skills with proficiency levels.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `user_id` (INT, FOREIGN KEY → profile.id)
- `skill_name` (VARCHAR(100), NOT NULL)
- `skill_type` (ENUM: 'technical', 'soft')
- `category` (VARCHAR(100)) - e.g., 'Programming', 'Design'
- `proficiency` (INT, 0-100 scale)
- `years_experience` (DECIMAL(3,1))
- `description` (TEXT)
- `icon` (VARCHAR(255))
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### 3. hobbies
Contains interests or activities outside academics.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `user_id` (INT, FOREIGN KEY → profile.id)
- `hobby_name` (VARCHAR(100), NOT NULL)
- `description` (TEXT)
- `category` (VARCHAR(100)) - Can be year started or category
- `proficiency` (INT, 0-100 scale)
- `icon` (VARCHAR(255))
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### 4. projects
Displays academic or personal projects with links and previews.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `user_id` (INT, FOREIGN KEY → profile.id)
- `title` (VARCHAR(200), NOT NULL)
- `description` (TEXT, NOT NULL)
- `project_url` (VARCHAR(255))
- `github_url` (VARCHAR(255))
- `demo_url` (VARCHAR(255))
- `image_preview` (VARCHAR(255)) - Photo preview
- `tags` (VARCHAR(255)) - Comma-separated
- `start_date` (DATE)
- `end_date` (DATE)
- `status` (ENUM: 'in_progress', 'completed', 'on_hold')
- `featured` (BOOLEAN)
- `display_order` (INT)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### 5. contacts
Records inquiries or messages from users.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `name` (VARCHAR(150), NOT NULL)
- `email` (VARCHAR(255), NOT NULL)
- `subject` (VARCHAR(255))
- `message` (TEXT, NOT NULL)
- `status` (ENUM: 'new', 'read', 'replied', 'archived')
- `ip_address` (VARCHAR(45))
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### 6. education
Stores educational background.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `user_id` (INT, FOREIGN KEY → profile.id)
- `institution_name` (VARCHAR(200), NOT NULL)
- `degree` (VARCHAR(150), NOT NULL)
- `field_of_study` (VARCHAR(150))
- `location` (VARCHAR(255))
- `start_date` (DATE)
- `end_date` (DATE) - NULL if currently studying
- `gpa` (DECIMAL(3,2))
- `description` (TEXT)
- `logo` (VARCHAR(255))
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### 7. certifications
Stores professional certifications.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `user_id` (INT, FOREIGN KEY → profile.id)
- `certification_name` (VARCHAR(200), NOT NULL)
- `issuing_organization` (VARCHAR(200), NOT NULL)
- `issue_date` (DATE)
- `expiry_date` (DATE) - NULL if no expiration
- `credential_id` (VARCHAR(150))
- `credential_url` (VARCHAR(255))
- `description` (TEXT)
- `logo` (VARCHAR(255))
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### 8. achievements
Stores school achievements and accomplishments.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `user_id` (INT, FOREIGN KEY → profile.id)
- `title` (VARCHAR(200), NOT NULL)
- `description` (TEXT)
- `category` (VARCHAR(100)) - e.g., 'Academic', 'Sports', 'Competition'
- `issuer` (VARCHAR(200))
- `date_achieved` (DATE)
- `image` (VARCHAR(255))
- `display_order` (INT)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### 9. experience
Stores work experience.

**Fields:**
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `user_id` (INT, FOREIGN KEY → profile.id)
- `company_name` (VARCHAR(200), NOT NULL)
- `job_title` (VARCHAR(150), NOT NULL)
- `location` (VARCHAR(255))
- `employment_type` (ENUM: 'full_time', 'part_time', 'contract', 'internship', 'freelance')
- `start_date` (DATE)
- `end_date` (DATE) - NULL if currently working
- `description` (TEXT)
- `responsibilities` (TEXT)
- `achievements` (TEXT)
- `company_logo` (VARCHAR(255))
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

## API Endpoints

All API endpoints are located in `backend/api/` and support RESTful operations:

### User Profile
- `GET /backend/api/user_api.php` - Get user profile
- `GET /backend/api/user_api.php?id={id}` - Get user by ID

### Skills
- `GET /backend/api/skills_api.php?user_id={id}` - Get all skills
- `POST /backend/api/skills_api.php` - Create new skill
- `PUT /backend/api/skills_api.php` - Update skill
- `DELETE /backend/api/skills_api.php` - Delete skill

### Hobbies
- `GET /backend/api/hobbies_api.php?user_id={id}` - Get all hobbies
- `POST /backend/api/hobbies_api.php` - Create new hobby
- `PUT /backend/api/hobbies_api.php` - Update hobby
- `DELETE /backend/api/hobbies_api.php` - Delete hobby

### Projects
- `GET /backend/api/projects_api.php?user_id={id}` - Get all projects
- `POST /backend/api/projects_api.php` - Create new project
- `PUT /backend/api/projects_api.php` - Update project
- `DELETE /backend/api/projects_api.php` - Delete project

### Achievements
- `GET /backend/api/achievements_api.php?user_id={id}` - Get all achievements
- `POST /backend/api/achievements_api.php` - Create new achievement
- `PUT /backend/api/achievements_api.php` - Update achievement
- `DELETE /backend/api/achievements_api.php` - Delete achievement

### Education
- `GET /backend/api/education_api.php?user_id={id}` - Get all education
- `POST /backend/api/education_api.php` - Create new education
- `PUT /backend/api/education_api.php` - Update education
- `DELETE /backend/api/education_api.php` - Delete education

### Certifications
- `GET /backend/api/certifications_api.php?user_id={id}` - Get all certifications
- `POST /backend/api/certifications_api.php` - Create new certification
- `PUT /backend/api/certifications_api.php` - Update certification
- `DELETE /backend/api/certifications_api.php` - Delete certification

### Experience
- `GET /backend/api/experience_api.php?user_id={id}` - Get all experience
- `POST /backend/api/experience_api.php` - Create new experience
- `PUT /backend/api/experience_api.php` - Update experience
- `DELETE /backend/api/experience_api.php` - Delete experience

### Contacts
- `GET /backend/api/contacts_api.php` - Get all contacts
- `GET /backend/api/contacts_api.php?status={status}` - Get contacts by status
- `POST /backend/api/contacts_api.php` - Create new contact message
- `PUT /backend/api/contacts_api.php` - Update contact status
- `DELETE /backend/api/contacts_api.php` - Delete contact

## Admin Features

As an admin, you can:

1. **Add Projects** - Upload project images, add descriptions, links (project URL, GitHub, demo)
2. **Manage Hobbies** - Add hobbies with proficiency levels and icons
3. **Manage Skills** - Add technical and soft skills with proficiency levels
4. **Add Achievements** - Document school and other achievements with images
5. **Manage Education** - Add educational background
6. **Add Certifications** - Add professional certifications
7. **Manage Experience** - Add work experience
8. **View Contact Messages** - See messages from portfolio visitors

## Notes

- All foreign keys reference the `profile` table's `id` field
- Timestamps are automatically managed (created_at, updated_at)
- Image uploads are stored in respective directories under `frontend/src/imgs/`
- All API endpoints support CORS for cross-origin requests
- The default user_id is 1 (this can be modified for multi-user support)
