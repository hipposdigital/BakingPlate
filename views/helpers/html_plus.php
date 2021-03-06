<?php
/**
 * Html Helper class file.
 *
 * Simplifies the construction of HTML elements.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @since         CakePHP(tm) v 0.9.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::import('Helper', 'Html');
/**
 * Html Helper class for easy use of HTML widgets.
 *
 * HtmlHelper encloses all methods needed while working with HTML pages.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @link http://book.cakephp.org/view/1434/HTML
 */
class HtmlPlusHelper extends HtmlHelper {

	/**
	 * html tags used by this helper.
	 *
	 * @var array
	 * @access public
	 */
	var $tags = array(
	    'html' => '<html%s>',
	    'htmlend' => '</html>',
	    'meta' => '<meta%s>',
	    'metalink' => '<link href="%s"%s>',
	    'link' => '<a href="%s"%s>%s</a>',
	    'mailto' => '<a href="mailto:%s" %s>%s</a>',
	    'form' => '<form %s>',
	    'formend' => '</form>',
	    'input' => '<input name="%s" %s>',
	    'textarea' => '<textarea name="%s" %s>%s</textarea>',
	    'hidden' => '<input type="hidden" name="%s" %s>',
	    'checkbox' => '<input type="checkbox" name="%s" %s>',
	    'checkboxmultiple' => '<input type="checkbox" name="%s[]"%s >',
	    'radio' => '<input type="radio" name="%s" id="%s" %s >%s',
	    'selectstart' => '<select name="%s"%s>',
	    'selectmultiplestart' => '<select name="%s[]"%s>',
	    'selectempty' => '<option value=""%s>&nbsp;</option>',
	    'selectoption' => '<option value="%s"%s>%s</option>',
	    'selectend' => '</select>',
	    'optiongroup' => '<optgroup label="%s"%s>',
	    'optiongroupend' => '</optgroup>',
	    'checkboxmultiplestart' => '',
	    'checkboxmultipleend' => '',
	    'password' => '<input type="password" name="%s" %s>',
	    'file' => '<input type="file" name="%s" %s>',
	    'file_no_model' => '<input type="file" name="%s" %s>',
	    'submit' => '<input %s>',
	    'submitimage' => '<input type="image" src="%s" %s>',
	    'button' => '<button type="%s"%s>%s</button>',
	    'image' => '<img src="%s" %s>',
	    'tableheader' => '<th%s>%s</th>',
	    'tableheaderrow' => '<tr%s>%s</tr>',
	    'tablecell' => '<td%s>%s</td>',
	    'tablerow' => '<tr%s>%s</tr>',
	    'block' => '<div%s>%s</div>',
	    'blockstart' => '<div%s>',
	    'blockend' => '</div>',
	    'tag' => '<%s%s>%s</%s>',
	    'tagstart' => '<%s%s>',
	    'tagend' => '</%s>',
	    'para' => '<p%s>%s</p>',
	    'parastart' => '<p%s>',
	    'label' => '<label for="%s"%s>%s</label>',
	    'fieldset' => '<fieldset%s>%s</fieldset>',
	    'fieldsetstart' => '<fieldset><legend>%s</legend>',
	    'fieldsetend' => '</fieldset>',
	    'legend' => '<legend>%s</legend>',
	    'css' => '<link rel="%s" href="%s"%s>',
	    'style' => '<style %s>%s</style>',
	    'charset' => '<meta charset="%s">',
	    'ul' => '<ul%s>%s</ul>',
	    'ol' => '<ol%s>%s</ol>',
	    'li' => '<li%s>%s</li>',
	    'error' => '<div%s>%s</div>',
	    'time' => '<time%s>%s</time>',
	    'javascriptblock' => '<script%s>%s</script>',
	    'javascriptstart' => '<script%s>',
	    'javascriptlink' => '<script src="%s"%s></script>',
	    'javascriptend' => '</script>'
	);


	/**
	 * Returns one or many `<script>` tags depending on the number of scripts given.
	 *
	 * If the filename is prefixed with "//", it will be returned early as its a special http(s) indepenent url.
	 *
	 * If the filename is prefixed with "/", the path will be relative to the base path of your
	 * application.  Otherwise, the path will be relative to your JavaScript path, usually webroot/js.
	 *
	 * Can include one or many Javascript files.
	 *
	 * ### Options
	 *
	 * - `inline` - Whether script should be output inline or into scripts_for_layout.
	 * - `once` - Whether or not the script should be checked for uniqueness. If true scripts will only be
	 *   included once, use false to allow the same script to be included more than once per request.
	 *
	 * @param mixed $url String or array of javascript files to include
	 * @param mixed $options Array of options, and html attributes see above. If boolean sets $options['inline'] = value
	 * @return mixed String of `<script />` tags or null if $inline is false or if $once is true and the file has been
	 *   included before.
	 * @access public
	 * @link http://book.cakephp.org/view/1589/script
	 */
	function script($url, $options = array()) {
		if (strpos((string) $url, '//') !== false) {
			return sprintf($this->tags['javascriptlink'], $url, null);
		}
		return parent::script($url, $options);
	}
	
	/**
	 * The time element represents either a time on a 24 hour clock,
	 * or a precise date in the proleptic Gregorian calendar,
	 * optionally with a time and a time-zone offset.
	 *
	 * @param $content string
	 * @param $options array
	 *      'format' STRING: Use the specified TimeHelper method (or format()). FALSE: Generate the datetime. NULL: Do nothing.
	 *      'datetime' STRING: If 'format' is STRING use as the formatting string. FALSE: Don't generate attribute
	 */
	function time($content, $options = array()) {
	        $options = array_merge(array(
	                'datetime' => 'Y-M-dTH:i+00:00',
	                'escape' => true,
	                'pubdate' => false,
	                'format' => false,
	        ), $options);

	        if ($options['format'] !== null) {
	                App::import('helper', 'Time');
	                $t = &new TimeHelper;
	        }
	        if ($options['format']) {
	                $time = $content;
	                if (method_exists($t, $options['format'])) {
	                        $content = $t->$options['format']($content);
	                } else {
	                        $content = $t->format($content, $options['format']);
	                }
	                $options['datetime'] = $t->format(strtotime($time), $options['datetime']);
	        } elseif ($options['format'] === false && $options['datetime']) {
	                $options['datetime'] = $t->format(strtotime($content), $options['datetime']);
	        }

	        if ($options['pubdate'])
	                $options['pubdate'] = 'pubdate';

	        return sprintf($this->tags['time'],  $this->_parseAttributes($options, array(0), ' ', ''), $content);
	}
}
