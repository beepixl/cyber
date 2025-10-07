<?php

namespace App\Http\Controllers;

use App\Models\ApplicationRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FeedbackController extends Controller
{
	public function showApplicant(string $hash)
	{
		$record = ApplicationRecord::query()->whereRaw('MD5(id) = ?', [$hash])->firstOrFail();
		return view('feedback.applicant', compact('record', 'hash'));
	}

	public function submitApplicant(Request $request, string $hash)
	{
		$record = ApplicationRecord::query()->whereRaw('MD5(id) = ?', [$hash])->firstOrFail();
		$validated = $request->validate([
			'feedback' => ['required', 'string', 'max:5000'],
		]);

		$date = now()->format('Y-m-d');
		$datetime = now()->format('d-m-Y h:i A');
		$newFeedback = "$datetime \n" . $validated['feedback'];
		if (!empty($record->applicant_feedback)) {
			$record->applicant_feedback .= "\n\n" . $newFeedback;
		} else {
			$record->applicant_feedback = $newFeedback;
		}
		$record->save();

		return redirect()->route('feedback.applicant', ['hash' => $hash])->with('status', 'Thank you! Your feedback was submitted.');
	}

	public function showIo(string $hash)
	{
		$record = ApplicationRecord::query()->whereRaw('MD5(id) = ?', [$hash])->firstOrFail();
		return view('feedback.io', compact('record', 'hash'));
	}

	public function submitIo(Request $request, string $hash)
	{
		$record = ApplicationRecord::query()->whereRaw('MD5(id) = ?', [$hash])->firstOrFail();
		$validated = $request->validate([
			'feedback' => ['required', 'string', 'max:5000'],
		]);

		$date = now()->format('Y-m-d');
		$datetime = now()->format('d-m-Y h:i A');
		$newFeedback = "$datetime \n" . $validated['feedback'];
		if (!empty($record->io_feedback)) {
			$record->io_feedback .= "\n\n" . $newFeedback;
		} else {
			$record->io_feedback = $newFeedback;
		}
		$record->save();

		return redirect()->route('feedback.io', ['hash' => $hash])->with('status', 'Thank you! Your feedback was submitted.');
	}
}
