<?php

namespace Chriskl\DBAL\Driver;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver;

/**
 * Abstract base implementation of the {@link Doctrine\DBAL\Driver} interface for ODBC based drivers.
 *
 * @author Chris Kings-Lynne <chris.kingslynne@gmail.com>
 */
abstract class AbstractSQLServerDriver implements Driver
{
    /**
     * {@inheritdoc}
     */
    public function getDatabase(\Doctrine\DBAL\Connection $conn)
    {
        $params = $conn->getParams();

        if (isset($params['dbname'])) {
            return $params['dbname'];
        }

        throw new Exception("Not available under ODBC");
    }

    /**
     * {@inheritdoc}
     */
    public function getDatabasePlatform()
    {
        //return new SQLServer2008Platform();
    }

    /**
     * {@inheritdoc}
     */

    public function getSchemaManager(\Doctrine\DBAL\Connection $conn)
    {
        //return new SQLServerSchemaManager($conn);
    }
}