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

<pre style="text-align:right;"><a href="form-partC.php">Go Back</a></pre>
<body>
			

	<table border='1' width:'80%' align='center'>
		<tr>
		<th>Wine Name</th>
		<th>Wine Variety</th>
		<th>Year</th>
		<th>Winery Name</th>
		<th>Region Name</th>
		<th>Bottles in Stock</th>
		<th>Cost (RM)</th>
		<th>Amount of customer purchased</th>
		</tr>
		<!-- BEGIN Search_Results -->
		<tr>
		<td>{WINE_N}</td>
		<td>{WINE_V}</td>
		<td>{YR}</td>
		<td>{WINERY_N}</td>
		<td>{REGION_N}</td>
		<td>{STOCK}</td>
		<td>{COST}</td>
		<td>{NO_OF_CUST}</td>	
			
		</tr>
		<!-- END Search_Results -->
		
	</table>
 	
</body>
</html>

