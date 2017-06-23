symfony-trainer-certification
=============================

A Symfony project that should help all the people who wants to take the exam of Symfony 3 certification.

Exercises 

I. "The bundles"

Code organization, Naming conventions (Best practices)

1. Integrate a third party library in your code.
   - I used a free API library, which provides data about food. More details about the API here:
   https://ndb.nal.usda.gov/ndb/doc/index
2. Implement a controller action which uses a third party library.
    Used Guzzle for making requests and I splited the logic into service and repository. 
    The controller method returns a list of the nutrients for a certain fruit, vegetable, etc (ex: apple, watermelon, egg)
 3. Add the needed files that are recommended in your bundles structure (LICENSE etc).
 4. Give an exemple where you can take the bundle alias.
    It is used in DI/Configuration.php - is the alias for the DI. In this case, we don't need configurable parameters so we dont build a special structure.
    
    Interesting fact:  if you need to put some config parameters and extract them in your code you should
    build a service, and in the Extension class get its definition and put in a property of that service the
    value of the needed parameter (More info here: https://stackoverflow.com/questions/4821692/how-do-i-read-configuration-settings-from-symfony2-config-yml)
    This case is for the config parameters which need to be configurable (especially for the bundles who are using you bundle as a third party). If not, the parameter could be part of parameters.yml.
 5. Add some logs in your bundle and check them.
    Used Monolog to print some info (I found the logs in var/logs/dev.log)
 6. Play with the routing and see what happens if you change the prefix.
    In the documentation states (in best practices): "If the bundle provides routes, they must be prefixed with the bundle alias."
    So it works with any prefix, is just a good practice to put the bundle alias. In our case : "nbdb_api_"
 
 Bundle inheritance, Compiler pass
 
 7. Create a new bundle named TestApiBundle which extends the NdbBundle and override the controller and the service.
    For the controller is enough to create a new class in the same path (after putting the bundle alias in the getParent method).
    An extra thing which is not mentioned in the documentation is that we need routing specified for our controller (so also a change in routing.yml)
    To not modify the current implementation, I just called the parent and did the same implementation (the idea was just to play with the bundle inheritance and see how it works.).
    To override a seevice, we needed a compiler pass - a class which needs to be in DI/Compiler folder and modifies the definition of our service.
    We needed to register it also in the bundle class through the ContainerBuilder.
    
    P.S Don't forget to put in the AppKernel the new bundle which will override the base bundle.
    
 Overriding default error pages
 
 8. Override some default error pages

    1.From docs: If you just want to change the contents and styles of the error pages to match the rest of your application, override the default error templates
    It seems that if you add error404.html.twig in the needed path, is not overriding the error template if you have debug mode on true.
    (Be aware that debug mode on it doesn't mean same thing with dev env, they are correlated but not mandatory to be like this)
    If you need to check the content of that error page you can access it at [MyHost]/app.php/_error/404
    If you need to change the content only for dev purposes, you can override the error using exception.html.twig(which will override all the exceptions).
    
    From docs:
    2. If you also want to tweak the logic used by Symfony to generate error pages, override the default exception controller
    3. If you need total control of exception handling to execute your own logic use the kernel.exception event.  
 
