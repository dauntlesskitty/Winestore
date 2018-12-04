<html> 
<head> <title>Search WineStore</title><meta charset="utf-8"></head> 
<link href="https://fonts.googleapis.com/css?family=Nosifer" rel="stylesheet">
<style>
header{
font-family: 'Nosifer', cursive;
font-size:210%;
color:black;
padding:10px 350px;
text-align:center;
}

table{
font-size:70%;
padding:50px 180px;

}

</style>
<body>
<?php
	include "DB.php";
	include "db.inc";
	require_once "HTML/Template/IT.php";
	
	//Connection to database
	$dsn = "mysql://{$dbuser}:{$dbpass}@{$dbhost}/{$dbname}";
	$connection = DB::connect($dsn);
		if(DB::isError($connection))
			die($connection->getMessage());
		
?>
<header> Wine Store 0325773 </header> 

    <table>
        <tr>
            <th>
                <h2>Wine Name</h2>
            </th>
            <th>
			
                <h2>Region</h2>
            </th>
            <th>
                <h2>Winery Name</h2>
            </th>
            <th>
                <h2>Range of Years</h2>
            </th>
            <th>
                <h2>Stock</h2>
            </th>
            <th>
                <h2>Customer Ordered</h2>
            </th>
		    <th>
                <h2>Cost Range</h2>
            </th>
            <td></td>
        </tr>
        
		<form method="GET" action="results-D.php"> 
        <tr>
            <td>
                <input type="text" name="WineName" style="width: 150px;" />
            </td>
            <td>
		<select name="region" style="width: 150px;">
        <?php
		
		 //Getting query for region from db using PEAR DB connection
		 $result = $connection->query("SELECT region_name FROM region");
		  if(DB::isError($result))
			  die($result->getMessage());
		
		  while($row=$result->fetchRow(DB_FETCHMODE_ASSOC)){
			  echo "<option>".$row['region_name']."</option>";
			}
		?>
		</select>
            </td>
            <td>
                <input type="text" name="WineryName" style="width: 150px;" />
            </td>
            <td>
			<!--Range of years -->
                <input type="number" name="year1" min="1950" max="2000" style="width:60px;"/>-
				<input type="number" name="year2" min="1950" max="2000" style="width:60px;"/>
            </td>
            <td>
                <input type="number" min="0" max="9999" name="WineStock" style="width:60px;" />
            </td>
            <td>
                <input type="number" min="0" max="9999" name="OrderQty" style="width: 135px;" />
            </td>
			 <td>
                $<input type="number" name="minCost" min="5" max="200"/>-
				$<input type="number" name="maxCost" min="5" max="200"/>
            </td>
			<td>
            <input type="submit" name="search" value="Search"/>
			<input type="reset"> <!--Check later -->
            </td>
		</tr>
		</form>
    </table>
<pre style="text-align:center;"> <a href="#top" style="text-align:right;" >Go to top</a> <br> 2017@Catherine Labial John@0325773</pre>
</body> 
</html> 