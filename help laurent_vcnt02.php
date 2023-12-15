<?php
	function hello($p1, $p2, $p3, $p4){
		
		if($p3 == '#default#'){
			$p3 = '$p3 = valeur par defaut';
		}
		
		if($p4 == '#default#'){
			$p4 = '$p4 = valeur par defaut';
		}
		
		echo $p1.'<br />';
		echo $p2.'<br />';
		echo $p3.'<br />';
		echo $p4.'<br />';
	}
	
	hello('value1','value2','#default#','#default#');
?>é