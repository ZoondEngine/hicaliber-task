Applicant test task for HiCaliber.

Laravel backend with searching features.

Installation steps:
1) Pull that branch on your local PC
2) Copy & paste .env.example file and rename it to .env
3) Prepare database connection
4) php artisan migrate --seed
5) php artisan key:generate
6) php artisan serve

Api routes
    [POST].................../api/search

Files
    app/Http/Controllers/SearchController.php <- controller
    app/Http/Requests/SearchRequest.php <- form request validation implementation
    app/Rules/SearchablePrice.php <- Validation rule for price range array
    app/Models/House.php <- model
    app/Services/Search/* <- search logic
