<?php

$tab_month=array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aougt","Septembre","Octobre","Novembre","Décembre");

function get_french_month($month){
	return $tab_month[$month-1];
}

function get_french_date($date){

	$date_convert_in_seconde = strtotime($date);
	$month=date('m',$date_convert_in_seconde);
	$month=get_french_month($month);
	return (date('d', $date_convert_in_seconde)." ".$month." ".date('Y', $date_convert_in_seconde));
}


function get_elapsed_time($datetime){
	global $tab_month;
	$date_convert_in_seconde = strtotime($datetime);
	if(date('Ymd', $date_convert_in_seconde) == date('Ymd')){
		$diff = time()-$date_convert_in_seconde;
		if($diff < 60){
			echo "Il y a ".$diff." secondes";
		}else if($diff < 3600){
			echo "Il y a ".floor($diff/60)." min";
		}else if($diff < 86400){
			echo "Il y a ".floor($diff/3600)."h";
		}

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 1 DAY'))){
		echo "Hier";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 2 DAY'))){
		echo "Il y a 2 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 3 DAY'))){
		echo "Il y a 3 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 4 DAY'))){
		echo "Il y a 4 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 5 DAY'))){
		echo "Il y a 5 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 6 DAY'))){
		echo "Il y a 6 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 1 WEEK'))){
		echo "Il y a 1 semaine";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 2 WEEK'))){
		echo "Il y a 2 semaines";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 3 WEEK'))){
		echo "Il y a 3 semaines";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 4 WEEK'))){
		echo "Il y a 4 semaines";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 1 MONTH'))){
		echo "Il y a 1 mois";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 1 YEAR'))){
		echo "Il y a 1 an";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 2 YEAR'))){
		echo "Il y a 2 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 3 YEAR'))){
		echo "Il y a 3 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 4 YEAR'))){
		echo "Il y a 4 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 5 YEAR'))){
		echo "Il y a 5 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 6 YEAR'))){
		echo "Il y a 6 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 7 YEAR'))){
		echo "Il y a 7 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 8 YEAR'))){
		echo "Il y a 8 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 9 YEAR'))){
		echo "Il y a 9 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 10 YEAR'))){
		echo "Il y a 10 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 11 YEAR'))){
		echo "Il y a 11 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 12 YEAR'))){
		echo "Il y a 12 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 13 YEAR'))){
		echo "Il y a 13 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 14 YEAR'))){
		echo "Il y a 14 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 15 YEAR'))){
		echo "Il y a 15 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 16 YEAR'))){
		echo "Il y a 16 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 17 YEAR'))){
		echo "Il y a 17 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 18 YEAR'))){
		echo "Il y a 18 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 19 YEAR'))){
		echo "Il y a 19 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 20 YEAR'))){
		echo "Il y a 20 ans";

	}else if(date('Y', $date_convert_in_seconde) < date('Y', strtotime('- 20 YEAR'))){
		echo "Il y a plus de 20 ans";

	}else{
		$mois=date('m',$date_convert_in_seconde);
		$mois=$tab_month[$mois-1];
		echo 'depuis le '.date('d', $date_convert_in_seconde)." ".$mois;
	}

}




function compressImage($source, $destination, $quality) {
    // Get image info
	$imgInfo = getimagesize($source);
	$mime = $imgInfo['mime'];

    // Create a new image from file
	switch($mime){
		case 'image/jpeg':
		$image = imagecreatefromjpeg($source);
		break;
		case 'image/jpg':
		$image = imagecreatefromjpg($source);
		break;
		case 'image/png':
		$image = imagecreatefrompng($source);
		break;
		case 'image/gif':
		$image = imagecreatefromgif($source);
		break;
		default:
		$image = imagecreatefromjpeg($source);
	}

    // Save image
	imagejpeg($image, $destination, $quality);

    // Return compressed image
	return $destination;
}











?>
