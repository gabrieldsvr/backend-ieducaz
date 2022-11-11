@extends('layouts.master-mini')
@section('content')
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo">
                        <img src="../../../../images/logo.svg" alt="logo">
                    </div>



                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />


                    <h4>Olá, Bem vindo ao SalesHome</h4>
                    <h6 class="fw-light">Faça login para entrar.</h6>
                    <form class="pt-3" method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >Entrar</button>
                        </div>
                        <div class="text-center mt-4 fw-light">
                            Não tem uma conta ainda? <a href="{{route("register")}}" class="text-primary">Cadastrar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


