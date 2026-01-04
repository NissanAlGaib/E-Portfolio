# E-Portfolio Page Structure

## Navigation Dock (Bottom of Page)

```
┌─────────────────────────────────────────────────────────────────────┐
│  🏠      📁       ✅       ⭐        🎓       ❤️                      │
│  Home  Projects Skills  Achievements Education Hobbies              │
└─────────────────────────────────────────────────────────────────────┘
```

## Page Layouts

### Skills Page
```
┌─────────────────────────────────────────────────────────┐
│                      My Skills                          │
├─────────────────────────────────────────────────────────┤
│  Technical Skills                                       │
│  ┌─────────┐ ┌─────────┐ ┌─────────┐                  │
│  │ 🖼️ Icon │ │ 🖼️ Icon │ │ 🖼️ Icon │                  │
│  │JavaScript│ │  React  │ │ Node.js │                  │
│  │ ▓▓▓▓▓▓░░ │ │ ▓▓▓▓▓░░░ │ │ ▓▓▓▓▓▓▓░ │                  │
│  │   85%    │ │   75%   │ │   90%   │                  │
│  └─────────┘ └─────────┘ └─────────┘                  │
│                                                          │
│  Soft Skills                                            │
│  ┌─────────┐ ┌─────────┐                               │
│  │Leadership│ │ Teamwork │                              │
│  │ ▓▓▓▓▓▓▓▓ │ │ ▓▓▓▓▓▓▓░ │                              │
│  │   80%    │ │   95%   │                              │
│  └─────────┘ └─────────┘                               │
└─────────────────────────────────────────────────────────┘
```

### Achievements Page
```
┌─────────────────────────────────────────────────────────┐
│                   My Achievements                       │
├─────────────────────────────────────────────────────────┤
│  Academic                                               │
│  ┌──────────────────┐ ┌──────────────────┐            │
│  │ [Certificate IMG]│ │ [Certificate IMG]│            │
│  │ Dean's List      │ │ Best Project     │            │
│  │ 🏛️ University    │ │ 🏛️ CS Department │            │
│  │ 📅 Jan 2024      │ │ 📅 Dec 2023      │            │
│  └──────────────────┘ └──────────────────┘            │
│                                                          │
│  Competition                                            │
│  ┌──────────────────┐                                  │
│  │ [Trophy IMG]     │                                  │
│  │ Hackathon Winner │                                  │
│  │ 🏛️ Tech Corp     │                                  │
│  └──────────────────┘                                  │
└─────────────────────────────────────────────────────────┘
```

### Education Page
```
┌─────────────────────────────────────────────────────────┐
│                    My Education                         │
├─────────────────────────────────────────────────────────┤
│  ┌────────────────────────────────────────────────┐    │
│  │ [Logo] University Name                         │    │
│  │        Bachelor of Science in Computer Science │    │
│  │                                                 │    │
│  │ 📍 City, Country                               │    │
│  │ 📅 Sep 2020 - Present                          │    │
│  │ ⭐ GPA: 3.85                                   │    │
│  │                                                 │    │
│  │ Relevant coursework and achievements...        │    │
│  └────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────┘
```

### Projects Page
```
┌─────────────────────────────────────────────────────────┐
│                    My Projects                          │
├─────────────────────────────────────────────────────────┤
│  ┌──────────┐ ┌──────────┐ ┌──────────┐              │
│  │ [Image]  │ │ [Image]  │ │ [Image]  │              │
│  │ Project 1│ │ Project 2│ │ Project 3│              │
│  │ #React   │ │ #Node    │ │ #Python  │              │
│  │ #TypeScript│ │ #Express│ │ #Django  │              │
│  │          │ │          │ │          │              │
│  │ Brief    │ │ Brief    │ │ Brief    │              │
│  │ desc...  │ │ desc...  │ │ desc...  │              │
│  │          │ │          │ │          │              │
│  │ 🐙 [View]│ │ 🐙 [View]│ │ 🐙 [View]│              │
│  └──────────┘ └──────────┘ └──────────┘              │
└─────────────────────────────────────────────────────────┘
```

### Hobbies Page (Timeline)
```
┌─────────────────────────────────────────────────────────┐
│                     My Hobbies                          │
├─────────────────────────────────────────────────────────┤
│  Timeline                                               │
│  ──●────────●────────●────────●────                    │
│   2020    2021    2022    2023                         │
│                                                          │
│  Hobbies from 2022                                      │
│  ┌────────────────────────────────────────┐            │
│  │ 🎮 3D Modeling                         │            │
│  │ ▓▓▓▓▓░░░░░ 60%                        │            │
│  │                                         │            │
│  │ 🎮 Game Development                    │            │
│  │ ▓▓▓▓▓▓▓░░░ 70%                        │            │
│  └────────────────────────────────────────┘            │
└─────────────────────────────────────────────────────────┘
```

## Data Flow Architecture

```
┌──────────────┐
│  Public User │
└──────┬───────┘
       │
       ▼
┌──────────────────────────────────────────┐
│        layout.php (Main Container)       │
│  ┌────────────────────────────────────┐  │
│  │   Navigation Dock (Bottom)         │  │
│  │   [Home|Projects|Skills|Achievements│Education|Hobbies]  │
│  └────────────────────────────────────┘  │
│  ┌────────────────────────────────────┐  │
│  │   AJAX Content Area                │  │
│  │   (Loads page content dynamically) │  │
│  └────────────────────────────────────┘  │
└──────────────────────────────────────────┘
       │
       ▼ (User clicks Skills)
┌──────────────┐
│  skills.php  │ ← Loads into content area
└──────┬───────┘
       │
       ▼
┌──────────────┐
│  Skills.js   │ ← Fetches data
└──────┬───────┘
       │
       ▼
┌────────────────────┐
│  skills_api.php    │ ← API endpoint
└──────┬─────────────┘
       │
       ▼
┌────────────────────┐
│  Skills.class.php  │ ← Database queries
└──────┬─────────────┘
       │
       ▼
┌────────────────────┐
│  MySQL Database    │
│  'skills' table    │
└────────────────────┘
```

## Admin vs Public Pages

### Admin Pages (backend management)
- `/frontend/views/admin/dashboard.php`
- `/frontend/views/admin/manage_projects.php`
- `/frontend/views/admin/manage_skills.php`
- `/frontend/views/admin/manage_achievements.php`
- `/frontend/views/admin/manage_education.php`
- `/frontend/views/admin/manage_contacts.php`

### Public Pages (visitor view)
- `/frontend/views/pages/home.php`
- `/frontend/views/pages/projects.php`
- `/frontend/views/pages/skills.php` ⭐ NEW
- `/frontend/views/pages/achievements.php` ⭐ NEW
- `/frontend/views/pages/education.php` ⭐ NEW
- `/frontend/views/pages/hobbies.php`

## Complete Feature Matrix

| Feature      | Database Table | Admin Page | Public Page | API Endpoint | JS File |
|--------------|----------------|------------|-------------|--------------|---------|
| Profile      | ✅ profile     | ❌         | ❌          | ✅ user_api  | ✅ User.js |
| Projects     | ✅ projects    | ✅         | ✅          | ✅           | ✅      |
| Skills       | ✅ skills      | ✅         | ✅ NEW      | ✅           | ✅ NEW  |
| Achievements | ✅ achievements| ✅         | ✅ NEW      | ✅           | ✅ NEW  |
| Education    | ✅ education   | ✅         | ✅ NEW      | ✅           | ✅ NEW  |
| Hobbies      | ✅ hobbies     | ✅         | ✅          | ✅           | ✅      |
| Contacts     | ✅ contacts    | ✅         | ❌          | ✅           | ❌      |
| Certifications| ✅ certifications| ❌      | ❌          | ✅           | ❌      |
| Experience   | ✅ experience  | ❌         | ❌          | ✅           | ❌      |

✅ = Implemented
❌ = Not yet implemented (can be added later)
⭐ NEW = Added in this update
