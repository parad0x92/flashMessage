Api to build flash messages and easly show them in frontend using bootstrap alerts

--USAGE--

require_once 'flashMessages/flashMessage.php';  <br/>
$flash=new flashMessage();  <br/>
&nbsp;&nbsp;&nbsp;  $flash->success("Success Message);  <br/>
&nbsp;&nbsp;&nbsp;  $flash->warning("Warning Message");  <br/>
&nbsp;&nbsp;&nbsp;  $flash->error("Error Message");  <br/>
&nbsp;&nbsp;&nbsp;  $flash->info("Info Message");  <br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      /  <br/>
&nbsp;&nbsp;&nbsp;  $flash->getFlashes('horizontal');  <br/>
&nbsp;&nbsp;&nbsp;  $flash->getFlashes();  <br/>



--FOLDERS--

assets = Bootstrap components (css, js, fonts).

flashMessages = Class to manage our flash messages using cookies.

--FILES--

control.php = Controller which will create the cookies using flashMessages class.

index.php = Usage example of how to show our messages using "getFlashes()" function.  <br/> 
	    CAUTION: in this example we created two contentMessages areas, there's no reason to create more than just one when implemented.  <br/>
	    (You can also change bootstrap grid layouts for a diferent display on the "div#contentMessages" which is used to group all the divs containing our alerts). <br/>
	    There's also added a bit of css and javascript for more functionality directly here.
