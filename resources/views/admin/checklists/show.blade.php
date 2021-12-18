@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row col-2 justify-content-around">
                <h5 class="m-0">{{ $checklist->name }}</h5>
                <a href="{{ route('admin.groups.checklists.edit', [$group, $checklist]) }}"><i class="fas fa-edit"></i></a>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <td><a href="{{ route('admin.checklists.tasks.create', $checklist) }}"><i
                                            class="fas fa-plus"></i> Add a task</a></td>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td class="text-md"><i class="far fa-circle mr-2"></i> {{ $task->name }}</td>
                                    <td class="text-right"><a
                                            href="{{ route('admin.checklists.tasks.edit', [$checklist, $task]) }}"><i
                                                class="fas fa-edit"></i></a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No tasks.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

