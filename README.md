# Towel

This is a sample symfony project to process xml files
and import this data to database. It also provides
a simple api to access the imported data.

## Running

To run this project you need [docker]() and [docker-compose](). If you have these
requirements, just execute the following steps:

 1. `export UID` - This is necessary so that the user inside the containers be your user.
 2. `docker-compose up -d` - Orchestrate the containers
 3. `docker-compose exec php composer install` - Installing dependencies
 4. `docker-compose exec php php app/console doctrine:migrations:make` - Configure the database
 5. Add to your */etc/hosts* file an entry so that the *towel.localhost* host be pointed to your
 machine ip
 6. Head over to http://towel.localhost and upload your xml files!
 
To try out the api doc go to http://towel.localhost/api/doc.

Note: Take a look at some sample xml files:

 - [People](src/AppBundle/Tests/Resources/people.xml)
 - [Order](src/AppBundle/Tests/Resources/shiporders.xml)

## Running tests

To run the unit and integration tests execute the following:

    cp app/phpunit.xml.dist app/phpunit.xml
    docker-compose exec php php bin/phpunit -c app/ --testsuite unit
    docker-compose exec php php bin/phpunit -c app/ --testsuite integration
