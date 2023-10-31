<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>

                <h4 class="modal-title" id="mdltitulo"></h4>

            </div>

            <form method="post" id="descuento_form">

                <div class="modal-body">

                    <input type="hidden" id="desc_id" name="desc_id">

                    <div class="form-group">

                        <label class="form-label" for="tar_id">Tarifas</label>

                        <select class="select2" id="tar_id" name="tar_id" required>


                        </select>

                    </div>

                    <div class="form-group">

                        <label class="form-label" for="desde">Desde kWh</label>
                        <input type="number" class="form-control" id="desde" name="desde" placeholder="Ingrese Consumo Inicial" onkeyup="format(this)" onchange="format(this)" required>

                    </div>

                    <div class="form-group">

                        <label class="form-label" for="hasta">Hasta kWh</label>
                        <input type="number" class="form-control" id="hasta" name="hasta" placeholder="Ingrese Consumo Final" onkeyup="format(this)" onchange="format(this)" required>

                    </div>

                    <div class="form-group">

                        <label class="form-label" for="descuento">Descuento %</label>
                        <input type="number" step="any" class="form-control" id="descuento" name="descuento" placeholder="Ingrese el Descuento" placeholder="Ingrese Precio por kWh" oninput="limitDecimalPlaces(event, 2)" onkeypress="return isNumberKey(event)" required>

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