<html>
<head><title> Search Wine Results </title></head>
<link href="https://fonts.googleapis.com/css?family=Nosifer" rel="stylesheet">
<style>
header{
 font-family: 'Nosifer', cursive;
 font-size:210%;
 color:black;
 padding:10px 350px;
 text-align:center;
}

center{
 color :red;
 font-size:120%;
}

table, th, td {
 border: 1px solid black;
 border-collapse: collapse;
 text-align:center;
 
}

table{
	width :80%;
	
}

</style>
<header> Wine Store 0325773 </header> 
<h3>Search Wine Results :</h3>

<pre style="text-align:right;"><a href="ass1partb.php">Go Back</a></pre>


<body>
<?php 
 //Connecting to server and database
 $con = mysql_connect("localhost","0325773","rapmonsta95")or die('Could not connect :'. mysql_error());
 mysql_select_db("winestore0325773",$con)or die('Cannot select DB');
 
 //Assign input from user to variable       
 $WineName = $_GET['wname'];
 $region = $_GET['region'];
 $WineryName = $_GET['WineryName'];
 $year1 = $_GET['yr1'];
 $year2 = $_GET['yr2'];
 $WineStock = $_GET['stock'];
 $OrderQty = $_GET['qty'];
 $minCost = $_GET['min'];
 $maxCost = $_GET['max'];
		
 //Check the validation of input
 if($WineName == NULL){
	$WineName = "";
 }
 
 if($region == "All"){
	$region = "";
 }

 if($WineryName == NULL){
	$WineryName = "";
 }
 if($year1 == NULL){
	$year1 = 1950;
 }
 if($year2 == NULL){
	$year2 = 2000;
}
 if($WineStock == NULL){
	$WineStock = 0;
}
 if($OrderQty == NULL){
	$OrderQty = 0;
}
 if($minCost == NULL){
	$minCost =0;
}
 if($maxCost == NULL){
	$maxCost = 999;
}
		
 if($year1 > $year2){
	echo "<center>".'Invalid input!!! Starting Year has to be smaller than Ending Year!'."</center>";
 }
 else if($minCost > $maxCost){
	echo "<center>".'Invalid input!!! Minimum Cost has to be smaller than Maximum Cost!'."</center>";
 }
//proceed to run query
 else{
 
 	$query = "SELECT wine_name,variety,year,winery_name,region_name,on_hand,cost,(SELECT COUNT(items.cust_id) FROM items 
			  WHERE items.wine_id = wine.wine_id) AS cust_purchased 
			  FROM wine,winery,region,wine_variety,grape_variety,inventory
			  WHERE wine.winery_id=winery.winery_id
			  AND winery.region_id = region.region_id
			  AND wine.wine_id = inventory.wine_id
			  AND wine_variety.wine_id = wine.wine_id
			  AND wine_variety.variety_id = grape_variety.variety_id
			  
				
			  AND wine_name LIKE '%".$WineName."%'
			  AND region_name LIKE '%".$region."%'
			  AND winery_name LIKE '%".$WineryName."%' 
			  AND on_hand >= '".$WineStock."'
			  AND (year BETWEEN '".$year1."' AND '".$year2."')
		      AND (cost BETWEEN '".$minCost."' AND '".$maxCost."')				
			  HAVING cust_purchased >= '".$OrderQty."'"; 
			
	$result = mysql_query($query,$con);
			
		if(mysql_num_rows($result) == 0){
			echo "<center>".'No Results Found'."</center>";
		}
		else{
			echo "<table border='1' width:'80%' align='center'>";
			echo "<tr>
					<th>Wine Name</th>
					<th>Wine Variety</th>
					<th>Year</th>
					<th>Winery Name</th>
					<th>Region Name</th>
					<th>Bottles in Stock</th>
					<th>Cost (RM)</th>
					<th>Amount of customer purchased</th>
				</tr>";
		
			  while ($row = mysql_fetch_array($result)) {
				  //change to for loop for($i=0; $i<=7; i++)//CANTWORK!
					  
					echo "<tr><td>".$row[0]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td>".$row[2]."</td>";
					echo "<td>".$row[3]."</td>";
					echo "<td>".$row[4]."</td>";
					echo "<td>".$row[5]."</td>";
					echo "<td>".$row[6]."</td>";
					echo "<td>".$row['cust_purchased']."</td>";
					echo "\n";
		    } //end while loop
			echo "</td></tr>";
			echo "</table>";
		 }	
			
		mysql_close($con);	
} //end of else
?>

<pre style="text-align:center;"> <a href="#top" style="text-align:right;" >Go to top</a> <br> 2017@Catherine Labial John@0325773</pre>
</body>
</html>