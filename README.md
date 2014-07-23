# Yo plugin for CakePHP

This is a component that allows you to send a YO to a specific user or to everyone subscribed to you.

## Usage
Copy `Yo` Folder to your `app/Plugin` directory.

Write your API Key in `Yo/Config/config.php`

Add the Yo Component to a controller, or to AppController to use it in every controller.

```
class AppController extends Controller {

	// plugin syntax, Yo plugin . Yo component
    public $components = array('Yo.Yo');

    public function index() {
    	// send a YO to everyone
    	$this->Yo->all();

    	// send a YO to a user
    	$this->Yo->user('USERNAME');
    }

}
```

## License
MIT