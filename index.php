<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test FlashMessages</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">

    <!-- INCLUDE FLASH MESSAGES -->
    <?php
		include_once('./flashMessages/flashMessage.php');
	?>

	<!-- CSS -->
	<style>
		/* used to differentiate beetwen messages (arrays are separated by a normal <hr> tag while messages are separated with an <hr> with 'sShadow' class) */
		hr.sShadow{height: 3px;box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.1);}
		/* needed to wrap flash messages with PHP_EOF */
		div.p-lin{white-space:pre-line;}
		/* needed to center our 'horizontal flash messages' */
		.row-centered {
		    text-align:center;
		}
		.col-centered {
		    display:inline-block;
		    float:none;
		    /* reset the text-align */
		    text-align:left;
		    vertical-align: top;
		}
		/*only to see red borders on this example for a better understanding*/
		div#contentMessages{
			border:1px solid red;
		}
	</style>

</head>
<body>


	<!-- FORM -->
	<div id="loginPanel" class="col-sm-2 col-sm-offset-1">
		<form action="control.php" method="POST" class="form-horizontal" role="form">
			<fieldset>
				<legend>Form</legend>
				Press submit to create flash messages.
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</fieldset>
		</form>
	</div>


	<!-- VERTICAL FLASH MESSAGES -->
	<div id="contentMessages" class="col-sm-offset-3 col-sm-5 p-lin">
	<legend><span style="color:red">Vertical Messages</span></legend>
		<?php
			//INSTANTIATE FLASH MESSAGE
			$flash=new flashMessage();
			//PRINT MESSAGES
			echo($flash->getFlashes());
		?>
	</div>

	<!-- HORIZONTAL FLASH MESSAGES -->
	<div id="contentMessages" class="col-sm-12 p-lin row-centered">
	<legend><span style="color:red">Horizontal Messages</span></legend>
		<?php
			//INSTANTIATE FLASH MESSAGE
			  //$flash=new flashMessage();		//ALREADY instantiated before (line 58), moreover we don't need more than 1 div to display flash messages
			//PRINT MESSAGES
			echo($flash->getFlashes('horizontal'));
		?>
	</div>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- JQUERY -->
	<script>
		$(document).ready(function () {
			// Remove flashMessages with cross button
			$("div#contentMessages").on("click", "a.details_btn.close.active", function(evt) {
				$(this).parents("div.alert").remove();
				evt.preventDefault();
			});
		});
	</script>


</body>
</html>
