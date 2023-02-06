@extends('layouts.app')

@section('template_title')
    Create Muelle
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Muelle</span>
                        <a href="{{ route('muelles.index') }}" class="btn btn-info btn-sm float-right m-3" data-placement="left">
                                {{ __('Back') }}
                            </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('muelles.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('muelle.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
