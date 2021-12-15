@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit checklist') }}</div>
                    <form action="{{ route('admin.groups.checklists.update', [$group, $checklist]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror"
                                       value="{{ $checklist->name }}" id="name" name="name">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save checklist</button>
                        </div>
                    </form>
                </div>
                <form action="{{ route('admin.groups.checklists.destroy', [$group, $checklist]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        Delete checklist
                    </button>
                </form>
                <hr />

                <h2>List of Tasks</h2>
                    <div class="card">
                        <div class="card-header">{{ __('New task') }}</div>
                        <form action="{{ route('admin.checklists.tasks.create', $checklist) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class=" mb-2 form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" id="name" name="name" >
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="5"></textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save task</button>
                            </div>
                        </form>
                    </div>

            </div>
        </div>
    </div>
@endsection
