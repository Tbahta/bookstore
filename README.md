# Bookstore Web App

*This is an academic project for my CS6P05 course*

## How to successfuly run this project in your environment

**Step 1 -**

Copy the project directory "bookstore" to htdocs or www directory of the webserver that you are using. Because I have used apache webserver, if I mention web server going forward, I mean apache.

**Step 2 -**

Create a database named bookstore(you can name your database any name but you have to change it in config.php file if you use a different name. The config.php file resides in bookstore\app\core\config.php).

**Step 3 -**

The default mysql user(root) is used both as the username and paassword for the mysql server. This is not advised but because my development environment is local, there is secruity issues. If your MySQL server has a password and you want to use the default root user, please replace the password for the DB_PASS variable in the config.php file mentioned in Step 3. If you want test the web app as a different user other than the default roor user, please do change the DB_USER variable in the config.php file.

**Step 4 -**

To have the starter data populated so that you can easily test the web app features, I have included all the tables that have sample data in them in a file named databasetables.sql. The file is located in the public folder. Please import this file to either MySQL Work Bench or XAMPP's PhpMyAdmin. The process of importing the databasetables.sql file is the same in both admin consoles, but I will give steps on how to import the sql file to MySQL Work Bench.

- Open MySQL Work bench and sign in
- Open the "bookstore" schema/database that you created
- From the top menu, click the "Server" menu item
- Click the "Data Import" from the menu that opens
- Select the radio button that says import from self-contained file and select the sql file (databasetables.sql) from the public folder of the project.

**Step 5 -**

To test the paypal payment integration, you need to create paypal sandbox accounts for Merchant/seller and buyer. Get the client id from the sandbox and open checkout.php under app\views\store\checkout.php and replace the client_id in line 110.
 
For clarity, just replace the part that I have added XXXXXX
"https://www.paypal.com/sdk/js?client-id=XXXXXXXXXX&disable-funding=credit,card"



That is all. There is default admin user with username as admin and password as Test123.

You can now access the backend of the website and check the features including adding, updating, and deleting authors, categories, publishers, and books. 