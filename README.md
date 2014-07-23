# Yo plugin for CakePHP

This CakePHP plugin features a simple component to send YOs from your controllers.

## Requirements

PHP 5 with CURL

CakePHP 2 and up

## Usage

Copy `Yo` Folder to your `app/Plugin` directory.

Enter your API Key in `Yo/Config/config.php`

Add the Yo Component to a controller, or to `AppController` to use it in every controller.

Call `$this->Yo->all()` to send a YO to everyone, or `$this->Yo->user('USERNAME')` to send a YO to USERNAME.

## Example

```
class UsersController extends AppController {

    // Add the component
    public $components = array('Yo.Yo');

    public function index() {
    	// send a YO to everyone
    	$this->Yo->all();

    	// send a YO to user USERNAME
    	$this->Yo->user('USERNAME');
    }

}
```

## License
MIT
