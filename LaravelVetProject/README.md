# My Laravel Project

This is a Laravel project. 

## Installation

1. Clone the repository:

    ```bash
    git clone <URL_GitHub_repo>
    ```

2. Navigate to the project directory:

    ```bash
    cd my-laravel-project
    ```

3. Install the dependencies using Composer:

    ```bash
    composer install
    ```

4. Set up the environment file:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Run the database migrations (optional):

    ```bash
    php artisan migrate
    ```

## Usage

To start the development server, run:

```bash
php artisan serve
