## Installation

Clone the project
```bash
git clone https://github.com/csfwn/laravel-coding-test-level-1.git
```

Install required packages
```bash
composer install
```

Setup environment configuration and update it accordingly (db, app key etc)
```bash
cp .env.example .env
```

Migrate DB and seeder
```bash
php artisan migrate:fresh --seed
```
> Set the db config before run miration

Install Vue & Start 
```bash
npm install
npm run dev
```
> Please use laravel directory to composer install, npm install, npm run dev


