
<?php

$pdo = null;

/*need to define DBHOST, DBNAME, DBUSER, DBPASS */

/* Connects to the DB */
function connect_database(){
    define('DBHOST', 'localhost');
	define('DBName', 'databasename'); /*change DB name to correct name */
	define('DBUSER', 'root');
	define('DBPASS', '');
	$host = "localhost";

    try{
        $connectionPutTogether = 'mysql:host=' . DBHOST.';dbname=' . DBNAME;
		$pdo = new PDO($connectionPutTogether, DBUSER, DBPASS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;

    }catch(PDOException $e){
        die($e->getMessage());
    }
}

/* creates empty tables, Product and Discount tables */
function createTables(){
    global $pdo;
    $sql1 = "CREATE TABLE IF NOT EXISTS product(
        productid VARCHAR(30) PRIMARY KEY,
        productname TEXT NOT NULL,
        price FLOAT,
        quantity INT,
        productimage VARCHAR(50),
        alt VARCHAR(50),
        source VARCHAR
    )";

    $sql2 = "CREATE TABLE IF NOT EXISTS discount(
        productid VARCHAR(30),
        dpercentage INT,
        PRIMARY KEY (productid, dpercentage)
    )";

    $pdo->exec($sql1);
    $pdo->exec($sql2);

}

/*
Creates a product entry within the DB
i: product ID 
n: product name
p: price
q: quantity
path: image path
a: alternate img text
s: image source*/
function createProduct($i, $n, $p, $q, $path, $a, $s){
    global $pdo;

    $sqlInsert = 'INSERT INTO product VALUES (:productId, :productName, :productPrice, :productQuantity, :productPath, :productAlt, :productSource)';

    $statement = $pdo->prepare($sqlInsert);

    $statement->bindValue(':productId', $i);
    $statement->bindValue(':productName', $n);
    $statement->bindValue(':productPrice', $p);
    $statement->bindValue(':productQuantity', $q);
    $statement->bindValue(':productPath', $path);
    $statement->bindValue(':productAlt', $a);
    $statement->bindValue(':productSource', $s);

    $statement->execute();


    /*productid
        productname
        price 
        quantity
        productimage 
        alt 
        source */

}

function renderInstockProductDisplays(){

    $inStockQuery = $pdo->query('SELECT Product.ProductID, Product.Name, Product.Price, Product.Quantity, Product.Image FROM Product WHERE Quantity > 0;');
    
    while($row = $inStockQuery->fetch()){
        /*echo display */
        echo ;
    }
}

function createNewItemDisplay(){

}
/* Checks if a product with the same id already exists in the Products Table, DB */
/* productID */
function checkItemAlreadyExists($productID){

}

/* Checks if the product already has a listed discount in the Discounts table, DB*/
/* productID */
function checkDiscountExistsForItem($productID){

}
/*pID is the product ID */
/*newQuantity is the new value for the quantity */
function updateQuantity($pID, $newQuantity){
    global $pdo;

    $sqlUpdate = 'UPDATE product SET quantity = :newq
    WHERE productid= :matchedID';

    $updateStatement = $pdo->prepare($sqlUpdate);

    $updateStatement->bindValue(':matchedID', $pID);
    $updateStatement->bindValue(':newq', $newQuantity);

    $updateStatement->execute();

}

/* Updates price of a product based on the productID */
/*pID: the product id */
/*userPrice: is the new price that will replace the old price */
function updatePrice($pID, $userPrice){
    global $pdo;

    $sqlUpdate = 'UPDATE product SET price = :newPrice
    WHERE productid= :matchedID';

    $updateStatement = $pdo->prepare($sqlUpdate);

    $updateStatement->bindValue(':matchedID', $pID);
    $updateStatement->bindValue(':newPrice', $userPrice);

    $updateStatement->execute();

}



function formValidation(){
    global $pdo;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

     /* check that form is filled with required info to create product*/
        if( isset($_POST["name"]) && isset($_POST["id"]) && isset($_POST["quantity"]) && isset($_POST["price"])){
            
            //check item entry does not already exist
            /*if(checkDiscountExistsForItem()){

            }*/

            // create item entry

            /*$entrySQL =*/

            //if a image is given
            if(isset($_POST["path"]) && isset($_POST["alt"]) && isset($_POST["source"])){
                // put image in item entry
            }else{ //do null for images, or do a default image

            }


            //check if discount field is filled in
            if(isset($_POST["percentage"])){

            }

        //check if ONLY discount info is filled in
        }else if(isset($_POST["discountId"]) && isset($_POST["percentage"])){
        //check if discountId already exists in database

        //otherwise invalid, give warning that no product matching the discountId exists within the DB
        }
    }
}

/*
$_POST["name"] //product name 

$_POST["quantity"]
input names: name, id, quantity, price, path, alt, source, discountId, percentage
*/

/*  */
connect_database();
createTables();

/* sell computer parts? */

/* create some initial products */
createProduct('1114', "CPU", "199.99",'20', "images/default.png", "default image of generic product", "none");
createProduct('1115', "Motherboard", "50",'50', "images/default.png", "default image of generic product", "none");
createProduct('1116', "Microphone", "26",'66.25', "images/default.png", "default image of generic product", "none");




?>