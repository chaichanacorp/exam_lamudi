# REST API PHP React

Web based app for to-do list created using PHP as backend and React JS as front-end.

Able to add to-do item, remove and check your to-do item if you're done with it.

## Getting Started

Please follow these instructions on your local machine to run.

### Prerequisites

Things you need to install the software and how to install them

```
XAMPP Control Panel
Node
React
Bootstrap
Immubility Helper
```

### Installing

Step 1:

Download and install xampp.

[XAMPP](https://www.apachefriends.org/download.html) - For server side

Step 2:

Download and install node js.

[Nodejs](https://nodejs.org/en/)

Step 3:

Install React JS globally by running this to your command prompt.

```
npm install -g create-react-app
```

Step 4:
Download or Git Clone this repository on your htdocs folder only w/c is located on Local Disk C or D (depends on your xampp installation path)

Ex:

```
c:\xampp\htdocs
```

Step 5:

Install and run an npm install to get our modules.

NOTE: You need to go to todo_app inside the exam_lamudi folder

on cmd terminal:

```
cd exam_lamudi\todo_app
```

then run this npm again on your cmd terminal

```
npm install
```

Step 6:

Installing other modules needed (i.e. Bootstrap, Immubility helper)

```
npm install immutability-helper --save
npm install --save reactstrap@next react react-dom
npm install bootstrap --save
```

Step 7:

Go to your local phpmyadmin on your browser to create our database and tables.

Example:

```
http://localhost/phpyadmin
```

Create a database named exam_lamudi (or you can choose any name)

SQL Query to run

```
--
-- Table structure for table `to_do_app`
--

CREATE TABLE `to_do_app` (
  `id` int(11) NOT NULL,
  `todo_item` text NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `to_do_app`
--

INSERT INTO `to_do_app` (`id`, `todo_item`, `is_done`, `date_added`) VALUES
(120, 'add na nga e ', 0, '2018-01-27 04:41:41'),
(121, 'asdadaa ada dasd adad adawea aweqwq4qasd a4qwasd ', 0, '2018-01-27 04:41:46');

--
-- Indexes for dumped tables
--
--
-- Indexes for table `to_do_app`
--
ALTER TABLE `to_do_app`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `to_do_app`
--
ALTER TABLE `to_do_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```

Step 8: 

NOTE: If you chose another database name, you need to update database name on this folder c:/xampp/htdocs/{ your path }/exam_lamudi/config/db.php

We need to change database connection credentials on located on c:/xampp/htdocs/{ your path }/exam_lamudi/config/db.phpmyadmin

```
    private $host = "your_host";
    private $db_name = "database_name";
    private $username = "database_username";
    private $password = "database_password";
```

Step 9:

Change your localhost in our App.js located in c:/xampp/htdocs/{ your path }/exam_lamudi/to_do_app/src/App.js

```
// global declaration of localhost for php
let localHost = 'http://localhost/ { your folder path }/exam_lamudi';
```

Step 10:

Once all done we can now run the application. Make sure on you cmd terminal we are located on todo_app folder.

```
npm start
```

## Running the tests

Able to add to-do list by putting the data on textarea.
Able to upda the to-do item by ticking the checkbox once we're done with the tasks.
Able to remove the to-do item.

## By:

Jerson Q. Conmigo

