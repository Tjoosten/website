<div id="searchUser" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Search user.</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('users.search') }}" class="form-horizontal">
                    {{-- CSRF Field --}}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-3">
                            Search Term: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-9">
                            <input class="form-control" placeholder="Search term" name="term" type="text">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-success">Search</button>
                </form>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>