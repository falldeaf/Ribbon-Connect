<br />Living room lamp<br />
<div class="button_small power" device="c5" act="fbright" count="10">bright</div>
<div class="button_small power" device="c5" act="fon">on</div>
<div class="button_small power" device="c5" act="foff">off</div>
<div class="button_small power" device="c5" act="fdim" count="10">dim</div>
<div class="clearing"></div>
<br />Computer room lamp<br />
<div class="button_small power" device="c4" act="fbright" count="10">bright</div>
<div class="button_small power" device="c4" act="fon">on</div>
<div class="button_small power" device="c4" act="foff">off</div>
<div class="button_small power" device="c4" act="fdim" count="10">dim</div>
<div class="clearing"></div>
<br />Dining room lamp<br />
<div class="button_small power" device="c3" act="fbright" count="10">bright</div>
<div class="button_small power" device="c3" act="fon">on</div>
<div class="button_small power" device="c3" act="foff">off</div>
<div class="button_small power" device="c3" act="fdim" count="10">dim</div>
<div class="clearing"></div>
<br />Living room picture frame<br />
<div class="button_small power" device="c7" act="fon">on</div>
<div class="button_small power" device="c7" act="foff">off</div>
<div class="clearing"></div>
<br />Master Bath light<br />
<div class="button_small power" device="c2" act="fbright" count="10">bright</div>
<div class="button_small power" device="c2" act="fon">on</div>
<div class="button_small power" device="c2" act="foff">off</div>
<div class="button_small power" device="c2" act="fdim" count="10">dim</div>
<div class="clearing"></div>
<br />Master Bedroom night-stand lamp (LEFT)<br />
<div class="button_small power" device="c8" act="fbright" count="10">bright</div>
<div class="button_small power" device="c8" act="fon">on</div>
<div class="button_small power" device="c8" act="foff">off</div>
<div class="button_small power" device="c8" act="fdim" count="10">dim</div>
<div class="clearing"></div>
<br />Master Bedroom night-stand lamp (RIGHT)<br />
<div class="button_small power" device="c9" act="fbright" count="10">bright</div>
<div class="button_small power" device="c9" act="fon">on</div>
<div class="button_small power" device="c9" act="foff">off</div>
<div class="button_small power" device="c9" act="fdim" count="10">dim</div>
<div class="clearing"></div>
<br />

<div id="power_result" class="message_box"></div>

<script>
$(".power").click(function(event){
	//alert('module/power/control.php?d=' + $(this).attr('device') + '&a=' +  $(this).attr('act'));
	$('#power_result').html(loader_html + 'Sending command...').show('fast');
	$('#power_result').load('module/power/control.php?d=' + $(this).attr('device') + '&a=' +  $(this).attr('act') + '&c=' +  $(this).attr('count') );	
});
</script>
