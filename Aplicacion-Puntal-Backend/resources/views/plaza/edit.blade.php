@extends('layouts.app')

@section('template_title')
    Update Plaza
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Plaza</span>
                         <a class="btn btn-info btn-sm float-right m-3" href="{{ route('plazas.index') }}"> Back</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('plazas.update', $plaza->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('plaza.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
