Bonjour &agrave; tous,

Voici les meilleurs joueurs de la semaine pass&eacute;e :


<?php 
foreach ($top3 as $what => $how) {
	foreach ($top3[$what] as $key => $value) {	
		echo strtoupper($what)."\n";	
		$cpt = 0;
		foreach ($value as $k => $v) {		
			if($cpt < 3){			
			echo ($what == 'avg') ? number_format($k,3)." : " : $k." : ";
				foreach ($v as $a => $z) {							
					echo  $z->getNom()." ".$z->getPrenom()."  ";
				}				
				$cpt++;
				echo "\n";
			}
		}
		echo "\n\n";
	}	
}
?>







---------------------------------------------------------
Ce mail est envoy&eacute; automatiquement, si vous constatez un probl&egrave;me, pri&egrave;re de me le signaler. Merci.