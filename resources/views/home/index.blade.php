@extends('layouts.master')

@push('styles')

@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 ">
            <div class="row flex-grow">
                <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="card-title card-title-dash">INFORMAÇÕES</h3>
                                </div>
                            </div>
                           <div class="row">
                               <h4>Empresa: {{$company->name}}</h4>
                               <h4>WebSite: {{$website->name}} - {{$website->domain}}</h4>

                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')

@endpush

@push('custom-scripts')
@endpush
