# Circular Living Standards – Bespoke WordPress Theme

This bespoke WordPress theme is built on top of **_s (Underscores)** — a lightweight starter theme widely used in custom WordPress development.

## ✳️ About This Theme

- **Created For:** WRAP  
- **Created By:** Among Equals 
- **Developed by:** Denis Bouquet  
- **Purpose:** Custom WordPress theme powering *CircularLivingStandards*  
- **Frontend components:** Integrated with Evergreen UI — https://evergreen.wrap.ngo/

## 📁 Folder Structure

### `/src`
This is where the development source files live.  
All editable SCSS, JS, components, and build assets are stored here.

### `/dist`
Automatically generated build output.  
Contains compiled CSS, JS, and production-ready assets.

## 🛠️ Development Setup

Install all dependencies:

```bash
npm install
```

Start the development watcher (with live reload):

```bash
npm run start
```

Build the production-ready `/dist` folder:

```bash
npm run build
```

## 🧩 Components

Theme components follow the Evergreen component patterns provided by WRAP:

🔗 https://evergreen.wrap.ngo/

You must have Evergreen loaded globally for components to work correctly.

## 🗂️ CMS & ACF Guide

A full editorial/CMS guide (ACF field structure, content model, admin usage) is available here:

👉 https://docs.google.com/document/d/12wtHz2kJYe8pVEiFgpqc6b8KfUGOqqSgT6fRAhifgbE/edit?tab=t.0

**Document name:** *CircularLivingStandards CMS by WRAP*

## ✔️ Recommended Additional Notes

- PHP templates follow WordPress coding standards.  
- ACF Pro is required (Flexible Content, Clone Fields, Options Pages).  
- Webpack is configured for SCSS, ES modules, and asset bundling.  
- Use `/dist` only — do not edit compiled files directly.  
- Gutenberg is disabled for certain templates to maintain controlled layouts.

---

