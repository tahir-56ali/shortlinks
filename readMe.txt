Your mission, should you choose to accept it, is to make a URL shortener API. Feel free to use any of the tools you are most familiar with.
Core Requirements

1. Create a POST endpoint that receives as a body param the URL to shorten and it returns as part of the response an URL with the shortest possible length. // DONE

	1.1 Use background/async jobs to crawl the URL that is shortened, pull the title from the website, and store it. // DONE using queue job
Create a route to get redirected to the original URL from the shortened URL, i.e // DONE

From https://localhost:3000/<unique code>   -> https://en.wikipedia.org/wiki/Genghis_Khan  // DONE

2. Create a GET endpoint that returns the top 100 URLs most frequently accessed, including the title crawled from step 2. // DONE

Deliverables

3. A Github public repository with the core requirements implemented. (Don’t mention Bluecoding in any of the links or names) // DONE on github public repo
If there is enough time, deploy to Heroku or any free host you’re comfortable with.

Notes / Hints

Feel free to use the PHP framework you’re comfortable with.
Feel free to show off if time allows, with
Ask questions to your interviewer.
Use Google effectively to find the right answer for the most optimal algorithm to implement the shortest URL.
You can use whatever database you are comfortable with.
Don’t forget about validations and handling exceptions.
--------------------------------------------------------------
Steps to setup:
    1. Clone the repo
    2. composer install
    3. php artisan migrate
    4. access on local machine like: http://localhost/generate-shorten-link
