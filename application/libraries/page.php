<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('content-type:text/html;charset=utf-8;');
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
		$page_p = $this->page_style($this->page,$this->nums);
		$html_page .= $page_p;
		$html_page .= $page_next;
		return $html_page;
	}


	/**
	 * 分页
	 * @auther jun
	 * @param int $page 当前页码
	 * @param int $nums 总页数
	 * @return string  分页
	 */
	protected function page_style($page,$nums)
	{
		$html_page = '';
		$sl = '<li><a>...</a></li>';
		if($page < 6)
		{
			if($nums > 10)
			{
				for( $i=1 ; $i<10 ; ++$i)
				{
					$cpage = (int)$page === (int)$i ? 'class="cpage"' : ''; 
					$html_page .= '<li '.$cpage.'><a href="?page='.$i.'">'.$i.'</a></li>';
				}
				$html_page .= $sl;		
			}
			else
			{
				for( $i=1 ; $i<$nums ; ++$i)
				{
					$cpage = (int)$page === (int)$i ? 'class="cpage"' : ''; 
					$html_page .= '<li '.$cpage.'><a href="?page='.$i.'">'.$i.'</a></li>';
				}
			}
		}
		elseif( 5 < $page )
		{
			if( $nums < 11 )
			{
				
				$html_page .= $sl;
				for( $i=$nums-9 ; $i<$nums ; ++$i)
				{
					$cpage = (int)$page === (int)$i ? 'class="cpage"' : ''; 
					$html_page .= '<li '.$cpage.'><a href="?page='.$i.'">'.$i.'</a></li>';
				}	
			}
			else
			{
				if($nums-10 > $page)
				{
					$html_page .= $sl;
					for( $i=($page-4) ; $i<$page+6 ; ++$i )
					{
						$cpage = (int)$page === (int)$i ? 'class="cpage"' : ''; 
						$html_page .= '<li '.$cpage.'><a href="?page='.$i.'">'.$i.'</a></li>';
					}
					$html_page .= $sl;
				}
				else
				{
					if( $page+5 > $nums )
					{
						for( $i=$nums-10 ; $i<$nums ; ++$i)
						{
							$cpage = (int)$page === (int)$i ? 'class="cpage"' : ''; 
							$html_page .= '<li '.$cpage.'><a href="?page='.$i.'">'.$i.'</a></li>';
						}
					}
					else
					{
						$html_page .= $sl;
						for( $i=($page-5) ; $i<$page+5 ; ++$i )
						{
							$cpage = (int)$page === (int)$i ? 'class="cpage"' : ''; 
							$html_page .= '<li '.$cpage.'><a href="?page='.$i.'">'.$i.'</a></li>';
						}
						$html_page .= $sl;
					}
				}
			}
		}
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
			$page_preg .= '<li><a href="?page='.($page-1).'">上一页</a></li>';
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
			$page_next .= '<li><a href="?page='.($page+1).'">下一页</a></li>';
		}
		return $page_next; 
	}

}
