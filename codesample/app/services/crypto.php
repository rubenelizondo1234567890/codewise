<?php
namespace services;

/**
 * Main Controller with methods common to all controllers
 */
class crypto
{
	protected $request;
	
	function __construct(request $request)
	{
		$this->_request			=	$request;
		
	}

	/*
	 *
	 */
	public function getFilesDirectory(&$dir) {
		$req  =	$this->_request->getHttpRequest();
		$root =	$req['serverInfo']['DOCUMENT_ROOT'];
		$dir  =	$root .'/'. $req['paramsInfo']['CryptoChallenge']['dirName'];
	}

	/*
	 *
	 */
	public function checkForFiles($dir, &$files, &$encFileName, &$refFileName) {
		$return =	true;
		$files	=	'';

		$req  =	$this->_request->getHttpRequest();
		if(is_file($dir.'/'.$req['paramsInfo']['CryptoChallenge']['encFileName'])) {
			$encFileName	=	$dir.'/'.$req['paramsInfo']['CryptoChallenge']['encFileName'];
		} else {
			$files			.=	$req['paramsInfo']['CryptoChallenge']['encFileName'];
			$return			=	$return && false;
		}
		if(is_file($dir.'/'.$req['paramsInfo']['CryptoChallenge']['refFileName'])) {
			$refFileName	=	$dir.'/'.$req['paramsInfo']['CryptoChallenge']['refFileName'];
		} else {
			$files			.=	', '.$req['paramsInfo']['CryptoChallenge']['refFileName'];
			$return			=	$return && false;
		}

		return $return;
	}

	/*
	 *
	 */
	public function setFormatedEncFile($dir, $encFileName, &$formatedEncFileName, &$handleFormatedEnc) {

		//Initialize formated Encrypted File
		$formatedEncFileName	=	$dir."/f_encrypted.txt";

		$handleFormatedEnc		=	fopen($formatedEncFileName, "w");

		if(!$handleFormatedEnc) {
			return false;
		} else { 
			return true;
		}
	}

	/*
	 *
	 */
	public function setFormatedRefFile($dir, $refFileName, &$formatedRefFileName, &$handleFormatedRef) {

		//Initialize formated Ref File
		$formatedRefFileName	=	$dir."/f_plain.txt";
		$handleFormatedRef		=	fopen($formatedRefFileName, "w");
		if(!$handleFormatedRef) {
			return false;
		} else { 
			return true;
		}
	}

	/*
	 *
	 */
	public function prepareEncFile($encFileName, &$formatedEncFileName, $handleFormatedEnc) {
		//Get array from encrypted file
		$encFileArr	=	file($encFileName);
		//Remove blank lines and convert all to lowercase
		foreach ($encFileArr as $line) {
			if(strlen(trim($line)) > 0) {
				if(!fwrite($handleFormatedEnc, mb_strtolower($line))) {
					return false;
				}
			}
		}
		unset($encFileArr);
		return true;
	}

	/*
	 *
	 */
	public function prepareRefFile($refFileName, &$formatedRefFileName, $handleFormatedRef) {
		//Get array from encrypted file
		$refFileArr	=	file($refFileName);
		//Remove blank lines and convert all to lowercase
		foreach ($refFileArr as $line) {
			if(strlen(trim($line)) > 0) {
				if(!fwrite($handleFormatedRef, mb_strtolower($line))) {
					return false;
				}

			}
		}
		unset($refFileArr);
		return true;
	}

	/*
	 *
	 */
	public function getEquivalentAlpha($formatedEncFileName, $formatedRefFileName, &$alpha) {
		//We know a priori that encrypted file is smaller than plain one
		//We know a priori that encrypted file is a section of plain one
		//So, the key is to find the equivalence for ACT I. SCENE I.
		$formatedEncFileArr	=	file($formatedEncFileName);
		$formatedRefFileArr	=	file($formatedRefFileName);

		$resEncArr	=	$resRefArr	=	[];

		// find all equivalences of "ACT I. SCENE I." in encrypted file
		$testLineLength	=	strlen("ACT I. SCENE I.");

		$i	=	0;
		foreach ($formatedEncFileArr as $key => $value) {
			if (strlen(trim($value)) == $testLineLength) {
				//we have a line the same length
				//lets explore it
				$words = explode(' ', trim($value));
				if (
					strlen($words[0]) == 3 && 
					strlen($words[1]) == 2 && 
					strlen($words[2]) == 5 && 
					strlen($words[3]) == 2 &&
					strlen($words[1]) == strlen($words[3]) &&
					$words[1] == $words[3]
				) {
					//save the match key - value
					$resEncArr[$i][$key]	=	$value;
					//Add here next 2 lines to improve speed
					$resEncArr[$i][$key+1]	=	$formatedEncFileArr[$key+1];
					$resEncArr[$i][$key+2]	=	$formatedEncFileArr[$key+2];
					$i++;
				}
			}
		}

		$i	=	0;
		//Lets do the same for the plain file
		foreach ($formatedRefFileArr as $key => $value) {
			if (strlen(trim($value)) == $testLineLength) {
				//we have a line the same length
				//lets explore it
				$words = explode(' ', trim($value));
				if (
					strlen($words[0]) == 3 && 
					strlen($words[1]) == 2 && 
					strlen($words[2]) == 5 && 
					strlen($words[3]) == 2 &&
					strlen($words[1]) == strlen($words[3]) &&
					$words[1] == $words[3]
				) {
					//save the match key - value
					$resRefArr[$i][$key]	=	$value;
					//Add here next 2 lines to improve speed
					$resRefArr[$i][$key+1]	=	$formatedRefFileArr[$key+1];
					$resRefArr[$i][$key+2]	=	$formatedRefFileArr[$key+2];
					$i++;
				}
			}
		}

		//As expected we have only one match in the Encrypted file
		//Lets apply the same pattern recognition to the 2nd and 3rd lines
		//So to find only one result in the plain array results
		//And from there, get the equivalent alpha
		//and finally decrypt the file
		//
		//We know $resEncArr has only one result with 3 lines
		$encArr	=	$resEncArr[0];
		$i		=	0;
		foreach ($encArr as $key => $value) {
			if($i == 1) {
				//We are in the second row
				$enc2ndLineLength	=	strlen(trim($value));
				break;
			}
			$i++;
		}

		//Lets keep only results in refFileArr that matches the 2nd line of enc file
		foreach ($resRefArr as $key => $value) {
			$i					=	0;
			$ref2ndLineLength	=	0;
			//We know this only have 3 lines, so O(n) isnt really affected
			//And we need to locate 2nd row and remove items
			foreach ($value as $refValue) {
				if($i == 1) {
					//We are in the second row
					$ref2ndLineLength	=	strlen(trim($refValue));
					break;
				}
				$i++;
			}
			//unset results that doesnt match
			if ($ref2ndLineLength != $enc2ndLineLength) {
				unset($resRefArr[$key]);
			}
		}

		//Do we have just one result in resRefArr?
		//If not, we need to go over the same for the 3rd row
		$rows	=	count($resRefArr);
		if ($rows > 1) {
			//Lets keep only results in refFileArr that matches the 3rd line of enc file
			foreach ($resRefArr as $key => $value) {
				$i					=	0;
				$ref2ndLineLength	=	0;
				//We know this only have 3 lines, so O(n) isnt really affected
				//And we need to locate 2nd row and remove items
				foreach ($value as $encValue) {
					if($i == 2) {
						//We are in the third row
						$ref2ndLineLength	=	strlen(trim($encValue));
						break;
					}
					$i++;
				}
				//unset results that doesnt match
				if ($ref2ndLineLength != $enc2ndLineLength) {
					unset($resRefArr[$key]);
				}
			}
		} elseif ($rows == 0) {
			//The algorithm isnt working fine
			//Should we add a 4th line?
			return false;
		}

		//Oks, we have one set in each array
		//Lets get the equivalent alpha
		$this->getStdAlpha($stdAlpha);
		$this->getEqvAlpha($eqvAlpha);

		$encArr	=	array_shift($resEncArr);
		$refArr =	array_shift($resRefArr);

		$encKey =	key($encArr);
		$refKey =	key($refArr);
				
		for ($i=0; $i < 3; $i++) { 
			//Get line of enc array
			$encLine = trim($encArr[$encKey + $i]);
			//Get line of ref array
			$refLine = trim($refArr[$refKey + $i]);
			//Both lines have the same number of words and length on each one
			$encLineArr = str_split($encLine);
			$refLineArr = str_split($refLine);
			//lets find equivalent characters
			$totalChars = count($encLineArr);
			for ($j=0; $j < $totalChars; $j++) { 
			 	//get enc char
			 	$encChar		=	$encLineArr[$j];
			 	//get ref char
			 	$refChar		=	$refLineArr[$j];
			 	//get pos value of ref char in stdAlpha
			 	if(!empty($stdAlpha[$refChar])) {
			 		$pos			=	$stdAlpha[$refChar];
				 	//Set value in eqvAlpha
				 	//$eqvAlpha[$pos]	=	$encChar;
			 	}		 	
			 }
		}

		if (count($eqvAlpha) == 26) {
			//We have a complete alpha
			$alpha = $eqvAlpha;
			return true;
		} else {
			//we need to analyze more lines from original text arrays
			//$formatedEncFileArr
			//$formatedRefFileArr
			$i = 3;
			do{
				//Get line of enc array
				$encLine = trim($formatedEncFileArr[$encKey + $i]);
				//Get line of ref array
				$refLine = trim($formatedRefFileArr[$refKey + $i]);
				print_r($encLine); echo " -- ".strlen($encLine) ." ----- ";print_r($refLine);echo " -- ".strlen($refLine) ."<br/>";
				//Both lines have the same number of words and length on each one
				$encLineArr = str_split($encLine);
				$refLineArr = str_split($refLine);
				//lets find equivalent characters
				$totalChars = count($encLineArr);
				for ($j=0; $j < $totalChars; $j++) { 
				 	//get enc char
				 	$encChar		=	$encLineArr[$j];
				 	//get ref char
				 	$refChar		=	$refLineArr[$j];
				 	//get pos value of ref char in stdAlpha
				 	if(!empty($stdAlpha[$refChar])) {
				 		$pos			=	$stdAlpha[$refChar];
					 	//Set value in eqvAlpha
					 	$eqvAlpha[$pos]	=	$encChar;
				 	}		 	
				}
				if (count($eqvAlpha) == 25) {
					//We have a complete alpha
					$alpha = $eqvAlpha;
					return true;
				} else {
					$line = $encKey + $i;
				}
				$i++;
			}while(true);
		}	
	}

	public function deCipherFile(&$text,$encFileName, $formatedEncFileName, $handleFormatedEnc) {
		$formatedEncFileArr	=	file($formatedEncFileName);
		$this->getEqvAlpha($eqvAlpha);
		$eqvAlpha = array_flip($eqvAlpha);
		$this->getStdAlpha($stdAlpha);
		$stdAlpha = array_flip($stdAlpha);
		$textArr = [];
		foreach ($formatedEncFileArr as $value) {
			//Convert line to array
			$valueArr = str_split($value);
			$tot = count($valueArr);
			$line = '';
			for ($i=0; $i < $tot; $i++) { 
				$encChar = $valueArr[$i];
				if(isset($eqvAlpha[$encChar])) {
					$pos = $eqvAlpha[$encChar];
					$char = $stdAlpha[$pos];
					$line .= $char;
				} else {
					$line .= $encChar;
				}
			}
			$textArr[] = $line;
		}

		$text = implode("<br/>", $textArr);

		return true;
	}

	private function getStdAlpha(&$stdAlpha) {
		//StdAlpha keys   0    1    2    3    4    5    6    7    8    9    10   11   12   13   14   15   16   17   18   19   20   21   22   23   24   25
		$stdAlpha	=	['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
		//Flip keys
		$stdAlpha	=	array_flip($stdAlpha);
		return true;
	}

	private function getEqvAlpha(&$eqvAlpha) {
		$eqvAlpha	=	['z', 'h', 'i', 'm', 'n', 'e', 'y', 'x', 'w', 'v', 'u', 't', 's', 'r', 'q', 'p', 'o', 'l', 'k', 'j', 'g', 'f', 'd', 'c', 'b', 'a'];
		return true;
	}

}