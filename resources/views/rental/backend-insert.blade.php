<div id="insert" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Verhuring toevoegen.</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" method="POST" action="{{ route('rental.store') }}">
                        {{-- CSRF TOKEN --}}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="start" class="col-sm-3 control-label">
                                <span class="pull-right">
                                    {{ trans('rental.lease-start-date') }}
                                    <span class="text-danger">*</span>
                                </span>
                            </label>

                            <div class="col-sm-4">
                                <input id="start" class="form-control" name="start_date" type="date" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end" class="col-sm-3 control-label">
                                <span class="pull-right">
                                    {{ trans('rental.lease-end-date') }}
                                    <span class="text-danger">*</span>
                                </span>
                            </label>

                            <div class="col-sm-4">
                                <input id="end" class="form-control" name="end_date" type="date" /> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="group" class="col-sm-3 control-label">
                                <span class="pull-right">
                                    {{ trans('rental.lease-group') }}
                                    <span class="text-danger">*</span>
                                </span>
                            </label>

                            <div class="col-sm-5">
                                <input type="text" id="group" name="group" placeholder="Naam v/d groep" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">
                                <span class="pull-right">
                                    {{ trans('rental.lease-email') }}
                                    <span class="text-danger">*</span>
                                </span>
                            </label>

                            <div class="col-sm-5">
                                <input type="text" id="email" name="email" placeholder="Email adres" class="form-control" /> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="number" class="col-sm-3 control-label">
                                <span class="pull-right">
                                    {{ trans('rental.lease-phone-number') }}
                                </span>
                            </label>

                            <div class="col-sm-5">
                                <input type="tel" id="number" placeholder="Tel. nummer" name="phone_number" class="form-control" />
                            </div> 
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">
                    {{ trans('rental.lease-button-add') }}
                </button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    {{ trans('rental.lease-button-close') }}
                </button>
            </div>
        </div>

    </div>
</div>
