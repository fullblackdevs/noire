<!DOCTYPE html>
<html class="h-dvh md:bg-gray-900">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="robots" content="noindex">

	<title>BLACC Media Manager</title>

	<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js" defer></script>

	<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>

	<script>
		document.addEventListener('alpine:init', () => {
			Alpine.data('dropzone', () => ({
				Media: [],
				User: null,
				Chapter: null,
				Event: {
					date: null,
					title: null
				},
				Actions: {
					available: {
						upload: false
					}
				},
				State: {
					uploading: {
						status: null,
						label: 'Submit Media'
					},
					uploadStart: true,
					uploadSuccess: null,
					formTransitions: {
						started: [],
						ended: []
					}
				},
				init() {
					console.log('Dropzone initialized')
					console.log(document.getElementsByTagName('form')[0])

					form = document.getElementsByTagName('form')[0]

					/* each time a new transition is detectd on the Form add it to an array */
					form.addEventListener('transitionstart', (e) => {
						this.State.formTransitions.started.push(e)
					})

					/* each time a transition ends add it to the ended transitions array
					 * then check if the Form has ended all transitions
					 */

					form.addEventListener('transitionend', (e) => {
						this.State.formTransitions.ended.push(e)
						console.log(this.State.formTransitions)

						if (this.State.formTransitions.started.length === this.State.formTransitions.ended.length) {
							console.log('All transitions have ended')
							// we can start our entrance transitions of the confirmation message
							form.classList.add('hidden')
							this.State.uploadSuccess = true
						}
					})
				},
				attachMedia(e, options) {
					const items = [...e.target.files]

					items.forEach((item, index) => {
						if (this.Media.some(asset => asset.name === item.name)) {
							console.log(`File ${item.name} already exists in the Media array`)
							return
						}

						this.Media[index] = {
							asset: item,
							upload: {
								percent: 0,
								status: null,
								complete: false
							}
						}
					})

					console.log(this.Media)
				},
				uploadMedia(e) {
					e.target.disabled = true
					this.Actions.available.upload = false
					this.State.uploading.label = "Uploading Media..."
					this.State.uploading.status = true

					let dropzone = e.target.closest('form').querySelector('label[for="dropzone"]')
					dropzone.addEventListener('click', (e) => {
						e.preventDefault()
					})

					console.log('Uploading media...')
					console.log(this.Media)

					this.Media.forEach((media, index) => {
						console.log(`Uploading ${media.asset.name}...`)
						// add support to upload media to the server

						this.simulateUpload(media, index)
					})
				},
				simulateUpload(media, index) {
					console.log(media)

					if (media.upload.percent >= 100) {
						media.upload.percent = 100
						media.upload.status = 'complete'
						media.upload.complete = true

						if (this.Media.every(media => media.upload.complete === true)) {
							this.State.uploading.label = "Media Uploaded"
							this.State.uploading.status = false

							setTimeout(() => {
								this.finishUpload()
							}, 600);
						}

						return
					}

					if (media.upload.percent < 100) {
						setTimeout(() => {
							const progress = Math.floor((Math.random() * (10 - 1 + 1) + 1))
							console.log('Increasing by ' + progress + '%')
							media.upload.percent += progress

							this.simulateUpload(media, index);
						}, 500);
					}

					console.log(`Uploading ${media.asset.name}... ${media.upload.percent}%`)
				},
				updateActions() {
					console.log('checking which Actions can be enabled')

					console.log(this.Media.length > 0)

					console.log(![null, 0, '0', ''].includes(this.User))
					console.log(this.User)

					console.log(![null, 0, '0', ''].includes(this.Chapter))
					console.log(this.Chapter)

					console.log(![null, 0, '0', ''].includes(this.Event.date))
					console.log(this.Event.date)

					if (this.Media.length > 0 &&
						![null, 0, '0', ''].includes(this.User) &&
						![null, 0, '0', ''].includes(this.Chapter) &&
						![null, 0, '0', ''].includes(this.Event.date)
					) {
						this.Actions.available.upload = true
					}
				},
				finishUpload() {
					// Start triggering transitions
					console.log('Media upload complete')
					this.State.uploadStart = false

					this.Actions.available.upload = false
					this.State.uploading.label = "Media Uploaded"

					form = document.getElementsByTagName('form')[0]
					form.classList.add('opacity-0')
					form.classList.add('scale-0')
				}
			}));

			Alpine.data('datepicker', () => ({
				Calendar: null,
				init() {
					import('https://cdn.jsdelivr.net/npm/flowbite-datepicker@1.2.6/+esm').then((module) => {
						Flowbite.Plugins = module;
						this.Calendar = new window.Flowbite.Plugins.Datepicker(this.$el, {
							format: 'mm-dd-yyyy',
							autohide: true,
							maxDate: new Date(),
						})

						const DatePicker = this.Calendar.pickerElement

						DatePicker.addEventListener('click', function($input, e) {
							if (typeof e.target.dataset.date !== 'undefined') {
								let dateChangeEvent = new Event('dateChange')
								$input.dispatchEvent(dateChangeEvent);
							}
						}.bind(this.Calendar, this.Calendar.inputField))

						//DatePicker.classList.add('w-full', 'flex', 'justify-stretch', 'content-stretch')
						DatePicker.querySelector('.datepicker-picker').classList.add('w-full')
						DatePicker.querySelector('.days').classList.add('w-full');
						DatePicker.querySelectorAll('.datepicker-view, .datepicker-grid').forEach((el) => {
							el.className = el.className.replace('w-64', 'w-[280px]')
						});

						DatePicker.addEventListener('click', function(e) {
							console.log(e);
							console.log(this.picker);
							if (this.picker.active) {
								this.picker.main.querySelectorAll('.datepicker-view, .datepicker-grid').forEach((el) => {
									el.classList.remove('w-64');
								})
							}

							const disabledDates = DatePicker.querySelectorAll('.datepicker-cell.disabled')
							console.log(disabledDates)
							disabledDates.forEach((date) => {
								date.addEventListener('click', function(e) {
									e.preventDefault()
									e.stopPropagation()
								})

								date.className = date.className.replace(/\b(dark:)\S+\s\b/g, '')
								date.className = date.className.replace(/\b(hover:)\S+\s\b/g, '')
								date.className = date.className.replace(/\b(text-gray-)\d+\s\b/g, '')
								date.classList.add('text-gray-300')
							})
						}.bind(this.Calendar));

						const disabledDates = DatePicker.querySelectorAll('.datepicker-cell.disabled')
						console.log(disabledDates)
						disabledDates.forEach((date) => {
							date.addEventListener('click', function(e) {
								e.preventDefault()
								e.stopPropagation()
							})

							date.className = date.className.replace(/\b(dark:)\S+\s\b/g, '')
							date.className = date.className.replace(/\b(hover:)\S+\s\b/g, '')
							date.className = date.className.replace(/\b(text-gray-)\d+\s\b/g, '')
							date.classList.add('text-gray-300')
						})

						this.Calendar.inputField.addEventListener('dateChange', function(e) {
							console.log('the date has changed')
							e.target._x_model.set(e.target.value)
							e.target.closest('form').dispatchEvent(new Event('change'))
						});

						// add support to change UI for disabled dates
						// add support to ensure picker UI matches text field
						console.log(this.Calendar)
						console.log('Datepicker initialized')
					})
				},
			}));
		})
	</script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

	<style>
		::-webkit-progress-bar {
			background-color: #94a3b8;
		}

		::-moz-progress-bar {
			background-color: #94a3b8;
		}

		progress::-webkit-progress-value {
			background: #14b8a6;
		}
	</style>
</head>

<body class="antialiased flex flex-col justify-start md:justify-center items-center font-body min-h-dvh overflow-y-scroll">
	<div class="md:mx-auto tracking-tighter w-screen md:w-96 overflow-y-visible md:py-10">
		<?= $content ?>
	</div>
</body>

</html>
