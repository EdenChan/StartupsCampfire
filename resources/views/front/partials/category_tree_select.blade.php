<select class="form-control" name="category_id" id="category-id">
    <option value="" disabled="" selected="">请选择动态分类</option>
    @foreach($category_tree as $category_level_1)
        <optgroup label="{{ $category_level_1->content }}">
            @foreach($category_level_1['children'] as $category_level_2)
                <option value="{{ $category_level_2->id }}">{{ $category_level_2->content }}</option>
            @endforeach
        </optgroup>
    @endforeach
</select>