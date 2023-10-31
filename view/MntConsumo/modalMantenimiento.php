<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>

                <h4 class="modal-title" id="mdltitulo"></h4>

            </div>

            <form method="post" id="consumo_form">

                <div class="modal-body">

                    <input type="hidden" id="cons_id" name="cons_id">
                    <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

                    <!-- ==================================================== -->
                    <div class="col-lg-12"><br></div>

                    <div class="col-lg-12">

                        <div class="form-group">

                            <label class="form-label semibold" for="tar_id">Tarifas</label>

                            <select class="select2" id="tar_id" name="tar_id" required>


                            </select>

                        </div>

                    </div>

                    <!-- ==================================================== -->

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-label semibold" for="periodo_inicial">Periodo Inicial</label>
                            <input type="date" class="form-control" id="periodo_inicial" name="periodo_inicial" required>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-label semibold" for="periodo_final">Periodo Final</label>
                            <input type="date" class="form-control" id="periodo_final" name="periodo_final" required>

                        </div>

                    </div>

                    <!-- ==================================================== -->

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-label semibold" for="lectura_act">Lectura Actual kWh</label>
                            <input type="number" min="0" class="form-control" id="lectura_act" name="lectura_act" value="0" placeholder="Ingrese Lectura Actual" required>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-label semibold" for="lectura_ant">Lectura Anterior kWh</label>
                            <input type="number" min="0" class="form-control" id="lectura_ant" name="lectura_ant" value="0" placeholder="Ingrese Lectura Anterior" required>

                        </div>

                    </div>

                    <!-- ==================================================== -->

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-label semibold" for="consumo">Consumo kWh</label>
                            <input type="text" class="form-control" id="consumo" name="consumo" placeholder="Consumo" readonly>

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-label semibold" for="fecha_crea">Fecha Registro</label>
                            <input type="date" class="form-control" id="fecha_crea" name="fecha_crea" readonly>

                        </div>

                    </div>

                    <!-- ==================================================== -->

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>

                </div>

            </form>

        </div>

    </div>

</div>