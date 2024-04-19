@extends('layouts.app')

@section('content')
<div class="container">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                    <b>{{ __('Dashboard') }}</b>
                    </div>
                    
                @if ($user->role_id === 2) 
                    <div>
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">{{__('tasks.add_task')}}</a>
                    </div>
                @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="mb-4">Role: {{ ucfirst($user->role->ime_role) }}</p>

                    @if ($user->role_id === 1)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nonAdminUsers as $nonAdminUser)
                                    <tr>
                                        <td>{{ $nonAdminUser->name }}</td>
                                        <td>{{ $nonAdminUser->email }}</td>
                                        <td>
                                            <form id="roleForm_{{ $nonAdminUser->id }}" action="{{ route('updateUserRole', $nonAdminUser->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="role_id" class="role-select">
                                                    <option value="" {{ is_null($nonAdminUser->role_id) ? 'selected' : '' }}>Empty</option>
                                                    <option value="2" {{ $nonAdminUser->role_id == 2 ? 'selected' : '' }}>Nastavnik</option>
                                                    <option value="3" {{ $nonAdminUser->role_id == 3 ? 'selected' : '' }}>Student</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if ($user->role_id === 2)
                    <table class="table mb-4">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Student</th>
                                    <th>Accept</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    @foreach ($task->users as $userAssigned)
                                        <tr>
                                            <td>
                                                {{ $task->naziv_rada }}({{ $task->engleski_naziv_rada }})
                                            </td>
                                            <td>
                                                {{ $userAssigned->name }}
                                            </td>
                                            <td>
                                                @if ($userAssigned->pivot->is_accepted)
                                                    Accepted
                                                @else
                                                    <a 
                                                        href="{{ route('tasks.accept', [$task->id, $userAssigned->id]) }}"
                                                        class="btn btn-primary">
                                                        Accept
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @if ($user->role_id === 3)
                    <div class="card-title"> <b>Assigned Tasks</b> </div>
                    <hr/>
                        <table class="table mb-4">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Description</th>
                                    <th>Unassign</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignedTasks as $assignedTask)
                                    <tr>
                                        <td>{{ $assignedTask->naziv_rada }}({{ $assignedTask->engleski_naziv_rada }})</td>
                                        <td>{{ $assignedTask->zadatak_rada }}</td>
                                        <td>
                                            <a href="{{ route('tasks.assign', $assignedTask->id) }}" class="btn btn-primary">Unassign</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <div class="card-title"> <b>Available Tasks</b> </div>
                        <hr/>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Description</th>
                                    <th>Assign</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availableTasks as $availableTask)
                                    <tr>
                                        <td>{{ $availableTask->naziv_rada }}({{ $availableTask->engleski_naziv_rada }})</td>
                                        <td>{{ $availableTask->zadatak_rada }}</td>
                                        <td>
                                            <a href="{{ route('tasks.assign', $availableTask->id) }}" class="btn btn-primary">Assign</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('select[name="role_id"]').change(function() {
                $(this).closest('form').submit();
            });
        });
    </script>

</div>
@endsection
