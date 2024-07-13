# My Laravel Project

This is a Laravel project for managing veterinary appointments. It allows for the registration of pets, management of veterinarians and appointments, and also enables scheduling of veterinarians for training sessions.

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
