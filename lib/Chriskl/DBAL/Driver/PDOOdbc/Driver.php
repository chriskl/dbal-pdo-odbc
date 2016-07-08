<?php

namespace Chriskl\DBAL\Driver\PDOOdbc;

use Doctrine\DBAL\Driver;
use Doctrine\DBAL\Driver\AbstractSQLServerDriver;

class Driver extends AbstractSQLServerDriver
{
    /**
     * Attempts to create a connection with the database.
     *
     * @param array $params All connection parameters passed by the user.
     * @param string|null $username The username to use when connecting.
     * @param string|null $password The password to use when connecting.
     * @param array $driverOptions The driver options to use when connecting.
     *
     * @return \Doctrine\DBAL\Driver\Connection The database connection.
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
    {
        try {
            $pdo = new PDOConnection(
                $this->_constructPdoDsn($params),
                $username,
                $password,
                $driverOptions
            );
//            if (defined('PDO::PGSQL_ATTR_DISABLE_PREPARES')
//                && (!isset($driverOptions[PDO::PGSQL_ATTR_DISABLE_PREPARES])
//                    || true === $driverOptions[PDO::PGSQL_ATTR_DISABLE_PREPARES]
//                )
//            ) {
//                $pdo->setAttribute(PDO::PGSQL_ATTR_DISABLE_PREPARES, true);
//            }
//            /* defining client_encoding via SET NAMES to avoid inconsistent DSN support
//             * - the 'client_encoding' connection param only works with postgres >= 9.1
//             * - passing client_encoding via the 'options' param breaks pgbouncer support
//             */
//            if (isset($params['charset'])) {
//                $pdo->query('SET NAMES \'' . $params['charset'] . '\'');
//            }
            return $pdo;
        } catch (PDOException $e) {
            throw DBALException::driverException($this, $e);
        }
    }

    /**
     * Gets the DatabasePlatform instance that provides all the metadata about
     * the platform this driver connects to.
     *
     * @return \Doctrine\DBAL\Platforms\AbstractPlatform The database platform.
     */
    public function getDatabasePlatform();

    /**
     * Gets the SchemaManager that can be used to inspect and change the underlying
     * database schema of the platform this driver connects to.
     *
     * @param \Doctrine\DBAL\Connection $conn
     *
     * @return \Doctrine\DBAL\Schema\AbstractSchemaManager
     */
    public function getSchemaManager(Connection $conn);

    /**
     * Gets the name of the driver.
     *
     * @return string The name of the driver.
     */
    public function getName()
    {
        return 'pdo_odbc';
    }

    /**
     * Gets the name of the database connected to for this driver.
     *
     * @param \Doctrine\DBAL\Connection $conn
     *
     * @return string The name of the database.
     */
    public function getDatabase(Connection $conn);
}