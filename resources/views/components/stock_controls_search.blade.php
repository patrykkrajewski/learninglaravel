<div class="d-flex justify-content-center mb-4">
    <nav class="navbar navbar-light bg-light">
        <!--Search form-->
        <form method="GET" action="{{ route('stock_controls.search') }}" class="form-inline d-flex">
            <!--Search by name or number-->
            <input name="search" class="form-control w-5" type="search" placeholder="Operacja/Numer"
                   aria-label="Search" value="{{ request()->input('search') }}">
            <!--Search by start date-->
            <input name="start_date" class="form-control w-3" type="date" placeholder="Start Date"
                   aria-label="Start Date" value="{{ request()->input('start_date') }}">
            <!--Search by end date-->
            <input name="end_date" class="form-control w-3" type="date" placeholder="End Date"
                   aria-label="End Date" value="{{ request()->input('end_date') }}">
            <!--Search button-->
            <button class="btn btn-outline-success" type="submit">Wyszukaj</button>
        </form>
    </nav>
</div>
