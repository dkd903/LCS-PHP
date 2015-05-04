<?php

/**
 * LCS - Print one of the longest common subsequence
 *             from two given input strings.
 *
 * This function implements the Naive Recursive algorithm and just does
 * not work well (interms of complexity) for very large strings.
 *
 * @param String $s1 First input string.
 * @param String $s2 Second input string.
 * @return String The LCS.
 */

function LCS($s1, $s2) {

	//Calculate the initial substrings needed for subsequent steps
	$s1sub = substr($s1, 0, (strlen($s1) - 1 < 0) ? 0 : strlen($s1) - 1);
	$s2sub = substr($s2, 0, (strlen($s2) - 1 < 0) ? 0 : strlen($s2) - 1);
 
    if (strlen($s1) == 0 || strlen($s2) == 0)            
        return "";
    else if ($s1[strlen($s1) - 1] == $s2[strlen($s2) - 1])
        return LCS($s1sub, $s2sub) . $s1[strlen($s1) - 1];
    else
    {
        $x = LCS($s1, $s2sub);
        $y = LCS($s1sub, $s2);
        return (strlen($x) > strlen($y) ? $x : $y);
    }
}

/**
 * LCSLength - Calculate the length of the longest common subsequence
 *             from two given input strings.
 *
 * This function implements the Naive Recursive algorithm and just does
 * not work well (interms of complexity) for very large strings.
 *
 * @param String $s1 First input string.
 * @param String $s2 Second input string.
 * @param String $l1 Length of the first input string.
 * @param String $l2 Length of the second input string.
 * @return integer length of the LCS.
 */

function LCSLength($s1, $s2, $l1, $l2) {

	if ($l1 == 0 || $l2 == 0) {
		
		return 0;
	
	}
	
	if ($s1[$l1-1] == $s2[$l2-1]) {
	
		return 1 + LCSLength($s1, $s2, $l1-1, $l2-1);
	
	} else {
	
		return max(LCSLength($s1, $s2, $l1, $l2-1), LCSLength($s1, $s2, $l1-1, $l2));
	
	}
}

/**
 * LCSMemoization - Print one of the longest common subsequence
 *             from two given input strings - Using memoization.
 *
 * This function implements the Memoization algorithm.
 *
 * @param String $s1 First input string.
 * @param String $s2 Second input string.
 * @return String The LCS.
 */

function LCSMemoization($s1, $s2) {

	//Create the memo
	static $LM = array();
 
    if (strlen($s1) == 0 || strlen($s2) == 0)            
        return "";
    
	if (isset($LM[$s1][$s2])) {
		return $LM[$s1][$s2];
	}	

	//Calculate the initial substrings needed for subsequent steps
	$s1sub = substr($s1, 0, (strlen($s1) - 1 < 0) ? 0 : strlen($s1) - 1);
	$s2sub = substr($s2, 0, (strlen($s2) - 1 < 0) ? 0 : strlen($s2) - 1);

    if ($s1[strlen($s1) - 1] == $s2[strlen($s2) - 1]) {
    	$ret0 = LCSMemoization($s1sub, $s2sub);

		$LM[$s1sub][$s2sub] = $ret0;

    	$ret0 = $ret0 . $s1[strlen($s1) - 1];

        return $ret0;

    } else {
        
        $x = LCSMemoization($s1, $s2sub);
        $LM[$s1][$s2sub] = $x;
        $y = LCSMemoization($s1sub, $s2);
        $LM[$s1sub][$s2] = $y;

        if (strlen($x) > strlen($y)) {
        	return $x;
        } else {
        	return $y;
        }

    }
}

/**
 * LCSLengthMemoization - Calculate the length of the longest common subsequence
 *             from two given input strings - Using Memoization
 *
 * This function implements the Memoization
 *
 * @param String $s1 First input string.
 * @param String $s2 Second input string.
 * @param String $l1 Length of the first input string.
 * @param String $l2 Length of the second input string.
 * @return integer length of the LCS.
 */

function LCSLengthMemoization($l1, $l2, $s1, $s2) {

	static $L = array();
	if (empty($L)) {
		for ($l1n = 0; $l1n < $l1+1; $l1n++) {
			for ($l2n = 0; $l2n < $l2+1; $l2n++) {
				$L[$l1n][$l2n] = -1;
			}
		}
	}

    if ($l1 == 0 || $l2 == 0) {    
        return 0;
    }

    if ($L[$l1][$l2] >= 0) {
        return $L[$l1][$l2];
    }

    if ($s1{$l1-1} == $s2{$l2-1}) {

         $lclm1 = LCSLengthMemoization($l1-1, $l2-1, $s1, $s2);
         $L[$l1][$l2] = $lclm1 + 1;

	 	return ($lclm1 + 1);
    
    } else {
        
        $lclm2 = LCSLengthMemoization($l1-1, $l2, $s1, $s2);
	 	$lclm3 = LCSLengthMemoization($l1, $l2-1, $s1, $s2);

	 	if ($lclm2 >= $lclm3) {

            $L[$l1][$l2] = $lclm2;
	    	return $lclm2;
	 	
	 	} else {

        	$L[$l1][$l2] = $lclm3; 
	    	return $lclm3;

	 	}
    }
}

/**
 * LCSDynamicProgramming - Calculate the length of the longest common subsequence
 *             from two given input strings - Using DP and also print one of 
 * 				the LCS.
 *
 * This function implements the Dynamic Programming
 *
 * @param String $s1 First input string.
 * @param String $s2 Second input string.
 * @return String The LCS.
 */

function LCSDynamicProgramming($s1, $s2) {

        $l1 = strlen($s1);
        $l2 = strlen($s2);

        $ldp = array();

		if (empty($ldp)) {
			for ($l1n = 0; $l1n < $l1+1; $l1n++) {
				for ($l2n = 0; $l2n < $l2+1; $l2n++) {
					$ldp[$l1n][$l2n] = 0;
				}
			}
		}        

		//$start = microtime(true);
        //compute length of LCS
        for ($i = $l1-1; $i >= 0; $i--) {
            for ($j = $l2-1; $j >= 0; $j--) {
                if ($s1{$i} == $s2{$j})
                    $ldp[$i][$j] = $ldp[$i+1][$j+1] + 1;
                else 
                    $ldp[$i][$j] = max($ldp[$i+1][$j], $ldp[$i][$j+1]);
            }
        }

        $min = PHP_INT_MAX;
		$max = 0;
		foreach ($ldp as $i) {
			foreach ($i as $j) {
			    $min = min($min, $j);
			    $max = max($max, $j);
			}
		}

		//LCS length
		//echo $max . "\n";
		//echo microtime(true) - $start;
		//echo "\n";

        //get the LCS
        $dp = "";
        $i = 0; $j = 0;
        while($i < $l1 && $j < $l2) {
            if ($s1{$i} == $s2{$j}) {
                $dp .= $s1{$i}; //print one of the LCS
                $i++;
                $j++;
            }
            else if ($ldp[$i+1][$j] >= $ldp[$i][$j+1]) {
            	$i++;
            }
            else {
            	$j++;
            }
        }

        return $dp;
}

/**
 * LCSQuad - Print one of the longest common subsequence
 *             from two given input strings.
 *
 * This function implements the Quadratic-time linear-space algorithm
 *
 * @param String $s1 First input string.
 * @param String $s2 Second input string.
 * @return String The LCS.
 */

function LCSQuad($s1, $s2) {

    $l1 = strlen($s1);		
    $l2 = strlen($s2);		


    if ($l1 == 0) {
        return "";
    }

    if ($l1 == 1) {
        for ($i = 0; $i < $l2; $i++) {
	    	if ($s2{$i} == $s1{0}) {
	       		return $s1;                   
	    	}
	   	}
		return "";	                      
    }

    $c = LCSQuadLength($s1, $s2);
    $c1 = 0; $c2 = 0;

    $s11 = substr($s1, 0, $l1/2);
    $s12 = substr($s1, $l1/2, $l1);

    for ($k = 0; $k < $l2; $k++) {

        $c1 = LCSQuadLength($s11, substr($s2, 0, $k)); 
        $c2 = LCSQuadLength($s12, substr($s2, $k, $l2));

	  	if ($c1 + $c2 == $c) {
	    	break;         
	  	}
    }

    $s21 = substr($s2, 0, $k);
    $s22 = substr($s2, $k, $l2);
    $sol1 = LCSQuad($s11, $s21);
    $sol2 = LCSQuad($s12, $s22);

    return $sol1.$sol2;
}

/**
 * LCSQuadLength - Calculate the length of the longest common subsequence
 *             from two given input strings.
 *
 * This function implements the Quadratic-time linear-space algorithm
 *
 * @param String $s1 First input string.
 * @param String $s2 Second input string.
 * @return integer length of the LCS.
 */

function LCSQuadLength($s1, $s2) {

	static $LCS = array();

	$l1 = strlen($s1);
	$l2 = strlen($s2);

	if (empty($LCS)) {

		for ($i = 0; $i < 2; $i++) { //space
			for ($j = 0; $j < $l2; $j++) {
				$LCS[$i][$j] = 0;
			}			
		}
	}

    if ($l1 == 0 || $l2 == 0) {
		return 0;
    }

    for ($j = 0; $j < $l2+1; $j++) {
        
        $LCS[1][$j] = 0;        
    
    }

    for ($i = 1; $i < $l1+1; $i++) {

        for ($j = 0; $j < $l2+1; $j++) {
        	
        	$LCS[0][$j] = $LCS[1][$j];
        
        }

		$LCS[1][0] = 0;  

        for ($j = 1; $j < $l2+1; $j++) {

            if ($s1{$i-1} == $s2{$j-1}) {

               $LCS[1][$j] = $LCS[0][$j-1] + 1;
            
            } else {
            
               $LCS[1][$j] = max($LCS[0][$j], $LCS[1][$j-1]);
            
            }
        }
    }

    return $LCS[1][$l2];

}
