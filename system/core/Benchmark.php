<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * 一个开源的框架对于php 5.1.6 或者更新
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright		Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Benchmark Class
 * ci 基准类
 *
 * This class enables you to mark points and calculate the time difference
 * between them.  Memory consumption can also be displayed.
 * 这个类使你能制作点和推测他们不同的时间，存储耗尽也可以拿来展示
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/benchmark.html
 */
class CI_Benchmark {

	/**
	 * List of all benchmark markers and when they were added
	 * 当他们被添加基准标记的标记列表
	 *
	 * @var array
	 */
	var $marker = array();

	// --------------------------------------------------------------------

	/**
	 * Set a benchmark marker
	 * 设置一个检测标记
	 *
	 * Multiple calls to this function can be made so that several
	 * execution points can be timed
	 * 多重访问这个函数可以制造多个执行点是同时的
	 *
	 * @access	public
	 * @param	string	$name	name of the marker
	 * @return	void
	 */
	function mark($name)
	{
		$this->marker[$name] = microtime();
	}

	// --------------------------------------------------------------------

	/**
	 * Calculates the time difference between two marked points.
	 * 计算2个标记点的不同时间
	 *
	 * If the first parameter is empty this function instead returns the
	 * {elapsed_time} pseudo-variable. This permits the full system
	 * execution time to be shown in a template. The output class will
	 * swap the real value for this variable.
	 * 如果第一个参数是空的那么就会返回 {elapsed_time} 假的变量，这个允许完全系统执行时间
	 * 去展示在模板中，这个输出类将交换真的值对于这个变量 
	 *
	 * @access	public
	 * @param	string	a particular marked point
	 * @param	string	a particular marked point
	 * @param	integer	the number of decimal places
	 * @return	mixed
	 */
	function elapsed_time($point1 = '', $point2 = '', $decimals = 4)
	{
		if ($point1 == '')
		{
			return '{elapsed_time}';
		}

		if ( ! isset($this->marker[$point1]))
		{
			return '';
		}

		if ( ! isset($this->marker[$point2]))
		{
			$this->marker[$point2] = microtime();
		}

		list($sm, $ss) = explode(' ', $this->marker[$point1]);
		list($em, $es) = explode(' ', $this->marker[$point2]);

		return number_format(($em + $es) - ($sm + $ss), $decimals);
	}

	// --------------------------------------------------------------------

	/**
	 * Memory Usage
	 * 存储习惯
	 *
	 * This function returns the {memory_usage} pseudo-variable.
	 * This permits it to be put it anywhere in a template
	 * without the memory being calculated until the end.
	 * The output class will swap the real value for this variable.
	 * 这个函数返回 {memory_usage} 伪变量
	 * 这个允许它去抛出它在模板的任何地方
	 * 除非这个内参是计算在结束之前
	 * 这个输出类将交换真的变量值
	 *
	 * @access	public
	 * @return	string
	 */
	function memory_usage()
	{
		return '{memory_usage}';
	}

}

// 用来做断点测试
// END CI_Benchmark class

/* End of file Benchmark.php */
/* Location: ./system/core/Benchmark.php */
