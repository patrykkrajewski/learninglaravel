<!-- Delete pop-up panel -->
<div class="modal fade" id="move-modal-{{$id}}">
    <div class="modal-dialog modal-dialog-centered">">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    Edycja faktury nr {{ $invoice->invoice_number }}
                </h5>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{route('invoices.stock.move')}}">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <label for="placeToMove">Gdzie chcesz przenieść:</label>
                    <input type="text"  id="placeToMove" name="placeToMove" class="form-control" value="{{$invoice->place}}">
                    <small id="placeHelp" class="form-text text-muted">Podaj miejsce przeniesienia.</small>
                    <br>
                    <label for="quantityToMove">Liczba sztuk do przeniesienia:</label>
                    <input type="number" min="1" value="1" id="quantityToMove" name="quantityToMove" class="form-control">
                    <small id="quantityHelp" class="form-text text-muted">Podaj liczbę sztuk które chcesz przenieść.</small>
                    <br>
                    <label for="operationDateToMove">Data operacja:</label>
                    <input type="date" value="{{date("Y-m-d")}}" id="operationDateToMove" name="operationDateToMove" class="form-control">
                    <small id="quantityHelp" class="form-text text-muted">Podaj date operacji</small>
                    <input type="hidden" name="id" value="{{$invoice->id}}"/>
                    <input type="hidden" name="invoice_number" value="{{ $invoice->invoice_number }}"/>
                    <input type="hidden" name="product_name" value="{{ $invoice->product_name }}"/>
                    <input type="hidden" name="search" value="{{$search ?? null}}"/>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="moveButton" data-invoice-id="{{ $invoice->id }}">
                        Przenieś
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>
</div>
