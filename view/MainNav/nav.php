<?php
    if ($_SESSION["rol_id"]==1){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\MntConsumo\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Gestionar Consumo</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Nuevo Ticket</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Consultar Ticket</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }else{
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\MntUsuario\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Gestionar Usuario</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\MntTarifas\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Gestionar Tarifas</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\MntFajaConsumo\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Gestionar Faja Consumo</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\MntDescuento\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Gestionar Descuento</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Nuevo Ticket</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Consultar Ticket</span>
                        </a>
                    </li>

                </ul>
            </nav>
        <?php
    }
?>
