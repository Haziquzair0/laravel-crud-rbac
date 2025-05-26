Lab Assignment 3 - Laravel CRUD with Role-Based Access Control (RBAC)

This project is a Laravel-based CRUD application with Role-Based Access Control (RBAC) implemented to manage user permissions and roles effectively. The application allows users to create, update, and manage tasks (To-Do items) while ensuring that only authorized users can perform specific actions.

Features

1. CRUD Operations:
   - Users can create, read, update, and delete To-Do items.
   - Each To-Do item includes a title, description, and status (pending/completed).

2. Role-Based Access Control (RBAC):
   - Admins can assign specific permissions (Create, Update, Delete) to roles.
   - Permissions are stored in the `role_permissions` table, and roles are linked to users via the `user_roles` table.
   - A pivot table (`role_permission`) connects roles and permissions.

3. Authentication:
   - Laravel's built-in authentication system is used to manage user login and registration.
   - Middleware ensures that only authenticated users can access the application.

4. Admin Dashboard:
   - Admins can manage users, assign permissions, and view user-specific tasks.

Database Structure

Tables

1. users:
   - Stores user information (e.g., name, email, password).
   - Linked to roles via the `role_id` column.

2. user_roles:
   - Stores roles (e.g., Admin, User).
   - Linked to permissions via the `role_permission` pivot table.

3. role_permissions:
   - Stores permissions (e.g., Create, Update, Delete).

4. role_permission:
   - Pivot table connecting roles and permissions.

5. todos:
   - Stores To-Do items created by users.

Implementation Details

Authorization Based on RBAC

1. Middleware:
   - Middleware ensures that only authenticated users can access the application.
   - Admin-specific routes are protected using role-based checks.

2. Assigning Permissions:
   - Admins can assign permissions to roles via the "Edit Permissions" page.
   - Permissions are stored in the `role_permission` pivot table.

3. Checking Permissions:
   - Permissions are checked dynamically in controllers and views.
   - Example: Only users with the "Update" permission can edit To-Do items.

