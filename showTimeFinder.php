<?php
/**
 * Showtime Finder
 *
 * This file will grab the last showtimes of theatres near a given zip code.
 * Please make the URL your own! You can also add parameters to this URL:
 * &date=0|1|2|3 => today|1 day|2 days|etc..
 * &start=10 gets the second page etc...
 *
 * Please download the latest version of simple_html_dom.php on sourceForge:
 * http://sourceforge.net/projects/simplehtmldom/files/
 *
 * @author Roger Creasy <Roger.Creasy@gmail.com>
 * @version 0.1
 *
 */

require_once('simple_html_dom.php');

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://www.google.com/movies?near=27298');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
$str = curl_exec($curl);
curl_close($curl);

$html = str_get_html($str);

print '<pre>';
foreach($html->find('#movie_results .theater') as $div) {
    // print theater and address info
    print "Theatre:  ".$div->find('h2 a',0)->innertext."\n";

    // print all the movies with showtimes
    foreach($div->find('.movie') as $movie) {
        print "Movie:    ".$movie->find('.name a',0)->innertext.'<br />';
        print "Time:    ".$movie->find('.times',0)->innertext.'<br />';
    }
    print "\n\n";
}

// clean up memory
$html->clear();
