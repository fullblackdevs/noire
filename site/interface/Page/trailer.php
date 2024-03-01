<h1 class="text-2xl">BLACC Media Manager</h1>

<form action="/upload" method="POST" enctype="multipart/form-data">
	<section>
		<div>
			<label for="title">User</label>
			<select name="user" id="user" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm border-gray-300 rounded-md">
				<option value="miquel@brazilliance.co">Miquel Brazil</option>
				<option value="imara.canady@ahf.org">Imara Canady</option>
				<option value="william.porch@ahf.org">William Porch</option>
			</select>
		</div>
		<div>
			<label for="chapter">Chapter</label>
			<select name="chapter" id="chapter" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm border-gray-300 rounded-md">
				<option value="CLE">Cleveland, OH</option>
				<option value="CHI">Chicago, IL</option>
				<option value="ATL">Atlanta, GA</option>
				<option value="FLL">Fort Lauderdale, FL</option>
			</select>
		</div>
		<div>
			<label for="chapter">Event Date</label>
			<div class="relative max-w-sm">
				<div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
					<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
						<path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
					</svg>
				</div>
				<input datepicker type="text" name="event-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
			</div>

		</div>
	</section>

	<section>
		<div class="flex items-center justify-center w-full">
			<label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
				<div class="flex flex-col items-center justify-center pt-5 pb-6">
					<svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
					</svg>
					<p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
					<p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
				</div>
				<input id="dropzone-file" name="media[]" type="file" multiple class="hidden" />
			</label>
		</div>
	</section>

	<button type="submit" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="upload">Submit Media</button>
</form>
