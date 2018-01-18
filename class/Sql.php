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
        $query = "SELECT * FROM `jongere` WHERE `jongereGeboortedatum` BETWEEN CURRENT_DATE() - INTERVAL 100 YEAR AND CURRENT_DATE()- INTERVAL 18 YEAR AND `jongereArchief` = 0";
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     * In deze functie wordt er berekend of een Jongere minder jarig is. Zodra hij de leeftijd van 18 behaald heeft zult hij/zij niet terug gevonden kunnen worden bij meerderjarige
     */
    public function leeftijdBerekenenMinderJarig()
    {
        $query = "SELECT * FROM `jongere` WHERE `jongereGeboortedatum` BETWEEN CURRENT_DATE() - INTERVAL 18 YEAR AND CURRENT_DATE() - INTERVAL 0 YEAR AND `jongereArchief` = 0";
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     * Deze functie wordt gebruikt voor het ophalen van de functie en te laten tonen in de formulieren die worden gebruikt vandaar dat we FetchAll gebruiken en niet Fetch
     */
    public function selectFromActiviteitFetch()
    {
        $query = "SELECT * FROM `activiteit`";
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     * Deze functie wordt gebruikt voor het ophalen van de functie en te laten tonen in de formulieren die worden gebruikt vandaar dat we FetchAll gebruiken en niet Fetch
     */
    public function selectFromInstituutFetch()
    {
        $query = "SELECT * FROM `instituut`";
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     * Deze functie wordt gebruikt om verschillende database tabellen samen te voegen zodat alle informatie van uit alle tabellen kunnen worden gebruikt
     */
    public function joinJongereActiviteit($jongereId)
    {
        $query = "SELECT * FROM jongereactiviteit JOIN activiteit ON jongereactiviteit.activiteitId = activiteit.activiteitId WHERE jongereId = ". $jongereId;
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     * Deze functie wordt gebruikt om verschillende database tabellen samen te voegen zodat alle informatie van uit alle tabellen kunnen worden gebruikt
     */
    public function joinJongereInstituut($jongereId)
    {
        $query = "SELECT * FROM `jongereinstituut` JOIN instituut ON jongereinstituut.instituutId = instituut.instituutId WHERE jongereId =". $jongereId;
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     * Deze functie wordt gebruikt om verschillende database tabellen samen te voegen zodat alle informatie van uit alle tabellen kunnen worden gebruikt, ook wordt hier een jaar mee gegeven
     * waardoor in het pdf de juiste datum word aangetoont
     */
    public function joinJongereInstituutPDF($year)
    {
        $query = "SELECT * FROM `jongereinstituut` JOIN instituut ON jongereinstituut.instituutId = instituut.instituutId JOIN jongere ON jongereinstituut.jongereId = jongere.jongereId WHERE YEAR(`instituutStartdatum`) =". $year;
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());

        echo date('Y', strtotime($year));
    }

    /*
     * Deze functie wordt gebruikt om verschillende database tabellen samen te voegen zodat alle informatie van uit alle tabellen kunnen worden gebruikt
     */
    public function joinJongereAfspraak($jongereId)
    {
        $query = "SELECT * FROM `jongereafspraak` JOIN gebruikers ON gebruikers.gebruikersId = jongereafspraak.gebruikersId WHERE jongereId=".$jongereId;
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     * In deze functie worden de jaren tot groepen gevormt. Dit is nodig omdat er anders jaren dubbel zouden kunnen worden getoont
     */
    public function checkYearDropdownPDF()
    {
        $query = "SELECT YEAR(`instituutStartdatum`) FROM jongereinstituut GROUP BY YEAR(`instituutStartdatum`)";
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
    }

    /*
     * In deze functie
     */
    public function teltAantalJongeren($jongereId)
    {
        $query = "SELECT COUNT(*) FROM jongere WHERE jongereArchief = ". $jongereId;
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        $count = $this->getQuery()->fetchColumn();

        //echo $count;
        return $count;
    }

    /*
     *  Deze functie zogd ervoor dat een grbruiker zich zelf niet kunt verwijderen in de tabel
     */
    public function gebruikersSort($id, $archief)
    {
        $query = "SELECT * FROM gebruikers WHERE gebruikersId !=". $id . " AND gebruikersArchief =" .$archief;
        $this->setQuery($this->getConn()->prepare($query));

        $this->getQuery()->execute();
        return ($this->getQuery()->fetchAll());
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