# test_back



# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone https://github.com/4ossama4/test_back.git

Switch to the repo folder

    cd test_back

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

    (**please create a new database before migrating)

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
      
    
Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000



## Database seeding



Run the database seeder and you're done

    php artisan db:seed

----------

# Testing API Catagery

   GET Index Categories :
    http://localhost:8000/api/categories

   GET Show Category
    http://localhost:8000/api/categories/{{category_slug}}

   POST Create Category:
    http://localhost:8000/api/categories
    * name is required
    * slug is optional
  
  
  PUT Update Category :
  
  http://localhost:8000/api/categories
  
  
  DEL Delete Category
  http://localhost:8000/api/categories/{{category_slug}}

# Testing API Course

    GET Index Courses :
    http://localhost:8000/api/courses

   GET Show Course
    http://localhost:8000/api/courses/{{course_slug}}

   POST Create Course:
    http://localhost:8000/api/courses
    * name is required
    * slug is optional
    
    BODY raw :
    {
      "category_id": 1,
      "name": "test this out",
      "image": "http://dli.me/images/MSnnFP6tXy9uMjhSbpmGiHUfwVR1BnelfPpScxoJ.jpeg",
      "description": "test"
    }
  
  PUT Update Course :
  
  http://localhost:8000/api/courses
  
  
  DEL Delete Course
  http://localhost:8000/api/courses/{{Course_slug}}
  
  # Testing API Image
  
  POST Upload :
  http://localhost:8000/api/upload
  
  BODY formdata:
    image
    resource exemple = courses
    resource_id exemple =  3
  
  
  
  
