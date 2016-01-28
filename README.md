# Pet Portal WordPress Plugin

#### MVP Structure

```
.
+-- app/
|  +-- assets/
|  |  +-- images/
|  |  +-- javascripts/
|  |  +-- stylesheets/
|  +-- controllers/
|  +-- models/
|  +-- views/
+-- bin/
+-- config/
|  +-- application.php
|  +-- autoloader.php
+-- lib/
+-- tests/
|  +-- controllers/
|  +-- models/
|  +-- bootstrap.php
+-- pet-portal.php
+-- phpunit.xml.dist
+-- README.md
```

[MVC Reference](https://iandunn.name/content/presentations/wp-oop-mvc/mvc.php)

* Class files need to have the namespace matching the path directory
* Action callbacks are usually controllers
* Filter callbacks are usually models
* Use output buffering to capture views into a string
* Single callback/view to markup settings, etc.
