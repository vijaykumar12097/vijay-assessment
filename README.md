# **Document Management System**

## **Project Overview**

This project is a secure, scalable document management system built with Laravel. It provides features such as:

- **Document Encryption**: AES-256 encryption for document headers and bodies.
- **Role-Based Access Control (RBAC)**: User roles and permissions.
- **Modular Architecture**: Modules for General, Motors, and Jobs.
- **Versioning and Audit Logs**: Track document changes and user actions.
- **Search and API Endpoints**: Efficiently manage and query documents.
- **Background Processing**: Asynchronous tasks using Redis Queues.
- **Dynamic Migrations**: Module-specific migrations with chained execution.

---

## **Features**

1. **Encryption**: Secure document storage using per-document encryption keys, encrypted with Laravel's `APP_KEY`.
2. **Modular Architecture**: Independent modules for different business logic with middleware for added security.
3. **RBAC**: Roles like Admin, User, Viewer control access to features.
4. **API Endpoints**: CRUD operations, search, and soft-delete.
5. **Background Tasks**: Asynchronous document handling with Redis.
6. **Audit Logging**: Tracks user activity.

---

## **Installation Instructions**

### **Prerequisites**

Ensure you have:
- PHP 8.1+
- Composer
- MySQL
- Redis
- Node.js & npm
- Laravel 10.x

### **Setup**

1. **Clone the Repository**:
   ```bash
   
2.Install Dependencies:
-composer install
-npm install
-npm run build

3.Configure Environment

-APP_NAME="Document Management System"
-APP_KEY=base64:your-app-key
-DB_CONNECTION=mysql
-DB_HOST=127.0.0.1
-DB_PORT=3306
-DB_DATABASE=your_database_name
-DB_USERNAME=your_database_user
-DB_PASSWORD=your_database_password
-REDIS_HOST=127.0.0.1
-REDIS_PORT=6379

4.Generate Application Key:
-php artisan key:generate

5.Run Migrations and Seed Data:
-php artisan migrate --seed

6.Start Redis:
-redis-server

7.Run Queue Worker:
-php artisan queue:work

8.Serve the Application:
-php artisan serve


API Documentation
Available Endpoints
Method	Endpoint	Description
POST	/api/login	User login
POST	/api/documents	Upload a document
GET	/api/documents/{id}	Get a document by ID
GET	/api/documents/versions/{id}	View all versions of a document
DELETE	/api/documents/{id}	Soft delete a document
POST	/api/documents/search	Search documents
POST	/api/modules/migrate	Run module-specific migrations
Authentication
Use POST /api/login to authenticate and retrieve an access token.
