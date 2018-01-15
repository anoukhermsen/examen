<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */

include 'DBConfi.php';
class Sql extends DBConfi
{
    private $_table;
    private $_columns;
    private $_columnId;
    private $_values;

    public function __construct()
    {
        $this->openConnection();
    }

    // Een Dynamic functie om een geselecteerde rij te kunnen archiveren
    public function archiveRow($table, $columns,  $values, $columnId, $id)
    {
        /*
         * UPDATE $table SET $column WHERE $columnId = $value;
         * Query opbouwen
         */
        $query = "UPDATE " . $table . " SET ";

        $query .= $columns . " = " . $values;

        $query .= " WHERE " . $columnId . " = " . $id . ";";

        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();

        //BIJ RETURN QUERY DE EXECUTE UITZETTEN EN IN DE UPDATE PAGINA ECHO $query->...
    }




    //////////////////////////////////////////Getters en setters////////////////////////////////////////////////////////
    public function getTable()
    {
        return $this->_table;
    }

    public function setTable($table)
    {

        $this->_table = $table;
    }

    public function getColumns()
    {
        return $this->_columns;
    }

    public function setColumns($columns)
    {
        $this->_columns = $columns;
    }

    public function getColumnId()
    {
        return $this->_columnId;
    }

    public function setColumnId($columnId)
    {
        $this->_columnId = $columnId;
    }

    public function getValues()
    {
        return $this->_values;
    }

    public function setValues($values)
    {
        $this->_values = $values;
    }
}