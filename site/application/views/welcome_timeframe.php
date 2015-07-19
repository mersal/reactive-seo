<div class="sixteen columns leftcontent" style='min-height:500px;text-align:left;'>
<form id="form3" name="form3" method="post" action="/submit" accept-charset="UTF-8" autocomplete="off" novalidate style="padding-left:210px;">
<div style="display:block;padding-bottom:10px;">Enter url to customize meta keywords:</div>
<div style="display:inline;padding-right:10px;">
<input type=text name='url' id="url" size=50 value="<?php echo set_value('url'); ?>">
</div>
<div style="display:inline;padding-right:10px;">
<select name='timeframe' id="timeframe">
<option value='' <?php echo set_select('timeframe', ''); ?>>--timeframe--</option>
<option value='count_last_hour' <?php echo set_select('timeframe', 'count_last_hour'); ?>>last hour</option>
<option value='count_last_day' <?php echo set_select('timeframe', 'count_last_day', TRUE); ?>>last day</option>
<option value='count_last_week' <?php echo set_select('timeframe', 'count_last_week'); ?>>last week</option>
<option value='count_last_month' <?php echo set_select('timeframe', 'count_last_month'); ?>>last month</option>
<option value='count_all_time' <?php echo set_select('timeframe', 'count_last_all_time'); ?>>all time</option>
</select>
</div>
<div style="display:inline-block;">
<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value=""/>
</div>
</form>
<div id='form-msg'><?php echo form_error('url'); ?><?php echo form_error('timeframe'); ?></div>

