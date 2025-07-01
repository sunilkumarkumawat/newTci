<div class="col-md-3 col-12 box">
                            {{-- <div class=" "> --}}
                            <div class="d-grid text-center py-4 ">
                                <img id="profilePreview" src="{{ asset('defaultImages/excel.jpg') }}"
                                    class="img-fluid mb-3 p-1 border shadow-lg"
                                    style="width: 120px; height: 120px; object-fit: cover; border-radius:10px; border-color: #b3b3b37a "
                                    alt="Excel Upload">

                                <div class="custom-file mt-3 col-md-8 col-12    ">
                                    <input type="file" id="excelFile" accept=".xlsx, .xls" data-modal='{{$modal}}' />

                                </div>
                                {{-- <small id="fileName" class="form-text text-muted mt-2">No file selected</small> --}}
                            </div>
                            {{-- </div> --}}
                        </div>