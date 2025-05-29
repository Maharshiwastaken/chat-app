# Laravel Reverb: Real-Time Chat App (Modified)

This is a modified version of the original **Laravel Reverb Real-Time Chat App** tutorial by [BoolFalse](https://boolfalse.com/), based on a [freeCodeCamp article](https://www.freecodecamp.org/news/laravel-reverb-realtime-chat-app/).

> ✨ **Update**: UI changes have been made to the **Login**, **Registration**, and **Email Verification** pages. More modifications are in progress as the app is being customized further.

Reverb is a first-party WebSocket server for Laravel applications, bringing real-time communication between client and server. This app uses Laravel (backend) and React.js with Vite.js (frontend) to implement a modern, real-time chat system.

![Chat Demo](https://i.imgur.com/kIRE69i.gif)

---

## 🚀 Installation

### Pre-requisites

- PHP >= 8.2  
- Composer  
- MySQL >= 5.7  
- Node.js >= 20  

### Steps

```bash
# Clone the repository
git clone git@github.com:boolfalse/laravel-reverb-react-chat.git
cd laravel-reverb-react-chat/

# Copy the environment file
cp .env.example .env

# Install PHP dependencies
composer install

# Generate app key
php artisan key:generate

# Set application URL (default: http://localhost)
# If using a virtual host, update APP_URL in .env

# Configure database credentials in .env
# DB_DATABASE, DB_USERNAME, DB_PASSWORD

# Setup Reverb credentials (or use example credentials)
# See article for Reverb setup if needed

# Cache the configuration
php artisan optimize

# Run database migrations
php artisan migrate:fresh

# Install Node.js dependencies and build frontend
npm install
npm run build

# [Optional] For development:
npm run dev  # Watch frontend assets

# Start WebSocket server
php artisan reverb:start

# Start queue listener
php artisan queue:listen

# Run local dev server
php artisan serve