<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>

                <h4 class="modal-title" id="mdltitulo"></h4>

            </div>

            <form method="post" id="fajaConsumo_form">

                <div class="modal-body">

                    <input type="hidden" id="fajaConsumo_id" name="fajaConsumo_id">

                    <div class="form-group">

                        <label class="form-label" for="cmbFajaConsumo">Tarifas</label>

                        <select class="select2" id="cmbFajaConsumo" name="cmbFajaConsumo" required>


                        </select>

                    </div>

                    <div class="form-group">

                        <label class="form-label" for="consumo_inicial">Consumo Inicial</label>
                        <input type="number" class="form-control" id="consumo_inicial" name="consumo_inicial" onkeyup="format(this)" onchange="format(this)" placeholder="Ingrese Consumo Inicial" required>

                    </div>

                    <div class="form-group">

                        <label class="form-label" for="consumo_final">Consumo Final</label>
                        <input type="number" class="form-control" id="consumo_final" name="consumo_final" placeholder="Ingrese Consumo Final" onkeyup="format(this)" onchange="format(this)" required>

                    </div>

                    <div class="form-group">

                        <label class="form-label decimales" for="precio">Precio</label>
                        <input type="number" step="any" class="form-control" id="precio" name="precio" placeholder="Ingrese Precio por kWh" oninput="limitDecimalPlaces(event, 2)" onkeypress="return isNumberKey(event)" required>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>

                </div>

            </form>

        </div>

    </div>

</div>