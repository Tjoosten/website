<div id="newUser" class="modal fade" role="dialog">
    <div class="modal-dialog">

        {{-- Modal content --}}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Creer een nieuwe gebruiker.</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('auth.new') }}" class="form-horizontal" method="POST">
                    {{-- CSRF Field --}}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-2">
                            Naam: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Naam" name="name" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">
                            Email: <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-10">
                            <input class="form-control" placeholder="Email adres" name="email" />
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-flat btn-success">Aanmaken</button>
                </form>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>