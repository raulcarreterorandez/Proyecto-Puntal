@extends('layouts.links')

<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>

<section class="vh-100">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                {{-- <img src="{{URL::asset('assets/fondoLogin.jpg')}}" class="img-fluid"> --}}
                <img src="{{ asset('assets/fondoLogin.jpg') }}" class="img-fluid">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <h1>LOGIN</h1>
                <form method="post" action="{{ route('logear') }}">
                    @csrf

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Email address</label>
                        <input name="email" type="email" id="form3Example3" class="form-control form-control-lg"
                            placeholder="Enter a valid email address" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Password</label>
                        <input name="password" type="password" id="form3Example4" class="form-control form-control-lg"
                            placeholder="Enter password" />
                    </div>

                    @if (session('message'))
                        <h4 style="color: red">{{ session('message') }}</h4>
                    @endif

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div
        class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
        <!-- Copyright -->
        <div class="text-white mb-3 mb-md-0">
            Copyright © 2020. All rights reserved.
        </div>
        <!-- Copyright -->

        <!-- Right -->
        <div class="text-white mb-3 mb-md-0">
            PROYECTO PUNTAL
        </div>
        <!-- Right -->
    </div>
</section>
