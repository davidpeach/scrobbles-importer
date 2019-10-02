@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <router-link to="/artists">Artists</router-link> --
        <router-link to="/albums">Albums</router-link> --
        <router-link to="/listens">Listens</router-link>
        <div class="col-md-12">
            <router-view></router-view>
        </div>
    </div>
</div>
@endsection
