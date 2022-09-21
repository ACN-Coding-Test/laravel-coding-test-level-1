## Backend Dependency
* php ^7.3|^8.0
* composer 
 
## Initial Installation
**Step 1:** Clone the repository
```
https://github.com/mashiurfpi/laravel-coding-test-level-1.git
```

**Step 2:**  Copy .env.example file to .env and edit database credentials there, or Create `.env` file 

**Step 3:**  Generate key

```
php artisan key:generate
```

**Step 4:** Install dependencies inside the repository

```
composer install or update
```

**Step 5:** Run migration for creating table.

```
php artisan migrate
```

**Step 6:** Run Seed.

```
php artisan db:seed --class=EventsTableSeeder
```

**Step 7:** Run the application
### Start Laravel app
```
php artisan serve
```

### Access the application at http://127.0.0.1:8000/
#### Open [http://127.0.0.1:8000/](http://127.0.0.1:8000/)

### Link to Github repo.

### [Github repository](https://github.com/mashiurfpi/laravel-coding-test-level-1.git)


