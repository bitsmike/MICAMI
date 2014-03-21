<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<header class="navbar navbar-inverse navbar-static-top" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a  id="" class="navbar-brand" href="#" onclick="btnPress('inicio');">Tiendas Micami</a>
        </div>
        <div class="collapse navbar-collapse bs-navbar-collapse" id="botoneraderubros" role="navigation">
            <ul class="nav navbar-nav">
                <li id="btnJugueteria"><a href="#" onclick="btnPress('Jugueteria');">JUGUETERIA</a></li>
                <li id="btnMaleteria"><a href="#" onclick="btnPress('Maleteria');">MALETERIA</a></li>
                <li id="btnLibreria"><a href="#" onclick="btnPress('Libreria');">LIBRERIA</a></li>
                <li id="btnAbarroteria"><a href="#" onclick="btnPress('Abarroteria');">ABARROTERIA</a></li>
                <li>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="" placeholder="Buscar carrito, muñeca, leche,etc" name="srcBuscar" required>
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </form>
                </li>
                <li>
                    <a type="submit"  class="navbar-right" id="miBolsa" onclick="">
                        MI BOLSA DE COMPRAS
                        <span class="badge" id="contadorProductos">0</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="row-fluid container" id="logeoIdentidad">
        </div>
    </div>
</header>