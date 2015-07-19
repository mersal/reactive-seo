<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Xtendsys\PrestoClient;
use \Xtendsys\PrestoException;

class Topic extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_topics($db_table='', $limit=20)
	{
		$sql = "select distinct term, count_term from {$db_table} where count_term > 0 order by count_term desc LIMIT {$limit}";
		switch ($this->config->item('use_database')) {
    	case 'mysql':
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
				$i = 0;
				$x = array();

				foreach ($query->result() as $row) {
					$x[$i][0] = $row->term;
					$x[$i][1] = $row->count_term;
					$i++;
				}
				$data["topic_result"] = json_encode($x);
				return $data;
        	break;
    	case 'presto':
			require_once(__DIR__ . '/../../scripts/PrestoClient/src/PrestoClient.php');
			$presto = new PrestoClient($this->config->item('presto_url'),$this->config->item('presto_catalog'));
			try {				
				$presto->Query($sql);
			} catch (PrestoException $e) {
				var_dump($e);
			}
			$presto->WaitQueryExec();
			$data["topic_result"] = json_encode($presto->GetData());
			return $data;
        	break;
		}
	}

}
?>
