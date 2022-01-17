## Install

you need to have docker installed

I'm using `traefik` as load balancer so you need that as well

setup the database file using this command in the root `touch application/database/database.sqlite`

setup `.env` file from the root

setup `.env` file from `application` folder

run `php artisan migrate`

optional you can run `php artisan db:seed` to randomly generate chunks of 10 users

## Customers crud

The api is meant to list/add/delete customers.

They can be sorted by every column using that in the url like : `/customers?sort=first_name`

By default the sort way is ascending. For descending you need to use a dash before the field `/customers?sort=-first_name`:

Available routes

`GET|HEAD v1/customers` - this will list customers with pagination

`POST v1/customers` - endpoint to add a customer

`GET|HEAD v1/customers/{customer}` - show a single customer resource where customer is a customer_id

`PUT|PATCH v1/customers/{customer}` - update a single customer resource where customer is a customer_id

`DELETE v1/customers/{customer}` - delete a single customer resource where customer is a customer_id 