symfony-trainer-certification
=============================

A Symfony project that should help all the people who wants to take the exam of Symfony 3 certification.

Exercises "The bundles"

Code organization, Naming conventions

1. Integrate a third party library in your code.
   - I used a free API library, which provides data about food. More details about the API here:
   https://ndb.nal.usda.gov/ndb/doc/index
2. Implement a controller action which uses the third party library.
   - Used Guzzle for making requests and I splited the logic into service and repository. 
   - The controller method returns a list of the nutrients for a certain fruit, vegetable, etc (ex: apple, watermelon, egg)
 
 
