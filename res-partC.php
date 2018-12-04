<?php
	require_once "HTML/Template/IT.php";
	
	//Connection To DB
	$connection = mysql_connect("localhost","0325773","rapmonsta95")or die('Could not connect :'. mysql_error());
	mysql_select_db("winestore0325773",$connection)or die('Cannot select DB');
	
	//Define Templates and Files to Load
	$tmp1 = new HTML_Template_IT(".");
	$tmp1->loadTemplatefile("ResultTmp.tpl",true,true);	
	
	$tmp2 = new HTML_Template_IT(".");
	$tmp2->loadTemplatefile("NoResultTmp.tpl",false,false);
	
	$tmp3 = new HTML_Template_IT(".");
	$tmp3->loadTemplatefile("YearValidationTmp.tpl",false,false);
	
	$tmp4 = new HTML_Template_IT(".");
	$tmp4->loadTemplatefile("CostValidationTmp.tpl",false,false);
	
	//Get Input from User
	$WineName = $_GET['WineName'];
	$region = $_GET['region'];
	$WineryName = $_GET['WineryName'];
	$minYear = $_GET['year1'];
	$maxYear = $_GET['year2'];
	$WineStock = $_GET['WineStock'];
	$qty = $_GET['OrderQty'];
	$minCost = $_GET['minCost'];
	$maxCost = $_GET['maxCost'];
	
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
	
	if($minYear == NULL){
		$minYear = 1900;
	}
	
	if($maxYear == NULL){
		$maxYear = 2000;
	}
	
	if($WineStock == NULL){
		$WineStock = 0;
	}
	
	if($qty == NULL){
		$qty = 0;
	}
	
	if($minCost == NULL){
		$minCost = 0;
	}
	
	if($maxCost == NULL){
		$maxCost = 999;
	}

	$query = "SELECT wine_name,variety,year,winery_name,region_name,on_hand,cost,
			 (SELECT COUNT(items.cust_id) FROM items 
			 WHERE items.wine_id = wine.wine_id) AS No_Cust
			 FROM wine,winery,region,wine_variety,grape_variety,inventory
			 WHERE wine.winery_id=winery.winery_id
			 AND wine.wine_id = inventory.wine_id
			 AND winery.region_id = region.region_id
			 AND wine_variety.wine_id = wine.wine_id
			 AND wine_variety.variety_id = grape_variety.variety_id
		
			 AND wine_name LIKE '%".$WineName."%'
			 AND region_name LIKE '%".$region."%'
			 AND winery_name LIKE '%".$WineryName."%' 
			 AND on_hand >= '".$WineStock."'
			 AND (year BETWEEN '".$minYear."' AND '".$maxYear."')
			 AND (cost BETWEEN '".$minCost."' AND '".$maxCost."')";
		
	$result = mysql_query($query,$connection);	
		
	if($minYear > $maxYear){
		$tmp3->setCurrentBlock("Year_Valid");
		$tmp3->show();
	}
	else if($minCost > $maxCost){
		$tmp4->setCurrentBlock("Cost_Valid");
		$tmp4->show();
	}
	else if(mysql_num_rows($result) == 0){
		$tmp2->setCurrentBlock("No_Results");
		$tmp2->parseCurrentBlock();
		$tmp2->show();
	}
	else{
		while($row = mysql_fetch_array($result)){
			//Setting the Start of Result in Template
			$tmp1->setCurrentBlock("Search_Results");
			//Setting the Row Variables into an Attribute
			$tmp1->setVariable("WINE_N", $row["wine_name"]);
			$tmp1->setVariable("WINE_V", $row["variety"]);
			$tmp1->setVariable("YR", $row["year"]);
			$tmp1->setVariable("WINERY_N", $row["winery_name"]);
			$tmp1->setVariable("REGION_N", $row["region_name"]);
			$tmp1->setVariable("STOCK", $row["on_hand"]);
			$tmp1->setVariable("COST", $row["cost"]);
			$tmp1->setVariable("NO_OF_CUST", $row["No_Cust"]);
			
			$tmp1->parseCurrentBlock();
		}
		
		$tmp1->show();
		mysql_close($connection);
	}
?>
