# Vaah Framework
##### If you love laravel you'll love this wordpress plugin framework too.
 
WordPress is a great CMS, but lacks MVC. Then I tried Laravel an awesome php framework loved by many. Hence, thought to create a bridge between WordPress & Laravel without losing the flexibility of a framework.

By installing this framework, you're actually install laravel as plugin and you'll be controlling the backend as well as the frontend of the plugin with no WordPress limitations.
 
 You'll able to use almost everything similar to laravel like ```routes```, ```controllers```, ```migrations```, ```models```, ```blade templates```  etc

 ## Setup
 
 #### Step 1
 Create a folder as ```vaah-framework``` in your WordPress plugins folder or clone this repository in your plugins folder.
 
#### Step 2
  Run following command to install all plugin dependencies.
  
   ```bash
   composer install
   ```
  Then Run
 ```bash
 composer dump-autoload
 ```


#### Step 3
  Login to your WordPress admin > plugins and activate Vaah Framework. And plugin is ready for development. 


## Migrations

### Initialize the migrations
Use any command line tool and navigate to Vaah plugins folder and run:

 ```bash
 vendor\bin\phinx init
 ```
Phinx is being used to manage migrations.

### Create migrations
Run

 ```bash
 vendor\bin\phinx create <table name> -c phinx-config.php --template=phinx-template.php.dist
 ```
 This will create a migration file under ```app/Migration/db``` folder.


Below is sample migration file. You may consider to read Phinx documentation to create these migration files. These are almost similar to laravel migration files.

```php
use \Vaah\Migration\Migration;

class VaahTasks extends Migration
{

    public function up()
    {
        $this->schema->create('vaah_tasks', function(Illuminate\Database\Schema\Blueprint $table){
            // Auto-increment id
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('vaah_catogary_id')->nullable();
            $table->timestamps();
        });
    }

    //-----------------------------------------------------

    public function down()
    {
        $this->schema->drop('vaah_tasks');
    }

}
```

### Run Migrations
Use following command to ```run``` migrations:

 ```bash
vendor\bin\phinx migrate -c phinx-config.php
 ```


### Rollback Migrations
Use following command to ```rollback``` migrations:
               	
 ```bash
vendor\bin\phinx migrate -c phinx-config.php
 ```

### Reset Migrations

Use following command to ```reset``` migrations:
               	
 ```bash
vendor\bin\phinx rollback -c phinx-config.php -t 0
 ```
 
 ##### remaining documentation will be updated soon...
 
