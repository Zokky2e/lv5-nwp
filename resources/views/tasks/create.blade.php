<!-- resources/views/tasks/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Kreiraj zadatak</div>
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="naziv_rada">Naslov rada</label>
                                <input type="text" name="naziv_rada" id="naziv_rada" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="engleski_naziv_rada">Engleski Naslov rada</label>
                                <input type="text" name="engleski_naziv_rada" id="engleski_naziv_rada" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="zadatak_rada">Tekst zadatka</label>
                                <textarea name="zadatak_rada" id="zadatak_rada" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tip_studija">Tip studija</label>
                                <select name="tip_studija" id="tip_studija" class="form-control" required>
                                    <option value="stručni">Stručni</option>
                                    <option value="preddiplomski">Preddiplomski</option>
                                    <option value="diplomski">Diplomski</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Kreiraj zadatak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
