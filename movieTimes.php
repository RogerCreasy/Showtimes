<?php
/**
 * Author: Roger Creasy
 * Email: Roger.Creasy@gmail.com
 * Date: 2/13/16
 * Time: 5:57 PM
 */


require __DIR__ . '/vendor/autoload.php';

use function SimpleHtmlDom\file_get_html;
//use SimpleHtmlDom\simple_html_dom_node;

$html = file_get_html('http://www.google.com/movies?near=27298');

print '<pre>';
foreach($html->find('#movie_results .theater') as $div) {
    // print theater and address info
    print "Theatre:  ".$div->find('h2 a',0)->innertext."\n";

    //TODO improve output formatting
    //TODO add links to trailers and movie detail info
    // print all the movies with showtimes
    foreach($div->find('.movie') as $movie) {
        print "Movie:    ".$movie->find('.name a',0)->innertext.'<br />';
        print "Time:    ".$movie->find('.times',0)->innertext.'<br />';
    }
    print "\n\n";
}

// clean up memory
$dom->clear();