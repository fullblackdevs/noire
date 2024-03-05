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
				init() {
					console.log('Dropzone initialized')
				},
				attachMedia(e, options) {
					const items = [...e.target.files]
					this.Media.push(...items)
				},
				uploadMedia() {
					console.log('Uploading media...')
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
						// add support to change UI for disabled dates
						// add support to ensure picker UI matches text field
						console.log(this.Calendar)
						console.log('Datepicker initialized')
					})
				}
			}));
		})
	</script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="antialiased flex flex-col lg:justify-stretch font-body h-lvh">
	<div class="flex flex-col h-full justify-start md:justify-center items-center md:mx-auto tracking-tighter w-screen md:w-96 grow">
		<?= $content ?>
	</div>
</body>

</html>
