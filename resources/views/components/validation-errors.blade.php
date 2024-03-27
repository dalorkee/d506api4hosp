@if ($errors->any())
	<div {{ $attributes }} style="padding: 10px; border: 1px solid rgb(243, 211, 211); border-radius: 10px;">
		<div class="font-medium text-red-600 text-center">{{ 'ไม่สามารถเข้าสู่ระบบได้' }}</div>
		<ul class="mt-3 list-disc list-inside text-sm text-red-600">
			@foreach ($errors->all() as $error)
				<li>
					<span class="text-red-800 text-xs font-medium mr-2 px-1 py-1 rounded">{{ $error }}</span>
				</li>
			@endforeach
		</ul>
	</div>
@endif
