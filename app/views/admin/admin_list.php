            <div class="flex justify-between items-center px-5 py-6">
                <h1 class="text-2xl font-bold">Librarian Management</h1>
                <div class="flex space-x-4">
                    <button class="w-38 flex p-2 rounded-lg bg-black text-base text-white shadow-lg addNew" id="addBtn" onclick="showModal('popupModal')"><i data-feather="plus" class="w-6 h-6"></i>Add New</button>
                    <form action="<?= BASE_URL; ?>/admin/search" class="flex" method="post">
                        <input type="text" class="w-64 rounded-l-lg p-2 shadow-lg focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" placeholder="Search by ID or Name" id="search" name="search" autocomplete="off">
                        <button type="submit" id="btnSearch">
                            <i data-feather="search" class="w-10 h-10 bg-black ring-1 ring-black hover:bg-gray-100 hover:text-black text-white rounded-r-lg shadow-lg p-2"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <?php Flasher::flash(); ?>
            </div>
            <div class="w-full px-4">
                <div class="rounded-lg bg-white shadow-lg">
                    <table class="w-full text-base text-left rtl:text-right">
                        <tr class="text-center">
                            <th class="px-6 py-3 border-b-2 border-black">ID</th>
                            <th class="px-6 py-3 border-b-2 border-black">Name</th>
                            <th class="px-6 py-3 border-b-2 border-black">Email</th>
                            <th class="px-6 py-3 border-b-2 border-black">Role</th>
                            <th class="px-6 py-3 border-b-2 border-black">Action</th>
                        </tr>
                        <?php foreach($data['librarian'] as $lbrn): ?>
                            <tr class="text-center">
                                <td class="px-6 py-3"><?= $lbrn['id_petugas'] ?></td>
                                <td class="px-6 py-3"><?= $lbrn['nama'] ?></td>
                                <td class="px-6 py-3"><?= $lbrn['username'] ?></td>
                                <td class="px-6 py-3"><?= $lbrn['jabatan'] ?></td>
                                <td class="flex justify-center space-x-2 px-6 py-3">
                                    <button class="changeModal" onclick="showModal('popupModal')" data-id="<?= $lbrn['id_petugas']; ?>" data-type="getData">
                                        <i data-feather="edit" class="w-6 h-6"></i>
                                    </button>
                                    <button class="DeleteModal" id="deleteModalbtn" data-id="<?= $lbrn['id_petugas']; ?>" onclick="showModal('deleteModal')" data-type="delete">
                                        <i data-feather="trash" class="w-6 h-6"></i>
                                    </button>
                                    <button class="detailModal" onclick="showModal('detailModal')" data-id="<?= $lbrn['id_petugas']; ?>" data-type="getData">
                                        <i data-feather="info" class="w-6 h-6"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="hidden justify-center items-center" id="popupModal">
                <div class="w-full h-screen flex overflow-y-auto overflow-x-hidden bg-black-rgba fixed  top-0 right-0 left-0 z-50 justify-center items-center">
                    <div class="relative p-4 w-full max-w-xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow px-4 modal-body">
                            <div class="flex items-center justify-start p-8 border-b-2 border-black">
                                <i data-feather="briefcase" class="w-8 h-8"></i>
                                <h2 class="text-2xl ms-3" id="formLabel">Add New</h2>
                            </div>
                            <form action="<?= BASE_URL; ?>/admin/add_data" method="post">
                                <input type="hidden" id="id_petugas" name="id_petugas">
                                <input type="text" class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" id="name" name="nama" placeholder="Name">
                                <input type="email" class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 invalid:focus:border-pink-400 peer" id="email" name="email" placeholder="Email">
                                <input type="text" class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" id="addrss" name="addrss" placeholder="Alamat">
                                <div class="flex items-center justify-center gap-4">
                                    <input type="text" class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" id="pass" name="pass"  placeholder="Password">
                                    <input type="text" class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" id="roles" name="roles"  placeholder="Role">
                                </div>
                                <div class="flex items-center justify-center gap-4">
                                    <input type="text" class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" id="dateBorn" name="dateBorn"  placeholder="Date Of Birth">
                                    <input type="text" class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500" id="phoneNumber" name="phoneNumber" placeholder="Telp">
                                </div>
                                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h8 ms-auto inline-flex justify-center items-center" data-modal-hide=
                                "popupModal" id="btnClose" onclick="closeModal('popupModal')">
                                    <i data-feather="x"></i>
                                </button>
                                <div class="flex flex-col justify-center items-center p-4 text-center modal-footer">
                                    <div>
                                        <button data-modal-hide="popupModal" id="btnCancel" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-gray-200 rounded-lg border hover:bg-gray-100 hover:text-red-600 focus:z-10 focus:right-4 focus:ring-gray-100" onclick="closeModal('popupModal')">No, cancel</button>
                                        <button type="submit" class="text-white bg-black border hover:bg-gray-100 hover:text-green-400 focus:ring-4 focus:ring-slate-950 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center" id="btnDelete">Add New</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden justify-center items-center" id="deleteModal">
                <div class="w-full h-screen flex overflow-y-auto overflow-x-hidden bg-black-rgba fixed  top-0 right-0 left-0 z-50 justify-center items-center">
                    <div class="relative p-4 w-full max-w-xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow px-4 pb-8 modal-body">
                            <div class="flex items-center justify-start p-8 border-b-2 border-black">
                                <i data-feather="trash" class="w-8 h-8"></i>
                                <h2 class="text-2xl ms-3" id="formLabel">Delete Confirmation</h2>
                            </div>
                            <div class="w-full mx-auto my-4 text-lg">
                                <p>"Are you certain you wish to proceed with the deletion of the selected entry?"</p>
                            </div>
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h8 ms-auto inline-flex justify-center items-center" data-modal-hide=
                                "popupModal" id="btnClose" onclick="closeModal('deleteModal')">
                                    <i data-feather="x"></i>
                                </button>
                            <a href="" class="py-4 px-8 mt-8 text-white bg-black hover:bg-gray-100 hover:text-red-600 rounded-lg" id="deleteBtn">CONFIRM</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden justify-center items-center" id="detailModal">
                <div class="w-full h-screen flex overflow-y-auto overflow-x-hidden bg-black-rgba fixed  top-0 right-0 left-0 z-50 justify-center items-center">
                    <div class="relative p-4 w-full max-w-xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow px-4 pb-4 modal-body">
                            <div class="flex items-center justify-start p-8 border-b-2 border-black">
                                <i data-feather="info" class="w-8 h-8"></i>
                                <h2 class="text-2xl ms-3" id="formLabel">Detail Librarian</h2>
                            </div>
                            <div class="p-4 border my-4 rounded-lg text-lg text-left">
                                <p class="border-b mb-6 px-2" id="idDetail" name="idDetail">User ID: </p>
                                <p class="border-b mb-6 px-2" id="nameDetail" name="nameDetail">Name: </p>
                                <p class="border-b mb-6 px-2" id="emailDetal" name="emailDetal">Username: </p>
                                <p class="border-b mb-6 px-2" id="dateBornDetail" name="dateBornDetail">Date of Birth: </p>
                                <p class="border-b mb-6 px-2" id="rolesDetail" name="rolesDetail">Role: </p>
                                <p class="border-b mb-6 px-2" id="phoneNumberDetail" name="phoneNumberDetail">Number: </p>
                                <p class="border-b px-2" id="addrssDetail" name="addrssDetail">Address: </p>
                            </div>
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h8 ms-auto inline-flex justify-center items-center" data-modal-hide=
                                "popupModal" id="btnClose" onclick="closeModal('detailModal')">
                                    <i data-feather="x"></i>
                                </button>
                            <button class="w-1/2 h-16 bg-black text-white rounded-lg mt-2" onclick="closeModal('detailModal')">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>