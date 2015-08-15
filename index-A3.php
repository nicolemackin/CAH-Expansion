<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "db_open.php" ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unity</title>

<link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
	<div id="wrapper">
		<div id="header">
            <div id="search">
            <form method="GET">
                <input name="stringsearch" type="text" placeholder="Search recipes" value="" />
                <select name="typesearch">
                    <option value="">All</option>
                    <option value="1">Cookbook</option>
                    <option value="2">Magazine</option>
                    <option value="3">Website</option>
                </select>
                    <select name="lnsearch">
                    <option value="">All Languages</option>
                    <option value="en">English</option>
                    <option value="fr">French</option>
                </select>
                <button type="submit">Submit</button>
            </form>
       		</div>
		</div>

<div id="content">
<div id="recipes">
<?php
if (isset($_GET['id'])) {
		
	$type = mysql_query('
	SELECT REC.title, TYPE.Name, REC.id, REC.description
	FROM REC 
	INNER JOIN TYPE ON REC.source_type = TYPE.ID 
	WHERE REC.id =' .$_GET['id']. '
	ORDER BY TYPE.Name
	');
	
		if($type===false)
			echo mysql_error();
		else
		{
			while($row = mysql_fetch_assoc($type))
			{
				echo '<div id="t">'.$row['title'].'</div> 
				</br>
				<div id="s">From: '. $row['Name'].'</div> 
				</br>
				<div id="d"> '. $row['description'].'</div> 
				</br>';
			}
		}
		
	$sql = 'SELECT name
	FROM ING
	JOIN INGREC ON INGREC.ingredient_id = ING.id
	JOIN REC ON INGREC.recipe_id = REC.id
	WHERE REC.id ='.$_GET['id'];
	
	
	$ingr = mysql_query($sql);
	
	
	
		if($ingr===false)
			echo mysql_error();
		else
		{
			echo '<div id="i"><h3>Ingredients:</h3>';
			echo '</br>';
			while($row = mysql_fetch_assoc($ingr))
			{
				echo $row['name'];
				echo '</br>';
			}
			echo '</div></br>';
		}
} else {
	$q = isset($_GET['stringsearch']) ? $_GET['stringsearch'] : '';
	
	$sql = "
	SELECT REC.title, REC.id
	FROM REC
	WHERE lower(REC.title) like lower('%$q%')
	";
	
	if(isset($_GET['lnsearch']) && $_GET['lnsearch'])
	{
		$sql .= ' AND REC.language = \''. $_GET['lnsearch'].'\' ';
	}
	
	if(isset($_GET['typesearch']) && $_GET['typesearch'])
	{
		$sql .= ' AND REC.source_type = '. $_GET['typesearch'].' ';
	}
	
	$sql .= ' LIMIT 30';
	
	$results = mysql_query($sql);
	if($results===false)
			echo mysql_error();
	else
	{
			while($row = mysql_fetch_assoc($results))
			{
				echo '<a href="?id=' . $row['id'] . '">' . $row['title'] . '</a><br/>';
			}
	}

	
}
?>
							</div>
		<!--content div=--></div>
		<div id="footer"<footer> Creative Cooking (c) Nicole Mackin 2014</footer></div>
	</div>

</body>

<?php include_once "db_close.php" ?>
</html>