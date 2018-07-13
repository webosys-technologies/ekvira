<?php
	  include("common/Navigation.php");

//CREATING DATABASE	  	  
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE admmgt";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

/*	  
//CREATING TABLES FROM SQL FILE IN DATABASE
$sql = file_get_contents( 'create_table.sql');

$query_array = explode(';', $sql);

// Run the SQL
$i = 0;
if( $conn->mysqli->multi_query( $sql ) )
{
    do {
        $conn->mysqli->next_result();

        $i++;
    }
    while( $conn->mysqli->more_results() );
}

if( $conn->mysqli->errno )
{
    die(
        '<h1>ERROR</h1>
        Query #' . ( $i + 1 ) . ' of <b>create_table.sql</b>:<br /><br />
        <pre>' . $query_array[ $i ] . '</pre><br /><br />
        <span style="color:red;">' . $conn->mysqli->error . '</span>'
    );
}
*/

$conn->close();

	  $a=new Navigation;
	  $id=$a->UniqueMachineID();
      $out=serialize($id);
	  $id=unserialize($out);
      file_put_contents('common/nav.obj', $out);
	  
	  //header("Location: index.php?flag=success");
	  //exit;
	  

?>
