    <div class="form-group">
        <label>Category Level</label><span style="color: red;"> *</span>
        <select class="form-control select2" id="parent_id" name="parent_id" style="width: 100%;">
            @if(!old('section_id'))
                <option value="0">Main Category</option>
                @if(!empty($getCategories))
                    @foreach($getCategories as $getCategory)
                        <option value="{{ $getCategory->id }}">{{ $getCategory->category_name }}</option>
                        @if(!empty($category->subcategories))
                            @foreach($category->subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">-- {{ $subcategory->category_name }}</option>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @else
                <option value="0">Main Category</option>
                @if(!empty($getCategories))
                    @foreach($getCategories as $getCategory)
                        <option value="{{ $getCategory->id }}" @if($getCategory->id == old('parent_id')) selected @endif>{{ $getCategory->category_name }}</option>
                        @if(!empty($category->subcategories))
                            @foreach($category->subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">-- {{ $subcategory->category_name }}</option>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endif
        </select>
    </div>
