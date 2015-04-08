Speedee
================
Calculate Spee-Dee Rates in PHP

Disclaimer
------------
I'm not responsible for wrong results. This does not currently handle additional surcharges or oversized packages

Setup
------------
Download latest rates file from http://www.speedeedelivery.com/rates.html

Extract the following files to the same folder as Speedee.php:

		/ZoneTables.CSV
		/RatesOnly.csv
		/zones/*.CSV (SPxxx.CSV)

Usage
------------
	require_once 'Speedee/Speedee.php';
	$rate = SpeeDee\CalcRate($origin_zip, $destination_zip, $weight);

Enjoy!
