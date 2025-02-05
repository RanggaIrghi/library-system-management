            <div class="flex justify-between items-center px-5 py-6">
                <h1 class="text-2xl font-bold">Returned Books Management</h1>
                <div class="flex space-x-4">
                    <button class="w-38 flex p-2 rounded-lg bg-black text-base text-white shadow-lg addNew" id="addBtn" onclick="showModal('popupModal')"><i data-feather="plus" class="w-6 h-6"></i>Add New</button>
                    <form action="<?= BASE_URL; ?>/admin/searchBorrowed" class="flex" method="post">
                        <input type="text" class="w-64 rounded-l-lg p-2 shadow-lg focus:outline-none focus:ring-1 focus:ring-sky-500 focus:border-sky-500" placeholder="Search by ID or NIK" id="search" name="search" autocomplete="off">
                        <button type="submit" id="btnSearch">
                            <i data-feather="search" class="w-10 h-10 bg-black ring-1 ring-black hover:bg-gray-100 hover:text-black text-white rounded-r-lg shadow-lg p-2"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex justify-center items-center">
                <?php Flasher::flash(); ?>
            </div>
            <div class="w-full px-4 block" id="borrBooks">
                <div class="rounded-lg bg-white shadow-lg">
                    <table class="w-full text-base text-left rtl:text-right">
                        <tr class="text-center">
                            <th class="px-6 py-3 border-b-2 border-black">ID</th>
                            <th class="px-6 py-3 border-b-2 border-black">Name</th>
                            <th class="px-6 py-3 border-b-2 border-black">Title</th>
                            <th class="px-6 py-3 border-b-2 border-black">Date Borrowed</th>
                            <th class="px-6 py-3 border-b-2 border-black">Due Date</th>
                            <th class="px-6 py-3 border-b-2 border-black">Returned Date</th>
                            <th class="px-6 py-3 border-b-2 border-black">Action</th>
                        </tr>
                        <?php foreach($data['pengembalian'] as $rtr): ?>
                            <tr class="text-center">
                                <td class="px-6 py-3"><?= $rtr['id_pinjam'] ?></td>
                                <td class="px-6 py-3"><?= $rtr['fullname'] ?></td>
                                <td class="px-6 py-3"><?= $rtr['judul'] ?></td>
                                <td class="px-6 py-3"><?= $rtr['tnggl_pinjam'] ?></td>
                                <td class="px-6 py-3"><?= $rtr['bts_pinjam'] ?></td>
                                <td class="px-6 py-3"><?= $rtr['tnggl_kembali'] ?></td>
                                <td class="flex justify-center space-x-2 px-6 py-3">
                                    <button class="detailModal" onclick="showModal('detailModal')" data-id="<?= $rtr['id_pinjam']; ?>" data-type="getBorrow">
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
                            <div class="flex items-center justify-start p-8 border-b-2 border-black mb-4">
                                <i data-feather="book-open" class="w-8 h-8"></i>
                                <h2 class="text-2xl ms-3" id="formLabel">Add New</h2>
                            </div>
                            <form action="<?= BASE_URL; ?>/admin/add_new" class="mb-4" method="post">
                                <input type="hidden" id="id" name="id">
                                <select class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 mb-4" name="bookId" id="bookId" placeholder="Select a Book" autocomplete="off">
                                    <option value="">Select a Book</option>
                                    <?php foreach($data['books'] as $bk): ?>
                                        <option value="<?= $bk['kode_buku']; ?>"><?= $bk['judul'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select class="w-full h-12 my-4 px-4 rounded-lg ring-2 ring-black focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 mb-4" name="userId" id="userId" >
                                    <option value="">Select User</option>
                                    <?php foreach($data['user'] as $usr): ?>
                                        <option value="<?= $usr['id_user']; ?>"><?= $usr['fullname'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="relative mt-4 mb-4">
                                    <input type="text" name="borrDate" id="borrDate" class="h-12 block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-black border-black ring-2 ring-black" placeholder="d-m-Y"/>
                                    <label for="borrDate" class="absolute text-sm text-black duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Borrow Date</label>
                                </div>
                                <div class="relative mt-8">
                                    <input type="text" name="dueDate" id="dueDate" class="h-12 block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-black border-black ring-2 ring-black" placeholder="d-m-Y "/>
                                    <label for="dueDate" class="absolute text-sm text-black duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Due Date</label>
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
            <div class="hidden justify-center items-center" id="detailModal">
                <div class="w-full h-screen flex overflow-y-auto overflow-x-hidden bg-black-rgba fixed  top-0 right-0 left-0 z-50 justify-center items-center">
                    <div class="relative p-4 w-full max-w-xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow px-4 pb-4 modal-body">
                            <div class="flex items-center justify-start p-8 border-b-2 border-black">
                                <i data-feather="info" class="w-8 h-8"></i>
                                <h2 class="text-2xl ms-3" id="formLabel">Detail Returned</h2>
                            </div>
                            <div class="p-4 border my-4 rounded-lg text-lg text-left">
                                <p class="border-b mb-6 px-2" id="idpinjamDetail" name="idpinjamDetail">ID: </p>
                                <p class="border-b mb-6 px-2" id="fullnmDetail" name="fullnmDetail">Name: </p>
                                <p class="border-b mb-6 px-2" id="titleDetail" name="titleDetail">Title: </p>
                                <p class="border-b mb-6 px-2" id="categoryDetail" name="emailDetal">Category: </p>
                                <p class="border-b mb-6 px-2" id="borrDetail" name="emailDetal">Borrowed: </p>
                                <p class="border-b mb-6 px-2" id="dueDetail" name="emailDetal">Due: </p>
                                <p class="border-b mb-6 px-2" id="penulisDetail" name="rolesDetail">Writer: </p>
                                <p class="border-b mb-6 px-2" id="petugasDetail" name="phoneNumberDetail">Librarian: </p>
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