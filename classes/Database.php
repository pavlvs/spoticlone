<?php
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $db;
    private $error;
    private $sth;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->db = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function query($sql)
    {
        $this->sth = $this->db->prepare($sql);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->sth->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->sth->execute();
    }

    public function resultset()
    {
        $this->execute();
        return $this->sth->fetchAll(PDO::FETCH_OBJ);
    }

    public function single()
    {
        $this->execute();
        return $this->sth->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        return $this->sth->rowCount();
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->db->commit();
    }

    public function cancelTransaction()
    {
        return $this->db->rollBack();
    }

    public function debugDumpParams()
    {
        return $this->sth->debugDumpParams();
    }
}
