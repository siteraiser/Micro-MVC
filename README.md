# Micro-MVC
Copy files to your htdocs folder and set your base_url and routing in the classes/requestHandler.php file to get started. The requestHandler file contains all of the logic for the MVC system.
All models and controllers extend the requestHandler object and will have some predefined functions and variables available via $this. To access the url segment of your choice anywhere, use $this->url_segments[0] or to access the base_url originally set in classes/requestHandler.php, use $this->base_url anywhere. 

See the classes/requestHandler.php file to modify any of the extra functions, variables or routing. There are examples of usage in the models, views and controllers folders.

