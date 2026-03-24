<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduChain - Blockchain Degree Verification</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Material Icons & Google Fonts for Stitch Design -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24..48,100..700,0..1,-50..200" rel="stylesheet" />
    
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>
<body class="antialiased font-sans bg-gray-50 text-black/50 dark:bg-background-dark dark:text-white/50 grid-bg">
    <!-- React Root Entry Point -->
    <div id="hero-react-root"></div>
</body>
</html>