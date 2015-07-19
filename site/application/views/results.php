<?php
if (isset($seo_records)) 
{
	$trending_list = array();
	if (!isset($seo_records['error']['seo_result'])) {
		$seo_records['seo_result'] = json_decode($seo_records['seo_result'], TRUE);
		foreach ($seo_records['seo_result'] as $row) {
			if (!isset($trending_list[$row[0]]))
				$trending_list[$row[0]] = 1;
			if (!isset($trending_list_keywords[$row[1]]))
				$trending_list_keywords[$row[1]] = 1;
		}
	}
	if (isset($seo_records['keywords_list']) || isset($seo_records['description_list']))
	{ 
?>
<div class="post">
	<h2 class="headergrey">current <span style="font-style:italic;">&lt;meta&gt; content</span></h2>
		<p>&lt;meta name="keywords" content="<?=$seo_records['keywords_list']?>" /&gt;</p>
		<p>&lt;meta name="description" content="<?=$seo_records['description_list']?>" /&gt;</p>

	<h2 class="headergrey">recommended &lt;meta&gt; Open Graph update</h2>
		<p>&lt;meta name="og:description"  content="<span class="<?php if ($seo_records['is_found']['og:description']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:description']?></span>
			
<?php 
 			$trending_list_count = count($trending_list);
			$y = 1;
			if ($seo_records['og:description'] != '') {
				if(substr($seo_records['og:description'], -1) == '.')
					echo ' ';
				else
					echo ", ";
			} else {
				if (isset($trending_list_keywords)) {
					foreach ($trending_list_keywords as $key=>$value)
						echo "<span><a href='#' class='trending_list' title='{$key}'>{$key}</a>, </span>";
				}
			}
			foreach ($trending_list as $key=>$value) {
				if ($seo_records['keywords_list'] == '')
?><span><a href="#" class='trending_list' title="<?=$key?>"><?=$key?></a><?php if ($y < $trending_list_count) { echo ", "; } ?>
<?php
				echo '</span>';					
				$y++;
				$show_comma = TRUE;
			} 
?>
" /&gt;</p>
		<p>&lt;meta property="og:site_name" content="<span class="<?php if ($seo_records['is_found']['og:site_name']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:site_name']?></span>"/&gt;
		<p>&lt;meta property="og:title" content="<span class="<?php if ($seo_records['is_found']['og:title']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:title']?></span>"/&gt;
		<p>&lt;meta property="og:url" content="<span class="<?php if ($seo_records['is_found']['og:url']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:url']?></span>"/&gt;
		<p>&lt;meta property="og:type" content="<span class="<?php if ($seo_records['is_found']['og:type']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:type']?></span>"/&gt;
		<p>&lt;meta property="og:image" content="<span class="<?php if ($seo_records['is_found']['og:image']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:image']?></span>"/&gt;

	<h2 class="headergrey">recommended &lt;meta&gt; keywords update</h2>

<?php if (isset($seo_records['error']['seo_result'])) { ?>
	<h3 class="postmargin" style='text-align:center;'><?=$seo_records['error']['seo_result']?></h3>
<?php } else { ?>
		<p>&lt;meta name="keywords" content="<?=$seo_records['keywords_list']?>
<?php 
 			$trending_list_count = count($trending_list);
			$y = 1;
			if ($seo_records['keywords_list'] != '')
				echo ", ";
			else {
				if (isset($trending_list_keywords)) {
					foreach ($trending_list_keywords as $key=>$value)
						echo "<span><a href='#' class='trending_list' title='{$key}'>{$key}</a>, </span>";
				}
			}
			foreach ($trending_list as $key=>$value) {
				if ($seo_records['keywords_list'] == '')
?><span><a href="#" class='trending_list' title="<?=$key?>"><?=$key?></a><?php if ($y < $trending_list_count) { echo ", "; } ?>
<?php
				echo '</span>';					
				$y++;
				$show_comma = TRUE;
			} 
?>
" /&gt;</p>


</div>
<?php 
		$data['seo_result'] = $seo_records['seo_result'];
		$this->load->view('results_detail_pie',$data);
		}
	}	
}	
?>
</div>
