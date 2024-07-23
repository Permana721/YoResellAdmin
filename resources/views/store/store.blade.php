<div id="modalChangeStore" class="modal bisa-geser fade text-left" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" >
                <h4>Change <span class="semi-bold">Store</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body col-md-12">
                {!! Form::open(array('route' => 'stores.changestore','method'=> 'POST')) !!}
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="form-group">
                            <strong>Store:</strong>
                            <select class="form-control select-data" name="store" required>
                                @foreach(changeStore() as $store)
                                <option value="{{ $store->initial }}" {{ $store->initial == Auth::user()->store ? 'selected' : ''}}>{{ $store->initial.' - '.$store->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button id="cmdCancel" class="btn btn-info" data-dismiss="modal" type="button">
                            <span>{{ __('general.cancel') }}</span>
                            </button>
                            <button id="cmdSave" class="btn btn-primary" type="submit">
                            <span class="simpanspan">{{ __('general.update') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
</div>