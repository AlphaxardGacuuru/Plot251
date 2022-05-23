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
								 'F1'=> 'F1',
								 'F2' => 'F2',
								 'F3' => 'F3',
								 'F4' => 'F4',
								 'F5' => 'F5',
								 'F6' => 'F6',
								 'F7' => 'F7',
								 'F8' => 'F8',
								 'F9' => 'F9'
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
            {{ Form::submit('Save', ['class' => 'rounded-0 btn btn-success']) }}
            {!!Form::close()!!}
            </form>
        </center>
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection
