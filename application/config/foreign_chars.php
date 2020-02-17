<?php  

	/**
	 *
	 * This is the CI config foreign_chars file
	 *
	 * @package    bizydads_hof\config\foreign_chars
	 * @version    1.0
	 * @copyright  2015, BizyCorp Internal Systems Development
	 * @license    private, All rights reserved
	 * @author     CI
	 * @uses
	 * @see
	 * @created
	 * @modified
	 * @modification
	 *
	 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Foreign Characters
| -------------------------------------------------------------------
| This file contains an array of foreign characters for transliteration
| conversion used by the Text helper
|
*/
$foreign_characters = array(
	'/ÃƒÆ’Ã‚Â¤|ÃƒÆ’Ã‚Â¦|Ãƒâ€¡Ã‚Â½/' => 'ae',
	'/ÃƒÆ’Ã‚Â¶|Ãƒâ€¦Ã¢â‚¬Å“/' => 'oe',
	'/ÃƒÆ’Ã‚Â¼/' => 'ue',
	'/ÃƒÆ’Ã¢â‚¬Å¾/' => 'Ae',
	'/ÃƒÆ’Ã…â€œ/' => 'Ue',
	'/ÃƒÆ’Ã¢â‚¬â€œ/' => 'Oe',
	'/ÃƒÆ’Ã¢â€šÂ¬|ÃƒÆ’Ã¯Â¿Â½|ÃƒÆ’Ã¢â‚¬Å¡|ÃƒÆ’Ã†â€™|ÃƒÆ’Ã¢â‚¬Å¾|ÃƒÆ’Ã¢â‚¬Â¦|Ãƒâ€¡Ã‚Âº|Ãƒâ€žÃ¢â€šÂ¬|Ãƒâ€žÃ¢â‚¬Å¡|Ãƒâ€žÃ¢â‚¬Å¾|Ãƒâ€¡Ã¯Â¿Â½/' => 'A',
	'/ÃƒÆ’Ã‚Â |ÃƒÆ’Ã‚Â¡|ÃƒÆ’Ã‚Â¢|ÃƒÆ’Ã‚Â£|ÃƒÆ’Ã‚Â¥|Ãƒâ€¡Ã‚Â»|Ãƒâ€žÃ¯Â¿Â½|Ãƒâ€žÃ†â€™|Ãƒâ€žÃ¢â‚¬Â¦|Ãƒâ€¡Ã…Â½|Ãƒâ€šÃ‚Âª/' => 'a',
	'/ÃƒÆ’Ã¢â‚¬Â¡|Ãƒâ€žÃ¢â‚¬Â |Ãƒâ€žÃ‹â€ |Ãƒâ€žÃ…Â |Ãƒâ€žÃ…â€™/' => 'C',
	'/ÃƒÆ’Ã‚Â§|Ãƒâ€žÃ¢â‚¬Â¡|Ãƒâ€žÃ¢â‚¬Â°|Ãƒâ€žÃ¢â‚¬Â¹|Ãƒâ€žÃ¯Â¿Â½/' => 'c',
	'/ÃƒÆ’Ã¯Â¿Â½|Ãƒâ€žÃ…Â½|Ãƒâ€žÃ¯Â¿Â½/' => 'D',
	'/ÃƒÆ’Ã‚Â°|Ãƒâ€žÃ¯Â¿Â½|Ãƒâ€žÃ¢â‚¬Ëœ/' => 'd',
	'/ÃƒÆ’Ã‹â€ |ÃƒÆ’Ã¢â‚¬Â°|ÃƒÆ’Ã…Â |ÃƒÆ’Ã¢â‚¬Â¹|Ãƒâ€žÃ¢â‚¬â„¢|Ãƒâ€žÃ¢â‚¬ï¿½|Ãƒâ€žÃ¢â‚¬â€œ|Ãƒâ€žÃ‹Å“|Ãƒâ€žÃ…Â¡/' => 'E',
	'/ÃƒÆ’Ã‚Â¨|ÃƒÆ’Ã‚Â©|ÃƒÆ’Ã‚Âª|ÃƒÆ’Ã‚Â«|Ãƒâ€žÃ¢â‚¬Å“|Ãƒâ€žÃ¢â‚¬Â¢|Ãƒâ€žÃ¢â‚¬â€�|Ãƒâ€žÃ¢â€žÂ¢|Ãƒâ€žÃ¢â‚¬Âº/' => 'e',
	'/Ãƒâ€žÃ…â€œ|Ãƒâ€žÃ…Â¾|Ãƒâ€žÃ‚Â |Ãƒâ€žÃ‚Â¢/' => 'G',
	'/Ãƒâ€žÃ¯Â¿Â½|Ãƒâ€žÃ…Â¸|Ãƒâ€žÃ‚Â¡|Ãƒâ€žÃ‚Â£/' => 'g',
	'/Ãƒâ€žÃ‚Â¤|Ãƒâ€žÃ‚Â¦/' => 'H',
	'/Ãƒâ€žÃ‚Â¥|Ãƒâ€žÃ‚Â§/' => 'h',
	'/ÃƒÆ’Ã…â€™|ÃƒÆ’Ã¯Â¿Â½|ÃƒÆ’Ã…Â½|ÃƒÆ’Ã¯Â¿Â½|Ãƒâ€žÃ‚Â¨|Ãƒâ€žÃ‚Âª|Ãƒâ€žÃ‚Â¬|Ãƒâ€¡Ã¯Â¿Â½|Ãƒâ€žÃ‚Â®|Ãƒâ€žÃ‚Â°/' => 'I',
	'/ÃƒÆ’Ã‚Â¬|ÃƒÆ’Ã‚Â­|ÃƒÆ’Ã‚Â®|ÃƒÆ’Ã‚Â¯|Ãƒâ€žÃ‚Â©|Ãƒâ€žÃ‚Â«|Ãƒâ€žÃ‚Â­|Ãƒâ€¡Ã¯Â¿Â½|Ãƒâ€žÃ‚Â¯|Ãƒâ€žÃ‚Â±/' => 'i',
	'/Ãƒâ€žÃ‚Â´/' => 'J',
	'/Ãƒâ€žÃ‚Âµ/' => 'j',
	'/Ãƒâ€žÃ‚Â¶/' => 'K',
	'/Ãƒâ€žÃ‚Â·/' => 'k',
	'/Ãƒâ€žÃ‚Â¹|Ãƒâ€žÃ‚Â»|Ãƒâ€žÃ‚Â½|Ãƒâ€žÃ‚Â¿|Ãƒâ€¦Ã¯Â¿Â½/' => 'L',
	'/Ãƒâ€žÃ‚Âº|Ãƒâ€žÃ‚Â¼|Ãƒâ€žÃ‚Â¾|Ãƒâ€¦Ã¢â€šÂ¬|Ãƒâ€¦Ã¢â‚¬Å¡/' => 'l',
	'/ÃƒÆ’Ã¢â‚¬Ëœ|Ãƒâ€¦Ã†â€™|Ãƒâ€¦Ã¢â‚¬Â¦|Ãƒâ€¦Ã¢â‚¬Â¡/' => 'N',
	'/ÃƒÆ’Ã‚Â±|Ãƒâ€¦Ã¢â‚¬Å¾|Ãƒâ€¦Ã¢â‚¬Â |Ãƒâ€¦Ã‹â€ |Ãƒâ€¦Ã¢â‚¬Â°/' => 'n',
	'/ÃƒÆ’Ã¢â‚¬â„¢|ÃƒÆ’Ã¢â‚¬Å“|ÃƒÆ’Ã¢â‚¬ï¿½|ÃƒÆ’Ã¢â‚¬Â¢|Ãƒâ€¦Ã…â€™|Ãƒâ€¦Ã…Â½|Ãƒâ€¡Ã¢â‚¬Ëœ|Ãƒâ€¦Ã¯Â¿Â½|Ãƒâ€ Ã‚Â |ÃƒÆ’Ã‹Å“|Ãƒâ€¡Ã‚Â¾/' => 'O',
	'/ÃƒÆ’Ã‚Â²|ÃƒÆ’Ã‚Â³|ÃƒÆ’Ã‚Â´|ÃƒÆ’Ã‚Âµ|Ãƒâ€¦Ã¯Â¿Â½|Ãƒâ€¦Ã¯Â¿Â½|Ãƒâ€¡Ã¢â‚¬â„¢|Ãƒâ€¦Ã¢â‚¬Ëœ|Ãƒâ€ Ã‚Â¡|ÃƒÆ’Ã‚Â¸|Ãƒâ€¡Ã‚Â¿|Ãƒâ€šÃ‚Âº/' => 'o',
	'/Ãƒâ€¦Ã¢â‚¬ï¿½|Ãƒâ€¦Ã¢â‚¬â€œ|Ãƒâ€¦Ã‹Å“/' => 'R',
	'/Ãƒâ€¦Ã¢â‚¬Â¢|Ãƒâ€¦Ã¢â‚¬â€�|Ãƒâ€¦Ã¢â€žÂ¢/' => 'r',
	'/Ãƒâ€¦Ã…Â¡|Ãƒâ€¦Ã…â€œ|Ãƒâ€¦Ã…Â¾|Ãƒâ€¦Ã‚Â /' => 'S',
	'/Ãƒâ€¦Ã¢â‚¬Âº|Ãƒâ€¦Ã¯Â¿Â½|Ãƒâ€¦Ã…Â¸|Ãƒâ€¦Ã‚Â¡|Ãƒâ€¦Ã‚Â¿/' => 's',
	'/Ãƒâ€¦Ã‚Â¢|Ãƒâ€¦Ã‚Â¤|Ãƒâ€¦Ã‚Â¦/' => 'T',
	'/Ãƒâ€¦Ã‚Â£|Ãƒâ€¦Ã‚Â¥|Ãƒâ€¦Ã‚Â§/' => 't',
	'/ÃƒÆ’Ã¢â€žÂ¢|ÃƒÆ’Ã…Â¡|ÃƒÆ’Ã¢â‚¬Âº|Ãƒâ€¦Ã‚Â¨|Ãƒâ€¦Ã‚Âª|Ãƒâ€¦Ã‚Â¬|Ãƒâ€¦Ã‚Â®|Ãƒâ€¦Ã‚Â°|Ãƒâ€¦Ã‚Â²|Ãƒâ€ Ã‚Â¯|Ãƒâ€¡Ã¢â‚¬Å“|Ãƒâ€¡Ã¢â‚¬Â¢|Ãƒâ€¡Ã¢â‚¬â€�|Ãƒâ€¡Ã¢â€žÂ¢|Ãƒâ€¡Ã¢â‚¬Âº/' => 'U',
	'/ÃƒÆ’Ã‚Â¹|ÃƒÆ’Ã‚Âº|ÃƒÆ’Ã‚Â»|Ãƒâ€¦Ã‚Â©|Ãƒâ€¦Ã‚Â«|Ãƒâ€¦Ã‚Â­|Ãƒâ€¦Ã‚Â¯|Ãƒâ€¦Ã‚Â±|Ãƒâ€¦Ã‚Â³|Ãƒâ€ Ã‚Â°|Ãƒâ€¡Ã¢â‚¬ï¿½|Ãƒâ€¡Ã¢â‚¬â€œ|Ãƒâ€¡Ã‹Å“|Ãƒâ€¡Ã…Â¡|Ãƒâ€¡Ã…â€œ/' => 'u',
	'/ÃƒÆ’Ã¯Â¿Â½|Ãƒâ€¦Ã‚Â¸|Ãƒâ€¦Ã‚Â¶/' => 'Y',
	'/ÃƒÆ’Ã‚Â½|ÃƒÆ’Ã‚Â¿|Ãƒâ€¦Ã‚Â·/' => 'y',
	'/Ãƒâ€¦Ã‚Â´/' => 'W',
	'/Ãƒâ€¦Ã‚Âµ/' => 'w',
	'/Ãƒâ€¦Ã‚Â¹|Ãƒâ€¦Ã‚Â»|Ãƒâ€¦Ã‚Â½/' => 'Z',
	'/Ãƒâ€¦Ã‚Âº|Ãƒâ€¦Ã‚Â¼|Ãƒâ€¦Ã‚Â¾/' => 'z',
	'/ÃƒÆ’Ã¢â‚¬Â |Ãƒâ€¡Ã‚Â¼/' => 'AE',
	'/ÃƒÆ’Ã…Â¸/'=> 'ss',
	'/Ãƒâ€žÃ‚Â²/' => 'IJ',
	'/Ãƒâ€žÃ‚Â³/' => 'ij',
	'/Ãƒâ€¦Ã¢â‚¬â„¢/' => 'OE',
	'/Ãƒâ€ Ã¢â‚¬â„¢/' => 'f'
);

/* End of file foreign_chars.php */
/* Location: ./application/config/foreign_chars.php */