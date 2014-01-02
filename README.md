evotingsystem
=============

Electronic Voting system
What is e-voting?
Electronic voting (also known as e-voting) is an electronic means of casting a vote and electronic means of counting votes. Electronic voting technology can include punched cards, optical scan voting systems and specialized voting kiosks (including self-contained direct-recording electronic voting systems, or DRE). It can also involve transmission of ballots and votes via telephones, private computer networks, or the Internet.
This e-voting system demonstrates the following features:
•	OOP concepts
•	preventing public access to your scripts
•	configuration for your application
•	accessing your database data
•	changing your database data (with redirect-after-post pattern)
•	validating your data
•	splitting scripts and templates
•	handling expected and unexpected exceptions
What is included in the DVD?
•	E-voting system PHP Application Project
•	Database SQL Script - Use this script to populate tables and sample records
•	Read me(how to deploy)
•	XAMMP Application Software

Requirements
 Follow these before you run the application: 
•	Install XAMMP (Apache, MySQL, PHP, and Perl) on your computer.
•	To test if XAMPP is installed, Open Windows Start Menu and Confirm if there is a directory named Apache Friends, Open the directory and start the XAMPP Control Panel i.e. Apache Friends/XAMPP/control panel.exe
•	Make sure all the services on the control panel are running.
•	Then place the E-voting system PHP Application Project Folder in the XAMPP htdocs directory which  is located on your drive “C:\xampp\htdocs”




Project folder's structure
•	config - Contains configuration file config.ini where you can edit the DB connection settings.
•	dao - Contains DAO (Data Access Object) classes.
•	db - Contains SQL dump for creating the database.
•	exception - Contains custom exceptions.
•	layout - Contains layout common for all web pages.
•	mapping - Contains classes used for mapping from database to model classes.
•	model - Contains model classes.
•	page - Contains pages of the Evotingsystem application.
•	util - Contains utility classes.
•	validation - Contains validation classes.
•	admin – this part of the site is meant to be accessed by the administrator who manages the system, the admin must login to use this section 
•	voter – this part of the site is meant to be accessed by voters, and a  voters  must login to use features like viewing result, updating profile e.t.c .
•	candidate – this part of the site is meant to be accessed by candidate, and  a candidate must login to use features like viewing result, updating profile e.t.c .
•	vote- this section of the site is where the election is done.


Getting Started
1.	Firstly, place the project into the htdocs directory of XAMPP i.e. C:\xampp\htdocs
2.	Secondly, we then set database authentication in config/config.ini, which is stored in EvotingSytem List Project directory. Just update login and password fields in the configuration file, so they are the same as MySQL ones. 
3.	 We create the database and populate it with data: 
a)	Create new MySQL database named evoting in phpMyAdmin (or any other MySQL administration tool).
b)	Import db/mysql.sql script stored in Evotingsystem List Project directory into the created database using phpMyAdmin import function. The script creates table and fills it with sample data.
4.	The strongly preferred way is to create all your PHP applications underneath the documents directory (htdocs) of your web server (so the web server can access them directly, e.g. http://localhost/evotingsystem/admin/). 
5.	To login to the Administrator Section use Matric Number: 10/52ha068  and password: admin
6.	And lastly enjoy playing with the application.
