Migrations
==========

Auto-Migration Files
--------------------

Once you've generated your first migration you'll probably want to do more changes to your database. To simplify the generation of new migrations you can perform schema diffs. For this, follow these steps:

1. Generate your first migration (if you haven't generated it yet)
2. Generate a schema file with ```cake schema generate``` command
3. Do the required changes to your database using your favorite tool
4. Generate a new migration file by running ```cake Migrations.migration generate```

Manually Creating Migration Files
---------------------------------

If you prefer full control over your changes, or don't want to mess with *SQL*, you have the option to manually create your migration files. First create a blank migration with the following command:

```
cake Migrations.migration generate
```

Skip the comparison of the current database to the existing schema if asked or force comparing using ```--compare``` parameter. Then, open the newly created file under ```app/Config/Migrations```, then fill the file with the following migration directives.

Column Keys
-----------

The **Migrations** plugin works on top of the *CakePHP* Model layer, so you can use all of the features that are supported by the framework to describe columns. See the section on [columns](http://book.cakephp.org/2.0/en/console-and-shells/schema-management-and-migrations.html#columns) for a complete list of all possible options.

Create Table
------------

The ```create_table``` directive is used for the creation of new tables in your database. Note that the **Migrations** plugin will generate errors if the specified table already exists in the database. The ```drop_table``` and ```rename_table``` directives exist to deal with existing tables before proceeding with table creation.

```php
'create_table' => array(
	'categories' => array(
		'id' => array(
			'type'    =>'string',
			'null'    => false,
			'default' => null,
			'length'  => 36,
			'key'     => 'primary'
		),
		'name' => array(
			'type'    =>'string',
			'null'    => false,
			'default' => null
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			)
		)
	),
	'emails' => array(
		'id' => array(
			'type'    => 'string',
			'length ' => 36,
			'null'    => false,
			'key'     => 'primary'
		),
		'data' => array(
			'type'    => 'text',
			'null'    => false,
			'default' => null
		),
		'sent' => array(
			'type'    => 'boolean',
			'null'    => false,
			'default' => '0'
		),
		'error' => array(
			'type'    => 'text',
			'default' => null
		),
		'created' => array(
			'type' => 'datetime'
		),
		'modified' => array(
			'type' => 'datetime'
		),
		'indexes' => array(
			'PRIMARY' => array(
				'column' => 'id',
				'unique' => 1
			)
		)
	)
);
```

Drop Table
----------

The ```drop_table``` directive is used for removing tables from the schema.

```php
'drop_table' => array(
	'categories',
	'emails'
)
```

Rename Table
------------

The ```rename_table``` directive changes the name of a table in the database.

```php
'rename_table' => array(
	'categories' => 'groups',
	'emails' => 'email_addresses'
)
```

Create Field
------------

The ```create_field``` directive is used to add fields to an existing table in the schema. Note that Migrations will generate errors if the specified field already exists in the table. The ```drop_field```, ```rename_field``` and ```alter_field``` directives exist to deal with existing fields before proceeding with field addition.

```php
'create_field' => array(
	'categories' => array(
		'created' => array(
			'type' => 'datetime'
		),
		'modified' => array(
			'type' => 'datetime'
		)
	)
)
```

Drop Field
----------

The ```drop_field``` directive is used for removing fields from existing tables in the schema.

```php
'drop_field' => array(
	'categories' => array(
		'created',
		'modified'
	),
	'emails' => array(
		'error'
	)
)
```

Alter Field
-----------

The ```alter_field``` directive changes the field properties in an existing table. Note that partial table specifications are passed, which is a subset of a full array of table data. These are the fields that are to be modified as part of the operation. If you wish to leave some fields untouched, simply exclude them from the ```table``` key for the ```alter_field``` operation.

```php
'alter_field' => array(
	'categories' => array(
		'name' => array(
			'length' => 11
		)
	)
)
```

Rename Field
------------

The ```rename_field``` directive changes the name of a field on a specified table in the database.

```php
'rename_field' => array(
	'categories' => array(
		'name' => 'title'
	),
	'emails' => array(
		'error' => 'error_code',
		'modified' => 'updated'
	)
)
```

Alter Index
-----------

In order to add a new index to an existing field, you need to pass the index definition in an array.

```php
'create_field' => array(
	'posts' => array(
		'indexes' => array(
			'UNIQUE_TITLE' => array(
				'column' => 'title',
				'unique' => true
			)
		)
	)
)
```

Likewise, if you want to drop an index.

```php
'drop_field' => array(
	'posts' => array(
		'indexes' => array(
			'UNIQUE_TITLE'
		)
	)
)
```

Callbacks
---------

You can make use of callbacks in order to execute extra operations, for example, to fill tables with predefined data. You can even use the shell to ask the user for data that is going to be inserted.

**Example 1:** Create table statuses and fill it with some default data.

```php
public $migration = array(
	'up' => array(
		'create_table' => array(
			'statuses' => array(
				'id' => array(
					'type' => 'string',
					'length' => 36,
					'null' => false,
					'key' => 'primary'
				),
				'name' => array(
					'type' => 'text',
					'null' => false,
					'default' => null
				)
			)
		)
	),
	'down' => array(
		'drop_table' => array('statuses')
	)
);

public function after($direction) {
	$Status = ClassRegistry::init('Status');
	if ($direction === 'up') {
		// add 2 records to statues table
		$data[0]['Status']['id'] = '59a6a2c0-2368-11e2-81c1-0800200c9a66';
		$data[0]['Status']['name'] = 'Published';
		$data[1]['Status']['id'] = '59a6a2c1-2368-11e2-81c1-0800200c9a67';
		$data[1]['Status']['name'] = 'Unpublished';
		$Status->create();
		if ($Status->saveAll($data)) {
			$this->callback->out('statuses table has been initialized');
		}
	} elseif ($direction === 'down') {
		// do more work here
	}
	return true;
}
```

**Example 2:** Prompt the user to insert data.

```php
public $migration = array(
	'up' => array(
		'create_table' => array(
			'statuses' => array(
				'id' => array(
					'type' => 'string',
					'length' => 36,
					'null' => false,
					'key' => 'primary'
				),
				'name' => array(
					'type' => 'text',
					'null' => false,
					'default' => null
				)
			)
		)
	),
	'down' => array(
		'drop_table' => array(
			'statuses'
		)
	)
);

public function after($direction) {
	$Status = ClassRegistry::init('Status');
	if ($direction === 'up') {
		$this->callback->out('Please enter a default status below:');
		$data['Status']['name'] = $this->callback->in('What is the name of the default status?');
		$Status->create();
		if ($Status->save($data)){
			$this->callback->out('statuses table has been initialized');
		}
	} elseif ($direction === 'down') {
		// do more work here
	}
	return true;
}
```
