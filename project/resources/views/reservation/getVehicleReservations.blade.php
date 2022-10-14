<form action="/reservation-getvehicle" method="post" enctype="multipart/form-data">
    <!-- Add CSRF Token -->
    @csrf
<div class="form-group">
    {{-- <label>start date</label>
    <input type="date" class="form-control" name="start_date" required>
</div>

<label>end date</label>
<input type="date" class="form-control" name="end_date" required> --}}


<label>vehicle id</label>
<input type="number"class="form-control" name="vehicle_id" required>


<button type="submit">Submit</button>
</form>