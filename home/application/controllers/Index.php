<?php
class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Column_model');
		$this->load->helper('cookie');
	}

	public function home()
	{
		$data['columns'] = $this->Column_model->get_columns();
		$data['leading_url'] = $this->Column_model->get_leading_url();
		$data['post_count_lastday'] = $this->db->like('update_dated', date('Y-m-d', strtotime('-1 day')), 'after')->count_all_results('posts');
		$data['post_count_today'] = $this->db->like('update_dated', date('Y-m-d', time()), 'after')->count_all_results('posts');
		$data['post_count_total'] = $this->db->count_all('posts');
		$data['member_counts'] = $this->db->count_all('users');
		$data['is_login'] = $this->Column_model->checkLogin(get_cookie('id'), get_cookie('token'));
		$this->load->view('global/header.php',$data);
		$this->load->view('Home/homepage.php',$data);
		$this->load->view('global/footer.php',$data);
	}

	/**
	 * 帖子列表
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function catList($id = 0, $page = 1)
	{
		if ($id < 1 || $id > 6) {
			$data['error'] = 1;
		} else {
			$count = 0; //置顶帖数量
		    $top_id[] = 0; //置顶帖id
			//获取三条置顶帖
			$top_list = $this->db->select('id,user_id,cate_id,title,reply_num,topdated,is_ban,update_dated')->where('topdated !=', '0000-00-00 00:00:00')->where('cate_id', $id)->order_by('topdated', 'desc')->get('posts',3)->result_array();
			$count = count($top_list); //置顶帖数量
		    if ($count > 0) {
		    	//获取已经置顶帖的id
		    	$top_id = array_column($top_list, 'id');
		    }
			//制作分页
		    $total_rows = $this->db->where('cate_id', $id)->count_all_results('posts') - $count;
		    $page_count = ceil($total_rows/5); //分页总数
		    $this->load->helper('MY_pagination');
		    $config = page_config($this->router->method,$id,$total_rows);
		    $this->pagination->initialize($config); //初始化分页类
			
		    $data['list'] = $this->Column_model->get_post_list($id, $page, $config['per_page'], $page_count, $count, $top_id, $top_list);
			$data['columns'] = $this->Column_model->get_columns();
			$data['title'] = $this->Column_model->get_column_title($id);
			$data['cate_id'] = $id;
			$data['top_id'] = $top_id;

		}
		//获得导航地址
		$data['leading_url'] = $this->Column_model->get_leading_url($this->router->method, $id);
		//判断是否登录
		$data['is_login'] = $this->Column_model->checkLogin(get_cookie('id'), get_cookie('token'));
		$this->load->view('global/header.php',$data);
 		$this->load->view('Home/listpage.php',$data);
	}

	/**
	 * 发帖
	 */
	public function addPost()
	{
		//@todo 内容 标题
		$data = $this->input->post(NULL,TRUE);
		$data['user_id'] = (int)get_cookie('id');
		$data['cate_id'] = (int)$this->input->post('cate_id', TRUE);
		$data['content'] = (string)$this->input->post('content', TRUE);
		$data['title']  = (string)$this->input->post('title', TRUE);
		$data['dated'] = (string)date('Y-m-d H:i:s',time());
		$data['update_dated'] = (string)$data['dated'];
		$data['ip'] = (string)$this->input->ip_address();
		$msg  = array(
			'state' => 0,
			'info' => '', 
			);
		if(empty(trim($data['title'])) || empty(trim(str_replace( '&nbsp;' , '',$data['content'])))){
			$msg['info'] = '标题或内容不能为空！';
			echo json_encode($msg);
			return;
		} elseif (mb_strlen(trim($data['title'])) < 5 || mb_strlen(trim(str_replace( '&nbsp;' , '',$data['content']))) < 5) {
			$msg['info'] = '标题或内容长度不能低于5！';
			echo json_encode($msg);
			return;
		} elseif (mb_strlen(trim($data['title'])) > 20) {
			$msg['info'] =  '标题长度不能大于20！';
			echo json_encode($msg);
			return;
		} elseif (mb_strlen(trim(str_replace( '&nbsp;' , '',$data['content']))) > 1000) {
			$msg['info'] =  '内容长度不能大于1000！';
			echo json_encode($msg);
			return;
		}
		//判断标题是否存在
		$title_exist = $this->db->select('id')->where('title', $data['title'])->get('posts', 1)->row_array();
		if (count($title_exist) == 1) {
			$msg['info'] = '帖子已存在！';
			echo json_encode($msg);
			return;
		} 

		$res = $this->Column_model->add_post($data);
		if ($res) {
			$msg['state'] = 1;
			$msg['info'] = '发帖成功！';
			echo json_encode($msg);
			return;
		}
	}

	/**
	 * 帖子详情
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function postDetail($id, $page = 1)
	{	
		$res = $this->db->where('id', $id)->count_all_results('posts');
		if ($res == 0) {
			$data['error'] = 1;
		} else {
			//制作分页
			$total_rows = $this->db->where('post_id', $id)->count_all_results('replys');
		    $this->load->helper('MY_pagination');
		    $config = page_config($this->router->method,$id,$total_rows);
		    $this->pagination->initialize($config); //初始化分页类

			$data['info'] = $this->Column_model->post_detail($id); //帖子信息

			$count = 0; //置顶帖数量
		    $top_id[] = 0; //置顶帖id
		    $top_list = $this->Column_model->get_top_list($data['info']['cate_id'], 3);//获取三条置顶帖
		    $count = count($top_list); //置顶帖数量
		    if ($count > 0) {
		    	//获取已经置顶帖的id
		    	$top_id = array_column($top_list, 'id');
		    }

			$data['top_id'] = $top_id;
			
			//获得回复信息
			$data['reply_list'] = $this->Column_model->reply_list($id, $config['per_page'], $page);
			//获得导航地址
			$data['leading_url'] = $this->Column_model->get_leading_url($this->router->method, $id);
		}
		$data['is_login'] = $this->Column_model->checkLogin(get_cookie('id'), get_cookie('token'));	
		$this->load->view('global/header.php',$data);
		$this->load->view('Home/postpage.php',$data);
	}

	/**
	 * 帖子回复
	 * @return [type] [description]
	 */
	public function replyPost()
	{
		$data = $this->input->post(NULL, TRUE);
		$data['content'] = (string)$this->input->post('content', TRUE);
		$data['user_id'] = (int)get_cookie('id');
		$data['post_id'] = (int)$this->input->post('post_id', TRUE);
		$data['dated'] = (string)date('Y-m-d H:i:s',time());
		$data['ip'] = (string)$this->input->ip_address();
		$msg  = array(
				'state' => 0,
				'info' => '', 
			);
		if(empty(trim(str_replace('&nbsp;', '', $data['content'])))){
			$msg['info'] = '回帖内容不能为空！';
			echo json_encode($msg);
			return;
		} elseif (mb_strlen(trim(str_replace('&nbsp;', '', $data['content']))) < 5) {
			$msg['info'] = '回帖内容长度不能低于5！';
			echo json_encode($msg);
			return;
		} elseif (mb_strlen(trim(str_replace('&nbsp;', '', $data['content']))) > 1000) {
			$msg['info'] = '回帖长度不能大于1000！';
			echo json_encode($msg);
			return;
		} 
		$res = $this->Column_model->reply_post($data); 
		if ($res) {
			$msg['state'] = 1;
			$msg['info'] = '回复成功！';
			echo json_encode($msg);
			return;
		} 
	}

	/**
	 *结帖操作
	 * @return [type] [description]
	 */
	public function endPost($id)
	{	
		if ($this->Column_model->end_post($id)) {
			redirect("Index/postDetail/{$id}");
		}
	}

	/**
	 * 置顶操作
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function topPost($id)
	{
		if ($this->Column_model->top_post($id)) {
			$cate_id = $this->Column_model->get_cate_id($id);
			redirect("Index/catList/{$cate_id['cate_id']}");
		}
	}

	/**
	 * 删帖操作
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function deletePost($id)
	{	
		$cate_id = $this->Column_model->get_cate_id($id);
		if ($this->Column_model->delete_post($id)) {
			redirect("Index/catList/{$cate_id['cate_id']}");
		}
	}

	/**
	 * 修改操作
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function editPost($id = 0)
	{	
		if (!empty($edit_data = $this->input->post(NULL, TRUE))) {
			$msg  = array(
				'state' => 0,
				'info' => '', 
			);
			if(empty(trim($edit_data['title'])) || empty(mb_strlen(trim(str_replace('&nbsp;', '', $edit_data['content']))))){
				$msg['info'] = '标题或内容不能为空！';
				echo json_encode($msg);
				return;
			} elseif (mb_strlen(trim($edit_data['title'])) < 5 || mb_strlen(trim(str_replace('&nbsp;' ,'', $edit_data['content']))) < 5) {
				$msg['info'] = '标题或内容长度不能低于5！';
				echo json_encode($msg);
				return;
			} elseif (mb_strlen(trim($edit_data['title'])) > 20) {
				$msg['info'] =  '标题长度不能大于20！';
				echo json_encode($msg);
				return;
			} elseif (mb_strlen(trim(str_replace('&nbsp;' ,'', $edit_data['content']))) > 1000) {
				$msg['info'] =  '内容长度不能大于1000！';
				echo json_encode($msg);
				return;
			}
			$res = $this->Column_model->edit_post();
			$cate_id = $this->Column_model->get_cate_id($this->input->post('id'));
			if ($res && $cate_id) {
				$msg['state'] = 1;
				$msg['info'] = '修改成功！';
				echo json_encode($msg);
				return;
			}
		}
		$info = $this->Column_model->post_detail($id);
		$data['id'] = $info['id'];
		$data['title'] = $info['title'];
		$data['cate_id'] = $info['cate_id'];
		$data['content'] = $info['content'];
		$data['columns'] = $this->Column_model->get_columns();

		$data['leading_url'] = $this->Column_model->get_leading_url($this->router->method, $id);
		$data['is_login'] = $this->Column_model->checkLogin(get_cookie('id'), get_cookie('token'));
		$this->load->view('global/header.php',$data);
		$this->load->view('Home/editpage',$data);
	}

	/**
	 * 用户注册
	 * [register description]
	 * @return [type] [description]
	 */
	public function register ()
	{
		$data['leading_url'] = $this->Column_model->get_leading_url($this->router->method);
		$data['is_login'] = $this->Column_model->checkLogin(get_cookie('id'), get_cookie('token'));
		$this->load->view('global/header.php',$data);
		$this->load->view('Home/registerpage');
	}

	/**
	 * 用户注册sub
	 * @return [type] [description]
	 */
	public function registerSub ()
	{	
		$data['username'] = (string)$this->input->post('username', TRUE);
		$data['nickname'] = (string)$this->input->post('nickname', TRUE);
		$pwd = (string)$this->input->post('password', TRUE);
		$data['password'] = md5($pwd . 'salt'); 
		$data['sex'] = (int)$this->input->post('sex', TRUE);
		$data['email'] = (string)$this->input->post('email', TRUE);
		$sel_year = (string)$this->input->post('sel_year', TRUE);
		$sel_month = (string)$this->input->post('sel_month', TRUE);
		$sel_day = (string)$this->input->post('sel_day', TRUE);
		$data['birthday'] = $sel_year.'-'.$sel_month.'-'.$sel_day;
		$res = $this->Column_model->unique_username($data['username']);
		if (!$res) {
			echo json_encode(array('state' => 0, 'name' => 'username', 'info' => '用户名已被占用'));return;
		} else if (empty(trim($data['username']))) {
			echo json_encode(array('state' => 0, 'name' => 'username', 'info' => '用户名不能为空'));return;
		} else if (mb_strlen(trim($data['username'])) < 3) {
			echo json_encode(array('state' => 0, 'name' => 'username', 'info' => '用户名长度不能小于3'));return;
		} else if (mb_strlen(trim($data['username'])) > 15) {
			echo json_encode(array('state' => 0, 'name' => 'username', 'info' => '用户名长度不能大于15'));return;
		}

		if (empty(trim($data['password']))) {
			echo json_encode(array('state' => 0, 'name' => 'password', 'info' => '密码不能为空'));return;
		} else if (mb_strlen(trim($data['password'])) < 8) {
			echo json_encode(array('state' => 0, 'name' => 'password', 'info' => '密码长度不能小于8'));return;
		} else if (mb_strlen(trim($data['password'])) > 50) {
			echo json_encode(array('state' => 0, 'name' => 'password', 'info' => '密码长度不能大于50'));return;
		} else if (!preg_match('/[a-zA-Z]+[0-9]+/' , $data['password'])) {
			echo json_encode(array('state' => 0, 'name' => 'password', 'info' => '密码必须以字母开头,包含数字'));return;
		} 

		if (empty(trim($data['nickname']))) {
			echo json_encode(array('state' => 0, 'name' => 'nickname', 'info' => '昵称不能为空'));return;
		} else if (mb_strlen(trim($data['nickname'])) < 3) {
			echo json_encode(array('state' => 0, 'name' => 'nickname', 'info' => '昵称长度不能小于3'));return;
		} else if (mb_strlen(trim($data['nickname'])) > 15) {
			echo json_encode(array('state' => 0, 'name' => 'nickname', 'info' => '昵称长度不能大于15'));return;
		}

		if (empty(trim($data['email']))) {
			echo json_encode(array('state' => 0, 'name' => 'email', 'info' => '邮箱不能为空'));return;
		} else if (mb_strlen(trim($data['email'])) > 50) {
			echo json_encode(array('state' => 0, 'name' => 'email', 'info' => '邮箱长度不能大于50'));return;
		} else if (!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/" , $data['email'])) {
			echo json_encode(array('state' => 0, 'name' => 'email', 'info' => '请输入合法邮箱，例如pww@163'));return;
		}

		$res = $this->Column_model->register($data);
		if ($res) {
			$id = (int)$this->db->insert_id();
			set_cookie('id', $id, 0);
			set_cookie('nickname', $data['nickname'], 0);
			set_cookie('token', md5($id.$data['nickname'].'salt'), 0);
			echo json_encode(array('state' => 1));return;
		} 
		
	}

	/**
	 * 用户登录
	 * @return [type] [description]
	 */
	public function login() 
	{	
		$data['username'] = (string)$this->input->post('username', TRUE);
		$pwd = (string)$this->input->post('password', TRUE);
		$data['password'] = md5($pwd.'salt');
		$rem_state = (int)$this->input->post('rem_state', TRUE);
 		$res = $this->Column_model->login($data);
		if ($res) {
			$this->db->set('last_dated', date('Y-m-d H:i:s' ,time()))->where('username', $data['username'])->update('users');
			$info = $this->Column_model->get_userinfo(0,$data['username']);//这个有问题
			if ($rem_state == 1) {
				set_cookie('id', $info['id'], 3600*24*7);
				set_cookie('nickname', $info['nickname'], 3600*24*7);
				set_cookie('token', md5($info['id'].$info['nickname'].'salt'), 3600*24*7);
			} else {
				set_cookie('id', $info['id'], 0);
				set_cookie('nickname', $info['nickname'], 0);
				set_cookie('token', md5($info['id'].$info['nickname'].'salt'), 0);
			}
			
			echo json_encode(array('state' => 1));
			return;
		} else {
			echo json_encode(array('state' => 3001));
			return;
		}
		
	}

	/**
	 * 注销登录
	 * @return [type] [description]
	 */
	public function logout () 
	{
		delete_cookie('id');
		delete_cookie('nickname');
		delete_cookie('token');
		redirect('Index/home');
	}

	/**
	 * 用户登录页面
	 * @return [type] [description]
	 */
	public function loginSub ()
	{
		$data['leading_url'] = $this->Column_model->get_leading_url($this->router->method);
		$data['is_login'] = $this->Column_model->checkLogin(get_cookie('id'), get_cookie('token'));
		$this->load->view('global/header', $data);
		$this->load->view('Home/loginpage');
	}

	/**
	 * 删除回复
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function deleteReply($post_id, $id) 
	{
		$res = $this->db->where('id', $id)->delete('replys');
		if ($res) {
			redirect("Index/postDetail/{$post_id}");
		}
	}

	/**
	 * 热门帖子
	 * @return [type] [description]
	 */
	public function hotPost ($id=0, $page=1)
	{
		if ($id < 1 || $id > 6) {
			$data['error'] = 1;
		} else {
			//制作分页
		    $total_rows = $this->db->where('cate_id', $id)->where('update_dated >', date('Y-m-d H:i:s', time()-3600*24*3))->count_all_results('posts');
		    $page_count = ceil($total_rows/5); //分页总数
		    $this->load->helper('MY_pagination');
		    $config = page_config($this->router->method,$id,$total_rows);
		    $this->pagination->initialize($config); //初始化分页类
			$data['top_id'] = array();
			$data['list'] = $this->Column_model->getHotPosts($id, $page, $config['per_page'], $page_count);

		}
		//获得导航地址
		$data['leading_url'] = $this->Column_model->get_leading_url($this->router->method, $id);
		//判断是否登录
		$data['is_login'] = $this->Column_model->checkLogin(get_cookie('id'), get_cookie('token'));
		$this->load->view('global/header.php',$data);
 		$this->load->view('Home/listpage.php',$data);
	}
}