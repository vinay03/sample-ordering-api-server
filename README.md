# Sample Ordering - API Server

## Installation
1. Run following commands to clone this repository and load dependency
<pre>
git clone https://github.com/vinay03/sample-ordering-api-server
cd sample-ordering-api-server
composer install
</pre>


2. Create a blank database in MySQL and mention login credentials in `/.env/` file located at root directory. You can modify following settings :
<pre>
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simple_ordering
DB_USERNAME=local
DB_PASSWORD=local
</pre>


3. Run following command :
<pre>
php artisan migrate:fresh --seed
</pre>

`Note: If you come across any issue related to database connection at this point, then verify database credentials which you have set above in Step 2 and re-run the command mentioned in Step 3.`


4. Run following command to start Laravel Server :
<pre>
npm run serve
</pre>

`Note: Above command starts Laravel server on port 8000. If you have any other service using the same port, then please stop that service first`