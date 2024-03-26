<!-- Delete pop-up panel -->
<div class="modal fade" id="add-modal-{{$id}}">
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
            <form method="POST" action="{{route('invoices.stock.add')}}" >
                <div class="modal-body">

                    @csrf
                    @method('PUT')
                    <label for="quantityToAdd">Liczba do dodania:</label>
                    <input type="number" min="0" id="quantityToAdd" name="quantityToAdd" class="form-control"
                           value="">
                    <input type="hidden"  name="id" value="{{$invoice->id}}" />
                    <small id="quantityHelp" class="form-text text-muted">Podaj liczbę sztuk które chcesz dodać.</small>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="addButton" data-invoice-id="{{ $invoice->id }}">
                        Dodaj
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>
</div>
