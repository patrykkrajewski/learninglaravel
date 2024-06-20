<!-- Delete pop-up panel -->
<div class="modal fade" id="delete-modal-{{$id}}">
    <div class="modal-dialog modal-dialog-centered">">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">
                    Edytujesz faktury nr {{ $invoice->invoice_number }}
                </h5>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('invoices.stock.delete') }}">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <label for="quantityToRemove">Liczba do usunięcia:</label>
                    <input type="number" min="0" id="quantityToRemove" name="quantityToRemove" class="form-control"
                           value="">
                    <input type="hidden" name="id" value="{{ $invoice->id }}"/>
                    <input type="hidden" name="invoice_number" value="{{ $invoice->invoice_number }}"/>
                    <small id="quantityHelp" class="form-text text-muted">Podaj liczbę sztuk, które chcesz
                        usunąć.</small>
                    <br><br>
                    <label for="s_type">Jaki rodzaj sprzedarzy:</label>
                    <select id="s_type" name="s_type" class="form-control">
                        <option value="Sprzedarz stacjonarna">Sprzedarz stacjonarna</option>
                        <option value="Sprzedarz internetowa">Sprzedarz internetowa</option>
                    </select>
                    <!-- Dodaj pole jako ukryte pole -->
                    <input type="hidden" name="product_name" value="{{ $invoice->product_name }}"/>
                    <!-- Dodaj pole jako ukryte pole -->

                    <br>
                    <label for="invDate">Data wystawienia faktury:</label>
                    <input type="date" value="{{ $invoice->invoice_date->format('Y-m-d')}}" id="invDate"
                           name="invDate" class="form-control">
                    <small id="quantityHelp" class="form-text text-muted">Podaj poprawioną date wystawienia
                        faktury.</small>
                    <input type="hidden" name="search" value="{{$search ?? null}}"/>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="deleteButton"
                            data-invoice-id="{{ $invoice->id }}">
                        Zapisz
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                </div>
            </form>
        </div>
    </div>
</div>
