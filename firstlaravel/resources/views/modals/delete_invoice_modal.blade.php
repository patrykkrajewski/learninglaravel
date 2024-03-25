<!-- Delete pop-up panel -->
<div class="modal fade" id="delete-modal-{{$id}}">
    <div class="modal-dialog modal-dialog-centered">">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    @if(isset($invoice->invoice_number))
                        Edycja faktury nr {{ $invoice->invoice_number }}
                    @else
                        Edycja faktury
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{route('invoices.stock.delete')}}" >
                <div class="modal-body">

                        @csrf
                        @method('PUT')
                        <label for="quantityToRemove">Liczba do usunięcia:</label>
                        <input type="number" min="0" id="quantityToRemove" name="quantityToRemove" class="form-control"
                               value="">
                        <input type="hidden"  name="id" value="{{$invoice->id}}" />
                        <small id="quantityHelp" class="form-text text-muted">Podaj liczbę sztuk które chcesz usunąć.</small>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="deleteButton" data-invoice-id="{{ $invoice->id }}">
                        Usuń
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>
</div>
