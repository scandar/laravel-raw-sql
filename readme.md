installation
    run "cp .env.example .env" or simply rename or copy .env.example to .env
    configure Database in .env file

    run
        "php artisan migrate"
        "php artisan db:seed"
        "php artisan serve"

    open the app in your browser in login using these credentials  
        admin account
            admin@mail.com
            password

        user account
            user@mail.com
            password

all of the SQL queries located in "App\\DBModel" which other models inherit from

Features
    -CRUD operations on news items
    -only admins can edit or delete items
    -search with title
    -search with date range
    -item view count
    -items can have unlimited number of associated images
    -raw SQL queries were used in this app no Eloquent
