<!-- resources/views/tasks/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
						<div>
						{{__('tasks.add_task')}}
						</div>
					<div>
					<a href="{{ route('home.switch', 'hr') }}">Hrvatski</a>
					<a href="{{ route('home.switch', 'en') }}">English</a>
					</div>
					</div>
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="naziv_rada">{{__('tasks.title')}}</label>
                                <input type="text" name="naziv_rada" id="naziv_rada" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="engleski_naziv_rada">{{__('tasks.english_title')}}</label>
                                <input type="text" name="engleski_naziv_rada" id="engleski_naziv_rada" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="zadatak_rada">{{__('tasks.assignment')}}</label>
                                <textarea name="zadatak_rada" id="zadatak_rada" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tip_studija">{{__('tasks.study_type')}}</label>
                                <select name="tip_studija" id="tip_studija" class="form-control" required>
                                    <option value="stručni">{{__('tasks.professional')}}</option>
                                    <option value="preddiplomski">{{__('tasks.undergraduate')}}</option>
                                    <option value="diplomski">{{__('tasks.graduate')}}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('tasks.add_task')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
