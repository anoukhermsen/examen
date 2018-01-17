<?php
/**
 * Created by PhpStorm.
 * User: melan
 * Date: 15-1-2018
 * Time: 13:45
 */

include_once 'DBConfi.php';
class Sql extends DBConfi
{
    private $_table;
    private $_columns;
    private $_columnId;
    private $_values;
    private $jongereId;


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

    /*
     * In deze functie wordt er berekend of een Jongere meerder jarig is. Zodra hij de leeftijd van 18 behaald heeft zult hij/zij terug gevonden kunnen worden bij meerderjarige
     */
    public function leeftijdBerekenenMeerderJarig()
    {
        $query = "SELECT * FROM `jongere` WHERE `jongereGeboortedatum` BETWEEN CURRENT_DATE()-INTERVAL 100 YEAR AND CURRENT_DATE()-INTERVAL 18 YEAR";
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
    }

    /*
     * In deze functie wordt er berekend of een Jongere minder jarig is. Zodra hij de leeftijd van 18 behaald heeft zult hij/zij niet terug gevonden kunnen worden bij meerderjarige
     */
    public function leeftijdBerekenenMinderJarig()
    {
        $query = "SELECT * FROM `jongere` WHERE `jongereGeboortedatum` BETWEEN CURRENT_DATE()- INTERVAL 18 YEAR AND CURRENT_DATE() - INTERVAL 0 YEAR AND `jongereArchief` = 0";
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
    }

    /*
     *
     */
    public function selectFromActiviteitFetch()
    {
        $this->setQuery($this->getConn()->prepare('SELECT * FROM `activiteit`'));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     *
     */
    public function selectFromInstituutFetch()
    {
        $this->setQuery($this->getConn()->prepare('SELECT * FROM `instituut`'));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     *
     */
    public function joinJongereActiviteit($jongereId)
    {
        $this->setQuery($this->getConn()->prepare("SELECT * FROM jongereactiviteit JOIN activiteit ON jongereactiviteit.activiteitId = activiteit.activiteitId WHERE jongereId = ". $jongereId));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     *
     */
    public function joinJongereInstituut($jongereId)
    {
        $this->setQuery($this->getConn()->prepare("SELECT * FROM `jongereinstituut` JOIN instituut ON jongereinstituut.instituutId = instituut.instituutId WHERE jongereId =". $jongereId));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     *
     */
    public function teltAantalJongeren()
    {
        $this->setQuery($this->getConn()->prepare("SELECT COUNT(*) FROM jongere WHERE jongereArchief = 0"));

        $this->getQuery()->execute();
        $count = $this->getQuery()->fetchColumn();

        //echo $count;
        return $count;
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

    /**
     *Het ophalen van de jongere Id
     */
    public function getJongereId()
    {
        return $this->jongereId;
    }

    /**
     * Het zetten van de jongere Id
     */
    public function setJongereId($jongereId)
    {
        $this->_jongereId = $jongereId;
    }

}