<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container-fluid">
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <div class="span12">
                    <div class="span4">
                        <a class="brand" href="#" onclick="btnPress('inicio');">MICAMI.com</a>
                    </div>
                    <div class="row-fluid" id="buscador">
                        <form class="navbar-search">
                            <input type="text" class="search-query" placeholder="Buscar carrito, muñeca, leche,etc" name="srcBuscadorMicami">
                        </form>
                    </div>
                    <div class="row-fluid" id="logeoIdentidad">

                    </div>
                </div>
            </div>
                
            <div id="botoneraderubros">
                <div class="row-fluid">
                    <div class="">
                        <button class="btn btn-success" id="jugueteria" onclick="btnPress('Jugueteria');">JUGUETERIA</button>
                        <button class="btn btn-success" id="maleteria" onclick="btnPress('Maleteria');">MALETERIA</button>
                        <button class="btn btn-success" id="libreria" onclick="btnPress('Libreria');">LIBRERIA</button>
                        <button class="btn btn-success" id="abarroteria" onclick="btnPress('Abarroteria');">ABARROTERIA</button>
                        <button class="btn btn-warning offset4 dropdown-toggle" data-toggle="dropdown" id="miBolsa" onclick="">
                            MI BOLSA DE COMPRAS
                            <span class="badge" id="contadorProductos"></span>
                        </button>
                        <div class="bolsadecompras"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
