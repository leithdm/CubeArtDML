<?php

class DatabaseSeeder extends Seeder {

	protected $tables = [
		'artists',
		'orders',
		'customers',
		'arts',
		'users',
		'employees',
		'exhibitions',
		'galleries',
		'carousels'
	];

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->cleanDatabase();
		$this->call('ArtistsTableSeeder');
		$this->call('ArtsTableSeeder');
		$this->call('CustomersTableSeeder');
//		$this->call('OrdersTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('EmployeeTableSeeder');
		$this->call('ExhibitionTableSeeder');
		$this->call('GalleryTableSeeder');
		$this->call('CarouselTableSeeder');
//		$this->call('GalleryArtTableSeeder');
	}

	/**
	 * clean out the database for new seed generation
	 */
	private function cleanDatabase()
	{
		/**
		 * general SQL statement that states dont even bother checking for foreign constraints.
		 */
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		foreach ($this->tables as $table)
		{
			/**
			 * truncate will empty out the table.
			 */
			DB::table($table)->truncate();
		}

		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}
}
