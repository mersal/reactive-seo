<?php if (isset($trending_topics)) { ?>
<?php
	$trending_list_arr = array();
	$trending_topics['topic_result'] = json_decode($trending_topics['topic_result'], TRUE);

	foreach($trending_topics['topic_result'] as $row){
		array_push($trending_list_arr, array("topic" => $row[0], "frequency"=>$row[1]));
	}
	$trending_list_json = json_encode($trending_list_arr);
?>
<?php } ?>
<style>
.axis text {
  font: 12px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.bar {
	fill: #C02126;
	fill-opacity: .5;
}

.bar:hover {
	fill: black ;
	fill-opacity: .75;
}

.x.axis path {
  display: none;
}

.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
}

/* Creates a small triangle extender for the tooltip */
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 10px;
  width: 100%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
}
</style>
<div class="fifteen columns leftcontent" style='text-align:center;'>
<h2 class="postmargin">Top Trends - <?=$page_title?></h2>
<div id="trendsChart"></div>
</div>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>

<script>
var data = '<?=$trending_list_json?>';
data = JSON.parse(data);
console.log(data);
var margin = {top: 0, right: 0, bottom: 120, left: 50},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1, 1);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    return "<span>" + d.topic + " : " + d.frequency.toLocaleString() + " </span>";
  })

var svg = d3.select("#trendsChart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

svg.call(tip);

  data.forEach(function(d) {
    d.frequency = +d.frequency;
  });

  x.domain(data.map(function(d) { return d.topic; }));
  y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + height + ")")
    .call(xAxis)
    .selectAll("text")  
    .style("text-anchor", "end")
    .attr("dx", "-.8em")
    .attr("dy", ".15em")
    .attr("transform", function(d) {
        return "rotate(-65)" 
    });

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Frequency");

  svg.selectAll(".bar")
      .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.topic); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.frequency); })
      .attr("height", function(d) { return height - y(d.frequency); })
	  .on('mouseover', tip.show)
      .on('mouseout', tip.hide)	
    
  d3.select("input").on("change", change);

  var sortTimeout = setTimeout(function() {
    d3.select("input").property("checked", true).each(change);
  }, 2000);

  function change() {
    clearTimeout(sortTimeout);

    // Copy-on-write since tweens are evaluated after a delay.
    var x0 = x.domain(data.sort(this.checked
        ? function(a, b) { return b.frequency - a.frequency; }
        : function(a, b) { return d3.ascending(a.topic, b.topic); })
        .map(function(d) { return d.topic; }))
        .copy();

    svg.selectAll(".bar")
        .sort(function(a, b) { return x0(a.topic) - x0(b.topic); });

    var transition = svg.transition().duration(750),
        delay = function(d, i) { return i * 50; };

    transition.selectAll(".bar")
        .delay(delay)
        .attr("x", function(d) { return x0(d.topic); });

    transition.select(".x.axis")
        .call(xAxis)
      .selectAll("g")
        .delay(delay);
  }

</script>

