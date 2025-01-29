<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <title><?= $data['judul']; ?></title>
</head>
<body>
    <div class="w-full flex bg-gray-200">
        <nav class="w-48 h-screen bg-black text-white flex flex-col justify-between">
            <div class="flex flex-col justify-center items-center space-y-12">
                <div class="h-12 text-2xl">LIBRARY LOGO</div>
                <a href="<?= BASE_URL; ?>/admin" class="w-full flex items-center px-6 py-2"><i data-feather="grid" class="w-5 h-5"></i><span class="ms-3">Dashboard</span></a>
                <a href="<?= BASE_URL; ?>/admin/catalogs_list" class="w-full flex items-center px-6 py-2"><i data-feather="archive" class="w-5 h-5"></i><span class="ms-3">Catalog</span></a>
                <a href="<?= BASE_URL; ?>/admin/book_list" class="w-full flex items-center px-6 py-2"><i data-feather="book-open" class="w-5 h-5"></i><span class="ms-3">Books</span></a>
                <a href="<?= BASE_URL; ?>/admin/users_list" class="w-full flex items-center px-6 py-2"><i data-feather="users" class="w-5 h-5"></i><span class="ms-3">Users</span></a>
                <a href="<?= BASE_URL; ?>/admin/admin_list" class="w-full flex items-center px-6 py-2"><i data-feather="briefcase" class="w-5 h-5"></i><span class="ms-3">Librarian</span></a>
            </div>
            <div class="flex items-center justify-center py-24">
                <a href="<?= BASE_URL; ?>" class="w-full flex items-center px-6 py-2"><i data-feather="log-out" class="w-5 h-5"></i><span class="ms-3">Log Out</span></a>
            </div>
        </nav>
        <div class="w-full flex flex-col text-center">
            <div class="w-full h-16 flex justify-between items-center px-4 bg-white shadow-md">
                <div class="text-base">
                    <img src="" alt="" class="">
                    <div class="text-left">
                        <h2 class="text-xl">Mohammad Rangga Irghivya</h2>
                        <p class="text-sm">Admin</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="time" id="currentTime"></p>
                    <p class="text-sm"><?php echo date("d M Y"); ?></p>
                </div>
            </div>