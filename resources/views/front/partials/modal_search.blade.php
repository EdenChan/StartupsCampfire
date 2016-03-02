<div class="modal fade" id="searchModal" tabindex="-1" role="dialog"
     aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    全站检索
                </h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('frontend::search.posts') }}">
                    <input name="q" type="text" class="form-control" placeholder="站内检索...">
                </form>
            </div>
        </div>
    </div>
</div>