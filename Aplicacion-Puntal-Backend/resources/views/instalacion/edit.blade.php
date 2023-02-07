@extends('layouts.app')

@section('template_title')
    Update Instalacion
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Instalacion</span>
                        <a class="btn btn-info btn-sm float-right m-3" href="{{ route('instalaciones.index') }}"> Back</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('instalaciones.update', $instalacion->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('instalacion.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
