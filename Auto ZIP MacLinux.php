<?php
	
	date_default_timezone_set('Europe/Brussels');
	
	$folders = scandir('.');

	$zipCreated = 0;
	foreach($folders as $folderKey => $folder){
		
		if(strpos($folder, '.')) continue;
		if(strpos($folder, '.zip')) continue;
		if($folder == '.') continue;
		if($folder == '..') continue;
		if($folder == '.DS_Store') continue;
		if($folder == 'zip') continue;
		
		$folderTime = filemtime($folder);
		$zipTime = 0;
		
		if(file_exists('zip/'.$folder.'.zip')) $zipTime = filemtime('zip/'.$folder.'.zip');
		
		if($folderTime > $zipTime){
			exec('zip -r zip/'.$folder.'.zip '.$folder);
			$zipCreated++;
		}
		
	}
	
	$date = date('Y-m-d H:i:s');
	
	if($zipCreated == 1) echo $date." => Zip créé : ".$zipCreated."\n";
	
	if($zipCreated > 1) echo $date." => Zips créés : ".$zipCreated."\n";