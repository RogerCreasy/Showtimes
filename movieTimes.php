<?php
/**
 * Author: Roger Creasy
 * Email: Roger.Creasy@gmail.com
 * Date: 2/13/16
 * Time: 5:57 PM
 */

# Use the Curl extension to query Google and get back a page of results
$url = "http://www.google.com/movies?near=27298";
$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);


# Create a DOM parser object
$dom = new DOMDocument();

# Parse the HTML from Google.
# The @ before the method call suppresses any warnings that
# loadHTML might throw because of invalid HTML in the page.
@$dom->loadHTML($html);

foreach($dom->getElementById('#movieResults') as $div)
{
    echo "Theatre:  ".$div->find('h2 a',0)->innertext."\n";
}


echo "##########################################################################";
# Iterate over all the <a> tags
foreach($dom->getElementsByTagName('a') as $link) {
    # Show the <a href>
    echo $link->getAttribute('href');
    echo "<br />";
}