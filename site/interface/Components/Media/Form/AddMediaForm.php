<div x-data="dropzone" class="flex flex-col w-full md:w-96 p-8 bg-white md:rounded-lg gap-4">
	<svg id="Layer_2" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 225 105">
		<defs>
			<style>
				.cls-1 {
					fill: #ea2334;
				}

				.cls-1,
				.cls-2 {
					stroke-width: 0px;
				}

				.cls-2,
				.cls-3 {
					fill: #000;
				}

				.cls-3 {
					stroke: #000;
					stroke-miterlimit: 10;
					stroke-width: 2.69px;
				}
			</style>
		</defs>
		<g id="Layer_1-2" data-name="Layer 1">
			<g>
				<g>
					<path class="cls-2" d="M134.91,61.05c-2.54-1.5-4.55-3.52-6.03-6.05-1.48-2.54-2.22-5.32-2.22-8.35s.73-5.82,2.2-8.37c1.47-2.55,3.48-4.58,6.03-6.08,2.55-1.5,5.37-2.25,8.46-2.25,2.66,0,5.16.6,7.5,1.79,2.34,1.19,4.29,2.83,5.85,4.91l-5.27,3.94c-2.11-2.81-4.75-4.22-7.93-4.22-1.8,0-3.45.47-4.95,1.42-1.5.95-2.68,2.21-3.53,3.78-.86,1.57-1.28,3.26-1.28,5.07s.43,3.45,1.28,5.02c.86,1.57,2.03,2.84,3.53,3.78,1.5.95,3.15,1.42,4.95,1.42,3.15,0,5.79-1.42,7.93-4.26l5.27,4.04c-1.56,2.05-3.5,3.67-5.82,4.86-2.32,1.19-4.83,1.79-7.52,1.79-3.09,0-5.9-.75-8.44-2.25Z" />
					<path class="cls-2" d="M173.19,61.05c-2.54-1.5-4.55-3.52-6.03-6.05-1.48-2.54-2.22-5.32-2.22-8.35s.73-5.82,2.2-8.37c1.47-2.55,3.48-4.58,6.03-6.08,2.55-1.5,5.37-2.25,8.46-2.25,2.66,0,5.16.6,7.5,1.79,2.34,1.19,4.29,2.83,5.85,4.91l-5.27,3.94c-2.11-2.81-4.75-4.22-7.93-4.22-1.8,0-3.45.47-4.95,1.42-1.5.95-2.68,2.21-3.53,3.78-.86,1.57-1.28,3.26-1.28,5.07s.43,3.45,1.28,5.02c.86,1.57,2.03,2.84,3.53,3.78,1.5.95,3.15,1.42,4.95,1.42,3.15,0,5.79-1.42,7.93-4.26l5.27,4.04c-1.56,2.05-3.5,3.67-5.82,4.86-2.32,1.19-4.83,1.79-7.52,1.79-3.09,0-5.9-.75-8.44-2.25Z" />
					<path class="cls-1" d="M99.62,29.96h9.81l12.62,33.34h-8.05l-2.43-6.57h-14.1l-2.43,6.57h-8.05l12.62-33.34ZM109.38,50.63l-4.86-13-4.86,13h9.72Z" />
					<path class="cls-2" d="M73.21,29.96h7.86v38.65h113.19v6.43h-121.04V29.96Z" />
					<path class="cls-3" d="M30.03,31.24h24.1c4.04,0,7.28,1.07,9.74,3.22,2.46,2.14,3.68,5.01,3.68,8.59,0,2.16-.58,4.14-1.75,5.93-1.17,1.79-2.77,3.16-4.81,4.12,2.04.96,3.64,2.33,4.81,4.12,1.17,1.79,1.75,3.77,1.75,5.93,0,2.29-.56,4.33-1.69,6.12-1.12,1.79-2.7,3.18-4.71,4.18-2.02,1-4.34,1.5-6.96,1.5h-24.16V31.24ZM54.13,51.35c2.87,0,5.11-.79,6.71-2.37,1.6-1.58,2.4-3.56,2.4-5.93s-.8-4.4-2.4-5.96c-1.6-1.56-3.84-2.34-6.71-2.34h-19.86v16.61h19.86ZM54.13,71.46c2.87,0,5.11-.79,6.71-2.37,1.6-1.58,2.4-3.56,2.4-5.93s-.8-4.4-2.4-5.96c-1.6-1.56-3.84-2.34-6.71-2.34h-19.86v16.61h19.86Z" />
				</g>
				<path class="cls-2" d="M219,6v93H6V6h213M225,0H0v105h225V0h0Z" />
			</g>
		</g>
	</svg>
	<h1 class="text-2xl font-bold text-center">Event Media Uploader</h1>
	<form action="/api/v0/media/upload" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4 transition duration-300" @change="updateActions" @submit.prevent="uploadMedia">
		<div class="flex flex-col gap-4">
			<div>
				<label for="user" class="sr-only">User</label>
				<select name="user" id="user" x-model="User" class="block focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm border-gray-300 rounded-md text-gray-300" :class="{'text-gray-900' : User }">
					<option :selected="[null, 0, '0', ''].includes(User)" disabled hidden value>Select Your Name</option>
					<?php foreach ($users as $email => $name) : ?>
						<option value="<?= $email ?>"><?= $name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div>
				<label for="chapter" class="sr-only">Chapter</label>
				<select name="chapter" id="chapter" x-model="Chapter" class="block focus:ring-indigo-500 focus:border-indigo-500 w-full text-sm border-gray-300 rounded-md text-gray-300" :class="{'text-gray-900' : Chapter }">
					<option :selected="[null, 0, '0', ''].includes(Chapter)" disabled hidden value>Select Event Host Chapter</option>
					<?php foreach ($chapters as $code => $name) : ?>
						<option value="<?= $code ?>"><?= $name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div>
				<label for="event-date" class="sr-only">Event Date</label>
				<div class="relative">
					<div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
						<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
							<path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
						</svg>
					</div>
					<input x-data="datepicker" type="text" id="event-date" name="event-date" x-model="Event.date" :value="Event.date" class="w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5 placeholder:text-gray-300" placeholder="Select Event Date" readonly>
				</div>
			</div>
		</div>

		<section class="flex items-center justify-center">
			<label for="dropzone" class="relative flex flex-col items-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50" :class="Media.length === 0 ? 'justify-center' : 'justify-start md:overflow-y-scroll'" style="aspect-ratio: 1/1">
				<div x-show="Media.length === 0" class="flex flex-col items-center justify-center pt-5 pb-6">
					<svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
					</svg>
					<p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
					<p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
				</div>
				<input id="dropzone" name="media[]" type="file" multiple class="hidden" @change="attachMedia($event, {source: 'dialog'})" />
				<ul x-show="Media.length > 0" class="flex flex-col items-center justify-between w-full my-5 px-4 text-sm gap-2">
					<template x-for="(media, index) in Media" :key="index">
						<li :id="'media-' + (Number(index) + Number(1)).toString()" class="py-3 px-2 flex items-center justify-between w-full border border-dashed rounded-md border-gray-600 relative overflow-hidden">
							<p x-text="media.asset.name" class="w-[75%] text-gray-500 truncate z-10" :class="{ 'text-white' : media.upload.percent > 0 }"></p>
							<button type="button" x-show="media.upload.percent===0" @click="Media.splice(index, 1)" class="w-[20%] text-red-500 z-10 text-right">Remove</button>
							<p x-show="media.upload.percent>0" x-text="Media[index].upload.percent + '%'" class="w-[20%] text-white z-10 text-right">0%</p>
							<progress x-show="media.upload.percent>0" :value="media.upload.percent" max="100" class="absolute size-full inset-0 transition-all ease-linear"></progress>
						</li>
					</template>
				</ul>
			</label>
		</section>

		<button type="submit" class="mt-auto inline-flex justify-center rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="upload" @click.prevent="uploadMedia" :class="{ 'pointer-events-none' : !Actions.available.upload, 'opacity-50' : !Actions.available.upload }" :disabled="!Actions.available.upload">
			<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" :class="{ 'hidden' : !State.uploading.status }">
				<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
				<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
			</svg>
			<span x-text="State.uploading.label"></span>
		</button>
	</form>
	<div x-show="State.uploadSuccess" class="flex flex-col px-6 pt-4 bg-white rounded-lg gap-4 justify-center items-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
		<p class="h-auto font-medium text-xl text-center">Thanks. Your Media has been successfully uploaded</p>
	</div>
</div>
