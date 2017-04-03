<?php
$base = dirname(__FILE__).'/';
$chmod = 0777;
$file = 'kieskring.json';
$db = json_decode(file_get_contents($file), TRUE);

header('Content-type: text/plain'); umask(0);

foreach($db as $i=>$kieskring){
	$map = $base.'kieskring-'.(strlen($kieskring['kieskring']) == 1 ? '0' : NULL).$kieskring['kieskring'];
	mkdir($map, $chmod); print 'mkdir '.$map."\n";
	file_put_contents($map.'/README.md', '# '.$kieskring['noemer'].' ('.$kieskring['hoofdstembureau'].')');
	foreach($kieskring['gemeente'] as $g=>$gemeente){
		mkdir($map.'/'.$gemeente, $chmod); print '+ mkdir '.$gemeente."\n";
		file_put_contents($map.'/'.$gemeente.'/README.md', "# ".$gemeente." \n> kieskring ".$kieskring['kieskring'].":  [".$kieskring['noemer'].'](../) (['.$kieskring['hoofdstembureau'].'](../'.$kieskring['hoofdstembureau'].'))');
	}
}
?>