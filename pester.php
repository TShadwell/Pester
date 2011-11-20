<?PHP
function nflames($entryn)
{
	$d = explode("\n",file_get_contents("/srv/http/pester/flam.es"));
	$n =0;
	for ($i = 0; $i < count($d) -1; $i++)
	{
		$x = explode(":",$d[$i]);
		if ((string)$x[0] == (string)$entryn)
		{
			$n++;
		}
	
	}
	return $n;
}
function splitdata($s)
{
	if (strpos($s, " ") === False)
	//If tag only:
	{
		$tag = $s;
		$longname = "";//str_replace("-"," ", $s);
	}
	else
	{
		if (strpos($s, "-") === False){
		//If longname only
			$a = explode(" ", $s);
			$tag = $a[count($a)-1]; //str_replace(" ","-", $s);
			array_pop($a);
			$longname = implode(" ", ($a));
		}
		else
		{
		//chimera
			$a = explode(" ", $s);
			$tag = $a[count($a)-1];
			array_pop($a);
			$longname = implode(" ", ($a));
		}
	}
	return array('tag' => $tag, 'longname' => $longname);
}
$d = file_get_contents("/opt/task/pending.data");
preg_match_all("/description:\"(.*?)\"/", $d, $descs);
preg_match_all("/entry:\"(.*?)\"/", $d, $entries);
?>
<!DOCTYPE HTML>
<html>
	<head>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<title>Ongoing Tasks</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
	<script src="main.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="main">
		<h1>Todo list</h1>
			<ul>
		<?PHP
		for ($i = 0; $i < count($descs[1]); $i++){
		$split = splitdata($descs[1][$i]);
		?>
			<li class="topic" ><span class="linky" onclick="<?PHP if (nflames($entries[1][$i]) > 0){ print("Ignite('" . $entries[1][$i] . "');");} ?>"><?PHP print($split['longname'])?> <span class="y"><?PHP print($split['tag']);?></span></span><span class="linky" id="nflames" onclick="$('#<?PHP print($entries[1][$i]) ?>d').toggle('fast');"><?PHP print(nflames($entries[1][$i])) ?> flames</span></li>

			<div id="flames">
			<ul class="flames"  style="display:none;" id="<?PHP print($entries[1][$i]) ?>">
			</ul>
			</div>
			<div id="<?PHP print($entries[1][$i]) ?>d" style="display:none;">
				<input type="text" name="firstname" id="<?PHP print($entries[1][$i]) ?>t" />
				<button onclick="MoreFlames('<?PHP print($entries[1][$i]) ?>')" type="button">FIRE!</button>
			</div>
		<?PHP }?>
		</ul>
		<div id="note"><span class="g">Note</span> <span class="y">tag</span></div>
		</div>
	</body>
</html>