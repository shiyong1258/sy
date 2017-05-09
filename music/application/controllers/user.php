<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
		class User extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('user_model');
		}
		
			
		public function login(){
			$this->load->view("html/login.php");
		}
		public function do_login(){
			$name=$this->input->post('name');
			$pass=$this->input->post('pass');
			$rs=$this->user_model->do_login($name,$pass);
			if($rs){
				$arr=array(
					'id'=>$rs->uid,
					'name'=>$rs->uname,
					'logged_in' => TRUE,
				);
				$this->session->set_userdata($arr);
				header("Refresh:0;url=index");
				echo"<script>alert('登录成功')</script>";
				
			}else{
				echo"<script>alert('对不起，用户名，密码输入错误!');history.back();</script>";
			}	
			
		}
		
		public function reg(){
			$this->load->view("html/reg.php");
		}
		
		public function check(){
			header("Access-Control-Allow-Origin:*");
			$name=$this->input->post('uemail');
			$rs=$this->user_model->get_check($name);
			if($rs){
				echo "success";
			}
		}	
		
		public function do_reg(){
			$name=$this->input->post('name');
			$zname=$this->input->post('zname');
			$pass=$this->input->post('pass1');
			$rpass=$this->input->post('pass2');
			if($pass==$rpass){
				$rs=$this->user_model->checkname($name);
			if($rs){
				redirect("user/reg");
			}else{
				$rs=$this->user_model->set_insert($zname,$name,$pass);
				if($rs){
					redirect("user/login");
				}	
			}	
			}else{
				redirect("user/reg");
			}
			
		}
		
		
		
		public function index(){
			$rs=$this->user_model->do_singer();
			$arr['singer']=$rs;
			$rs1=$this->user_model->get_album();
			$arr['album']=$rs1;
			$this->load->view("html/index.php",$arr);
		}
		public function unindex(){
			$rs=$this->user_model->do_singer();
			$arr['singer']=$rs;
			$rs1=$this->user_model->get_album();
			$arr['album']=$rs1;
			$this->load->view("html/unindex.php",$arr);
		}
		
		public function lists(){
			$rs=$this->user_model->do_lists();
			$arr['lists']=$rs;
			$this->load->view("html/list.php",$arr);
		}
		public function list1(){
			$rs=$this->user_model->do_list1();
			$arr['lists']=$rs;
			$this->load->view("html/list1.php",$arr);
		}
		
		public function listen(){
			$uid = $this->session->userdata('id');
			$id=$this->input->get('id');
			
			if($id){
				$rs1=$this->user_model->do_listen_hits($id);
			} 
				$r=$this->user_model->get_all_pl($id);
				
				$rs=$this->user_model->do_listen($id);
				$arr['pl']=$r;
				$arr['listen']=$rs;
				$arr['id']=$id;
				$this->load->view("html/listen.php",$arr);
		}
		
		public function search(){
			$search=$this->input->post('search');
			if($search){
				$rs=$this->user_model->do_search1($search);
				if($rs){
					$rs1=$this->user_model->do_search_shits($search);
				}
			}else{
				$rs=$this->user_model->do_search();
			}
			$arr['search']=$rs;
			$this->load->view("html/search.php",$arr);
		}
		
		public function collect(){
			$uid = $this->session->userdata('id');//用户id
			$rs = $this->user_model->get_collect($uid);
			$arr['all']=$rs;
			$this->load->view("html/collect.php",$arr);
		}
		public function album(){
			$id=$this->input->get('id');
			$rs=$this->user_model->do_album($id);
			$arr['album']=$rs;
			$this->load->view("html/album.php",$arr);
		}
		
		public function album_detail(){
			$id=$this->input->get('id');
			$rs=$this->user_model->do_album_d($id);
			$rs1=$this->user_model->do_album_m($id);
			$arr['albumd']=$rs;
			$arr['albumm']=$rs1;
			$this->load->view("html/album_detail.php",$arr);
		}
		
		
		public function singer(){
			$rs=$this->user_model->do_singer();
			$arr['singer']=$rs;
			$this->load->view("html/singer.php",$arr);
		}
		public function do_collect(){
			$uid = $this->session->userdata('id');//用户id
			$mid=$this->input->get('id');
			$result = $this->user_model->check_collect($uid,$mid);
			 
			if(!$result){
				$rs = $this->user_model->collected($uid,$mid);
				echo"<script>alert('收藏成功');history.back();</script>";
				//echo "success";			
				}else{
				
				echo"<script>alert('已收藏，请勿重复添加');history.back();</script>";
				//echo "fail";
			}
		}
		public function do_collected(){
			$uid = $this->session->userdata('id');//用户id
			$mid=$this->input->get('id');
			$result = $this->user_model->check_collect($uid,$mid);
			 
			if(!$result){
				$rs = $this->user_model->collected($uid,$mid);
				header("Refresh:0;url=search");
				echo"<script>alert('收藏成功');</script>";
				//echo "success";			
				}else{
				
				echo"<script>alert('已收藏，请勿重复添加');</script>";
				header("Refresh:0;url=search");
				//echo "fail";
			}
		}
		//collect删除
		public function do_delete(){
			$uid = $this->session->userdata('id');//用户id
			$mid=$this->input->get('mid');//mid
			$rs = $this->user_model->col_delete($uid,$mid);
			if($rs){
				echo json_encode($rs2);
				
			}else{
				echo 'fail';
			}
			
		}
		
		
		/*----------评论代码------------------------------------------------------*/
		
		
		public function pl_con(){
			$uid = $this->session->userdata('id');//用户id
			$id=$this->input->get('xid');//mid
			$pltime= date("Y-m-d");
			$con = $this->input->get('comment');
			$rs = $this->user_model->save_comment($id,$uid,$con,$pltime);
			$rs2 = $this->user_model->get_one($con);
			if($rs){
				echo json_encode($rs2);
			}else{
				echo 'fail';
			}
		}
		public function in(){
			redirect("user/login");
		}
		
	
		
}
?>