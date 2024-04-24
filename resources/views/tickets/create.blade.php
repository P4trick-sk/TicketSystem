<x-app-layout>
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tickets.index.created') }}">{{ __('Tickety') }}</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('Vytvoriť ticket') }}</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">{{ __('Vytvorenie ticketu') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('tickets.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">{{ __('Predmet') }}:</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="{{ __('Zadefinujte problém') }}" value="{{ old('subject') }}" required autofocus>
                            <small class="form-text text-muted">{{ __('Napíšte krátkú a trefnú definíciu problému') }}</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Popis') }}:</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="{{ __('Popíšte problém') }}" value="{{ old('description') }}" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">{{ __('Miestnosť') }}:</label>
                                    <select class="form-select" id="classroom_id" name="classroom_id" autocomplete="off" required aria-label="select example">
                                        <option selected="selected" disabled="disabled">{{ __('Vyberte') }}</option>
                                        @foreach($classrooms as $classroom)
                                            <option value="{{$classroom->id}}" >{{ $classroom->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <x-category-select :categoryTypes="$categoryTypes"></x-category-select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">{{ __('Popis') }}:</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="{{ __('Popíšte problém') }}" value="{{ old('description') }}" required></textarea>
                        </div>
                        <div class="form-file mb-3">
                            <label class="form-label">{{ __('Prílohy') }}:</label>
                            <input type="file" class="form-control" aria-label="attachment" name="attachments[]" id="attachment" multiple required>
                            {{--<div class="invalid-feedback">Example invalid form file feedback</div>--}}
                        </div>
                        <button class="btn btn-primary" type="submit">{{ __('Odoslať') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
