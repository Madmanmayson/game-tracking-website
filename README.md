# Game Progress Tracker Website
A website for tracking progress and completion of games.

## Authors
[Dylan Hardy @Madmanmayson](https://github.com/Madmanmayson)

[Ben Fuqua @B-Fuqua](https://github.com/B-Fuqua)

## Notes
- the `.htacces` has been altered from the one shown in class. The one we use routes any links with /api/ from the relative root to api-router.php and everything else to index.php
- Every function that accesses the database does so through an HTTP request to the API. Not a single function in the main index.php router (or anywhere on the front end) has any access to the database. The two routers are just in the same project as we do not have access to a DNS to properly set CNAME and A records like you would on an actual web server. They are also in the same project so that you can easily see the database code without having to open another repo.
- Due to `.htaccess` handling reroutes and multiple routers, the `$_POST` array was completely inaccessable from the API so all inputs were loaded from the PHP input stream.
- A lot of the HTTP Request URLs for accessing the API are dynamically generated due to the fact we needed to handle having the repository hosted on multiple remote hosts. This caused a lot of complex string math and building to properly generate.

## Project Requirements
1. Separates all database/business logic using the MVC pattern.
    - logic is under the model folder
    - All HTML is under views folder
    - Routes to all html is under the index.php
    - index.php calls function in controller to get data from model and return views
    - classes under classes folder
    - Javascripts under scripts folder
    - api-router is NOT split into a controller class however.

2. Routes all URLs and leverages a templating language using the Fat-Free framework.
   - All view routes are in the index.php and all api routes are in api-router.php.
   - Templating is used for all routes found in index.php utilizing the F3 Templating language
   - All routes for the api in api-router echo out string encoded jsons rather than being templated.

3. Has a clearly defined database layer using PDO and prepared statements. You should have at least two related tables.
   - All database code is built using PDO and prepared statements. However it is currently all kept in the API router rather then being put into a data layer level class.
   - All tables in the database are related to each other in some form. This can be seen more clearly in the UML diagram

4. Data can be viewed and added.
   - All routes except for the home page access the database in some way. However, they do so by either using cURL (for PHP) or Fetch API (for JavaScrip) to generate HTTP requests that either GETs, POSTs, or PATCHs the data at each end point declared in the api-router.
   - The following pages view data: search, profile.
   - The following pages add data: profile (for avatars via PATCH), add-game, registration, search (to add games to your list)

5. Has a history of commits from both team members to a Git repository. Commits are clearly commented.
   - 50 commits from Dylan (Madmanmayson)
   - 36 commits from Ben (B-Fuqua)

6. Uses OOP, and defines multiple classes, including at least one inheritance relationship.
   - OOP is used for all classes in the following folders: classes, controller, model.
   - Both routing files use OOP classes to create objects.
   - The Admin class inherits from the User class to get profile data but has an Admin only function for adding games to the database.

7. Contains full Docblocks for all PHP files and follows PEAR standards.
   - All classes contain DocBlock and follows PEAR standards

8. Has full validation on the client side through JavaScript and server side through PHP.
   - Has server side validation through PHP (On the front end controller)

9. All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.
    - All functions and files are commented. Any code that was repeated was turned into a fucntion and called upon instead of repeating code

10. Your submission shows adequate effort for a final project in a full-stack web development course.
    - I think it's fair to say we went above and beyond for this project, and we both learned a lot

11. BONUS:  Incorporates Ajax that access data from a JSON file, PHP script, or API. If you implement Ajax, be sure to include how you did so in your readme file.
    - The entire project is build upon an API accessed through either cURL if done so in PHP or through Fetch if done so in JavaScript. Although we didn't use AJAX specificall, I believe that using either of those two should also satisfy the bonus requirement.

## UML

![UML](https://raw.githubusercontent.com/Madmanmayson/game-tracking-website/master/readme/UML.PNG)

## ERD

![ERD](https://raw.githubusercontent.com/Madmanmayson/game-tracking-website/master/readme/ERD.PNG)
