# Multaqa (ملتقى)

Multaqa is a modern, community-driven social platform built with a focus on simplicity, privacy, and meaningful interactions. It revives the spirit of classic online communities while utilizing modern technologies.

[![Test Site](https://img.shields.io/badge/Test--Site-multaqa.live-blue?style=for-the-badge)](https://multaqa.live)

## 🚀 Overview

Multaqa (Arabic for "Meeting Point") is a 100% Egyptian-developed platform designed to provide a clean, high-quality environment for users to discuss various topics in dedicated "Spaces." It emphasizes free expression, anonymity where desired, and community-led moderation.

## 🛠️ Technology Stack

- **Backend:** PHP (Custom MVC Framework)
- **Database:** MySQL
- **Frontend:** HTML5, Tailwind CSS, JavaScript, jQuery
- **Infrastructure:** Docker, Docker Compose
- **Development Tools:** Bun (for Tailwind & Node modules), Composer (for PHP dependencies)

## 🏗️ Architecture

The project follows a custom-built Model-View-Controller (MVC) architecture designed for performance and flexibility.

- **Core Engine:** Custom routing, database abstraction, and query building.
- **Security:** Built-in CSRF protection, Captcha verification, and secure password hashing.
- **Localization:** Full support for multiple languages (currently focusing on Arabic).

For more details on the architecture, see [ARCHITECTURE.md](ARCHITECTURE.md).

## 📊 Database

Detailed documentation of the database schema, including table structures and relationships, can be found in [DB.md](DB.md).

## 🔧 Getting Started

### Prerequisites

- Docker and Docker Compose
- Bun (for frontend development)

### Running with Docker

1. Clone the repository.
2. Build and start the containers:
   ```bash
   docker compose --build -d up
   ```
3. Install PHP dependencies:
   ```bash
   # Access the webserver shell
   docker exec -it multaqa-webserver-1 bash
   # Inside the container, run:
   composer install
   ```

### Frontend Development (Tailwind CSS)

1. Initialize Bun:
   ```bash
   bun install
   ```
2. For development (watch mode):
   ```bash
   bun run dev
   ```
3. For production build:
   ```bash
   bun run build
   ```

## 🤝 Contributing

We welcome contributions from the community! Whether you are a developer, a moderator, or want to suggest new features, your help is appreciated.

Please see [CONTRIBUTORS.md](CONTRIBUTORS.md) for our Hall of Fame and special thanks.

## 📜 License

GPL3 - Gnu Public License v3.0

---
*Made with ❤️ in Egypt*