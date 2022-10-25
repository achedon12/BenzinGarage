# BenzinGarage

![icon](assets/img/logo.png)

Benzin Garage is a website project for courses implementing a whole web interface
for stock management and interventions for employees and workshop managers.

# Objectives

This web application allows a garage to manage its stocks and the interventions of its customers.
Our objective is to modernise this garage and enable it to better manage its stocks and customers.
This change will allow the garage to increase its reputation and also give a better image of itself.

# Requirements

* Php 7.*
* Composer
* A database

# Clone the project

    git clone https://github.com/achedon12/BenzinGarage.git

----

# Launching

Before starting the project, check that you have the file DataBaseManager.php
in the assets/php/database folder. If you do not have it, please create a file
and put the following information

```php
<?php

class DatabaseManager{

    private static PDO|null $pdo;

    public static function getInstance(): ?PDO{
        if(self::$pdo === null){
            self::$pdo = new PDO("mysql:host=gigondas;dbname=yourDatabaseName;charset=utf8","yourUserName","yourPassword");
        }
        return self::$pdo;
    }
}
```


Do not hesitate to give your opinion on the project and on what can be improved so that it can be refined as much as possible