<x-app-layout>
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tickets.index.created') }}">{{ __('Tickety') }}</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('Moje tickety') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">{{ __('Mnou vytvorené aktívne tickety') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- DOM/Jquery table start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="dt-responsive">
                        <div id="dom-jqry_wrapper" class="dt-container dt-bootstrap5">
                            <div class="row mt-2 justify-content-between">
                                <div class="col-md-auto me-auto ">
                                    <div class="dt-length">
                                        <select name="dom-jqry_length" aria-controls="dom-jqry" class="form-select form-select-sm" id="dt-length-0">
                                            <option value="10" selected="selected">10</option><option value="25">25</option>
                                            <option value="50">50</option><option value="100">100</option>
                                        </select>
                                        <label for="dt-length-0"> {{ __('záznamov na stranu') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-auto ms-auto ">
                                    <div class="dt-search">
                                        <label for="dt-search-0">{{ __('Vyhľadať') }}:</label>
                                        <input type="search" class="form-control form-control-sm" id="dt-search-0" placeholder="" aria-controls="dom-jqry">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 justify-content-md-center">
                                <div class="col-12 ">
                                    <table id="dom-jqry" class="table table-striped table-bordered nowrap dataTable" aria-describedby="dom-jqry_info" style="width: 1435px;">
                                        <colgroup>
                                            <col style="width: 284px;">
                                            <col style="width: 396.017px;">
                                            <col style="width: 216.517px;">
                                            <col style="width: 129.117px;">
                                            <col style="width: 232.433px;">
                                            <col style="width: 176.917px;">
                                        </colgroup>
                                        <thead>
                                            <tr role="row">
                                                <th data-dt-column="0" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc dt-ordering-asc" aria-sort="ascending" aria-label="Name: Activate to invert sorting" tabindex="0">
                                                    <span class="dt-column-title" role="button">{{ __('Predmet') }}</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-dt-column="1" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Position: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">{{ __('Učiteľ') }}</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-dt-column="2" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Office: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">{{ __('Vytvorené') }}</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-dt-column="3" rowspan="1" colspan="1" class="dt-type-numeric dt-orderable-asc dt-orderable-desc" aria-label="Age: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">{{ __('Priorita') }}</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-dt-column="4" rowspan="1" colspan="1" class="dt-type-date dt-orderable-asc dt-orderable-desc" aria-label="Start date: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">{{ __('Kategória') }}</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-dt-column="5" rowspan="1" colspan="1" class="dt-type-numeric dt-orderable-asc dt-orderable-desc" aria-label="Salary: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">{{ __('Učebňa') }}</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($tickets->first())
                                            @foreach($tickets as $ticket)
                                                <tr>
                                                    <td class="sorting_1"><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->subject }}</a></td>
                                                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->assignedTo->name }}</a></td>
                                                    <td><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->created_on }}</a></td>
                                                    <td class="dt-type-numeric"><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->priority }}</a></td>
                                                    <td class="dt-type-date"><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->category?->name }}</a></td>
                                                    <td class="dt-type-numeric"><a href="{{ route('tickets.show', $ticket->id) }}">{{ $ticket->classroom?->name }}</a></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" align="center">{{ __('Žiaden ticket') }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                        <tfoot>
                                            <tr role="row">
                                                <th data-dt-column="0" rowspan="1" colspan="1">
                                                    <span class="dt-column-title">{{ __('Predmet') }}</span>
                                                </th>
                                                <th data-dt-column="1" rowspan="1" colspan="1">
                                                    <span class="dt-column-title">{{ __('Učiteľ') }}</span>
                                                </th>
                                                <th data-dt-column="2" rowspan="1" colspan="1">
                                                    <span class="dt-column-title">{{ __('Vytvorené') }}</span>
                                                </th>
                                                <th data-dt-column="3" rowspan="1" colspan="1" class="dt-type-numeric">
                                                    <span class="dt-column-title">{{ __('Priorita') }}</span>
                                                </th>
                                                <th data-dt-column="4" rowspan="1" colspan="1" class="dt-type-date">
                                                    <span class="dt-column-title">{{ __('Kategória') }}</span>
                                                </th>
                                                <th data-dt-column="5" rowspan="1" colspan="1" class="dt-type-numeric">
                                                    <span class="dt-column-title">{{ __('Učebňa') }}</span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            {{--<div class="row mt-2 justify-content-between">
                                <div class="col-md-auto me-auto ">
                                    <div class="dt-info" aria-live="polite" id="dom-jqry_info" role="status">Showing 1 to 10 of 20 entries</div>
                                </div>
                                <div class="col-md-auto ms-auto ">
                                    <div class="dt-paging paging_full_numbers">
                                        <ul class="pagination">
                                            <li class="dt-paging-button page-item disabled">
                                                <a class="page-link first" aria-controls="dom-jqry" aria-disabled="true" aria-label="First" data-dt-idx="first" tabindex="-1">«</a>
                                            </li>
                                            <li class="dt-paging-button page-item disabled">
                                                <a class="page-link previous" aria-controls="dom-jqry" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1">‹</a>
                                            </li>
                                            <li class="dt-paging-button page-item active">
                                                <a href="#" class="page-link" aria-controls="dom-jqry" aria-current="page" data-dt-idx="0" tabindex="0">1</a>
                                            </li>
                                            <li class="dt-paging-button page-item">
                                                <a href="#" class="page-link" aria-controls="dom-jqry" data-dt-idx="1" tabindex="0">2</a>
                                            </li>
                                            <li class="dt-paging-button page-item">
                                                <a href="#" class="page-link next" aria-controls="dom-jqry" aria-label="Next" data-dt-idx="next" tabindex="0">›</a>
                                            </li>
                                            <li class="dt-paging-button page-item">
                                                <a href="#" class="page-link last" aria-controls="dom-jqry" aria-label="Last" data-dt-idx="last" tabindex="0">»</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- DOM/Jquery table end -->
    </div>

    @vite(['resources/js/dataTables.min.js', 'resources/js/dataTables.bootstrap5.min.js'])
</x-app-layout>
