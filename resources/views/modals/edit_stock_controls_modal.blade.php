<!-- edit stock_controls pop-up panel -->
<div class="modal fade" id="edit-modal-{{$id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    Edytujesz fakturę nr {{ $stock->invoice_id }}
                </h5>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('stock_controls.update', ['id' => $stock->id]) }}">
                @csrf
                @method('PUT')

                <input type="text" id="invoice_id" name="invoice_id" class="d-none"
                       value="{{ $stock->invoice_id }}">
                <div class="modal-body">
                    <div class="row">
                        <label for="title">Nazwa operacji:</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $stock->title }}">
                        <small id="titleHelp" class="form-text text-muted">Podaj poprawioną nazwę operacji.</small>
                    </div>
                    <div class="row">
                        <label for="invoice_number">Numer faktury:</label>
                        <input type="text" id="invoice_number" name="invoice_number" class="form-control"
                               value="{{ $stock->invoice->invoice_number }}">
                        <small id="invoiceNumberHelp" class="form-text text-muted">Podaj poprawiony numer
                            faktury.</small>
                    </div>
                    <div class="row">
                        <label for="product_name">Nazwa produktu:</label>
                        <input type="text" id="product_name" name="product_name" class="form-control"
                               value="{{ $stock->product_name }}">
                        <small id="productNameHelp" class="form-text text-muted">Podaj poprawioną nazwę
                            produktu.</small>
                    </div>
                    <div class="row">
                        <label for="operation_date">Data wystawienia faktury:</label>
                        <input type="date" id="operation_date" name="operation_date"
                               value="{{ $stock->operation_date->format('Y-m-d') }}" class="form-control">
                        <small id="operationDateHelp" class="form-text text-muted">Podaj poprawioną datę wystawienia
                            faktury.</small>
                    </div>
                    <div class="row">
                        <label for="quantity">Ilość sztuk:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control"
                               value="{{ $stock->quantity }}">
                        <small id="quantityHelp" class="form-text text-muted">Podaj poprawioną ilość sztuk.</small>
                    </div>
                    <div class="row">
                        <label for="move_to">Przeniesione do:</label>
                        <input type="text" id="move_to" name="move_to" class="form-control"
                               value="{{ $stock->move_to }}">
                        <small id="moveToHelp" class="form-text text-muted">Podaj poprawione przeniesienie.</small>
                    </div>
                    <input type="hidden" name="search" value="{{ $search ?? null }}"/>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edytuj</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>
</div>
