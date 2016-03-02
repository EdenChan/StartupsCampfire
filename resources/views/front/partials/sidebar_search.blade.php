<div class="well">
    <h4>搜全站</h4>
    <form action="{{ route('frontend::search.posts') }}" method="get">
        <div class="input-group">
            <input type="text" class="form-control" name="q">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
</div>