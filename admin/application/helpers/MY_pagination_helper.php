<?php
//分页
function page_config ($method, $id , $total_rows)
{
	$config['base_url'] = site_url("Index/{$method}/{$id}/");
	$config['total_rows'] = $total_rows;
	$config['per_page'] = 5;
	$config['uri_segment'] = 4; //表示第5段url为当前页数
	$config['full_tag_open'] = '<div class="page">';  //整个分页封闭标签
    $config['full_tag_close'] = '</div> ';
    $config['first_url'] = site_url("Index/{$method}/{$id}"); //第一个链接地址
    $config['num_links'] = 2;
    $config['first_link'] = '首页';
    $config['last_link'] = '尾页';
    $config['use_page_numbers'] = true;
    return $config;
}