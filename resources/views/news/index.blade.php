@extends('layouts.back-end')

{{-- TODO: Register create route. --}}
{{-- TODO: Register validation. --}}

@section('content-header')
<h1>
    Nieuwsberichten
    <small>Deel nieuws mee met ouders en leden.</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Nieuwsberichten</li>
</ol>
@endsection 

@section('content')
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_1" data-toggle="tab">
                Gepubliceerde nieuwsberichten.
            </a>
        </li>
        <li>
        	<a href="#tab_2" data-toggle="tab">
        		Klad nieuwsberichten
        	</a>
        </li>
        <li>
        	<a href="#tab_3" data-toggle="tab">
        		Nieuw nieuwsbericht.
        	</a>
        </li>
    </ul>

    <div class="tab-content">

        {{-- Published messages --}}
        <div class="tab-pane active" id="tab_1">
        	
        </div>
        {{-- /Published messages --}}

        {{-- Draft messages --}}
        <div class="tab-pane" id="tab_2">
        </div>
        {{-- /Draft messages --}}


		{{-- Create new message --}}
		<div class="tab-pane" id="tab_3">
			<div class="row">
				<div class="col-sm-10">
					<form action="" method="POST" class="form-horizontal">
						{{-- CSRF TOKEN --}}
						{{ csrf_field() }}

						{{-- Hidden inputs --}}
							<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
							<input type="hidden" name="state" value="1" >
						{{-- /Hidden inputs --}}

						<div class="form-group">
							<label for="titel" class="col-sm-1 control-label">
								Titel: <span class="text-danger">*</span>
							</label>

							<div class="col-sm-2">
								<input type="text" class="form-control" name="title" id="heading" placeholder="bericht titel">
							</div>
						</div>

						<div class="form-group">
							<label id="tags" class="col-sm-1 control-label">
								Categorie: {{-- <span class="text-danger">*</span> --}}
							</label>

							<div class="col-sm-2">
								<select multiple class="form-control" id="tags" name="tags">
									<option value="">-- Selecteer je categorie --</option>
									
									@foreach($tags as $tag)
										<option value="{{ $tag->id }}">{{ $tag->name }}</option>	
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="message" class="col-sm-1 control-label">
								Bericht: <span class="text-danger">*</span>
							</label>

							<div class="col-sm-4">
								<textarea class="form-control" rows="7" placeholder="Bericht" name="content" type="text" id="bericht"></textarea>
								<span class="help-block"><small>Dit veld is <a href="#">Markdown</a> gevoelig.</small></span>
							</div>
						</div>

						<div class="col-sm-offset-1">
							<button type="submit" class="btn btn btn-sm btn-flat btn-success">Aanmaken</button>
							<button type="reset" class="btn btn-flat btn-sm btn-danger">Reset</button>
						</div>

					</form>
				</div>				
			</div>
		</div>
		{{-- /Create new message --}}        
    </div> 
@endsection
