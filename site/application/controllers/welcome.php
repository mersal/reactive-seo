<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
	    parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('welcome');
		$this->load->view('footer');
	}
	
	public function submit()
	{
		$this->form_validation->set_error_delimiters('<div class=display_error>','</div>');	
		if ($this->form_validation->run('seo_form') == FALSE)
		{
			$this->load->view('header');
			$this->load->view('welcome');
			$this->load->view('footer');
		}
		else
		{
			$url = $_POST['url'];
			$timeframe = $_POST['timeframe'];
			$data['seo_records'] = $this->seo->get_seo_records($url, $timeframe);	
			$this->load->vars($data);
			$this->load->view('header');
			$this->load->view('welcome');

			if (isset($data['seo_records']['error']['curl']))
				$this->load->view('error');
			else 
				$this->load->view('results_fb');
			$this->load->view('footer');
		}	
	}

	public function about()
	{
		$this->load->view('header');
		$this->load->view('about');
		$this->load->view('footer');
	}

	public function fb_share()
	{
		$this->load->view('fb_share');
	}
	
	public function trends()
	{
		$trend_time_frame = $this->uri->segment(2, 'search_logs_last_day');
		switch ($trend_time_frame) {
    	case 'hour':
			$data['page_title'] = "Last Hour";
			$db_time_frame = "search_logs_last_hour";
			
			break;
    	case 'day':
			$data['page_title'] = "Today";
			$db_time_frame = "search_logs_last_day";
			break;
    	case 'week':
			$data['page_title'] = "This Week";
			$db_time_frame = "search_logs_last_week";
			break;
    	case 'month':
			$data['page_title'] = "This Month";
			$db_time_frame = "search_logs_last_month";
    		break;
		case 'alltime':
			$data['page_title'] = "All Time";
			$db_time_frame = "search_logs_all_time";
    		break;
		default:
			$data['page_title'] = "Today";
			$db_time_frame = "search_logs_last_day";
			break;
		}
		
		$data['trending_topics'] = $this->topic->get_topics($db_time_frame, 25);
		$this->load->vars($data);
		$this->load->view('header');
		$this->load->view('trends');
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */