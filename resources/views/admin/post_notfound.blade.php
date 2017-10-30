@extends('admin.layout.master')
@section('body')
    <div class="container">
        <main>
            <div class="alert alert-danger" role="alert">
                Գրառում <strong class="text-inverse text-inverse-light">#{{ $reference }}</strong> գոյություն չունի:
                <hr>
                <a href="{{ route('_admin.post.create') }}" role="button" class="btn btn-success">
                    <i class="fa fa-fw fa-plus"></i> Ստեղծել նորը</a>
                <a href="{{ route('_admin.posts') }}" role="button" class="btn btn-light">
                    <i class="fa fa-fw fa-database"></i> Բոլոր գրառումները</a>
            </div>
        </main>
    </div>
@endsection