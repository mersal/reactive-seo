<div class="sixteen columns leftcontent" style='min-height:500px;text-align:left;'>
<form id="form3" name="form3" method="post" action="/submit" accept-charset="UTF-8" autocomplete="off" novalidate style="padding-left:250px;">
<input type='hidden' name='timeframe' id="timeframe" value='count_last_day'>
<div style="display:block;padding-bottom:10px;">Enter url to customize meta keywords & open graph data:</div>
<div style="display:inline;padding-right:10px;">
<input type=text name='url' id="url" size=50 value="<?php echo set_value('url'); ?>">
</div>
<div style="display:inline-block;">
<input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value=""/>
</div>
</form>
<div id='form-msg'><?php echo form_error('url'); ?></div>

