<!DOCTYPE html>
<head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {listt-style: none;}
</style>
</head>
<body>
<h2>Enter information regarding book</h2>
<ul>
<form name="insert" action="insert.php" method="get" >
<li>Book ID:</li><li><input type="text" name="bookid" /></li>
<li>Book Name:</li><li><input type="text" name="book_name" /></li>
<li><input type="submit" /></li>
</form>
</ul>
</body>
</html>
<?php
$db = pg_connect("host=localhost port=5050 dbname=testapp user=postgres password=90november-=") or die("Nahi aaya".pg_last_error());
if(!$db){
             echo "Error : Unable to open database\n";
        } else {
             echo "Opened database successfully\n";
          }
//$query = "INSERT INTO public.book(bookid,BookName) VALUES ('$_GET[bookid]','$_GET[book_name]')";
//$result = pg_query($db,$query); 
//echo $result;
?>