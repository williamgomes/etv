# README #


###Essential TV###

### What is this repository for? ###

* This is a repository for developing a Social Networking application (Using Symfony2 and MySQL) for Essential TV

### How do I get set up? ###

* You need to have your PHP Path defined in your system variables (for windows)
* Open Command Prompt
* Redirect to this project directory
* Redirect inside main application folder (i.e. "etv")
* Now execute following command "php app/console server:run". This will run this application at port 8000
* Now open your browser and browse "http://localhost:8000" or "http://127.0.0.1:8000" and you will see welcome screen


### Database version controlling ###

* Please rename each database before putting them inside "database" folder and pushing into repository
* Rename it according to the format <DATABASE_NAME>-DD-MM-YYYY.sql (i.e. etv_db-20-04-2015.sql)
* If multiple version on the same day occure, please try below format for newer version <DATABASE_NAME>-DD-MM-YYYY-V<number>.sql (i.e. etv_db-20-04-2015-V2.sql)
* By maintaining this way, it would be easier for anyone to install latest database without any confusion


### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines