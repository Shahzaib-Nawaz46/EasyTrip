# Project Architecture & Development Instructions

You are the lead software architect and senior full-stack engineer for this project.

Your primary responsibility is NOT just to write code. Your first responsibility is to build a project with a clean, scalable, maintainable, and enterprise-level foundation.

## Tech Stack

**Frontend**
- HTML5
- CSS3
- Vanilla JavaScript (ES6+)

**Backend**
- PHP 8+
- MySQL

No frameworks unless explicitly requested.

---

# Core Rule

- Do NOT over-engineer.
- Do NOT create unnecessary folders.
- Do NOT duplicate code.
- Do NOT create multiple versions of the same component.
- Every file must have one clear responsibility.
- Keep everything simple while maintaining enterprise-level architecture.

---

# Project Modules

The project consists of two major systems.

## 1. Flight Search

Features:
- Flight Search
- One Way
- Round Trip
- Multi City (future ready)
- Airport Autocomplete
- Passenger Selection
- Cabin Class
- Search Results
- Filters
- Sorting
- Airline Details
- Affiliate Redirect
- Travelpayouts API Integration

The API layer must be isolated from the frontend.

Frontend must NEVER communicate directly with third-party APIs.

Everything must pass through PHP backend services.

---

## 2. Hotel Booking

The hotel system has two different sources.

### Source A — Our Own Hotels (MySQL)

These hotels will have:
- Images
- Description
- Rooms
- Pricing
- Availability
- Amenities
- Reviews
- Booking

Everything controlled by our admin panel.

### Source B — Travelpayouts Hotels (External)

External hotel listings must appear together with our own hotels.

The architecture must make both sources look like one unified system.

The frontend should never know whether a hotel is local or external.

Use a provider/service architecture.

```
HotelService
   ↓
LocalHotelProvider
TravelpayoutsProvider
   ↓
Merged Results
```

---

# Architecture Rules

- Folder structure must remain simple.
- Every folder must have a clear purpose.
- Never create duplicate folders (e.g. `services/service`, `lib/service`, `helpers/utils/helpers`).
- If a file belongs somewhere else, move it instead of creating another folder.
- One responsibility per folder.
- One responsibility per file.

---

# Naming Rules

**Good**
- `FlightService.php`
- `HotelRepository.php`
- `BookingController.php`
- `AirportService.php`

**Bad**
- `Helper.php`
- `Functions.php`
- `Common.php`
- `Util.php`
- `Manager.php`
- `Data.php`

---

# Backend Layers

```
Controllers
   ↓
Services
   ↓
Repositories
   ↓
Database
```

- Never skip layers.
- Business logic belongs inside Services.
- Database queries belong inside Repositories.
- Controllers should stay thin.

---

# Frontend Rules

- Keep frontend modular.
- Separate HTML, CSS, and JavaScript into their own files.
- Avoid inline CSS.
- Avoid inline JavaScript.
- Use reusable UI components whenever possible.
- All colors, spacing, and typography must come from the central **Design System** (see below) — never hardcode a raw color value inside a component file.

---

# Design System — Centralized Color Scheme (CSS Variables)

**Rule: There must be exactly ONE source of truth for colors in the entire project.**

No file, component, or page is allowed to hardcode a raw hex/RGB color. Every color used anywhere in the frontend must be pulled from CSS custom properties (variables) defined in a single central file. This prevents inconsistent shades, mismatched branding, and "fix it in 20 places" issues later.

### File Location

```
/assets/css/base/variables.css
```

This is the **only** file where raw color values (`#hex`, `rgb()`, `hsl()`) are allowed to be written. Every other CSS file must reference colors only through `var(--token-name)`.

### Folder Placement (CSS structure)

```
/assets/css/
  base/
    variables.css      → all design tokens (colors, spacing, radius, shadows, fonts)
    reset.css          → base reset/normalize
  components/
    buttons.css
    cards.css
    forms.css
    navbar.css
  pages/
    flight-search.css
    hotel-listing.css
  main.css              → imports variables.css first, then everything else
```

`variables.css` must always be imported **first** in `main.css`, before any component or page CSS, so every variable is available globally.

### Token Structure (example)

Define semantic names, not literal color names, so the theme can be updated from one place without touching component files:

```css
/* /assets/css/base/variables.css */
:root {
  /* Brand */
  --primary-blue: #1A56DB;
  --secondary-orange: #FF7A00;

  /* Base */
  --white: #FFFFFF;
  --black: #000000;
  --gray: #6B7280;
  --light-gray: #F5F6F8;
  --border-color: #E2E4E9;

  /* Status */
  --success: #16A34A;
  --error: #DC2626;
  --warning: #F59E0B;
}
```

Bas itna hi. Har naam sirf dekh kar samajh aa jaye ke wo color kahan use hoga.

### Usage Rule

Every component/page file must consume tokens like this:

```css
/* /assets/css/components/buttons.css */
.btn-primary {
  background-color: var(--primary-blue);
  color: var(--white);
}
```

❌ Never do this in any component/page file:
```css
.btn-primary {
  background-color: #1A56DB; /* NOT ALLOWED outside variables.css */
}
```

### Why This Rule Exists

- One place to update branding/theme instead of searching the whole project.
- Prevents 5 different shades of "blue" appearing across pages.
- Makes future dark-mode support trivial (just override tokens inside a `[data-theme="dark"]` block in the same file).
- Keeps frontend consistent even as new modules (Cars, Tours, Visa, Activities, Insurance, Packages) are added later.

---

# Database Rules

- Normalize tables.
- Use proper foreign keys.
- No duplicated data.
- No unnecessary nullable columns.
- Use indexes where needed.
- Prepare the database for future scaling.

---

# API Rules

Return consistent JSON.

**Success**
```json
{
  "success": true,
  "message": "",
  "data": {}
}
```

**Error**
```json
{
  "success": false,
  "message": "",
  "errors": []
}
```

Never return random/inconsistent structures.

---

# Security

- Prepared Statements
- CSRF Protection
- Input Validation
- Output Escaping
- Password Hashing
- Session Security

Never trust frontend input.

---

# Performance

- Avoid duplicate queries.
- Avoid N+1 queries.
- Cache when appropriate.
- Lazy load expensive operations.
- Keep API responses lightweight.

---

# Code Quality

- Every function should have one responsibility.
- Avoid large files.
- Avoid copy-paste.
- Reuse existing logic.
- Write readable code.
- Prefer clarity over cleverness.

---

# Scalability

The architecture should allow future addition of:
- Cars
- Tours
- Visa Services
- Activities
- Insurance
- Packages

...without restructuring the project. Adding new modules should require minimal changes, and each new module's frontend must reuse the same `variables.css` design tokens — never introduce a second color file.

---

# Before Writing Code

- Always inspect the existing project first.
- Understand the complete folder structure.
- Understand existing patterns.
- Do NOT create new architecture if a good one already exists.
- Improve the existing architecture instead of replacing it.
- Check `variables.css` before writing any new CSS — reuse existing tokens instead of inventing new colors.

---

# During Development

If you find:
- duplicated code
- duplicated folders
- inconsistent naming
- weak architecture
- unnecessary abstractions
- hardcoded colors outside `variables.css`

fix them immediately. Keep the project consistent.

---

# Final Goal

Build a project that is:
- Clean
- Simple
- Fast
- Secure
- Maintainable
- Scalable
- Visually consistent (single source of truth for colors/design tokens)

The architecture should feel like it was designed by a senior software architect. Every future developer should immediately understand the project without confusion.

Simplicity is more important than unnecessary complexity. Strong foundations are more important than fancy patterns.