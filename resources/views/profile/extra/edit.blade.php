@extends('layouts.profile')

@section('profile-content')
<div class="row">
    <div class="col-md-12">
        <h5>Επεξεργασία επιπλέον πληροφορίας</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('profile.extra.update', ['extra'=>$extra->id]) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="content">{{ $extra->description }}</label>
                <textarea class="form-control" id="content" name="content" rows="3" required maxlength="1024">{{ $extra->pivot->content }}</textarea>        
                <small class="text-muted">Μέγιστος αριθμός χαρακτήρων: 1024</small>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.extra.index') }}">Άκυρο</a>
        </form>
    </div>
</div>
@endsection
