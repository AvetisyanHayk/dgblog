@if(count($errors) > 0)
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading"><i class="fa fa-fw fa-warning"></i> Ուշադրություն</h4>
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif