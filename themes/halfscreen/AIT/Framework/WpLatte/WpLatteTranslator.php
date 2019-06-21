<?php

/**
 * AIT WordPress Framework
 *
 * Copyright (c) 2011, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


/**
 * The WpLatte Translator 
 */
class WpLatteTranslator implements ITranslator
{

	/**
	 * Translates the given string.
	 *
	 * Uses in WpLatte templates is:
	 *
	 * {_'Dog', 'Dogs', 3} gives: Dogs
	 *
	 * {_'Some text %s with %d symbols.', 'bla bla', 3} gives: Some text bla bla with 3 symbols.
	 *
	 * {_Some text} or {_}Some text{/_} gives: Some text
	 *
	 * @param string $message
	 * @param int $number Plural count
	 * @return string
	 */
	public function translate($message, $number = null)
	{
		$args = func_get_args();
		$count = func_num_args();

		// _n( $single, $plural, $number, $domain)
		// {_'Dog', 'Dogs', 3} => Dogs
		if(isset($args[1]) and is_string($args[1]) and isset($args[2]) and is_numeric($args[2]) and $count == 3){

			return _n($args[0], $args[1], $args[2], THEME_CODE_NAME);

		// {_'Some text %s with %d symbols.', 'bla bla', 3}
		}elseif($args > 1){

			array_shift($args);
			return vsprintf(__($message, THEME_CODE_NAME), $args);

		// {_Some text} or {_}Some text{/_}
		}elseif($count == 1){
			return __($args[0], THEME_CODE_NAME);
		}
	}
}