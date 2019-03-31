<?php 
print "\n\n \033[93m
 ------------------------------------------------
 IIIIIIIIIIIIIII                  IIIIIIIIIIIIIII
 IIIIIIIIIIIIIII                  IIIIIIIIIIIIIII
 IIIII                                      IIIII
 IIIII                                      IIIII
 IIIII ----------- ADMIN FINDER ----------- IIIII
 IIIII                                      IIIII
 IIIII          CODED BY MR.KH4L3D          IIIII
 IIIII                                      IIIII
 IIIII                                      IIIII
 IIIII          THANKS TO MR.TENWAP         IIIII
 IIIII                                      IIIII
 IIIII                                      IIIII
 IIIIIIIIIIIIIII                  IIIIIIIIIIIIIII
 IIIIIIIIIIIIIII                  IIIIIIIIIIIIIII
 ------------------------------------------------
\n\n\n";
echo "\033[92m Masukan Target ===> ";
$input = trim(fgets(STDIN));
$wordlist = "admin_wordlist.txt";
if (!preg_match("/^http:\/\//", $input) AND !preg_match("/^https:\/\//", $input)) {
	$result_input = "http://$input";
}else{$result_input= $input;
}

$open=fopen("admin_wordlist.txt", "r");
$size=filesize("admin_wordlist.txt");
$read=fread($open, $size);
$list=explode("\r\n", $read);
foreach($list as $login){
	$log = "$result_input/$login";
	$opening = curl_init("$log");
	curl_setopt($opening, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($opening, CURLOPT_RETURNTRANSFER, 1);
	curl_exec($opening);
	$httpcode = curl_getinfo($opening, CURLINFO_HTTP_CODE);
	curl_close($opening);
	if($httpcode == 200){
		 $write_result = fopen("scanning_admin_result.txt", "a+");
		fwrite($write_result, "$log\n");
		print "\033[92m \n\n [".date('H:m:s')."] Mencoba : $log => Ditemukan\n\n";
	}else{
		print "\033[91m \n[".date('\033[91m H:m:s')."] Mencoba : $log => Tidak di temukan";
	}
}
  
 ?>