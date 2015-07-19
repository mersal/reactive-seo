<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Xtendsys\PrestoClient;
use \Xtendsys\PrestoException;

class Seo extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->stopwords = array("a","about","above","after","again","against","all","am","an","and","any","are","aren't","as","at","be","because","been","before","being","below","between","both","but","by","can't","cannot","could","couldn't","did","didn't","do","does","doesn't","doing","don't","down","during","each","few","for","from","further","had","hadn't","has","hasn't","have","haven't","having","he","he'd","he'll","he's","her","here","here's","hers","herself","him","himself","his","how","how's","i","i'd","i'll","i'm","i've","if","in","into","is","isn't","it","it's","its","itself","let's","me","more","most","mustn't","my","myself","no","nor","not","of","off","on","once","only","or","other","ought","our","ours","ourselves","out","over","own","same","shan't","she","she'd","she'll","she's","should","shouldn't","so","some","such","than","that","that's","the","their","theirs","them","themselves","then","there","there's","these","they","they'd","they'll","they're","they've","this","those","through","to","too","under","until","up","very","was","wasn't","we","we'd","we'll","we're","we've","were","weren't","what","what's","when","when's","where","where's","which","while","who","who's","whom","why","why's","with","won't","would","wouldn't","you","you'd","you'll","you're","you've","your","yours","yourself","yourselves");
    }
	
	function get_seo_records($url='', $timeframe='')
	{
		$data = $this->get_url_content($url);
		$sql_list = "";
		$do_union = FALSE;

		if (isset($data["error"]['curl']))
			return $data;

		if ($data["keywords_list"] == "" && $data["description_list"] == "") {
			$data["error"]["seo_result"] = "no meta keywords or description found.";
			return $data;
		}

		if ($data["keywords_list"] != "") {
			$keywords_list = preg_split("/[\s,]+/", strtolower($data["keywords_list"]));
			if (in_array("news", $keywords_list))
				$do_union = TRUE;
				
			foreach ($keywords_list as $keyword) {
				$keyword = trim($keyword);
				$keyword = preg_replace('/\W+/', '', $keyword);
				if (!in_array($keyword, $this->stopwords))
					$sql_list .= "'" . $keyword . "'," ;
			}
		} else {
			if ($data["description_list"] != "") {
				$keywords_list = preg_split("/[\s,]+/", strtolower($data["description_list"]));
				if (in_array("news", $keywords_list))
					$do_union = TRUE;				
				foreach ($keywords_list as $keyword) {
					$keyword = trim($keyword);
					$keyword = preg_replace('/\W+/', '', $keyword);
					if (!in_array($keyword, $this->stopwords))
						$sql_list .= "'" . $keyword . "'," ;
				}
			}
		}
		
		$sql_list = rtrim($sql_list, ",");
		$sql = "select distinct term_trending, meta_term,{$timeframe} as term_count from seo_dict_merge where {$timeframe} > 0 and meta_term in (" . $sql_list . ")";
		$sql .= " order by term_count desc";
		switch ($this->config->item('use_database')) {
    	case 'mysql':
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$i = 0;
				$x = array();
				foreach ($query->result() as $row) {
					$x[$i][0] = $row->term_trending;
					$x[$i][1] = $row->meta_term;
					$x[$i][2] = $row->term_count;
					$i++;
				}
				$data["seo_result"] = json_encode($x);
			} else {
				$data["error"]["seo_result"] = "no matches found.";
			}	
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
			$data["seo_result"] = $presto->GetData();
			
			if (empty($data["seo_result"])) {
				$data["error"]["seo_result"] = "no matches found.";
			} else {
				$data["seo_result"] = json_encode($data["seo_result"]);
			}
			return $data;
        	break;
		}
	}


	function get_url_content($url='')
	{

		foreach (array("keywords_list", "description_list", "og:type","og:title", "og:image", "og:url","og:site_name","og:description") as $og_var) {
			$data[$og_var] = "";
			$data['is_found'][$og_var] = 0;
		}
		$data["og:url"] = $url;
		$data["og:type"] = "website";

		$this->load->library('curl');
		$this->curl->option(CURLOPT_TIMEOUT, 60); 
		$this->curl->option(CURLOPT_SSL_VERIFYPEER,false);
		
		$this->load->library('simplexml');
		$return_str = '';
	
		$response = $this->curl->simple_get($url);
		if($response) {
			$response = str_ireplace("<", "\n<", $response);
			$lines = explode("\n", $response);
			foreach ($lines as $line) {
				$line = trim($line);        
				$pos = strpos($line, "<meta ");
				if ($pos === false) {
					continue;
				} else {
					$xmlData = $this->simplexml->xml_parse($line);
					if (isset($xmlData["@attributes"]["name"])) {
						if ($xmlData["@attributes"]["name"] == "keywords") {
							if (isset($xmlData["@attributes"]["content"])) {
								$data["keywords_list"] = $xmlData["@attributes"]["content"];
								break;
							}
						}
					}
				}
			}

			foreach ($lines as $line) {
				$line = trim($line);        
				$pos = strpos($line, "<meta ");
				if ($pos === false) {
					continue;
				} else {
					$xmlData = $this->simplexml->xml_parse($line);
					if (isset($xmlData["@attributes"]["name"])) {
						if ($xmlData["@attributes"]["name"] == "description") {
							if (isset($xmlData["@attributes"]["content"])) {
								$data["description_list"] = $xmlData["@attributes"]["content"];
								$data["og:description"] = $xmlData["@attributes"]["content"];
								break;							
							}
						}	
					}
				}
			}
						
			foreach ($lines as $line) {
				$line = trim($line);        
				$pos = strpos($line, "<title>");
				if ($pos === false) {
					continue;
				} else {
					$xmlData = $this->simplexml->xml_parse($line);
					if (isset($xmlData["@content"])) {
						$data["og:title"] = $xmlData["@content"];
						$data["og:site_name"] = $xmlData["@content"];
						break;
					}
				}
			}

			foreach ($lines as $line) {
				$line = trim($line);        
				$pos = strpos($line, "<img ");
				if ($pos === false) {
					continue;
				} else {
					$xmlData = $this->simplexml->xml_parse($line);
					$pattern = "/(.png|.jpg|.gif|.jpeg|.svg)/i";
					$pattern2 = "/^(http:|https:)\/\//i";
					$pattern3 = "pixel";

					if (isset($xmlData["@attributes"])) {
					foreach ($xmlData["@attributes"] as $key=>$value) {
						if (preg_match($pattern, $value, $matches) > 0 && preg_match($pattern2, $value, $matches) > 0 && stristr($value, $pattern3) == FALSE) {
							$data["og:image"] = $value;
							break;
						}						
					}
					}
				}
			}

			foreach (array("og:type","og:title", "og:image", "og:url","og:description","og:site_name") as $og_var) {
				foreach ($lines as $line) {
					$line = trim($line);        
					$pos = strpos($line, "<meta ");
					if ($pos === false) {
						continue;
					} else {
						$xmlData = $this->simplexml->xml_parse($line);
						if (isset($xmlData["@attributes"]["property"])) {
							if ($xmlData["@attributes"]["property"] == $og_var) {
								if (isset($xmlData["@attributes"]["content"])) {
									if ($xmlData["@attributes"]["content"]) {
										$data[$og_var] = $xmlData["@attributes"]["content"];
										$data['is_found'][$og_var] = 1;
									}
									break;							
								}
							}	
						}
					}
				}
			}			
			$data['url'] = str_ireplace("http://", "", $url);	
			return $data;
		} else {
			$data["error"]['curl'] = $this->curl->error_string;
			return $data;
		}
	}
}

?>
