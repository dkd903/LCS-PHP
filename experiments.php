<?php

//Generate LCS and Lengths from a combination of {A, C, G, T}
$array = array("A","C","G","T","GA","TC","GT","AC","GC","AT","GTC","GAT","ACT","GCA","AGCT");

foreach ($array as $k=>$v) {
	$temp = $array;
	unset($temp[$k]);
	$temp = array_values($temp);
	foreach ($temp as $key=>$value) {

		$string1 = $v;
		$string2 = $value;

		echo "String 1: " . $string1 . ", String 2: " . $string2 . "\n";

		$start = microtime(true);
		$lcs = LCS($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 1 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSMemoization($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 2 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSDynamicProgramming($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 3 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSQuad($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 4 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";						

	}
}

exit;

//Generate LCS and Lengths from a combination of 0,1
function generateZeroes($count) {
	$s = "";
	for ($i = 0; $i < $count; $i++) {
		$s .= "0";
	}
	return $s;
}

function generateAlphabet01($limit) {

	$arr = array();
	for ($i = 0; $i <= $limit; $i++) {
		$s = decbin($i);
		if (strlen($s) < strlen(decbin($limit))) {
			$s = generateZeroes(strlen(decbin($limit)) - strlen($s)) . $s;
		}
		$arr[] = $s;
	}
	return $arr;

}

$alphabets01 = generateAlphabet01(5);

foreach ($alphabets01 as $k=>$v) {
	$temp = $alphabets01;
	unset($temp[$k]);
	$temp = array_values($temp);
	foreach ($temp as $key=>$value) {

		$string1 = $v;
		$string2 = $value;
	
		echo "String 1: " . $string1 . ", String 2: " . $string2 . "\n";

		$start = microtime(true);
		$lcs = LCS($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 1 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSMemoization($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 2 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSDynamicProgramming($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 3 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSQuad($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 4 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";	

	}
}

exit;

//function to generate the random strings for random lengths
//for the randomly generated sequences test.

function generateRandString($length) {

	$numbers = range(0, 9);
	$alphabets = range('a', 'z');

    $basket = array_merge($numbers, $alphabets);

    $string = "";

    for($i=0; $i < $length; $i++) {
        $string .= $basket[array_rand($basket)];
    }
    return $string;
}

//generate 20 sets of random strings whose lengths vary between 3 to 5
//and run the Naive Recursion Algorithm to calculate the LCS Length
//and find the LCS

for ($i = 0; $i < 20; $i++) {
	
	$string1 = generateRandString(mt_rand(3,12));
	$string2 = generateRandString(mt_rand(3,12));

	$start = microtime(true);
	
	$lcs = LCS($string1, $string2);
	$lcslength = LCSLength($string1, $string2, strlen($string1), strlen($string2));
	
	$end = microtime(true) - $start;
	
	//echo "String 1: " . $string1 . ", String 2: " . $string2 . ", LCS: " . $lcs . ", Length: " . $lcslength . ", Time: " . $end . "\n\n";

		echo "String 1: " . $string1 . ", String 2: " . $string2 . "\n";

		$start = microtime(true);
		$lcs = LCS($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 1 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSMemoization($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 2 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSDynamicProgramming($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 3 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

		$start = microtime(true);
		$lcs = LCSQuad($string1, $string2);
		$end = microtime(true) - $start;
	
		echo "Algo 4 - LCS: " . $lcs . ", Length: " . strlen($lcs) . ", Time: " . $end . "\n";

}

exit;

//Test Cases for running XHProf profiles

$s1 = "thisisatest";
$s2 = "testing123testing";

$l1 = strlen($s1);
$l2 = strlen($s2);

echo "Naive: \n";
$start = microtime(true);
echo LCSLength($s1, $s2, $l1, $l2);
echo "\n";
echo $end = microtime(true) - $start;
$start = microtime(true);
echo "\n";
echo LCS($s1, $s2);
echo "\n";
echo $end = microtime(true) - $start;
echo "\n\nMemoization: \n";
$start = microtime(true);
echo LCSLengthMemoization($l1, $l2, $s1, $s2);
echo "\n";
echo $end = microtime(true) - $start;
$start = microtime(true);
echo "\n";
echo LCSMemoization($s1, $s2);
echo "\n";
echo $end = microtime(true) - $start;
echo "\n\nDP:";
$start = microtime(true);
echo "\n";
$start = microtime(true);
echo LCSDynamicProgramming($s1, $s2);
echo "\n";
echo $end = microtime(true) - $start;
echo "\n\nQuad Time: \n";
$start = microtime(true);
echo LCSQuadLength($s1, $s2);
echo "\n";
echo $end = microtime(true) - $start;
echo "\n";
$start = microtime(true);
echo LCSQuad($s1, $s2);
echo "\n";
echo $end = microtime(true) - $start;
echo "\n";

$s1 = "AAACAABBBBAASCACAAAD";
$s2 = "AABCABBAASCAAACCCASD";
