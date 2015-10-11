@extends('layouts.master')

@section('content')

    <h1>Contact</h1>
    <div class="table-responsive">
        <div style="width:100%;padding:5px 6px"><strong>ID: </strong>{{ $contact->id }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Salutation: </strong>{{ $salutation[$contact->salutation] }} </div>
        <div style="width:100%;padding:5px 6px"><strong>First Name: </strong>{{ $contact->first_name }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Last Name: </strong>{{ $contact->last_name }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Email: </strong>{{ $contact->email }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Phone: </strong>{{ $contact->phone }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Organization: </strong>{{ $contact->organization }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Country: </strong>{{ $countries[$contact->country] }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Test Phase: </strong>{{ $test_phase[$contact->test_phase] }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Current Tool: </strong>{{ $contact->current_tool }}</div>
        <div style="width:100%;padding:5px 6px"><strong>App Type: </strong>{{ $type[$contact->type] }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Virtual User Load Requirement: </strong>{{ $load_requirement[$contact->load_requirement] }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Best way to reach: </strong>{{ $way[$contact->way] }}</div>
        <div style="width:100%;padding:5px 6px"><strong>Message: </strong>{{ $contact->message }}</div>
  </div>

@endsection
