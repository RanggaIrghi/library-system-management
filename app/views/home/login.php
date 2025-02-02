<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/erimicel/select2-tailwindcss-theme/dist/select2-tailwindcss-theme-plain.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <title><?= $data['judul']; ?></title>
</head>
<body>
    <div class="flex items-center justify-center w-full h-screen bg-gray-200 px-12">
        <div class="w-1/2 h-1/2 flex flex-col items-center justify-center bg-white shadow-lg rounded-lg">
            <h1 class="mb-12 text-4xl font-bold">Welcome Back Librarian !!</h1>
            <p class="text-lg mb-8">Please enter your credentials to log in</p>
            <form action="<?= BASE_URL; ?>/home/authentication" method="POST" class="w-1/2 flex flex-col items-center justify-center">
                <input type="text" name="email" id="email" class="w-full h-12 ring-2 ring-black focus:ring-blue-400 p-4 rounded-lg mb-4" placeholder="example@gmail.com">
                <input type="password" name="pass" id="pass" class="w-full h-12 ring-2 ring-black focus:ring-blue-400 p-4 rounded-lg" placeholder="Password">
                <button type="submit" class="flex items-center justify-center w-1/2 px-8 py-4 text-white bg-black rounded-lg shadow-lg mt-4">LOG IN</button>
            </form>

        </div>
    </div>

<script>
      feather.replace();
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.2/dist/js/tom-select.complete.min.js"></script>
    <script src="<?= BASE_URL; ?>/js/javascript.js"></script>
</body>
</html>