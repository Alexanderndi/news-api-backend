
# News Aggregator Backend

This is a Laravel 10+ backend for a News Aggregator application. It fetches, stores, and serves news articles from multiple sources (NewsAPI, The Guardian, NYTimes), supports user preferences, and provides a robust RESTful API.

---

## Features

- Aggregates news from NewsAPI, The Guardian, and NYTimes
- Stores articles, authors, categories, and sources in a normalized database
- User preferences for topics, sources, and categories
- RESTful API for articles, sources, categories, authors, and user preferences
- Scheduled background jobs to fetch and update news
- Static analysis (PHPStan/Larastan), code style (Laravel Pint)
- Unit and feature tests

---

## Tech Stack

- **PHP 8.2+**
- **Laravel 10+**
- **MySQL** (or compatible database)
- **Composer**
- **PHPStan/Larastan** (static analysis)
- **Laravel Pint** (code style)

---

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL or compatible database

### Installation

```bash
git clone https://github.com/your-username/news-aggregator-backend.git
cd news-api-backend
composer install
cp .env.example .env
php artisan key:generate
```

Configure your database and API keys in `.env` and `config/services.php`:

- `NEWSAPI_KEY`
- `GUARDIAN_KEY`
- `NYTIMES_KEY`

### Migrate Database

```bash
php artisan migrate
```

### Run Scheduler (for news fetching)

Set up the Laravel scheduler in your system's cron:

```
* * * * * cd /path/to/news-api-backend && php artisan schedule:run >> /dev/null 2>&1
```

---

## API Endpoints

All endpoints are prefixed with `/api`.

### Articles
- `GET /api/articles` — List articles
- `GET /api/articles/{id}` — Get article details
- `POST /api/articles` — Create article (admin)
- `PUT /api/articles/{id}` — Update article (admin)
- `DELETE /api/articles/{id}` — Delete article (admin)

### Sources
- `GET /api/sources` — List sources
- `GET /api/sources/{id}` — Get source details

### Categories
- `GET /api/categories` — List categories
- `GET /api/categories/{id}` — Get category details

### Authors
- `GET /api/authors` — List authors
- `GET /api/authors/{id}` — Get author details

### User Preferences
- `GET /api/user-preferences` — Get user preferences
- `POST /api/user-preferences` — Set user preferences

---

## News Fetching & Scheduling

- News is fetched from external APIs using Laravel jobs and scheduled tasks.
- To trigger fetching manually:
	```bash
	php artisan news:fetch
	```
- Scheduler will run jobs automatically if cron is set up.

---

## Static Analysis & Code Style

- Run static analysis:
	```bash
	./vendor/bin/phpstan analyse
	```
- Run code style fixer:
	```bash
	./vendor/bin/pint
	```

---

## Testing

- Run all tests:
	```bash
	php artisan test
	```

---

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/your-feature`)
3. Commit your changes with clear messages
4. Push to your fork and open a Pull Request

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
