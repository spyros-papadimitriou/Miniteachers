@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5>Επικοινωνία</h5>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            @if(session()->has('message'))
            <div class="alert alert-success mb-3">
                {{ session()->get('message') }}
            </div>
            @endif

            @foreach ($errors->all() as $error)
            <span class="text-danger">- {{ $error }}</span><br />
            @endforeach

            <form action="" method="post">
                @csrf
                @method('post')
                <div class="form-group">
                    <label for="name">Ονοματεπώνυμο*</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="subject">Θέμα*</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}">
                </div>

                <div class="form-group">
                    <label for="message">Μήνυμα*</label>
                    <textarea class="form-control" id="content" name="content" rows="3">{{ old('content') }}</textarea>
                    <small class="text-muted">Μέχρι 255 χαρακτήρες.</small>
                </div>

                <div class="form-group">
                    @if(env('GOOGLE_RECAPTCHA_KEY'))
                    <div class="g-recaptcha mb-3"
                         data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                    </div>
                    @endif
                </div>

                <p class="text-muted small">* Υποχρεωτικό πεδίο</p>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Αποστολή</button>
                </div>
            </form>
        </div>

        <div class='col-md-3 offset-md-3'>
            @tip(contact)
        </div>
    </div>


</div>
@endsection
