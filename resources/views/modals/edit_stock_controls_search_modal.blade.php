<!-- edit stock_controls pop-up panel -->
<div class="modal fade" id="edit-modal-{{$id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    Edytujesz fakturę nr {{ $result->invoice_id }}
                </h5>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('stock_controls.update', ['id' => $result->id]) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <label for="title">Nazwa operacji:</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ $result->title }}">
                        <small id="titleHelp" class="form-text text-muted">Podaj poprawioną nazwę operacji.</small>
                    </div>
                    <div class="row">
                        <label for="invoice_number">Numer faktury:</label>
                        <input type="text" id="invoice_id" name="invoice_id" class="form-control"
                               value="{{$result['invoice']['invoice_number']}}">
                        <small id="invoiceNumberHelp" class="form-text text-muted">Podaj poprawiony numer
                            faktury.</small>
                    </div>
                    <div class="row">
                        <label for="product_name">Nazwa produktu:</label>
                        <input type="text" id="product_name" name="product_name" class="form-control"
                               value="{{$result['invoice']['product_name']}}">
                        <small id="productNameHelp" class="form-text text-muted">Podaj poprawioną nazwę
                            produktu.</small>
                    </div>
                    <div class="row">
                        <label for="operation_date">Data wystawienia faktury:</label>
                        <input type="date" id="operation_date" name="operation_date"
                               value="{{ $result->operation_date->format('Y-m-d') }}" class="form-control">
                        <small id="operationDateHelp" class="form-text text-muted">Podaj poprawioną datę wystawienia
                            faktury.</small>
                    </div>
                    <div class="row">
                        <label for="quantity">Ilość sztuk:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control"
                               value="{{ $result->quantity }}">
                        <small id="quantityHelp" class="form-text text-muted">Podaj poprawioną ilość sztuk.</small>
                    </div>
                    <div class="row">
                        <label for="move_to">Przeniesione do:</label>
                        <input type="text" id="move_to" name="move_to" class="form-control"
                               value="{{ $result->move_to }}">
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
