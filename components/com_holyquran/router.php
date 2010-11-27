<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

/*
 * Function to convert a system URL to a SEF URL
 */
function HolyquranBuildRoute(&$query) {
//dump($query, '$query');
    $segments = array();
    if(isset( $query['view'] )) {
        $segments[] = $query['view'];
        unset( $query['view'] );
    };
    if(isset($query['chapter'])) {
        $segments[] = $query['chapter'];
        unset( $query['chapter'] );
    };
//dump($segments, 'Build');
    return $segments;
}
/*
 * Function to convert a SEF URL back to a system URL
 */
function HolyquranParseRoute($segments) {
    $vars = array();
    switch($segments[0]) {
        case 'holyquran':
            $vars['view'] = 'holyquran';
            break;
        case 'indexlist':
            $vars['view'] = 'indexlist';
            break;
        case 'surah':
            $vars['view'] = 'surah';
            $id = explode( ':', $segments[1] );
            $vars['id'] = (int) $id[0];
            break;
        case 'ayah':
            $vars['view'] = 'ayah';
            $id = explode( ':', $segments[1] );
            $vars['id'] = (int) $id[0];
            break;
    }
//dump($vars, 'Parse');
    return $vars;
}
?>