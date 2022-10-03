<form action="/incident-create" method="post">
    <!-- Add CSRF Token -->
    @csrf
<div class="form-group">
    <label>date</label>
    <input type="date" class="form-control" name="date" required>
</div>
<div class="form-group">
    <input type="file" name="photo" required>
</div>
<label>address</label>
<input type="text" class="form-control" name="address" required>


<label>description</label>
<input type="text" class="form-control" name="description" required>


<label>car id</label>
<input type="number"class="form-control" name="vehicle_id" required>

<button type="submit">Submit</button>
</form>