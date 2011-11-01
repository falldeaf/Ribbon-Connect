<div class="button_small remote">tv</div>
<div class="button_small remote">music</div>
<div class="button_small remote">videos</div>
<div class="button_small remote">record</div>
<div class="button_small remote">gallery</div>
<div class="button_small remote">guide</div>
<div class="clearing"></div>

<p></p>

<div class="button_small remote">Info</div>
<div class="button_small remote">Up</div>
<div class="button_small remote">Menu</div>
<div class="clearing"></div>
<div class="button_small remote">Left</div>
<div class="button_small remote">OK</div>
<div class="button_small remote">Right</div>
<div class="clearing"></div>
<div class="button_small remote">Back</div>
<div class="button_small remote">Down</div>
<div class="button_small remote">Guide</div>
<div class="clearing"></div>

<p></p>

<div class="button_large remote">Vol_Up</div>
<div class="button_small remote">mute</div>
<div class="button_large remote">Vol_Dn</div>
<div class="clearing"></div>

<p></p>

<div class="button_small remote">play</div>
<div class="button_small remote">pause</div>
<div class="button_small remote">stop</div>
<div class="button_small remote">rec</div>
<div class="clearing"></div>
<div class="button_small remote">|<</div>
<div class="button_small remote"><<</div>
<div class="button_small remote">>></div>
<div class="button_small remote">>|</div>
<div class="clearing"></div>

<script>
$(".remote").click(function(event){
	//alert('module/remote/control.php?submit=' + $(this).text());
	$.get('module/remote/control.php?submit=' + $(this).text());	
});
</script>