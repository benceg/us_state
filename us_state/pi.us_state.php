<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name'        => 'US State',
	'pi_version'     => '1.0.0',
	'pi_author'      => 'Ben Ceglowski',
	'pi_author_url'  => 'http://phuse.ca',
	'pi_description' => 'Converts a US state\'s name to its initials and vice versa.',
	'pi_usage'       => '{exp:us_state:initials state="New York"} or {exp:us_state:name state="NY"}'
);

/**
 * < EE 2.6.0
 */
if ( ! function_exists('ee'))
{
	function ee()
	{
		static $EE;
		if (!$EE)
		{
			$EE = get_instance();
		}
		return $EE;
	}
}

/**
 * US State Plugin class
 *
 * @package        us_state
 * @author         Ben Ceglowski <ben@phuse.ca>
 * @link           http://phuse.ca
 * @license        https://opensource.org/licenses/MIT
 */
class Us_state {

	public $return_data;

	private $states;

	/** Decode JSON file - the JSON file makes it trivial to hot swap any country's provinces/states */
	public function __construct()
	{
		$this->states = json_decode(file_get_contents(__DIR__ . '/resources/states.json'), true);
	}

	/** Converts initials to a name */
	public function name()
	{
		$initials = strtoupper(ee()->TMPL->fetch_param('state'));

		if (array_key_exists($initials, $this->states))
		{
			return $this->states[$initials];
		}
		else
		{
			return $initials;
		}
	}

	/** Converts a name to initials */
	public function initials()
	{
		$name = ucwords(ee()->TMPL->fetch_param('state'));
		$state = array_search($name, $this->states);

		if (!empty($state))
		{
			return $state;
		}
		else
		{
			return $name;
		}
	}

}

/* End of file pi.us_state.php */