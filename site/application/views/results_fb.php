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

	$fb_list = $seo_records['og:description'] . ", ";
	foreach ($trending_list as $key=>$value) {
		$fb_list .= "{$key}, ";
	}
	$fb_list = ltrim(rtrim($fb_list, ", "), ", ");
?>
<div class="post">
	<h2 class="headergrey">current <span style="font-style:italic;">&lt;meta&gt; content</span></h2>
		<p>&lt;meta name="keywords" content="<?=$seo_records['keywords_list']?>" /&gt;<br>
		&lt;meta name="description" content="<?=$seo_records['description_list']?>" /&gt;</p>
<iframe src="/fb_share?purl=<?=urlencode($seo_records['url'])?>&pimage=<?php if ($seo_records['is_found']['og:image']==1) { echo urlencode($seo_records['og:image']); } ?>&ptitle=<?php if ($seo_records['is_found']['og:title']==1) { echo urlencode($seo_records['og:title']); } ?>&psummary=<?php if ($seo_records['is_found']['og:description']==1) { echo urlencode($seo_records['og:description']); } ?>" frameborder="0" width="960" height="375" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
	<h2 class="headergrey" style='background-color: #fd948d;'>Updated &lt;meta&gt; Open Graph</h2>
<iframe src="/fb_share?purl=<?=urlencode($seo_records['url'])?>&pimage=<?=urlencode($seo_records['og:image'])?>&ptitle=<?=urlencode($seo_records['og:title'])?>&psummary=<?=urlencode($fb_list)?>" frameborder="0" width="960" height="375" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
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
" /&gt;<br>
		&lt;meta property="og:site_name" content="<span class="<?php if ($seo_records['is_found']['og:site_name']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:site_name']?></span>"/&gt;
		<br>&lt;meta property="og:title" content="<span class="<?php if ($seo_records['is_found']['og:title']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:title']?></span>"/&gt;
		<br>&lt;meta property="og:url" content="<span class="<?php if ($seo_records['is_found']['og:url']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:url']?></span>"/&gt;
		<br>&lt;meta property="og:type" content="<span class="<?php if ($seo_records['is_found']['og:type']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:type']?></span>"/&gt;
		<br>&lt;meta property="og:image" content="<span class="<?php if ($seo_records['is_found']['og:image']==0) {?> trending_list<?php } ?>"><?=$seo_records['og:image']?></span>"/&gt;</p>

<?php if (!isset($seo_records['error']['seo_result'])) { ?>
</div>
<?php 
		$data['seo_result'] = $seo_records['seo_result'];
		$this->load->view('results_detail_pie',$data);
		}
	}	
}	
?>
</div>
