<!-- Delete pop-up panel -->
<div class="modal fade" id="excel-modal">
    <div class="modal-dialog modal-dialog-centered">">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    Generuj Exel
                </h5>
            </div>
            <!-- Modal body -->
            <form method="GET" action="{{ route('export') }}">
                <div class="modal-body">

                    <label for="dateStart">Data startu: </label>
                    <input type="date" id="dateStart" name="dateStart" class="form-control"/>
                    <small id="quantityHelp" class="form-text text-muted">Od kiedy mają być wpisywane faktury.</small>
                    <br>
                    <label for="dateEnd">Data końcowa:</label>
                    <input type="date" value="{{ now()->format('Y-m-d')}}" id="dateEnd" name="dateEnd" class="form-control">
                    <small id="quantityHelp" class="form-text text-muted">Do kiedy mają być wpisywane faktury.</small>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="addButton">
                        Generuj
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>
</div>
