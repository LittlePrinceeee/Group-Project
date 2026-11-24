<!DOCTYPE html>
<html>
    <head>
        <title>Products test page</title>
		<meta charset="UTF-8">
    </head>
    <body>

    <?php
        define('DBHOST', 'localhost');
	    define('DBName', 'databasename');
	    define(‘DBUSER’, ‘root’);
	    define(‘DBPASS’, ‘my password’);
	    $host = "localhost";
	


	    try{
		    $connectionPutTogether = ‘mysql:host=“‘ DBHOST .’dbname=‘ . DBNAME;
		    $pdo = new PDO($connectionPutTogether, DBUSER, DBPASS);
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $sql1 = “CREATE TABLE IF NOT EXISTS product(
			    productid VARCHAR(30) PRIMARY KEY,
			    name TEXT NOT NULL,
			    price FLOAT,
			    quantity INT,
			    image VARCHAR(50))“;

		    $sql2 = “CREATE TABLE IF NOT EXISTS discount(
			    productid VARCHAR(30),
			    percentage INT,
			    PRIMARY KEY (productid, percentage)
		    )”;


	    $pdo->execute($sql1, $sql2);
	    echo “Success: Both tables created successfully”;
    }catch (PDOException $e){
        echo “Error: cannot create tables, or cannot connect to DB”;
        die($e->getMessage());
    }
    ?>




    </body>
</html>