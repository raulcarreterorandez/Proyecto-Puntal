@extends('layouts.app')

@section('template_title')
    Create Transito
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Transito</span>
                        <a class="btn btn-info btn-sm float-right m-3" href="{{ route('transito.index') }}"> Back</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('transitos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('transito.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
