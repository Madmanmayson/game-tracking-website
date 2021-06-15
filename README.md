# game-tracking-website
A website for tracking progress and completion of games.

Authors:
- Dylan Hardy
- Ben Fuqua

# Project Requirements
1. Separates all database/business logic using the MVC pattern.
   - logic is under the model folder
    - All HTML is under views folder
    - Routes to all html is under the index.php
    - index.php calls function in controller to get data from model and return views
    - classes under classes folder
    - Javascripts under scripts folder
2. Routes all URLs and leverages a templating language using the Fat-Free framework.
   - All view routes are in the index.php and all api routes are in api-router.php and leverages a templating language using Fat-Free Framework
3. Has a clearly defined database layer using PDO and prepared statements. You should have at least two related tables.
   - all database layer is under model in data-layer.php
        - Related tables: games, gamePlatforms, Platforms, users, userGameLists, statuses
4. Data can be viewed and added.
   - Functions in the controller use PDO and prepared statements to add, retrieve, and delete from the database
5. Has a history of commits from both team members to a Git repository. Commits are clearly commented.
   - 50 commits from Dylan
    - 36 commits from Ben
6. Uses OOP, and defines multiple classes, including at least one inheritance relationship.
   - admin class inherits from user class
7. Contains full Docblocks for all PHP files and follows PEAR standards.
   - All classes contain DocBlock and follows pear standards
8. Has full validation on the client side through JavaScript and server side through PHP.
   - Has server side validation through PHP
9. All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.
    - All functions and files are commented. Any code that was repeated was turned into a fucntion and called upon instead of repeating code
10. Your submission shows adequate effort for a final project in a full-stack web development course.
    - I think it's fair to say we went above and beyond for this project, and we both learned a lot
11. BONUS:  Incorporates Ajax that access data from a JSON file, PHP script, or API. If you implement Ajax, be sure to include how you did so in your readme file.
    - Our project incorporates fetch that access data via an API

![UML](https://github.com/Madmanmayson/game-tracking-website/blob/master/readme/UML.png?raw=true)

![ERD](https://github.com/Madmanmayson/game-tracking-website/blob/master/readme/ERD.png?raw=true)
