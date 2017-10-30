@extends('admin.layout.master')
@section('body')
    <div class="container">
        <main>
            @if(isset($result) && $result == 'delete-ok')
            <div class="alert alert-info" role="alert">
                Հաջողվեց ջնջել գրառումը:
                <hr>
                <a href="{{ route('_admin.post.create') }}" role="button" class="btn btn-success">
                    <i class="fa fa-fw fa-plus"></i> Ստեղծել նորը</a>
                <a href="{{ route('_admin.posts') }}" role="button" class="btn btn-light">
                    <i class="fa fa-fw fa-database"></i> Բոլոր գրառումները</a>
            </div>
            @endif
        </main>
    </div>
@endsection