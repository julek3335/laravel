<form action="{{ url('user/edit/'.$user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputName1">Imię</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="imię" name="name" value="{{$user->name}}" required>
        </div>
        <div class="form-group">
            <label for="exampleInputSurname1">Nazwisko</label>
            <input type="text" class="form-control" id="exampleInputSurname1" placeholder="nazwisko" name="last_name" value="{{$user->last_name}}" required>
        </div>
        <div class="form-group">
            <label for="exampleStatus">Status</label>
            <input type="text" class="form-control" id="exampleStatus" placeholder="status" name="status" value="free">
        </div>
        <div class="form-group">
            <label for="exampleInputInputEmail">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail" placeholder="email" name="email" value="{{$user->email}}" required>
        </div>
        <div class="form-group">
            <label for="exampleInputDrivingLicence">Prawo jazdy</label>
            <input type="text" class="form-control" id="exampleInputDrivingLicence" placeholder="Prawo jazdy" name="driving_licence_category" value="{{$user->driving_licence_category}}">
        </div>
        <x-adminlte-input-file name="photo" label="Zdjęcie profilowe" legend="Wybierz" placeholder="Wybierz lub upuść zdjęcie" value="{{asset('storage/users_photos/'. $user->photo)}}">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-file>
        <div class="form-group">
            <label for="#">Uprawienia</label>
            <div class="form-group">
                <select class="form-control" id="#" name="auth_level">
                    <option value="0">Administrator</option>
                    <option value="1">Edytor</option>
                    <option value="2">Użytkownik</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Zatwierdź</button>
    </div>
</form>