@extends('template.components.default')

@section('content')
    @role('super-admin')
        <p>welcome super admin</p>
    @endrole

    @role('user')
        <p>welcome user</p>
    @endrole

    @role('admin')
        <p>welcome admin</p>
    @endrole

    @include('template.components.badges')
@endsection
