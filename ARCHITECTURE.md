# Architecture Documentation 🏗️

This document outlines the technical architecture of the Multaqa project.

## 🧱 The MVC Framework

Multaqa uses a custom-built PHP MVC (Model-View-Controller) framework designed to be lightweight and efficient.

### 1. Routing (`core\App`)
The `App` class is the entry point of the application. It parses the URL and determines which controller and method to execute.
- **URL Format:** `example.com/controller/method/params`
- **Default Controller:** `ErrorPage` (404) if not found, or `Home` if empty.

### 2. Base Controller (`core\Controller`)
All controllers extend this base class. It provides helper methods for:
- `model($model)`: Instantiates a model from the `app/models` directory.
- `view($view, $data)`: Renders a view template from `app/views`.
- `canProcess($interval)`: Simple rate limiting for actions.
- `setLastAction()`: Updates the timestamp of the user's last action.

### 3. Database Layer (`core\Database`)
A PDO-based singleton wrapper for database interactions.
- Handles connection management using `config.ini`.
- Provides easy methods like `fetchAll`, `fetchOne`, and `lastInsertId`.

### 4. Query Builder (`core\QueryBuilder`)
A fluent interface for building SQL queries, preventing SQL injection through prepared statements.
- **Example Usage:**
  ```php
  $this->SQL->select("users", ["id", "username"])
            ->where([["username", "="]])
            ->build()
            ->execute([$username]);
  ```

### 5. Validation (`core\Validation`)
Centralized validation logic for user input.
- Supports length checks, email validation, CSRF protection, and Captcha verification.

### 6. Traits & Helpers (`core\traits\AuthHelper`)
Reusable logic shared across controllers. `AuthHelper` handles common authentication tasks like input checking, user retrieval, and session management.

---

## 🌐 Frontend & Localization

### Localization
Multaqa supports multi-language interfaces.
- **Storage:** Translations are stored in `website/public/lang/*.json`.
- **Handling:** A hybrid approach using PHP for initial state and `website/public/scripts/lang.js` for client-side interactions.

### Styling
- **Tailwind CSS:** Used for all styling.
- **Build Process:** Managed by Bun. The `@apply` directive is used in `app.css` to keep HTML clean and reuse styles.

---

## 🔒 Security Measures

- **Password Hashing:** Uses `password_hash()` with `PASSWORD_DEFAULT` and a cost of 12.
- **CSRF Protection:** Tokens are validated for all state-changing requests.
- **Captcha:** Custom captcha implementation to prevent bot registrations.
- **Input Sanitization:** Performed via `QueryBuilder` and `Validation` classes.

---

## 🐳 Infrastructure

The project is fully containerized using Docker.
- **Webserver:** Apache with PHP 8.4.
- **Database:** MySQL.
- **Configuration:** Managed via `docker-compose.yml`.
