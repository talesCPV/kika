<?php

	function shuff($pos){
		$index = [11,22,23,35,9,43,1,30,8,34,17,0,46,10,7,44,21,31,47,42,39,29,38,0,27,13,6,36,0,16,14,24,20,2,25,15,26,37,45,19,41,5,33,18,40,12,3,28,4,32];

		return array_search($pos+1, $index);

	}


	function shift($chr,$key,$st){

		$allowed = ["5","8","F","J","9"," ","g","Y","t",":","I","s","b","=","&",";","^","W","2","x","A","R","/","'","X","o","#","q","@","}","|","%","E","4","C","u","r","0","P","6","c",",","f","l","G","p","`","y","d","L","N","?","v","Z","*","i","e","T","O",")","D","Q","m","~",">","$","(","+","K","!","{","3","w",'"',"-","]","M","z","H","h","B","7","U","k","V","1",".","a","S","<","[","_","j","n"];


		$ind = array_search($chr, $allowed);
		$ind = $ind + ($key - 33) * $st;

		if($ind >= 94){
			$ind = $ind - 94;
		}else if($ind < 0){
			$ind = $ind + 94;
		}

		return  $allowed[$ind];

	}



	function crip($str){

		$word = "";		
		
		while (strlen($word) < 50) { // fill word
			$word = $word . chr(random_int(32,126));
		}

		$word_sz = strlen($str);
		if($word_sz < 6){
			echo "Numero menor que 6 dígitos.";
		}else{
			$ch1 = ord($str[4]);
			$ch2 = ord($str[3]);
			if($ch1 % 2 == 0){
				$st2 = 1;
			}else{
				$st2 = -1;
			}
			if($ch2 % 2 == 0){
				$st1 = 1;
			}else{
				$st1 = -1;
			}

			$word[23] = chr($word_sz + 33);
			$word[28] = shift(chr($ch1),$word_sz,1);
			$word[11] = shift(chr($ch2),$word_sz,-1);


			for($i=0; $i<$word_sz;$i++){

				if($i % 2 == 0){
					$word[shuff($i)] = shift($str[$i],$ch1,$st1);
				}else{
					$word[shuff($i)] = shift($str[$i],$ch2,$st2);
				}

			}

			echo $word;

		}

	};

	function decrip($str){
/*
		$allowed = [ "!",'"',"#","$","%","&","'","(",")","*","+",",","-",".","/","0","1","2","3","4","5","6","7","8","9",":",";","<","=",">","?","@","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","[","]","^","_","`"," ","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","{","|","}","~"];
*/

		$word_sz = $str[23];


		echo "new size: ".$word_sz."<br>";


		$out = "";
/*
		for($i=0;$i<94; $i++){
			if(!in_array($allowed[$i], $new)){
				$out = $out . $allowed[$i];
			}
		}

*/
		echo $out;

/*

		while(count($resp) < 94){

			$sort = random_int(0,93);

			if(!in_array($allowed[$sort], $resp)){
				$resp[count($resp)] = $allowed[$sort];
				$out = $out . $allowed[$sort];
			}
		}
*/
		echo $out;






//		shift("T",2,1);

//		echo "Descriptografar => {$str}";		

	};

	if (IsSet($_POST ["std"])){
		$std = $_POST ["std"];
		$str = $_POST ["str"];

		if($std == 1){ // CRIPTOGRAFAR
			crip($str);
		}else{        // DESCRIPTOGRAFAR
			decrip($str);
		}
		
	}else{
		echo "Deu Ruim!";

	}


?>