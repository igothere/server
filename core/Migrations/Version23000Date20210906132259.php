<?php

declare(strict_types=1);

namespace OC\Core\Migrations;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\DB\Types;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version23000Date20210906132259 extends SimpleMigrationStep {
	private const TABLE_NAME = 'ratelimit_entries';

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		$hasTable = $schema->hasTable(self::TABLE_NAME);

		if(!$hasTable)
		{
			$table = $schema->createTable(self::TABLE_NAME);
			$table->addColumn('hash', Types::STRING, [
				'notnull' => true,
				'length' => 128,
			]);
			$table->addColumn('timestamp', 'datetime', [
				'notnull' => true,
			]);
			$table->addIndex(['hash'], 'ratelimit_hash_idx');
			$table->addIndex(['timestamp'], 'ratelimit_timestamp_idx');
		}

		return $schema;
	}
}
