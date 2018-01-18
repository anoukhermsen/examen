<?php
/**
 * Created by PhpStorm.
 * User: Anouk Hermsen
 * Date: 17-1-2018
 * Time: 12:57
 */
include_once 'Sql.php';
class Menu
{
    public function generateMenu()
    {
        ?>
        <html>
        <head>
            <div>
            <img src="../../img/klavertjevier.jpg"height="147" style="float:left"><br><H1>Jongeren Kansrijker</H1><br>
            </div>
        </head>
        <style>
/*Made by http://www.cssterm.com/css-menus/horizontal-css-menu/simple-drop-down-menu*/

            .drop_menu {
                background:dimgrey;
                list-style-type:none;
                height:50px;
            }
            .drop_menu li { float:left; }
            .drop_menu li a {
                padding:9px 20px;
                display:block;
                color:#fff;
                text-decoration:none;
            }

            /* Submenu */
            .drop_menu ul {
                position:absolute;
                left:-9999px;
                top:-9999px;
                list-style-type:none;
            }
            .drop_menu li:hover { position:relative; background:#3ca222; }
            .drop_menu li:hover ul {
                left:0px;
                top:49px;
                background:#3ca222;
                padding:0px;
            }

            .drop_menu li:hover ul li a {
                padding:5px;
                display:block;
                width:168px;
                text-indent:15px;
                background-color:#3ca222;
            }
            .drop_menu li:hover ul li a:hover { background:#005555; }

        </style>
        <body>
        <div class="drop">
            <ul class="drop_menu">
                <li><a>Activiteiten</a>
                    <ul>
                        <li><a href='../activiti/createActiviti.php'>Toevoegen</a></li>
                        <li><a href='../activiti/overviewActiviti.php'>Overzicht</a></li>
                    </ul>
                </li>
                <li><a>Medewerkers</a>
                    <ul>
                        <li><a href='../users/createUser.php'>Toevoegen</a></li>
                        <li><a href='../users/overviewUsers.php'>Overzicht</a></li>
                    </ul>
                </li>
                <li><a>Instituten</a>
                    <ul>
                        <li><a href='../institute/createInstitute.php'>Toevoegen</a></li>
                        <li><a href='../institute/overviewInstitute.php'>Overzicht</a></li>
                    </ul>
                </li>
                <li><a>Jongeren</a>
                    <ul>
                        <li><a href='../youth/createYouth.php'>Toevoegen</a></li>
                        <li><a href='../youth/overviewYouth.php'>Overzicht</a></li>
                    </ul>
                </li>

                <li><a>Rapporten uitgeschreven jongeren</a>
                    <ul>
                        <?php
                            $sql = new Sql();

                            foreach ($sql->checkYearDropdownPDF() as $value)
                            {
                                $teller = 0;
                                echo "<li><a href='../pdfTable.php?id=".$value[$teller]."'>".$value[$teller]."</a></li>";
                                $teller++;
                            }
                        ?>
                    </ul>
                </li>
                <li><a href='../users/updateUser.php' class="right">Gegevens bewerken</a>
                <li><a href='../../logout.php' class="right">Uitloggen</a>
            </ul>

        </div>
        </body>
        </html>




        <?php
    }
}

