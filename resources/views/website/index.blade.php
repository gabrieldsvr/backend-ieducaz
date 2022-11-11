<?php
use App\Http\Controllers\InputController;
?>


@extends('layouts.master')

@push('styles')

    <link rel="stylesheet" href="{{url('vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('vendors/owl-carousel-2/owl.theme.default.min.css')}}">

@endpush

@section('content')


    <div class="row">
        <div class="col-2">
            <ul class="nav nav-pills nav-pills-vertical nav-pills-info" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <li class="nav-item">
                    <a class="nav-link <?=$pageTypeId == 1 ? 'active' : ''?>" href="{{route('website',[1])}}">
                        <i class="ti-home"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$pageTypeId == 2 ? 'active' : ''?>" href="{{route('website',[2])}}">
                        <i class="ti-menu"></i>
                        Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$pageTypeId == 3 ? 'active' : ''?>" id="v-pills-rodape-tab"
                       data-bs-toggle="pill" href="#v-pills-rodape" role="tab"
                       aria-controls="v-pills-rodape" aria-selected="false">
                        <i class="ti-menu-alt" href="{{route('website',[2])}}"></i>
                        Rodapé
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$pageTypeId == 4 ? 'active' : ''?>" id="v-pills-info-tab"
                       data-bs-toggle="pill" href="#v-pills-info" role="tab"
                       aria-controls="v-pills-info" aria-selected="false">
                        <i class="ti-info"></i>
                        Sobre
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$pageTypeId == 5 ? 'active' : ''?>" id="v-pills-contato-tab"
                       data-bs-toggle="pill" href="#v-pills-contato"
                       role="tab" aria-controls="v-pills-contato" aria-selected="false">
                        <i class="ti-email"></i>
                        Contato
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?=$pageTypeId == 6 ? 'active' : ''?>" id="v-pills-procura-tab"
                       data-bs-toggle="pill" href="#v-pills-procura"
                       role="tab" aria-controls="v-pills-procura" aria-selected="false">
                        <i class="ti-search"></i>
                        Procura
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-10">
            @switch($pageTypeId)
                @case($pageTypeId == 1)
                    {{view('website.home')}}
                    @break
                @case($pageTypeId == 2)
                    {{view('website.menu')}}
                    @break
            @endswitch
{{--            <div class="row">--}}
{{--                <div class="col-12 px-5">--}}
{{--                    <div class="container">--}}
{{--                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"--}}
{{--                             aria-labelledby="v-pills-home-tab">--}}
{{--                            --}}{{--                       CARROSSEL--}}
{{--                            <?= $carrosel?>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <hr>--}}
{{--            <div class="row">--}}

{{--                <div class="col-12">--}}
{{--                  --}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>



@endsection

@push('plugin-scripts')
    <script src="{{ url("vendors/owl-carousel-2/owl.carousel.min.js") }}"></script>
@endpush

@push('custom-scripts')
    <script>
        {{--        CARROSSEL--}}
            $.fn.andSelf = function () {
            return this.addBack.apply(this, arguments);
        }

        var owl = $('.carrosel').owlCarousel({
            margin: 10,
            items: 1,
            nav: true,
            mouseDrag: false,
            touchDrag: false,
            pullDrag: false,
            freeDrag: false,
            rewind: true,
            navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"]
        });

        owl.on('changed.owl.carousel', function (event) {
            callback(event)
        })

        function callback(e) {
            console.log(e)
        }
    </script>
@endpush
