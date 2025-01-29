            <div class="flex justify-center items-center" id="popupModal">
                <div class="w-full h-screen flex overflow-y-auto overflow-x-hidden fixed bg-[rgba(0, 0, 0, 0.5)] top-0 right-0 left-0 z-50 justify-center items-center">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h8 ms-auto inline-flex justify-center items-center" data-modal-hide=
                            "popupModal" id="btnClose" onclick="CloseModal()">
                                <i data-feather="x"></i>
                            </button>
                            <div class="flex flex-col justify-center items-center p-4 text-center">
                                <i data-feather="info" class="w-12 h-12"></i>
                                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this?</h3>
                                <div>
                                    <button data-modal-hide="popupModal" id="btnCancel" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:right-4 focus:ring-gray-100" onclick="CloseModal()">No, cancel</button>
                                    <button type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center" id="btnDelete">Yes, I'm sure</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>