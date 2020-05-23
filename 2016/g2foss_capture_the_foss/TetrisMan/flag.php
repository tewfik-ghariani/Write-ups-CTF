<?php

function parite($v)
{
	      	$tab=str_split($v);
	
        /*pair : 1,4,6,8,9,10,11,12,13 */
		$pair=array(1,4,6,8,9,10,11,12,13);

		  $j=0;
		  $index=0;
		  $longueurP=count($pair);
		  while($j< $longueurP)
		  {
		$index=$pair[$j] ;
		 if 	(   (hexdec($tab[$index]) % 2) == 0    ){$j++;}
		 else { return false;}
		 
		  }
		 
		 /*impair : 0,2,3,5,7,14 */  
		$impair=array(0,2,3,5,7,14);
			
		 $j=0;
		 $longueurI=count($impair);
		$index=0;
		  while($j< $longueurI)
		  {
		$index=$impair[$j] ;
		 if 	((hexdec($tab[$index]) %2) == 0){return false;}
		 else { $j++;}
		  }
		 return true;
	
}


  
		  
		  
$dico="xaa.txt";
ini_set('memory_limit', '-1');
$f=file_get_contents($dico);
$read=explode("\n",$f);

$i=0;
$b=false;
$longueur=count($read);
while($b==false && $i<$longueur)
{
	$mdp=$read[$i];
$test=md5($mdp);
if (substr_count($test,2)==0 && substr_count($test,0)==2&& substr_count($test,1)==2 && substr_count($test,3)==1 && substr_count($test,4)>0)   

	
	{ 

       if (parite($test))
      {echo "\n The Word = \n ".$mdp."\n and its hash is \n".$test."\n ||";
  $b=true;}
	
	}
	
$i++;
	
}
if ($b==false){ echo "Not HERE ";}



?>
