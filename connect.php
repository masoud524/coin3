<?php
class DatabaseConnection {
    private $host;
    private $username;
    private $password;
    private $database;
    private $pdo;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        // Establish a connection to the database
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function createRecord($tableName, $data) {
        try {
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $query = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
            $statement = $this->pdo->prepare($query);
            $statement->execute($data);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("Error creating record: " . $e->getMessage());
        }
    }

    public function readRecords($tableName, $conditions = []) {
        try {
            $query = "SELECT * FROM {$tableName}";
            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error reading records: " . $e->getMessage());
        }
    }

    public function updateRecord($tableName, $data, $conditions) {
        try {
            $set = [];
            foreach ($data as $key => $value) {
                $set[] = "{$key}=:{$key}";
            }
            $set = implode(", ", $set);
            $query = "UPDATE {$tableName} SET {$set} WHERE {$conditions}";
            $statement = $this->pdo->prepare($query);
            $statement->execute($data);

            return $statement->rowCount();
        } catch (PDOException $e) {
            die("Error updating record: " . $e->getMessage());
        }
    }

    public function deleteRecord($tableName, $conditions) {
        try {
            $query = "DELETE FROM {$tableName} WHERE {$conditions}";
            $statement = $this->pdo->prepare($query);
            $statement->execute();

            return $statement->rowCount();
        } catch (PDOException $e) {
            die("Error deleting record: " . $e->getMessage());
        }
    }
}

// اتصال به دیتابیس (باید به شکلی باشد که اطلاعات دیتابیس شما را بخواند)
$host = "localhost"; // میزبان دیتابیس
$username = "aqubit_aqu"; // نام کاربری دیتابیس
$password = "Zfc2ajoUQ1ep75"; // رمز عبور دیتابیس
$database = "aqubit_aqu"; // نام دیتابیس

$connection = new DatabaseConnection($host, $username, $password, $database);

// Create a record
/*$newRecordId = $connection->createRecord("your_table_name", ["name" => "John Doe", "age" => 30]);

// Read records
$records = $connection->readRecords("your_table_name");
print_r($records);

// Update a record
$updatedRows = $connection->updateRecord("your_table_name", ["age" => 31], "id=1");

// Delete a record
$deletedRows = $connection->deleteRecord("your_table_name", "id=1");

echo "New record ID: {$newRecordId}<br>";
echo "Updated rows: {$updatedRows}<br>";
echo "Deleted rows: {$deletedRows}<br>";
*/