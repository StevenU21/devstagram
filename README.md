# SocialHubProject

Welcome to SocialHubProject, your very own Facebook clone built with Laravel, Intervention Image, and more! 

## Getting Started

To kick things off, follow these simple steps:

### Install Dependencies

Make sure you have all the necessary dependencies. Run the following commands:


## Installation

1. Clone this repository to your local server.
```sh
git clone -b develop git@bitbucket.org:strappberry/heracall-server.git
```

2. Navigate to the project directory.
```sh
cd heracall-server
```

3. Install project dependencies.
```sh
composer install
```
4. Run storage link.
```sh
php artisan storage:link
```

5. Create a `.env` file from `.env.example` and configure the environment variables.
```sh
cp .env.example .env
```

6. Generate an application key.
```sh
php artisan key:generate
```

7. Run migrations and seeders (if you have them).
```sh
php artisan migrate --seed
```

Now you're all set to explore the exciting world of SocialHubProject! Happy coding!