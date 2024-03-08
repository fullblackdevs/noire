<div x-data="dropzone" class="w-full md:w-96">
	<form x-show="State.uploadStart" action="/api/v0/media/upload" method="POST" enctype="multipart/form-data" class="flex flex-col p-8 bg-white rounded-lg gap-4" @change="updateActions" @submit.prevent="uploadMedia"
		x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
		@transitionend="State.uploadSuccess=true"
	>
		<h1 class="text-2xl font-bold">BLACC Media Uploader</h1>
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

		<section>
			<div class="flex items-center justify-center w-full">
				<label for="dropzone" class="flex flex-col items-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50" :class="Media.length === 0 ? 'justify-center' : 'justify-start overflow-y-scroll'">
					<div x-show="Media.length === 0" class="flex flex-col items-center justify-center pt-5 pb-6">
						<svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
						</svg>
						<p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
						<p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</p>
					</div>
					<input id="dropzone" name="media[]" type="file" multiple class="hidden" @change="attachMedia($event, {source: 'dialog'})" />
					<ul x-show="Media.length > 0" class="flex flex-col items-center justify-between w-full mt-5 px-4 text-sm gap-2">
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
			</div>
		</section>

		<button type="submit" class="mt-auto inline-flex justify-center rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="upload" @click.prevent="uploadMedia" :class="{ 'pointer-events-none' : !Actions.available.upload, 'opacity-50' : !Actions.available.upload }" :disabled="!Actions.available.upload">
			<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" :class="{ 'hidden' : !State.uploading.status }">
				<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
				<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
			</svg>
			<span x-text="State.uploading.label"></span>
		</button>
	</form>
	<div x-show="State.uploadSuccess" class="flex flex-col p-8 bg-white rounded-lg gap-4 justify-center items-center md:h-auto"
		x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
	>
		<p class="h-auto font-medium">Your Media has been successfully uploaded.</p>
	</div>
</div>
