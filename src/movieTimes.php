<?php
/**
 * Author: Roger Creasy
 * Email: Roger.Creasy@gmail.com
 * Date: 2/13/16
 * Time: 5:57 PM
 */

namespace src;

use function SimpleHtmlDom\file_get_html;
//use SimpleHtmlDom\simple_html_dom_node;

class movieTimes
{
    protected $html;
    protected $output;

    public function __construct($zip)
    {
        setHTML($zip = 27298);
        return generateList();
    }

    protected function setHTML($zip)
    {
        $html = file_get_html('http://www.google.com/movies?near=' . $zip);
    }

    protected function generateList()
    {
        $this->$output = '<pre>';
        foreach($this->html->find('#movie_results .theater') as $div) {
            // print theater and address info
            $this->$output .= "Theatre:  ".$div->find('h2 a',0)->innertext."\n";

            //TODO improve output formatting
            //TODO add links to trailers and movie detail info
            // print all the movies with showtimes
            foreach($div->find('.movie') as $movie) {
                $this->$output .= "Movie:    ".$movie->find('.name a',0)->innertext.'<br />';
                $this->$output .= "Time:    ".$movie->find('.times',0)->innertext.'<br />';
            }
            print "\n\n";
        }

        // clean up memory
        $dom->clear();
    }
}


