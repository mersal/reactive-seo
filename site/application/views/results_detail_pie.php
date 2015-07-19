<?php if (isset($seo_result)) { ?>
<?php
$trending_list_arr = array();
$lookup_array=array();
$colors = array("#3b0300","#470500","#510600","#5c0702","#670901","#710a03","#7a0b03","#840d04","#8f0f06","#991107","#a51207","#ae1408","#b61509","#bf170a","#cb1b0e","#d41d0f","#e22113","#ed2617","#f82f20","#fe4132","#fd5042","#fd6055","#fe7067","#fd847b","#fd948d","#fc9f99","#fdafaa","#fcbfbb");
		foreach($seo_result as $row){
		    if (isset($lookup_array[$row[1]]['value'])) {
				$lookup_array[$row[1]]['value'] += 1;
				$lookup_array[$row[1]]['caption'] .= ", " . $row[0];

			} else {
				$lookup_array[$row[1]]['value'] = 1;
				$lookup_array[$row[1]]['color'] = $colors[array_rand($colors, 1)];
				$lookup_array[$row[1]]['caption'] = $row[0];
			}
		}
		foreach ($lookup_array as $key=>$value) {
			array_push($trending_list_arr, array("label" => $key, "value"=>$value['value'], "color"=>$value['color'], "caption"=>$value['caption']));
		}
		$trending_list_json = json_encode($trending_list_arr);
?>
<div id="pieChart"></div>
<script>
var pie = new d3pie("pieChart", {
	"header": {
		"title": {
			"text": "results detail",
			"fontSize": 24,
			"font": "open sans"
		},
		"subtitle": {
			"text": "",
			"color": "#999999",
			"fontSize": 12,
			"font": "open sans"
		},
		"titleSubtitlePadding": 9
	},
	"footer": {
		"color": "#999999",
		"fontSize": 10,
		"font": "open sans",
		"location": "bottom-left"
	},
	"size": {
		"canvasWidth": 960,
		"pieOuterRadius": "90%"
	},
	"data": {
		"sortOrder": "value-desc",
		"smallSegmentGrouping": {
			"enabled": false
		},
		"content": <?=$trending_list_json?>
	},
	"labels": {
		"outer": {
			"pieDistance": 32
		},		
		"mainLabel": {
			"fontSize": 16
		},
		"percentage": {
			"color": "#ffffff",
			"decimalPlaces": 0
		},
		"value": {
			"color": "#adadad",
			"fontSize": 12
		},
		"lines": {
			"enabled": true
		},
		"truncation": {
			"enabled": true
		}
	},
	"effects": {
		"pullOutSegmentOnClick": {
			"effect": "linear",
			"speed": 400,
			"size": 8
		}
	},
	"misc": {
		"gradient": {
			"enabled": true,
			"percentage": 100
		}
	},
	"tooltips": {
    	"enabled": true,
    	"type": "caption"
  	}
});
</script>
<?php } ?>