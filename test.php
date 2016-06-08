<?php 

$this->load->library('domparser');
$html = $this->domparser->file_get_html('http://www.google.com/');
$rank = $html->find('b.gb1');

// will show all content of tag with class gb1
print_r($rank);