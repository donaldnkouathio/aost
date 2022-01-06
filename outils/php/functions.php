<?php

$tab_month=array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aougt","Septembre","Octobre","Novembre","Décembre");

function get_french_month($month){
	global $tab_month;
	return $tab_month[$month-1];
}

function get_french_date($date){
	global $tab_month;
	$date_convert_in_seconde = strtotime($date);
	$month=date('m',$date_convert_in_seconde);
	$month=get_french_month($month);
	return (date('d', $date_convert_in_seconde)."  ".$month." ".date('Y', $date_convert_in_seconde));
}


function get_elapsed_time($datetime){
	global $tab_month;
	$date_convert_in_seconde = strtotime($datetime);
	if(date('Ymd', $date_convert_in_seconde) == date('Ymd')){
		$diff = time()-$date_convert_in_seconde;
		if($diff < 60){
			return "Il y a ".$diff." secondes";
		}else if($diff < 3600){
			return "Il y a ".floor($diff/60)." min";
		}else if($diff < 86400){
			return "Il y a ".floor($diff/3600)."h";
		}

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 1 DAY'))){
		return "Hier";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 2 DAY'))){
		return "Il y a 2 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 3 DAY'))){
		return "Il y a 3 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 4 DAY'))){
		return "Il y a 4 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 5 DAY'))){
		return "Il y a 5 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('- 6 DAY'))){
		return "Il y a 6 jours";

	}else if(date('YW', $date_convert_in_seconde) == date('YW', strtotime('- 1 WEEK'))){
		return "Il y a 1 semaine";

	}else if(date('YW', $date_convert_in_seconde) == date('YW', strtotime('- 2 WEEK'))){
		return "Il y a 2 semaines";

	}else if(date('YW', $date_convert_in_seconde) == date('YW', strtotime('- 3 WEEK'))){
		return "Il y a 3 semaines";

	}else if(date('YW', $date_convert_in_seconde) == date('YW', strtotime('- 4 WEEK'))){
		return "Il y a 4 semaines";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 1 MONTH'))){
		return "Il y a 1 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 2 MONTH'))){
		return "Il y a 2 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 3 MONTH'))){
		return "Il y a 3 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 4 MONTH'))){
		return "Il y a 4 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 5 MONTH'))){
		return "Il y a 5 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 6 MONTH'))){
		return "Il y a 6 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 7 MONTH'))){
		return "Il y a 7 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 8 MONTH'))){
		return "Il y a 8 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 9 MONTH'))){
		return "Il y a 9 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 10 MONTH'))){
		return "Il y a 10 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('- 11 MONTH'))){
		return "Il y a 11 mois";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 1 YEAR'))){
		return "Il y a 1 an";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 2 YEAR'))){
		return "Il y a 2 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 3 YEAR'))){
		return "Il y a 3 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 4 YEAR'))){
		return "Il y a 4 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 5 YEAR'))){
		return "Il y a 5 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 6 YEAR'))){
		return "Il y a 6 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 7 YEAR'))){
		return "Il y a 7 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 8 YEAR'))){
		return "Il y a 8 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 9 YEAR'))){
		return "Il y a 9 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 10 YEAR'))){
		return "Il y a 10 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 11 YEAR'))){
		return "Il y a 11 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 12 YEAR'))){
		return "Il y a 12 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 13 YEAR'))){
		return "Il y a 13 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 14 YEAR'))){
		return "Il y a 14 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 15 YEAR'))){
		return "Il y a 15 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 16 YEAR'))){
		return "Il y a 16 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 17 YEAR'))){
		return "Il y a 17 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 18 YEAR'))){
		return "Il y a 18 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 19 YEAR'))){
		return "Il y a 19 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('- 20 YEAR'))){
		return "Il y a 20 ans";

	}else if(date('Y', $date_convert_in_seconde) < date('Y', strtotime('- 20 YEAR'))){
		return "Il y a plus de 20 ans";

	}else{
		$mois=date('m',$date_convert_in_seconde);
		$mois=$tab_month[$mois-1];
		return 'depuis le '.date('d', $date_convert_in_seconde)." ".$mois;
	}

}






function get_expired_time($datetime){
	global $tab_month;
	$date_convert_in_seconde = strtotime($datetime);
	if(date('Ymd', $date_convert_in_seconde) == date('Ymd')){
		$diff = $date_convert_in_seconde-time();
		if($diff < 60){
			return "Dans ".$diff." secondes";
		}else if($diff < 3600){
			return "Dans ".floor($diff/60)." min";
		}else if($diff < 86400){
			return "Dans ".floor($diff/3600)."h";
		}

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('+ 1 DAY'))){
		return "Demain";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('+ 2 DAY'))){
		return "Dans 2 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('+ 3 DAY'))){
		return "Dans 3 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('+ 4 DAY'))){
		return "Dans 4 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('+ 5 DAY'))){
		return "Dans 5 jours";

	}else if(date('Ymd', $date_convert_in_seconde) == date('Ymd', strtotime('+ 6 DAY'))){
		return "Dans 6 jours";

	}else if(date('YW', $date_convert_in_seconde) == date('YW', strtotime('+ 1 WEEK'))){
		return "Dans 1 semaine";

	}else if(date('YW', $date_convert_in_seconde) == date('YW', strtotime('+ 2 WEEK'))){
		return "Dans 2 semaines";

	}else if(date('YW', $date_convert_in_seconde) == date('YW', strtotime('+ 3 WEEK'))){
		return "Dans 3 semaines";

	}else if(date('YW', $date_convert_in_seconde) == date('YW', strtotime('+ 4 WEEK'))){
		return "Dans 4 semaines";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 1 MONTH'))){
		return "Dans 1 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 2 MONTH'))){
		return "Dans 2 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 3 MONTH'))){
		return "Dans 3 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 4 MONTH'))){
		return "Dans 4 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 5 MONTH'))){
		return "Dans 5 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 6 MONTH'))){
		return "Dans 6 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 7 MONTH'))){
		return "Dans 7 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 8 MONTH'))){
		return "Dans 8 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 9 MONTH'))){
		return "Dans 9 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 10 MONTH'))){
		return "Dans 10 mois";

	}else if(date('Ym', $date_convert_in_seconde) == date('Ym', strtotime('+ 11 MONTH'))){
		return "Dans 11 mois";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 1 YEAR'))){
		return "Dans 1 an";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 2 YEAR'))){
		return "Dans 2 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 3 YEAR'))){
		return "Dans 3 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 4 YEAR'))){
		return "Dans 4 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 5 YEAR'))){
		return "Dans 5 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 6 YEAR'))){
		return "Dans 6 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 7 YEAR'))){
		return "Dans 7 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 8 YEAR'))){
		return "Dans 8 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 9 YEAR'))){
		return "Dans 9 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 10 YEAR'))){
		return "Dans 10 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 11 YEAR'))){
		return "Dans 11 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 12 YEAR'))){
		return "Dans 12 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 13 YEAR'))){
		return "Dans 13 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 14 YEAR'))){
		return "Dans 14 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 15 YEAR'))){
		return "Dans 15 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 16 YEAR'))){
		return "Dans 16 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 17 YEAR'))){
		return "Dans 17 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 18 YEAR'))){
		return "Dans 18 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 19 YEAR'))){
		return "Dans 19 ans";

	}else if(date('Y', $date_convert_in_seconde) == date('Y', strtotime('+ 20 YEAR'))){
		return "Dans 20 ans";

	}else if(date('Y', $date_convert_in_seconde) > date('Y', strtotime('+ 20 YEAR'))){
		return "Dans plus de 20 ans";

	}else{
		$mois=date('m',$date_convert_in_seconde);
		$mois=$tab_month[$mois-1];
		return 'le '.date('d', $date_convert_in_seconde)." ".$mois;
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
