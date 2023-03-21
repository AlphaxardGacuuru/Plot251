@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <center>
            <h1>Water payments</h1>
            <h2>Hello Sir!</h2>
            <h4>Who has paid?</h4>
            {!!Form::open(["action" => "WaterPaymentsController@store", "method" => "POST"])!!}
            <br>
            {{ Form::select('apartment', [
								 'F1'=> 'Gacuuru wa Karenge',
								 'F2' => 'Gacuuru wa Karenge',
								 'F3' => 'Naomi',
								 'F4' => 'Shadrack',
								 'F5' => 'Katumbu',
								 'F6' => 'Salome',
								 'F7' => 'Angela Nzuki',
								 'F8' => 'Angienade',
								 'F9' => 'Phiona'
								 ], 
								 null, 
								 [
									 'class' => 'rounded-0 form-control', 
									 'placeholder' => 'Select apartment', 
									 'required'
									 ]) }}
            <br>
            {{ Form::number('amount', '', ['class' => 'rounded-0 form-control', 'placeholder' => 'Amount paid', 'required']) }}
            <br>
            {{ Form::submit('Save', ['class' => 'sonar-btn']) }}
            {!!Form::close()!!}
            </form>
        </center>
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection
