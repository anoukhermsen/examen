<?php
include_once 'DBConfi.php';

class Crud extends DBConfi
{
    private $_table;
    private $_columns;
    private $_columnId;
    private $_values;

    public function __construct()
    {
        $this->openConnection();
    }

    ////////////////////////////////////////////Methods/////////////////////////////////////////////////////////////////
    /*Dynamische SELECT functie met gegevens vanuit de database*/
    public function selectFromTable($table, $columns, $where = null, $id = null, $columnSort, $orderBy)
    {
        $aantal = count($columns);
        $teller = 1;

        // SELECT $columns FROM $table WHERE $... ORDER BY $...;
        //Query opbouwen

        $query = "SELECT ";
        //Kijken hoe veel $columns er zijn in de array
        if($columns != null)
        {
            foreach ($columns as $column)
            {
                $query .= $column;

                if ($teller < $aantal)
                {
                    $query .= ", ";
                    $teller++;
                }
            }
        }
        //als je alles haal je $columns weg
        else
        {
            $query .= "*";
        }

        $query .= " FROM " . $table;

        //als je alles wil zet je $where op null
        if($where != null)
        {
            $aantal = count($where);

            $query .= " WHERE ";

            for ($i = 0; $i < $aantal; $i += 2)
            {
                $query .= $where. " = ";
                $query .= $id;

                if($where > 2 && $i !=($aantal - 2))
                {
                    $query .= " AND ";
                }
            }

        }

        //SELECT * FROM participate JOIN users ON users.userId = participate.userId ORDER BY users.userId ASC
        $query .= " ORDER BY ". $columnSort. " " . $orderBy;

        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();


        return $this->getQuery();






        //BIJ RETURN QUERY DE EXECUTE UITZETTEN EN DE RETURN $this->getQuery();
        //return $query;
    }

    /*Dynamische INSERT functie met gegevens vanuit de database*/
    public function insertIntoTable($table, $columns, $values)
    {
        $aantal = count($columns);
        $teller = 1;
        $aantal2 = count($columns);
        $teller2 = 1;
        //INSERT INTO $table ($columns) VALUES ($value);
        //Query opbouwen

        $query = "INSERT INTO " . $table . "(";

        //Kijken hoe veel $columns er zijn in de array
        foreach ($columns as $column)
        {
            $query .= $column;

            if ($teller < $aantal)
            {
                $query .= ", ";
                $teller++;
            }
        }

        $query .= ")" . " VALUES " . "(";

        //Dezelfde $columns nog een keer maar dan met : ervoor voor veiligheid
        foreach ($columns as $column)
        {
            $query .= ":" . $column;

            if ($teller2 < $aantal2)
            {
                $query .= ", ";
                $teller2++;
            }
        }

        $query .= ")";

        $this->setQuery($this->getConn()->prepare($query));

        //bindParam eerst $column met : en daarna de value
        foreach (array_combine($columns, $values) as $column => &$value)
        {
            $this->getQuery()->bindParam(':'.$column, $value);
        }

        $this->getQuery()->execute();






        //BIJ RETURN QUERY DE EXECUTE UITZETTEN EN IN DE INSERT PAGINA ECHO $query->...
        //return $query;
    }

    /*Dynamische UPDATE functie met gegevens vanuit de database*/
    public function updateRow($table, $columns, $columnId, $values, $id)
    {
        $aantal = count($columns);
        $teller = 1;


        //UPDATE $table SET $column WHERE $columnId = $value;
        //Query opbouwen
        $query = "UPDATE " . $table . " SET ";

        //Kijken hoe veel $columns er zijn in de array en daarna er een : met $columns voor de veiligheid
        foreach ($columns as $column)
        {
            $query .= $column . " = :" . $column;

            if ($teller < $aantal)
            {
                $query .= ", ";
                $teller++;
            }
        }

        $query .= " WHERE " . $columnId . " = " . $id . ";";

        $this->setQuery($this->getConn()->prepare($query));

        //bindParam eerst $column met : en daarna de value
        foreach (array_combine($columns, $values) as $column => &$value)
        {
            $this->getQuery()->bindParam(':'.$column, $value);
        }

        $this->getQuery()->execute();





        //BIJ RETURN QUERY DE EXECUTE UITZETTEN EN IN DE UPDATE PAGINA ECHO $query->...
        //return $query;
    }

    /*Dynamische DELETE functie met gegevens vanuit de database*/
    public function deleteRow($table, $where, $id)
    {
        $query = "DELETE FROM " . $table . " WHERE " . $where . " = " . $id ;

        $this->setQuery($this->getConn()->prepare($query));
        $this->getQuery()->execute();





        //BIJ RETURN QUERY DE EXECUTE UITZETTEN EN IN DE DELETE PAGINA ECHO $query->...
        //return $query;

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