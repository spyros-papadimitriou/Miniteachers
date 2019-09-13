@extends('layouts.profile')

@section('profile-content')

<div class="row">
    <div class="col-md-12">
        <h5>Προσθήκη/Επεξεργασία στόχων - ομάδων</h5>
    </div>
</div>
<hr />

<div class="row">
    <div class="col-md-9">
        <form action="{{ route('profile.target-groups.store') }}" method="post">
            @csrf
            @foreach ($targetGroups as $targetGroup)
            @if ($loop->iteration % 3 == 1)
            <div class="row mb-3">
                @endif
                <div class="col-md-4">
                    <div class="card small">
                        <label class="card-header text-center" style="cursor: pointer;" for="target-group{{ $targetGroup->id }}">
                            <b>{{ $targetGroup->name }}</b><br />
                            <img src="{{ $targetGroup->picture }}" height="48" alt="">
                        </label>

                        <div class="card-body text-center">                               
                            <input class="form-checkbox" type="checkbox" name="targetGroups[]" id="target-group{{ $targetGroup->id }}" value="{{ $targetGroup->id }}"{{ $user->targetGroups->contains($targetGroup) ? ' checked': null}}>
                        </div>
                    </div>
                </div>
                @if ($loop->iteration % 3 == 0 || $loop->last)
            </div>
            @endif    
            @endforeach
            <button class="btn btn-primary btn-sm" type="submit">Αποθήκευση</button>
            <a class="btn btn-danger btn-sm" href="{{ route('profile.target-groups.index') }}">Άκυρο</a>
        </form>
    </div>

    <div class='col-md-3 mt-3'>
        <div class="card bg-light">
            <div class="card-header">
                <img src='{{ asset('svg/info.svg') }}' height="24" alt=''> Tip
            </div>
            <div class="card-body">
                <blockquote class="mb-0">
                    <p>Μπορείτε να επιλέξετε πολλούς στόχους - ομάδες μαζί. Αν αποεπιλέξετε κάποιο επιλεγμένο στόχο - ομάδα, θα διαγραφεί από τη λίστα με τους στόχους - ομάδες που διδάσκετε.</p>
                    <footer class="blockquote-footer">Ανδρέας</footer>
                </blockquote>
            </div>
        </div>
        <div class="text-center mt-3">
            <img src='{{ asset('svg/tips/4.svg') }}' height="300" alt=''>
        </div>
    </div>
</div>
@endsection
