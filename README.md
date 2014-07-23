# Yo plugin for CakePHP

This CakePHP plugin features a simple component to send Yos from your controllers and a behavior that you can attach to your models.

Get your API Key at http://dev.justyo.co/

## Requirements

PHP >= 5.2 with CURL

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

Check the example below

```php
class UsersController extends AppController {

    // Add the component
    public $components = array('Yo.Yo');

    public function index() {
    	// send a Yo to everyone
    	$this->Yo->all();

    	// send a Yo to user USERNAME
    	$this->Yo->user('USERNAME');
    }

}
```

### Using Yo in a model

If you want to get a Yo whenever a model is created, updated or deleted use the behavior included.

In the model you care about add `$actsAs = array('Yo.Yo')`. By default it will Yo only when a record is created. If you care about updates and deletes you'll need to modify the options.

By default the behavior sends a Yo using `$this->Yo->all()`. If you want to send to only one user, modify the setting when adding the behavior in `$actsAs`.

Check the example below

```php
class User extends AppModel {
	
	// These settings are defaults.
	public $actsAs = array(
		'Yo.Yo' => array(
			'afterSave' => true,
			'afterUpdate' => false,
			'afterDelete' => false,
			'username' => '' // set a username so it doesn't send to everyone
		)
	);
}
```

## License
MIT
