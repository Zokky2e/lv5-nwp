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
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
                </div>
                @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Role: {{ ucfirst($user->role->ime_role) }}</p>

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
