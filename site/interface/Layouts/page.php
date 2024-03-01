<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="robots" content="noindex">

	<title>BLACC Media Manager</title>

	<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js" defer></script>
	<script src="//unpkg.com/alpinejs" defer></script>

	<script defer>
		document.addEventListener('DOMContentLoaded', function() {
			console.log('DOMContentLoaded');
		});
	</script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="antialiased lg:flex lg:flex-col lg:justify-stretch font-body lg:min-h-lvh">
	<div class="mx-auto">
		<?= $content ?>
	</div>
</body>

</html>
