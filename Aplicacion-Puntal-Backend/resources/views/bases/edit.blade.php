@extends('layouts.app')

@section('template_title')
    Update Base
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Base</span>
                        <a class="btn btn-info btn-sm float-right m-3" href="{{ route('bases.index') }}"> Back</a>
                    </div>
                    <div class="card-body">
                    {{-- {{dd($bases)}} --}}
                        <form method="POST" action="{{ route('bases.update', $bases->idPlaza) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('bases.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
