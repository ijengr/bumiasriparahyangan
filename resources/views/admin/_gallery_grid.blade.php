@foreach($images as $image)
	<div class="group">
		<label class="block">
			<div class="relative">
				<input type="checkbox" data-bulk value="{{ $image->id }}" class="absolute top-2 left-2 z-20 form-checkbox h-4 w-4 text-emerald-600 bg-white rounded">
				@include('admin._gallery_item', ['image' => $image])
			</div>
		</label>
	</div>
@endforeach
