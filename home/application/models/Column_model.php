<?php
class Column_model extends CI_Model{
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * 板块首页
	 * @return [type] [description]
	 */
	public function get_columns()
	{
		$query = $this->db->select('id,name')->get('categorys');
		return $query->result_array();
	}

	/**
	 * 获得帖子列表信息
	 * @return [type] [description]
	 */
	public function get_post_list ($id=0, $page=1, $page_size=5, $page_count=1, $top_count=0, $top_id=array(),$top_list=array() )
	{	
		if ($page <= 1) {
	    	//剩余首页非置顶帖信息
	    	$offset = 0;
	    } else if ($page > $page_count) {
    		$offset = $page_size*($page_count-1);
    		$top_count = 0;
    		$top_list = array();
	    } else {
			$offset = $page_size*($page-1);
			$top_count = 0; //置顶帖数量
			$top_list = array();
	    }
    	$list = $this->db->select('id,user_id,cate_id,title,reply_num,topdated,is_ban,update_dated')->where('cate_id',$id)->where_not_in('id', $top_id)->order_by('update_dated','desc')->get('posts', $page_size-$top_count, $offset)->result_array();
	    //合并数据
		$data = $this->handleList($list, $top_list);
	    return $data;
	}

	/**
	 * 处理二维数组数据
	 * @param  array  $list [description]
	 * @return [type]       [description]
	 */
	private function handleList ($list = array(), $top_list = array())
	{	
		//配置对应的hash表
	    $reply_info = $this->db->select('post_id,user_id,max(dated) as reply_dated')->group_by('post_id')->get('replys')->result_array();
    	$user_info = $this->db->select('id,nickname')->get('users')->result_array();
    	$reply_dated_hash = array_column($reply_info, 'reply_dated', 'post_id'); // 回复post_id---reply_dated hash表
    	$user_hash = array_column($user_info, 'nickname', 'id');   //用户id---nickname hash表
    	$reply_user_hash = array_column($reply_info, 'user_id', 'post_id'); //回复post_id---user_id  hash表
		if (empty($top_list)) {
			foreach ($list as $v) {
	    		$v['user_name'] = array_key_exists($v['user_id'],$user_hash) ? $user_hash[$v['user_id']] : ''; //会有不存在的键值对应
	    		$v['reply_dated'] = array_key_exists($v['id'],$reply_dated_hash) ? $reply_dated_hash[$v['id']] : '';
	    		$reply_user_id = array_key_exists($v['id'],$reply_user_hash) ? $reply_user_hash[$v['id']] : 0; 
	    		$v['reply_user_name'] = array_key_exists($reply_user_id,$user_hash) ? $user_hash[$reply_user_id] : '';
	    		$data[] = $v;
	    	}
	    	return $data;
		} else {
			foreach ($top_list as $v) {
		    		$v['user_name'] = array_key_exists($v['user_id'],$user_hash) ? $user_hash[$v['user_id']] : ''; //会有不存在的键值对应
		    		$v['reply_dated'] = array_key_exists($v['id'],$reply_dated_hash) ? $reply_dated_hash[$v['id']] : '';
		    		$reply_user_id = array_key_exists($v['id'],$reply_user_hash) ? $reply_user_hash[$v['id']] : 0; 
		    		$v['reply_user_name'] = array_key_exists($reply_user_id,$user_hash) ? $user_hash[$reply_user_id] : '';
		    		$data[] = $v;
		    	}
	    	foreach ($list as $v) {
	    		$v['user_name'] = array_key_exists($v['user_id'],$user_hash) ? $user_hash[$v['user_id']] : ''; //会有不存在的键值对应
	    		$v['reply_dated'] = array_key_exists($v['id'],$reply_dated_hash) ? $reply_dated_hash[$v['id']] : '';
	    		$reply_user_id = array_key_exists($v['id'],$reply_user_hash) ? $reply_user_hash[$v['id']] : 0; 
	    		$v['reply_user_name'] = array_key_exists($reply_user_id,$user_hash) ? $user_hash[$reply_user_id] : '';
	    		$data[] = $v;
	    	}
	    	return $data;
		}
	} 

	/**
	 * 获取置顶帖信息
	 * @return [type] [description]
	 */
	public function get_top_list($id, $page_size)
	{	
		return $this->db->select('id,user_id,cate_id,title,reply_num,topdated,is_ban,update_dated')->where('topdated !=', '0000-00-00 00:00:00')->where('cate_id', $id)->order_by('topdated', 'desc')->get('posts',$page_size)->result_array();
	}

	/**
	 * 获取对应模块的帖子列表，非置顶
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_list($id, $page_size, $page ,$top_id = 0)
	{
		$offset = $page_size*($page-1);
		return $this->db->select('id,user_id,cate_id,title,reply_num,topdated,is_ban,update_dated')
			->where('cate_id',$id)
			->where_not_in('id', $top_id)
			->order_by('update_dated','desc')
			->get('posts', $page_size, $offset)
			->result_array();
	}

	/**
	 * 获得帖子对应的最新回复信息
	 * @return [type] [description]
	 */
	public function get_reply_info ($id)
	{
		return $this->db->select('user_id, dated')->where('post_id', $id)->order_by('dated desc')->get('replys', 1)->row_array();
	}


	/**
	 * 获取模块名称
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_column_title($id)
	{
		$query = $this->db->select('name')->where('id', $id)->get('categorys');
		return $query->row_array();
	}

	/**
	 * 发帖
	 */
	public function add_post($data)
	{	
		$post_data  = array(
			'user_id' => $data['user_id'],
			'cate_id' => $data['cate_id'],
			'title' => $data['title'],
			'dated' => $data['dated'],
			'update_dated' => $data['update_dated'],
			'ip' => $data['ip'],
			);
		$res = $this->db->insert('posts',$post_data);
		if ($res) {
			$post_content_data  = array(
				'post_id' => $this->db->insert_id(),
				'content' => $data['content'],
				'dated' => $data['dated'],
				);
			$res2 = $this->db->insert('post_contents',$post_content_data);
			$res3 = $this->db->set('post_num', 'post_num+1',false)->set('dated', $data['dated'])->where('id', $data['cate_id'])->update('categorys');
			if ($res2 && $res3) {
				return true;
			}
		}
		return false;
	}

	/**
	 * 帖子详情
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function post_detail($id)
	{
		$query = $this->db->select('id,user_id,cate_id,title,reply_num,is_ban,update_dated')->where('id', $id)->get('posts');
		$data1 = $query->row_array();
		$data2 = $this->db->select('content')->where('post_id', $data1['id'])->get('post_contents')->row_array();
		$data1['content'] = $data2['content'];
		$user_info = $this->db->select('id,nickname')->get('users')->result_array();
		$user_hash = array_column($user_info, 'nickname', 'id');  
		$data1['user_name'] = array_key_exists($data1['user_id'], $user_hash) ? $user_hash[$data1['user_id']] : ''; 
		return $data1;
	}

	/**
	 * 帖子回复
	 * @return [type] [description]
	 */
	public function reply_post($data)
	{	
		$res = $this->db->insert('replys', $data);
		$res2 = $this->db->set('reply_num','reply_num + 1',false)->where('id', $data['post_id'])->update('posts');
		if ($res && $res2) {
			return true;
		}
		return false;
	}

	/**
	 * 回复列表
	 * @return [type] [description]
	 */
	public function reply_list($id, $page_size, $page)
	{
		$offset = $page_size*($page-1);
		$data =  $this->db->select('id,user_id,content, dated')->where('post_id', $id)->order_by('dated','asc')->get('replys', $page_size, $offset)->result_array();
		$user_info = $this->db->select('id,nickname')->get('users')->result_array();
		$user_hash = array_column($user_info, 'nickname', 'id');   //用户id---nickname hash表
		$info = array();
		foreach ($data as $v) {
			$v['reply_user_name'] = array_key_exists($v['user_id'], $user_hash) ? $user_hash[$v['user_id']] : '';
			$info[] = $v;
		}
		return $info;
	}	

	/**
	 *结帖操作
	 * @return [type] [description]
	 */
	public function end_post($id)
	{	
		$info = $this->db->select('is_ban')->where('id', $id)->get('posts',1)->row_array();
		if ($info['is_ban'] == 0) {
			$res = $this->db->set('is_ban', 1)->where('id', $id)->update('posts');
		} else {
			$res = $this->db->set('is_ban', 0)->where('id', $id)->update('posts');
		}
		if ($res == true) {
			return true;
		}
		return false;
	}

	/**
	 * 根据帖子id获取模块id
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_cate_id($id) 
	{
		return $this->db->select('cate_id')->where('id', $id)->get('posts')->row_array();
	}

	/**
	 * 置顶
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function top_post($id)
	{
		if ($this->db->set('topdated', date('Y-m-d H:i:s', time()))->where('id', $id)->update('posts')) {
			return true;
		}
		return false;
	}

	/**
	 * 删帖
	 * @return [type] [description]
	 */
	public function delete_post($id)
	{
		if ($this->db->where('id', $id)->delete('posts')) {
			$this->db->where('post_id', $id)->delete('post_contents');
			$this->db->where('post_id', $id)->delete('replys');
			return true;
		}
		return false;
	}

	/**
	 * 修改帖子
	 * @return [type] [description]
	 */
	public function edit_post()
	{	
		$data['id'] = $this->input->post('id', TRUE);
		$data['title'] = $this->input->post('title', TRUE);
		$data['update_dated'] = date('Y-m-d H:i:s',time());
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		if ($this->db->where('id', $data['id'])->update('posts', $data)) {
			$data['content'] = $this->input->post('content', TRUE);
			$this->db->where('post_id', $data['id'])->set('content', $data['content'])->set('dated', $data['update_dated'])->update('post_contents');
			return true;
		}
		return false;
	}

	/**
	 * 获得导航地址
	 * @return [type] [description]
	 */
	public function get_leading_url($method = 'home', $id = 0)
	{
		if ($method == 'catList') {
			$cate_info = $this->db->select('id,name')->where('id', $id)->get('categorys', 1)->row_array();
			$data['name'] = $cate_info['name'];
			$data['id'] = $cate_info['id'];
			return $data;
		}
		if ($method == 'postDetail' || $method == 'editPost') {
			$post_info = $this->db->select('id,cate_id, title')->where('id', $id)->get('posts', 1)->row_array();
			$cate_info = $this->db->select('id,name')->where('id', $post_info['cate_id'])->get('categorys', 1)->row_array();
			$data['cate_name'] = $cate_info['name'];
			$data['cate_id'] = $cate_info['id'];
			$data['name'] = $post_info['title'];
			$data['id'] = $post_info['id'];
			return $data;
		}
		if ($method == 'register') {
			$data['name'] = '用户注册';
			return $data;
		}
		if ($method == 'loginSub') {
			$data['name'] = '用户登录';
			return $data;
		} 
	}

	/**
	 * 用户注册
	 * @return [type] [description]
	 */
	public function register ($data) 
	{
		$data['dated'] = date('Y-m-d H:i:s',time());
		$res = $this->db->insert('users', $data);
		if ($res == true) {
			return true;
		}
		return false;
	}

	/**
	 * 用户登录
	 * @return [type] [description]
	 */
	public function login ($data) 
	{
		$arr = array('username' => $data['username'], 'password' => $data['password']);
		$res = $this->db->where($arr)->count_all_results('users');
		if ($res > 0) {
			return true;
		} 
		return false;
	}

	/**
	 * 获取用户信息id和nickname,
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function get_userinfo ($id = 0, $username = '')
	{
		$info = $this->db->select('id, nickname')->where('id', $id)->or_where('username', $username)->get('users',1)->row_array();
		return $info;
	}

	/**
	 * 判断用户名是否已被占用
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function unique_username ($username) 
	{
		$res = $this->db->where('username', $username)->count_all_results('users');
		if ($res > 0) {
			return false;
		}
		return true;
	}

	/**
	 * 验证登录
	 * @return [type] [description]
	 */
	public function checkLogin ($id = 0,$token = '')
	{
		$info = $this->db->select('nickname')->where('id', $id)->get('users',1)->row_array();
		if (empty($info)) {
			return false;
		} else {
			$str = md5($id.$info['nickname'].'salt');
			if ($str == $token) {
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	 * 获取三天内热帖信息
	 * @return [type] [description]
	 */
	public function getHotPosts ($id = 0, $page = 1, $page_size = 5, $page_count = 1)
	{	
		if ($page <= 1) {
	    	//剩余首页非置顶帖信息
	    	$offset = 0;
	    } else if ($page > $page_count) {
    		$offset = $page_size*($page_count-1);
	    } else {
			$offset = $page_size*($page-1);
	    }
		$list = $this->db->select('id,user_id,cate_id,title,reply_num,topdated,is_ban,update_dated')
				->where('cate_id', $id)
				->where('update_dated >', date('Y-m-d H:i:s', time()-3600*24*3))
				->order_by('reply_num', 'desc')
				->order_by('update_dated', 'desc')
				->get('posts', $page_size, $offset)
				->result_array();
		$data = $this->handleList($list);		
		return $data;
	}
}