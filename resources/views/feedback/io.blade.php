@php($title = 'Investigating Officer Feedback')
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ $title }}</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
	</head>
	<body class="bg-gray-50">
		<div class="max-w-2xl mx-auto p-6">
			<h1 class="text-2xl font-semibold mb-4">Investigating Officer Feedback</h1>
			<div class="bg-white rounded shadow p-4 mb-6">
				<div class="text-sm text-gray-600">Case/Application</div>
				<div class="font-medium">{{ $record->name }} @if($record->mobile_no) ({{ $record->mobile_no }}) @endif</div>
				<div class="text-sm text-gray-600">Date: {{ optional($record->date)->format('d-m-Y') }} | Time: {{ $record->time }}</div>
			</div>

			@if(session('status'))
				<div class="mb-4 p-3 bg-green-50 text-green-700 rounded">{{ session('status') }}</div>
			@endif

	
			
			@if($record->status !== 'pending')
				<div class="mb-6 p-4 bg-yellow-50 text-yellow-800 rounded border border-yellow-200">
					Feedback submission is closed for this application.
				</div>
			@else
			

			<form method="POST" action="{{ route('feedback.io.submit', ['hash' => $hash]) }}" class="bg-white rounded shadow p-4">
				@csrf
				<label for="feedback" class="block text-sm font-medium text-gray-700 mb-1">Your Feedback</label>
				<textarea id="feedback" name="feedback" rows="6" class="w-full border rounded p-2 @error('feedback') border-red-500 @enderror" required></textarea>
				@error('feedback')
					<div class="text-red-600 text-sm mt-1">{{ $message }}</div>
				@enderror
				<div class="mt-4">
					<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
				</div>
			</form>
			
			@endif
		
		</div>
	</body>
</html>
