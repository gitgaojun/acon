<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 分页类
 */


class page
{
	public $num;//总数量
	public $page;//当前页，页码
	public $pages;//每页数量
	public $nums;//总的页数
	public $page_preg = '上一页';
	public $page_next = '下一页';

	/**
	 * 返回分页样式
	 * @auther jun
	 * @param  int $page 当前页码
	 * @param  int $num  总数
	 * @param  int $pages 每页数量,默认每页10条数据 
	 * @return string 分页样式字符串
	 */
	public function get_page($page,$num,$pages=10)
	{
		$this->page = (int)$page;
		$this->num = (int)$num;
		$this->pages = (int)$pages;
		$this->nums = ceil($num/$pages);
		$html_page = '';
		$page_preg = $this->get_preg($this->page, $this->nums);
		$page_next = $this->get_next($this->page, $this->nums);
		$html_page .= $page_preg;
		for($i=1;$i<$this->nums;++$i)
		{
			// 当为当前页的时候 class = 'cpage'
			$cpage = $this->page === $i ? 'class="cpage"' : ''; 
			$html_page .= '<li '.$cpage.'><a href="?page='.$i.'">'.$i.'</a></li>';
		}
		$html_page .= $page_next;
		var_dump($html_page);exit;
		return $html_page;
	}

	/**
	 * 返回上一页
	 * @auther jun
	 * @param int $page 当前页码
	 * @param int $nums 总的页数
	 * @return string
	 */
	protected function get_preg($page=1, $nums)
	{
		$page_preg = '';
		if($page === 1)
		{
			$page_preg .= '';
		}else
		{
			$page_preg .= '<li><a href="?page='.($page-1).'">'.上一页.'</a></li>';
		}
		
		return $page_preg; 
	}

	
	/**
	 * 返回下一页
	 * @auther jun
	 * @param int $page 当前页码
	 * @param int $nums 总的页数
	 * @return string
	 */
	protected function get_next($page=1, $nums)
	{
		$page_next = '';
		if($page === $nums)
		{
			$page_next .= '';
		}else
		{
			$page_next .= '<li><a href="?page='.($page+1).'">'.下一页.'</a></li>';
		}
		echo $page_next;exit;	
		return $page_next; 
	}

}
