<form action="{{ route('report.store') }}" method="POST">
@csrf

<input type="hidden" name="reported_id" value="{{ $reported_id }}">
<input type="hidden" name="booking_id" value="{{ $booking_id }}">

<select name="reason" class="border p-2 w-full mb-2">
    <option value="Late">Late</option>
    <option value="No Show">No Show</option>
    <option value="Rude">Rude Behavior</option>
</select>

<textarea name="description" class="border p-2 w-full mb-2"
placeholder="Explain the issue..." required></textarea>

<button class="bg-red-500 text-white px-4 py-2 rounded">
    Submit Report
</button>

</form>