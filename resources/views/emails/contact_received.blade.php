<!DOCTYPE html>
<html>
<head>

</head>
<body class="body" style="background:#eef0f1;padding:10px 40px 20px 40px;font-family: 'Open Sans',sans-serif;">
<div style="background:white;border-radius:10px;padding:0px 0px;margin:0px">
	<div style="text-align:center;width:100%;height:auto;background:#202e54;padding:0;margin-top:0px;border-top:1px;border-top-right-radius:10px;border-top-left-radius:10px;">
		<h1 style="color:#fff;padding:20px;">
			Aptimyze
		</h1>
	</div>
	<div style="padding:0px 40px">
		<h1 style="font-size:150%; color:#000;">
			Dear admin,
		</h1>
		<p style="color:#000;">
			You have received a contact us message from {{$first_name.' '.$last_name}}
		</p>
		<div style="background:#FAFDFE;border:2px solid #1E2C4F;display:inline-block;min-width:100%;overflow:hidden;border-radius:10px;">
			<div style="background:#1E2C4F;padding:10px 5px; color:white">
			</div>
			<div style="max-width:100%;padding:1.6% 2% 5% 2%;">
				<div style="max-width:47%;display:inline-block;float:left;width:100%;border: 2px solid grey;margin:1%;overflow:hidden;border-radius:10px">
					<div style="width:100%;padding:5px 6px"><strong>Salutation: </strong>{{ $salutation[$contact['salutation']] }} </div>
					<div style="width:100%;padding:5px 6px"><strong>First Name: </strong>{{ $contact['first_name'] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Last Name: </strong>{{ $contact['last_name'] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Email: </strong>{{ $contact['email'] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Phone: </strong>{{ $contact['phone'] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Organization: </strong>{{ $contact['organization'] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Country: </strong>{{ $countries[$contact['country']] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Test Phase: </strong>{{ $test_phase[$contact['test_phase']] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Current Tool: </strong>{{ $contact['current_tool'] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>App Type: </strong>{{ $type[$contact['type']] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Virtual User Load Requirement: </strong>{{ $load_requirement[$contact['load_requirement']] }}</div>
					<div style="width:100%;padding:5px 6px"><strong>Best way to reach: </strong>{{ $way[$contact->way] }}</div>

				</div>
				<div style="max-width:47.5%;display:inline-block;width:100%;border: 2px solid grey;margin:1%;overflow:hidden;border-radius:10px">
					<div style="width:100%;float:left;padding:5px 6px 5px"> Message: {{$contact['message']}}</div>
				</div>
			</div>
		</div>
		<p >
			To check all the messages, open {{url('/contact')}}
		</p>
	</div>
	<div style="padding:1px 30px 1px 30px;background:#17223E;color:white;border-bottom-left-radius:10px;border-bottom-right-radius:10px;margin-top:30px">
		<p style="text-align:center; color:#fff;margin-top:0px">
			&copy; {{ date('Y') }}. Aptimyze
		</p>
	</div>
</div>
</body>
</html>