<?php
// My ORM feels so sigma
namespace Core;

use Core\Database;

class QueryBuilder
{
    protected $selectLine = "";
    protected $JoinLine = "";
    protected $whereLine = "";
    protected $orderLine = "";
    protected $insertLine = "";
    protected $updateLine = "";
    protected $deleteLine = "";

    /*
     * this would be just a stupid function!
     */
    public function selectAll($table)
    {
        $this->selectLine = " SELECT * FROM {$table}; ";
    }

    /*
     * counting method
    */
    public function count($table, $column = '*')
    {
        $this->selectLine = " SELECT COUNT(*) AS count FROM {$table}; ";
    }

    /*
     * @param $table for table name
     * @param $columns [ alias => column name ]
     * @param $as AS whatever!
     */
    public function select($table, $columns, $tableAlias)
    {
        $selectedFields = [];
        foreach ($columns as $key => $value) {
            $selectedFields[] = is_int($key) ? $value : "$key AS $value";
        }

        $this->selectLine = " SELECT " . implode(", ", $selectedFields) . " FROM " . $table . " " . $tableAlias . " ";
        return $this;
    }

    /*
     * @param $table table name
     * @param $columnOnPKTable for the right side
     * @param $columnOnFKTable for the left side
     * @param $type for Left, Right or inner!
     */
    public function join($table, $columnOnPKTable, $columnOnFKTable, $type = "")
    {
        $type = match ($type) {
            "left" => " LEFT",
            "right" => " RIGHT",
            "inner" => " INNER",
            default => "",
        };
        $this->JoinLine = $type . " JOIN " . $table . " ON " . $columnOnFKTable . " = " . $columnOnPKTable;
        return $this;
    }

    /*
     * where protection, to kill the connector if the developer inserted it by mistake
     */
    protected function whereConnectorProtection($arr) :array
    {
        $index = count($arr) - 1;
        if(isset($arr[$index][2])) $arr[$index][2] = "";
        return $arr;
    }

    /*
     * I need to reduce the repeation
     */
    protected function whereBuilder($arr) :string
    {
        $placeholders = " :" . $arr[0];
        $arr[1] = strtoupper($arr[1]); // if operator is LIKE
        $arr[2] = $arr[2] ? strtoupper($arr[2]) : "";
        return " {$arr[0]} {$arr[1]} {$placeholders} {$arr[2]} ";
    }

    /*
     * @param $columns is the right side
     * [ [column, "=", "or"], [column, "!=", "and"], [column, "like"], [[column, "=", "and"], [column, "LIKE"]], [column, "="] ]
     */
    public function where($columns)
    {
        $columnEqlPlaceholder = [];
        $lastIndex = count($columns) - 1;
        if(is_array($columns[$lastIndex][0])) {
            $columns = $this->whereConnectorProtection($columns);
        }
        for($i = 0; $i < count($columns); $i++) {
            $arr = $columns[$i];
            if (is_array($arr[0])) {
                $arr = $this->whereConnectorProtection($arr);
                $columnEqlPlaceholder[] .= " ( ";
                foreach ($arr as $subArr) {
                    $columnEqlPlaceholder[] .= $this->whereBuilder($subArr);
                }
                $columnEqlPlaceholder[] .= " ) ";
            } else {
                $columnEqlPlaceholder[] .= $this->whereBuilder($arr); ;
            }
        }
        $this->whereLine = " WHERE " . implode(' ', $columnEqlPlaceholder);
        return $this;
    }

    /*
     * @param $column is the column at the end of order
     * @param $type, is the ASC or DESC
     */
    public function order($column, $type = "a")
    {
        $type = match ($type) {
            "asc" => "ASC",
            "desc" => "DESC",
            default => ""
        };

        $this->orderLine = " ORDER BY " . $column . " " . $type;

        return $this;
    }

    /*
     * $table is the table name
     * $value is the columns
     * result will be (column) VALUES (:column)
     * values will be inserted in another array for it, and will be handel in the execute method
     */
    public function insert($table, $columns)
    {
        $fields = "`" . implode("`, `", $columns) . "`";
        $placeholders = ":" . implode(", :", $columns);
        $this->insertLine = " INSERT INTO " . $table . " (" . $fields . ") VALUES (" . $placeholders . ")";

        return $this;
    }

    /*
     * same as insert table literally
     */
    public function update($table, $columns)
    {
        // SQL: SET col1 = :col1, col2 = :col2
        $columnEqlPlaceholder = [];
        foreach ($columns as $column) {
            $columnEqlPlaceholder[] = "`$column` = :$column";
        }
        $this->updateLine = " UPDATE " . $table . " SET " . implode(', ', $columnEqlPlaceholder);

        return $this;
    }

    public function delete($table)
    {
        $this->deleteLine = " DELETE FROM " . $table . " ";
        return $this;
    }

    protected function Build(): string
    {
        $sql = "";
        if ($this->selectLine) {
            $sql = $this->selectLine . $this->JoinLine . $this->whereLine . $this->orderLine . " ;";
        }

        if ($this->insertLine) {
            $sql = $this->insertLine . " ;";
        }

        if ($this->updateLine && $this->whereLine) {
            $sql = $this->updateLine . $this->whereLine . " ;";
        }

        if ($this->deleteLine && $this->whereLine) {
            $sql = $this->deleteLine . $this->whereLine . " ;";
        }

        return $sql;
    }

    public function execute(array $params = [], $all = false)
    {
        $sql = $this->Build();
        $result = $all ? Database::fetchAll($sql, $params) : Database::fetchOne($sql, $params);

        // تصفير كل الـ properties عشان الاستعلام اللي جاي
        $this->selectLine = $this->JoinLine = $this->whereLine = $this->orderLine = "";
        $this->insertLine = $this->updateLine = $this->deleteLine = "";

        return $result;
    }
}