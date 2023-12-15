<?php
	function hello($p1, $p2, $p3, $p4){
		
		if(!isset($p3)){
			$p3 = '$p3 = valeur par defaut';
		}
		
		if(!isset($p4)){
			$p4 = '$p4 = valeur par defaut';
		}
		
		echo $p1.'<br />';
		echo $p2.'<br />';
		echo $p3.'<br />';
		echo $p4.'<br />';
	}
	
	hello('value1','value2');
?>