@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5><img src='{{ asset('svg/points.svg') }}' height="32" alt=''> Ιστορικό πόντων</h5>
            <hr />
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">

            @if (count($userActions) > 0)
            <div class="row small font-weight-bold">
                <div class="col-md-1">
                    Α/Α
                </div>
                <div class="col-md-2">
                    Ημ/νία ενέργειας
                </div>
                <div class="col-md-3">
                    Περιγραφή ενέργειας
                </div>
                <div class="col-md-3">
                    Εμπλεκόμενος τύπος χρήστη
                </div>
                <div class="col-md-3">
                    minipoints
                </div>
            </div>
            <hr />

            @foreach ($userActions as $userAction)
            <div class="row small">
                <div class="col-md-1">
                    {{ ($userActions ->currentpage()-1) * $userActions ->perpage() + $loop->index + 1 }}.
                </div>
                <div class="col-md-2">
                    {{ $userAction->created_at }}
                </div>
                <div class="col-md-3">
                    {{ $userAction->action->name }}
                    @if (!empty($userAction->achievement))
                    <br />
                    {{ $userAction->achievement->achievementType->name }}:
                    {{ $userAction->achievement->value }}
                    @endif
                </div>
                <div class="col-md-3">
                    @if ($userAction->otherUser != null)
                    {{ $userAction->otherUser->userType->name }}
                    @else
                    -
                    @endif
                </div>
                <div class="col-md-3">
                    <span class="badge badge-primary">+{{ $userAction->points }}</span>
                </div>
            </div>
            <hr />
            @endforeach

            <div class="row">
                <div class="col-md-12 small">
                    {{ $userActions->links() }}
                </div>
            </div>

            @else
            <p>Δε βρέθηκε ιστορικό πόντων.</p>
            @endif

            <div class="row mb-3">
                <div class="col-md-12 text-md-right text-sm-center">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#actionsModal">
                        Ενέργειες που δίνουν minipoints
                    </button>


                </div>
            </div>
        </div>

        <div class='col-md-3'>
            @tip(points)
        </div>
    </div>
</div>

<div class="modal fade" id="actionsModal" tabindex="-1" role="dialog" aria-labelledby="actionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="actionsModalLabel"><img height="24" src="{{ asset('svg/points.svg') }}" alt=""> Ενέργειες που δίνουν minipoints</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body small text-right">
                <div class="row font-weight-bold">
                    <div class="col-md-2 text-center">Α/Α</div>
                    <div class="col-md-8">Περιγραφή ενέργειας</div>
                    <div class="col-md-2 text-center">minipoints</div>
                </div>
                @forelse ($actions as $action)
                <div class="row">
                    <div class="col-md-2 text-center">
                        {{ $loop->iteration }}.
                    </div>
                    <div class="col-md-8">
                        {{ $action->name }}
                    </div>
                    <div class="col-md-2 text-center">
                        {{ $action->points }}
                    </div>
                </div>
                <hr />
                @empty
                -
                @endforelse
                <div class="row mt-3">
                    <div class="col-md-12">
                        Σε κάθε ενέργεια παίρνετε επιπλέον πόντους για κάθε miniuser που σας έχει προσθέσει στη λίστα αγαπημένων του.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Κλείσιμο</button>
            </div>
        </div>
    </div>
</div>

@endsection
