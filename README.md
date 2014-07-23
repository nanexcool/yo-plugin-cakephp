# Yo plugin for CakePHP

This CakePHP plugin features a simple component to send YOs from your controllers and a behavior that you can attach to models.

Get your API Key at http://dev.justyo.co/

## Requirements

PHP 5.2 and up with CURL

CakePHP 2 and up

## Usage

Copy `Yo` Folder to your `app/Plugin` directory.

Load plugin in `app/Config/bootstrap.php`

```php
CakePlugin::loadAll(); // Loads all plugins at once
CakePlugin::load('Yo'); //Loads a single plugin
```

Enter your API Key in `Yo/Config/config.php`

```php
Configure::write('Yo.apiKey', 'YOUR_API_KEY');
```

### Using Yo in a controller

Add the Yo Component to a controller, or to `AppController` to use it in every controller.

Call `$this->Yo->all()` to send a YO to everyone, or `$this->Yo->user('USERNAME')` to send a YO to USERNAME.

## Example

```php
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

### Using yo in a model

If you want to get a Yo whenever a model is created, updated or deleted use the behavior included.

In the model you care about add `$actsAs = array('Yo.Yo')`. By default it will Yo only when a record is created. If you care about updates and deletes you'll need to modify the options.

Check the example below

```php
class User extends AppModel {
	
	// These settings are defaults.
	public $actsAs = array(
		'Yo.Yo' => array(
			'afterSave' => true,
			'afterUpdate' => false,
			'afterDelete' => false,
			'username' => ''
		)
	);
}
```

## License
MIT
