<!-- edit stock_controls pop-up panel -->
<div class="modal fade" id="delete-modal-{{$id}}">
    <div class="modal-dialog modal-dialog-centered">">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    Edytujesz faktury nr {{ $stock->invoice_number }}
                </h5>
            </div>
            <!-- Modal body -->
            <!-- Routing do napisania, poprawa na js wyswietlanie pop-upów oraz nazy id itp -->
            <form method="POST" action="" >
                <div class="modal-body">
                    @csrf
                    @method('PUT')


                    <label for="quantityToRemove">Nazwa operacji:</label>
                    <input type="text" id="quantityToRemove" name="quantityToRemove" class="form-control" value="{{ $stock->title}}">
                    <small id="quantityHelp" class="form-text text-muted">Podaj poprawioną nazwe operacji.</small>

                    <label for="quantityToRemove">Numer faktury:</label>
                    <input type="text" id="quantityToRemove" name="quantityToRemove" class="form-control" value="{{ $stock->invoice_id}}">
                    <small id="quantityHelp" class="form-text text-muted">Podaj poprawiony numer faktury.</small>

                    <label for="quantityToRemove">Nazwa produktu:</label>
                    <input type="text" id="quantityToRemove" name="quantityToRemove" class="form-control" value="{{ $stock->product_name}}">
                    <small id="quantityHelp" class="form-text text-muted">Podaj poprawioną nazwe produktu.</small>

                    <label for="quantityToRemove">Data wystawienia faktury:</label>
                    <input type="date" value="{{ $stock->operation_date->format('Y-m-d')}}"  id="quantityToRemove" name="quantityToRemove" class="form-control">
                    <small id="quantityHelp" class="form-text text-muted">Podaj poprawioną date wystawienia faktury.</small>

                    <label for="quantityToRemove">Ilość sztuk:</label>
                    <input type="date" value="{{ $stock->quantity}}"  id="quantityToRemove" name="quantityToRemove" class="form-control">
                    <small id="quantityHelp" class="form-text text-muted">Podaj poprawioną ilość sztuk.</small>

                    <label for="quantityToRemove">Przeniesione do:</label>
                    <input type="text" value="{{ $stock->move_to}}"  id="quantityToRemove" name="quantityToRemove" class="form-control">
                    <small id="quantityHelp" class="form-text text-muted">Podaj poprawione przeniesienie.</small>

                    <input type="hidden" name="search" value="{{$search ?? null}}"/>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="deleteButton" data-invoice-id="{{ $stock->id }}">
                        Edytuj
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>
</div>
