@extends('layouts.admin')

@section('content')
    <div class="content pt-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{ $checklist->name }}
                        </div>
                        <div class="card-body">
                            @forelse($checklist->tasks as $task)
                            <div class="accordion md-accordion" id="accordionEx" role="tablist"
                                 aria-multiselectable="true">

                                <!-- Accordion card -->
                                <div class="card">

                                    <!-- Card header -->
                                    <div class="card-header" role="tab" id="headingOne{{$task->id}}">
                                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne{{$task->id}}"
                                           aria-expanded="true"
                                           aria-controls="collapseOne{{$task->id}}">
                                            <h5 class="mb-0">
                                                <i class="nav-icon far fa-circle text-info"></i>
                                                {{$task->name}}
                                                <i class="fas fa-angle-down rotate-icon float-right"></i>
                                            </h5>
                                        </a>
                                    </div>

                                    <!-- Card body -->
                                    <div id="collapseOne{{$task->id}}" class="collapse" role="tabpanel"
                                         aria-labelledby="headingOne{{$task->id}}"
                                         data-parent="#accordionEx">
                                        <div class="card-body">
                                            {!! $task->description !!}
                                        </div>
                                    </div>

                                </div>
                                <!-- Accordion card -->
                                @empty
                                    No tasks found.
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



