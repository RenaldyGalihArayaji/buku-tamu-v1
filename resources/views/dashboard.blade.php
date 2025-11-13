@extends('layouts.app')

@section('content')
    <div class="title">
        Dashboard
    </div>

    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-12">
                <div class="card border-0 h-100 py-3" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <h5 class="font-weight-bold text-uppercase text-secondary mb-1">SELAMAT DATANG <strong>{{ Auth::user()->name }}</strong></h5>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <img src="{{ asset('template-admin/assets/image/tugas-sukses.gif') }}" alt=""
                                    width="60" height="60">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
