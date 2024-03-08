<!DOCTYPE html>
<html class="h-full md:bg-gray-900">

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
					uploadSuccess: null
				},
				init() {
					console.log('Dropzone initialized')
					console.log(this.Currently)
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

							this.State.uploadStart = false
							//this.State.uploadSuccess = true

							this.Actions.available.upload = false
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

						this.Calendar.pickerElement.addEventListener('click', function($input, e) {
							if (typeof e.target.dataset.date !== 'undefined') {
								let dateChangeEvent = new Event('dateChange');
								$input.dispatchEvent(dateChangeEvent);
							}
						}.bind(this.Calendar, this.Calendar.inputField));

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

<body class="antialiased flex flex-col lg:justify-stretch font-body h-dvh">
	<div class="flex flex-col h-full justify-start md:justify-center items-center md:mx-auto tracking-tighter w-screen md:w-96 grow">
		<?= $content ?>
	</div>
</body>

</html>
