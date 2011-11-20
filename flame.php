<?PHP
//Determine which function they need
switch ($_GET['a']){
	case "":
		echo("Hey, hey! No poking around in here!");
	break;
	case "a"://add
		//Open flames
		$Flames = fopen("/srv/http/pester/flam.es", "a");
		//Add entry (iD, Text)
		fwrite($Flames, htmlspecialchars($_GET['d'] . ":" . $_GET['t']) . "\n");
		fclose($Flames);
	break;
	case "r"://read
		$d = explode("\n",file_get_contents("/srv/http/pester/flam.es"));
		for ($i = 0; $i < count($d); $i++)
		{
			$x = explode(":",$d[$i]);
				if ((string)$x[0] == (string)$_GET['d']){
					print("<li>" . $x[1] . "</li>");
				}
		}
	break;
}
?>