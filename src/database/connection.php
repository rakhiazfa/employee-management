<?php

/**
 * Koneksi database.
 * 
 */

class Connection extends mysqli
{
    /**
     * @param string|null $hostname
     * @param string|null $username
     * @param string|null $password
     * @param string|null $database
     * @param int|null $port
     * @param string|null $socket
     */
    public function __construct(
        ?string $hostname = null,
        ?string $username = null,
        ?string $password = null,
        ?string $database = null,
        ?int $port = null,
        ?string $socket = null
    ) {
        parent::__construct(
            $hostname,
            $username,
            $password,
            $database,
            $port,
            $socket,
        );
    }

    /**
     * Fungsi untuk membuat statement sekaligus menentukan tipe data dari value yang dimasukan.
     * 
     * @param string $query
     * @param array|null $params
     * 
     * @return mysqli_result
     */
    public function execute_query(string $query, ?array $params = null): mysqli_result|bool
    {
        $statement = $this->prepare($query);

        $types = "";

        foreach ($params as $param) {

            $types .= $this->getDataType($param);
        }

        $statement->bind_param($types, ...$params);

        $statement->execute();

        return $statement->get_result();
    }

    private function getDataType(mixed $value)
    {
        switch (gettype($value)) {
            case 'string':
                return 's';
            case 'integer':
                return 'i';
            case 'double':
                return 'd';
            default:
                return 's';
        }
    }
}

$connection = new Connection(
    env('DATABASE_HOST'),
    env('DATABASE_USERNAME'),
    env('DATABASE_PASSWORD'),
    env('DATABASE_NAME'),
    env('DATABASE_PORT'),
);
