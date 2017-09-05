Api to build flash messages and easly show them using bootstrap alerts

_USAGE_

require_once 'flashMessages/flashMessage.php';
$flash=new flashMessage();
  $flash->success("Success Message);
  $flash->warning("Warning Message");
  $flash->error("Error Message");
  $flash->info("Info Message");
      /
  $flash->getFlashes('horizontal');
  $flash->getFlashes();




_FOLDERS_

assets = Bootstrap components (css, js, fonts).

flashMessages = Class to manage our flash messages using cookies.

_FILES_

control.php = Controller which will create the cookies using flashMessages class.

index.php = Usage example of how to show our messages using "getFlashes()" function.  CAUTION: in this example we created two contentMessages areas, there's no reason to create more than just one when implemented.
	    (You can also change bootstrap grid layouts for a diferent display on the "div#contentMessages" which is used to group all the divs containing our alerts).
	    There's also added a bit of css and javascript for more functionality directly there.
