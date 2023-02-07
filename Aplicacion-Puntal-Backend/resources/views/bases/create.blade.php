@extends('layouts.app')

@section('template_title')
    Create Base
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Base</span>
                        <a class="btn btn-info btn-sm float-right m-3" href="{{ route('bases.index') }}"> Back</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('bases.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('bases.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
