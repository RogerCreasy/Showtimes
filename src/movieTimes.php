<?php
/**
 * Author: Roger Creasy
 * Email: Roger.Creasy@gmail.com
 * Date: 2/13/16
 * Time: 5:57 PM
 */

namespace src;

use function SimpleHtmlDom\file_get_html;

class movieTimes
{
    protected $html;
    protected $output;
    protected $url;

    public function __construct($zip)
    {
        $this->__setURL($zip = 27298);
        $this->__setHTML();
        return $this->generateList();
    }

    /**
     * @param $zip
     */
    protected function __setURL($zip)
    {
        $this->url = 'http://www.google.com/movies?near=' . $zip;
    }

    /**
     * set $HTML to the Google URL
     */
    protected function __setHTML()
    {
        $this->html = file_get_html($this->url);
    }

    /**
     * the real work is done here
     * parse the DOM for the desired info
     */
    protected function generateList()
    {
        $this->output = '<pre>';
        foreach($this->html->find('#movie_results .theater') as $div) {
            // print theater and address info
            //TODO fix Theatre link and anchor text
            $element = $div->find('a',0);
            $tag = $this->__buildTheatreLink($element);
            //TODO extract protected method to generate link, include Google
            $this->output .= "Theatre:  ".$tag;

            //TODO improve output formatting
            //TODO add links to trailers and movie detail info
            // print all the movies with showtimes
            foreach($div->find('.movie') as $movie) {
                $this->output .= "Movie:    ".$movie->find('.name a',0)->innertext.'<br />';
                $this->output .= "Time:    ".$movie->find('.times',0)->innertext.'<br />';
            }
            $this->output .= "\n\n";
        }

    }

    /**
     * FUnction to build out theatre link
     */
    protected function __buildTheatreLink($element)
    {
        $link = $element->href;
        $anchor = $element->innertext;
        $tag = "<a href=\"http://www.google.com".$link."\" target=\"_blank\">".$anchor."</a>\n\n";

        return $tag;
    }

    /**
     * Print the generated HTML
     */
    public function printListings()
    {
        print $this->output;
    }

    /**
     * print the entire DOM
     */
    public function printHTML()
    {
        print $this->html;
    }
}


