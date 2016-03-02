<select class="form-control" name="parent_id" id="parent_id">
    <option value="">无</option>
    @foreach($category_tree as $category_level_1)
        <option value="{{ $category_level_1->id }}">|-{{ $category_level_1->content }}</option>
        <br>
    @endforeach
</select>