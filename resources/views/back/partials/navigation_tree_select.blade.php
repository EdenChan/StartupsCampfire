<select class="form-control" name="parent_id" id="parent_id">
    <option value="">无</option>
    @foreach($navigation_tree as $navigation_level_1)
        <option value="{{ $navigation_level_1->id }}">|-{{ $navigation_level_1->name }}</option>
        <br>
    @endforeach
</select>